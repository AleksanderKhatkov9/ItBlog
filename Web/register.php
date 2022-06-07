<?php
//include_once "D:/home/itBlog/web/basic.php";
include_once "../../ItBlog/web/header.php";
$img = '../resources/img/avatar.jpg';
?>

<link rel="stylesheet" type="text/css" href="../resources/css/register.css">
<script src="../resources/js/register.js"></script>


<div class="container">
    <form method="post" action="">
        <img src="<?= $img; ?>">

        <div class="dws-input">
            <input type="text" name="fio" id="fio" placeholder=" Введите ФИО">
        </div>

        <div class="dws-input">
            <input type="text" name="login" id="login" placeholder="Введите логин">
        </div>


        <div class="dws-input">
            <input type="password" name="password" id="password" placeholder="Введите пароль">
            <label style="color: #20c997" id="label-checkbox"><input type="checkbox" class="password-checkbox" id="password-checkbox" onclick="showPassword()">Показать пароль</label>
        </div>

        <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Почта">
        </div>

        <button type="button" class="dws-submit" name="submit" id="submit">Зарегистрироваться</button>
        <button type="button" class="dws-submit" name="return" id="return" style="display: none">На сайт</button>
    </form>
</div>

<script src="../resources/js/register.js"></script>

