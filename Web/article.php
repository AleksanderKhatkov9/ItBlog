<?php

include_once "../../ItBlog/Web/basic.php";
include_once "../../ItBlog/Connect/Globals.php";



if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_SESSION['login'])) {
    $fio = $_SESSION['fio'];
    $login = $_SESSION['login'];

    try {
        $connection = Globals::getPDOConnection('blog');
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $query = "SELECT users.fio,users.login, rules.rules_code FROM users 
JOIN users_rules ON users.id = users_rules.users_id
JOIN rules ON users_rules.rules_id = rules.id WHERE  fio = :fio";

    try {
        $res = $connection->prepare($query);
        $res->bindValue(":fio", $fio);
        $res->execute();
        $num = $res->rowCount();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }

    foreach ($res as $value) {
        $login_db = $value['login'];
        $rules = $value['rules_code'];
    }
}

try {
    $query = "SELECT * FROM news WHERE id=:id";
    $res = $connection->prepare($query);
    $res->bindValue(':id', $id);
    $res->execute();
    $num = $res->rowCount();
    $res = $res->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
}

for ($i = 0; $i < $num; $i++) {
    $id = $res[$i]['id'];
    $file = $res[$i]['file'];
    $title = $res[$i]['title'];
    $description = $res[$i]['description'];
    $content = $res[$i]['content'];
    $date = $res[$i]['date'];
    list($year, $month, $day) = explode("-", $date);
    $Date = "${day}.${month}.${year}";
    $file_path = '../resources/img/' . $file;
    ?>

    <link rel="stylesheet" type="text/css" href="../resources/css/article.css">
    <script src="../resources/js/article.js"></script>
    <script src="../resources/js/plagin/ckeditor/ckeditor.js"></script>

    <div class="container mt-3">
        <div class="card" style="width:1024px">
            <div class="row-3" id="title">
                <h3 style="text-align: center; padding-top: 10px;"><?= $title; ?></h3>
            </div>

            <img style="margin: 20px; " src="<?= $file_path; ?>"><br>

            <div class="row-3" id="description-article">
                <p><?= $description; ?></p>
            </div>

            <div class="row-3" id="content-article">
                <p><?= $content; ?></p>
            </div>

            <hr>
            <div class="row-3" id="date-article">
                <p>Дата публикации: <b><?= $Date; ?> </b></p>
            </div>
            <br>
            <div class="row-3" style="display: block" id="del_news">

                            <?php if ($rules == 10) { ?>
                <button type="button" class="btn btn-success" name="submit" id="submit">Изменить</button>
                <button type="submit" name="delete" id="delete" value="<?= $id; ?>" class="btn btn-danger"
                        style="margin-left: 10px;">Удалить
                </button>
                                <?php } ?>
            </div>
        </div>
        <br>

        <?php
        try {
            $query = "SELECT comments.id, comments.comments, comments.date_com, comments.login, comments.fio FROM news
            JOIN comments ON news.id = comments.id_news Where news.id=:id";

//            $query = "SELECT * FROM news JOIN comments ON news.id = comments.id_news Where news.id=:id";
            $res = $connection->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
            $num = $res->rowCount();
            $res = $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
        }
        ?>

        <?php for ($i = 0; $i < $num; $i++) {
            $comments = $res[$i]['comments'];
            error_reporting(E_ALL);
            }
            if ($comments != null) {

                ?>
        <div class="card" style="width:1024px">
            <div class="row-3" id="title-comments">
                <h2 style="">Комментарии &#128584;&#x1f649;&#x1f64a;</h2>
            </div>
            <?php }

            ?>
            <?php for ($i = 0; $i < $num; $i++) {
                $comments = $res[$i]['comments'];
                $date_com = $res[$i]['date_com'];
                $login = $res[$i]['login'];
                list($year, $month, $day) = explode("-", $date_com);
                $Date2 = "${day}.${month}.${year}";
                ?>

                <hr>
                <div class="row-3" id="comments" style="margin-left: 30px">
                    <p style="font-size: 20px">&#128526; <?= $login; ?> <?= $Date2; ?> </p>
                    <?= $comments; ?>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>


    <div class="container mt-3" style="display: none" id="form1">
        <form method="post" action="../../ItBlog/Controller/newsAjax.php" enctype="multipart/form-data">
            <div class="container mt-3">
                <div class="card" style="width:1024px">
                    <div class="form-group" style="display: none">
                        <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                    </div>
                    <h2 style="text-align: center; padding-top: 20px;">Изменить статью &#128221;</h2><br>
                    <div class="mb-3" id="img">
                        <img src="<?= $file_path; ?>" style="width: 20%;">
                        <label for="file" class="form-label">&#128206; <?= $file; ?></label>
                        <input type="hidden" name="file" id="file" value="<?= $file; ?>">
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"
                               value="<?= $file_path; ?>" accept=".jpg, .jpeg, .png" placeholder="">
                    </div>

                    <div class="mb-3" id="title-article">
                        <label for="title" class="form-label" id="text">Заголовок &#128195;</label>
                        <textarea class="form-control" name="title" id="title" rows="1"
                                  placeholder=""><?= $title; ?></textarea>
                    </div>
                    <div class="mb-3" id="description-div">
                        <label for="description" class="form-label" id="text">Описание &#128214;</label>
                        <textarea class="form-control" name="description"
                                  id="description"><?= $description; ?></textarea>
                    </div>
                    <div class="mb-3" id="content-div">
                        <label for="content" class="form-label" id="text">Контент &#128172;</label>
                        <textarea class="form-control" name="content" id="content"><?= $content; ?></textarea>
                    </div>
                    <div class="mb-3" id="date-div">
                        <label for="date" class="form-label" id="text">Дата &#128197;</label>
                        <input type="date" class="form-control" name="date" id="date" value="<?= $date; ?>"
                               placeholder="">
                    </div>
                    <div class="mb-3" id="button-div">
                        <button type="submit" class="btn btn-success" name="updateForm" id="updateForm">Изменить
                        </button>
                        <button type="button" class="btn btn-danger" style="margin-left: 10px;" name="cancel"
                                id="cancel">Отмена
                        </button>
                        <button type="button" class="btn btn-outline-primary" style="margin-left: 10px;" name="comment"
                                id="comment">Оставить отзвы
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>

    <div class="container mt-3" style="display: none" id="form2">
        <form method="post" action="" enctype="">
            <div class="container mt-3">
                <div class="card" style="width:1024px">

                    <div class="mb-3">
                        <h3 style="text-align: center; padding-top: 20px">Оставить отзыв &#x1f601;</h3><br>
                    </div>

                    <div class="mb-3" id="review-div">
                        <label for="comment" class="form-label" id="text">Отзыв &#128172;</label>
                        <textarea class="form-control" name="comments-text" id="comments-text"></textarea>
                    </div>


                    <div class="mb-3" id="review-date">
                        <label for="date" class="form-label" id="text">Дата отзыва &#128197;</label>
                        <input type="date" class="form-control" name="date" id="date" placeholder="">
                    </div>
                    <div class="mb-3" id="commit-div">
                        <button type="button" class="btn btn-success" name="comment_sub" id="comment_sub">Добавить
                            &#128192;
                        </button>
                        <button type="button" class="btn btn-danger" name="com_cancel" style="margin-left: 20px;"
                                id="com_cancel">Отмена
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    ?>

    <script>
        $(function () {
            let editor1 = CKEDITOR.replace('content');
            let editor2 = CKEDITOR.replace('description');
            let editor3 = CKEDITOR.replace('comments-text');

            $('#submit').click(function () {
                $("#form1").css("display", "block");
                let file = $('#file').val();

                $.ajax({
                    url: "/ItBlog/Controller/newsAjax.php",
                    method: "POST",
                    data: {
                        'file': file,
                    },
                    dataType: "json",
                    success: function (data) {
                        alert("Отправка");
                    }
                });
            });

            $('#cancel').click(function () {
                $("#form1").css("display", "none");
            })

            $('#delete').click(function () {
                let id = $('#delete').val();
                let type = "delete";
                window.location = "http://localhost/ItBlog/Web/index.php";
                $.ajax({
                    url: "/ItBlog/Controller/newsAjax.php",
                    method: "GET",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    dataType: "json",
                    success: function (data) {
                        alert("Отправка");
                    }
                });
            });

            $('#comment').click(function () {
                $("#form2").css("display", "block");
            });

            $('#com_cancel').click(function () {
                $("#form2").css("display", "none");
            })

            $('#comment_sub').click(function () {
                let id = "<?=$id;?>";
                let comments = editor3.getData();
                let date = $('#date').val();
                let login = "<?=$login = $_SESSION['login'];?>";
                let fio = "<?=$fio = $_SESSION['fio'];?>";

                window.location = "http://localhost/ItBlog/Web/index.php";

                $.ajax({
                    url: "/ItBlog/Controller/commentsAjax.php",
                    method: "POST",
                    data: {
                        'id': id,
                        'comments': comments,
                        'date': date,
                        'login': login,
                        'fio': fio,
                    },
                    dataType: "json",
                    success: function (data) {
                        alert("Отправка" + data);
                    }
                });

            });
        });
    </script>

    <?php
}
?>

<?php include_once "../../ItBlog/web/footer.php" ?>





