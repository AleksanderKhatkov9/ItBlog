<?php
include_once "../../ItBlog/Connect/Globals.php";
include_once "../../ItBlog/Web/header.php";

session_start();

if (isset($_SESSION['login'])) {
    $fio = $_SESSION['fio'];


    if(isset($_SESSION['fio']) == null){
        $fio = "";
    }else{
        $fio = $_SESSION['fio'];
    }

    try {
        $connection = Globals::getPDOConnection('blog');
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    try {
        $query = "SELECT users.fio,users.login, rules.rules_code FROM users JOIN users_rules ON users.id = users_rules.users_id JOIN rules ON users_rules.rules_id = rules.id WHERE  fio = :fio";
        $res = $connection->prepare($query);
        $res->bindValue(":fio", $fio);
        $res->execute();
        $num = $res->rowCount();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }

    foreach ($res as $value) {
        $rules = $value['rules_code'];
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Блог новостей</title>
    <link href="../resources/css/lib/bootstrap.min.css" rel="stylesheet">
    <script src="../resources/js/lib/bootstrap.bundle.min..js"></script>
    <script src="../resources/js/lib/jquery.min.js"></script>
</head>

<style>
    header {
        background-color: #303b44;
    }
    .nav li a {
        color: #faebd7; /* Цвет текста в блоках меню. */
        text-decoration: none;
    }
    .nav li a:hover {
        color: #2ca8c6; /* Цвет текста при наведении курсора мыши */
        text-decoration: none;
    }
</style>


<body>
<header class="p-3  text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"
               style="margin-right: -50px;">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <nav class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <ul class="nav nav-pills">
                    <a href="http://localhost/ItBlog/Web/index.php">
                        <img src="../resources/img/blog.png" style="width: 100px; height: 50px; margin-right: 50px;"></a>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="index.php">НОВОСТИ</a>
                    </li>
                    <div style="display: block" id="bloc-add">
                        <?php if ($rules == 10) { ?>
                        <li class="nav-item">
                            <a class="nav-link header-link" data-toggle="pill" href="new_form.php">ДОБАВИТЬ</a>
                        </li>
                        <?php }?>
                    </div>
                </ul>
            </nav>

            <form class="" style="display: flex;">
                <input type="search" class="form-control form-control-dark" name="val" id="val" placeholder="&#128270;"
                       aria-label="Search">
                <button type="submit" class="btn btn-outline-success my-2 my-sm-0" name="search" id="search"
                        style="color: antiquewhite;">Поиск
                </button>
            </form>

            <div class="text-end" style="color: #faebd7;" id="aut-text">
                <span tabindex="-1" id="ldap_auth_form_fio" style="display: inline; margin-left: 40px"><b
                            style="color:darksalmon">User: </b> <?= $fio; ?>
                </span>
            </div>

            <?php if ($fio == null) { ?>
                <div class="text-end" style="margin-left: 100px;" id="aut-text">
                    <button type="button" class="btn btn-outline-success" name="aut" id="aut" style="color: #faebd7">Войти</button>
                </div>
            <?php } else { ?>
                <div class="text-end" style="margin-left: 100px; color: #faebd7" id="exit-text">
                    <button type="button" class="btn btn-outline-danger" name="exit" id="exit" style="color: #faebd7" value="tru">Выйти</button>
                </div>
            <?php } ?>

        </div>
    </div>

</header>

<script src="../resources/js/basic.js"></script>
<?php
if (isset($_GET['destroy'])) {
    session_destroy();

}
?>

<script>

</script>




</body>
</html>
