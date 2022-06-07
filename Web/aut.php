<?php
//include_once "D:/home/itBlog/web/basic.php";
include_once "../../ItBlog/Connect/Globals.php";
include_once "../../ItBlog/web/header.php";
?>
<?php
$img = '../resources/img/avatar.jpg';

session_start();

try {
    $connection = Globals::getPDOConnection('blog');
} catch (Exception $e) {
    echo $e->getMessage();
}
?>


<link rel="stylesheet" type="text/css" href="../resources/css/aut.css">
<script src="../resources/js/aut.js"></script>

<div class="container">
    <form method="post" action="../../ItBlog/Web/aut.php" enctype="">
        <img src="<?= $img; ?>">
        <div class="dws-input">
            <input type="text" name="login" id="login" placeholder=" Введите логин">
        </div>

        <div class="dws-input">
            <input type="password" name="password" id="password" placeholder="Введите пароль">
            <label style="color: #20c997" id="label-checkbox"><input type="checkbox" class="password-checkbox" id="password-checkbox" onclick="showPassword()">Показать пароль</label>
        </div>

        <button type="submit" class="dws-submit" name="submit" id="submit">Войти</button>
        <button type="button" class="dws-button" name="reg" id="register" style="">Регестрация</button>


        <div style="display: none" id="check">
            <p class="text-danger" style=" font-weight: bold">Не правельный логин и пароль</p>
        </div>

        <div style="display: none" id="input">
            <p class="text-success">Авторизация</p>
        </div>
    </form>
</div>


<?php
if (isset($_POST['login'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $password_hash = md5($password);
    $query = "SELECT * FROM blog.users WHERE  login = :login AND  password = :password";
    try {
        $res = $connection->prepare($query);
        $res->bindValue(':login', $login);
        $res->bindValue(':password', $password_hash);
        $res->execute();
        $num = $res->rowCount();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }
    for ($i = 0; $i < $num; $i++) {
        $fio = $res[$i]['fio'];
        $login_db = $res[$i]['login'];
        $password_db = $res[$i]['password'];
    }
    if (($login_db && $password_db) != null) {
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['fio'] = $fio;
        $info_input = "Авторизация = " . $fio

    ?>
        <script>
            $("#input").css('display', 'block');
            window.location = 'http://localhost/ItBlog/Web/index.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            $(function () {
                $('#register').click(function () {
                    window.location = 'http://localhost/ItBlog/Web/register.php';
                });
            });
        </script>

        <script>
            $("#check").css('display', 'block');
        </script>

   <?php
    }
}
?>





