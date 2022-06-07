<?php
include_once "../../ItBlog/Entity/User.php";
include_once "../../ItBlog/PDO/DaoUser.php";

if (isset($_POST['fio'])) {
    $fio = htmlspecialchars($_POST['fio']);
    $login = htmlspecialchars($_POST['login']);
    $passPost = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $password = $passPost;
    $user = new User($fio, $login, $password, $email);
    $fio = $user->getFio();
    $login = $user->getLogin();
    $password = $user->getPassword();
    $password = md5($password);
    $email = $user->getEmail();
    $dao_save = new DaoUser();
    $dao_save->save($fio, $login, $password, $email);
}



