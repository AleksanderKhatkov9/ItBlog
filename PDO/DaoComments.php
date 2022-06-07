<?php
include_once "../../ItBlog/Connect/Globals.php";
include_once "../../ItBlog/Controller/commentsAjax.php";


class DaoComments
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


    function save($comments, $date, $id, $login, $fio)
    {
        $connect = $this->connectPDO();
        $query = "INSERT INTO blog.comments (comments, id_news, date_com, login, fio ) VALUES (:comments, :id, :date, :login, :fio )";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':comments', $comments);
            $res->bindValue(':id', $id);
            $res->bindValue(':date', $date);
            $res->bindValue(':login', $login);
            $res->bindValue(':fio', $fio);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }
}