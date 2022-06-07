<?php
include_once "../../ItBlog/Connect/Globals.php";
include_once "../../ItBlog/Controller/registerAjax.php";


class DaoUser
{
    public function connectPDO()
    {
        try {
            $connect = Globals::getPDOConnection('blog');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $connect;
    }

    public function create_guid()
    {

        $guid = '';
        $namespace = rand(11111, 99999);
        $uid = uniqid('', true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash, 0, 8) . '-' .
            substr($hash, 8, 4) . '-' .
            substr($hash, 12, 4) . '-' .
            substr($hash, 16, 4) . '-' .
            substr($hash, 20, 12);
        return $guid;
    }

    public function save($fio, $login, $password, $email)
    {

        $token = $this->create_guid();
        $connect = $this->connectPDO();
        $query = "INSERT INTO blog.users (fio, login, password, email, token) VALUES (:fio, :login, :password, :email,:token)";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':fio', $fio);
            $res->bindValue(':login', $login);
            $res->bindValue(':password', $password);
            $res->bindValue(':email', $email);
            $res->bindValue(':token', $token);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }
}