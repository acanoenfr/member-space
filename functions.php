<?php

    /**
     * Test if a data is correct
     * - Prevent security flaw
     *
     * @param string $data
     * @return string
     */
    function testData(string $data): string
    {
        return htmlspecialchars(stripcslashes(trim($data)));
    }

    /**
     * Connect to database
     *
     * @param string $host
     * @param string $name
     * @param string $user
     * @param string $pass
     * @param boolean $debug
     * @return PDO|null
     */
    function connect(string $host, string $name, string $user, string $pass, bool $debug = false): ?PDO
    {
        try {
            $pdo = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            if ($debug) {
                die($e->getMessage());
            } else {
                die('Database error, please contact an administrator !');
            }
        }
    }

    /**
     * Detect if the user is connected
     *
     * @return bool
     */
    function isConnected(): bool
    {
        if (isset($_COOKIE['sid'])) {
            $db = connect('localhost', 'membre', 'root', 'root', true);
            $req = $db->prepare("SELECT sid FROM users WHERE sid = :sid LIMIT 1");
            $req->execute([
                "sid" => $_COOKIE['sid']
            ]);
            if ($req->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }
