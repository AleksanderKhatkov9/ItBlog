<?php
include_once "../../ItBlog/Entity/Comments.php";
include_once "../../ItBlog/PDO/DaoComments.php";

if (isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
//    $comments = htmlspecialchars($_POST['comments']);
    $comments =$_POST['comments'];
    $date = htmlspecialchars($_POST['date']);
    $login = htmlspecialchars($_POST['login']);
    $fio = htmlspecialchars($_POST['fio']);
    $comments = new Comments($comments, $date);
    $comments_form = $comments->getComments();
    $date = $comments->getDate();
    $dao_comments = new DaoComments();
    $dao_comments->save($comments_form, $date, $id, $login, $fio);
}