<?php

include_once "../../ItBlog/Entity/News.php";
include_once "../../ItBlog/PDO/DaoBlog.php";


if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST["title"]);
//    $description = htmlspecialchars($_POST['description']);
//    $content = htmlspecialchars($_POST["content"]);

    $description = $_POST['description'];
    $content = $_POST["content"];

    $date = htmlspecialchars($_POST["date"]);

    if($date == null){
        $date = date("Y-m-d");
    }

    $file = htmlspecialchars($_FILES["fileToUpload"]['name']);
    $file_path = htmlspecialchars($_FILES['fileToUpload']['tmp_name']);
    /*Сохранение файла */
    $path = '../../ItBlog/resources/img/';
    $filename = iconv('utf-8', 'windows-1251', $file);
    $files = $path . $filename;
    if (move_uploaded_file($file_path, $files)) {
        $message = 'File is successfully uploaded.';
    } else {
        $message = 'Error.';
    }

    $news = new News($file, $title, $description, $content, $date);
    $file = $news->getFile();
    $title = $news->getTitle();
    $description = $news->getDescription();
    $content = $news->getContent();
    $data = $news->getDate();
    $dao_save = new DaoBlog();
    $dao_save->save($file, $title, $description, $content, $data);

?>
    <script>window.location = "http://localhost/ItBlog/Web/index.php";</script>
<?php
}

if (isset($_POST['updateForm'])) {
    $id = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);

//    $description = htmlspecialchars($_POST['description']);
//    $content = htmlspecialchars($_POST['content']);

    $description =$_POST['description'];
    $content = $_POST['content'];

    $date = htmlspecialchars($_POST['date']);
    $file = htmlspecialchars($_FILES['fileToUpload']['name']);
    $file_path = htmlspecialchars($_FILES['fileToUpload']['tmp_name']);
    $file_ajax = htmlspecialchars($_POST['file']);

    if ($file != null) {
        /*Сохранение файла */
        $path = $file_ajax;
        $path = '../../ItBlog/resources/img/';
        $filename = iconv('utf-8', 'windows-1251', $file);
        $files = $path . $filename;
        if (move_uploaded_file($file_path, $files)) {
            $message = 'File is successfully uploaded.';
        } else {
            $message = 'Error.';
        }
    } else {
        $file = $file_ajax;
    }

    $news = new News($file, $title, $description, $content, $date);
    $file = $news->getFile();
    $title = $news->getTitle();
    $description = $news->getDescription();
    $content = $news->getContent();
    $data = $news->getDate();
    $dao_save = new DaoBlog();
    $dao_save->update($id, $file, $title, $description, $content, $data);

    $url = "http://localhost/ItBlog/Web/index.php";
    header('Location:' . $url);
}

if (isset($_GET['type'])) {
    $id = htmlspecialchars($_GET['id']);
    $dao_delete = new DaoBlog();
    $dao_delete->delete($id);
}
