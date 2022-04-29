<?php
class DB {

        private static function connect() {     // connecting to database
                $pdo = new PDO('mysql:host=127.0.0.1;dbname=economy;charset=utf8', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
        }

        public static function query($query, $params = array()) {       // query method that execute the statement, setup to for multiple $params.
                $statement = self::connect()->prepare($query);
                $statement->execute($params);

                if (explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                return $data;
                }
        }

}