<?php

class Globals
{
    /**
     * @var array name connection to db.sql, login, password, host
     */
    static $pdo_connection_data = [
        ['blog','root','sa@12345#','127.0.0.1']];


    /** Connection to database (PDO)
     * @param name name connection to db.sql
     * @param db.sql name database
     * @return DaoBlog new connection to PDO
     * @throws PDOException
     */

    static function getPDOConnection($name)
    {
        foreach (self::$pdo_connection_data as &$str) {
            if ($str[0] == $name) {
                $db = $str[0];
                $host = $str[3];
                $dsn = 'mysql:host='.$host.'; dbname='.$db;
                $username = $str[1];
                $password = $str[2];
                return new PDO($dsn, $username, $password);
            }
        }
        throw new PDOException("Connection $name was not found!");
    }

}