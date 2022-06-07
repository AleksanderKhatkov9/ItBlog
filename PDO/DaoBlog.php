<?php
include_once "../../ItBlog/Connect/Globals.php";
include_once "../../ItBlog/Controller/newsAjax.php";


class DaoBlog
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

    function save($file, $title, $description, $content, $data)
    {
        $connect = $this->connectPDO();
        $query = "INSERT INTO blog.news (file, title, description, content, date) VALUES (:file, :title, :description, :content, :date )";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':file', $file);
            $res->bindValue(':title', $title);
            $res->bindValue(':description', $description);
            $res->bindValue(':content', $content);
            $res->bindValue(':date', $data);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }


    function update($id, $file, $title, $description, $content, $data)
    {
        $connect = $this->connectPDO();
        $query = "UPDATE blog.news SET file =:file, title =:title, description =:description, content =:content, date = :date WHERE id =:id";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id', $id);
            $res->bindValue(':file', $file);
            $res->bindValue(':title', $title);
            $res->bindValue(':description', $description);
            $res->bindValue(':content', $content);
            $res->bindValue(':date', $data);
            $res->execute();

        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }

    }

    function delete($id)
    {
        $connect = $this->connectPDO();
        $query = "DELETE FROM blog.news WHERE id = :id";
        try {
            $res = $connect->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
    }

}