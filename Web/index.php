<?php
include_once "../../ItBlog/Connect/Globals.php";
include_once "../../ItBlog/Web/basic.php";

try {
    $connection = Globals::getPDOConnection('blog');
} catch (Exception $e) {
    echo $e->getMessage();
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

//количество записей для вывода страниц
$size_page = 4;
// Вычисляем с какого объекта начать выводить
$from = ($page - 1) * $size_page;

if (isset($_GET['search']) != null) {
    $search = htmlspecialchars($_GET['val']);
    $query = "SELECT * FROM blog.news Where id >0 AND title like '%$search%' ORDER BY date DESC LIMIT $from, $size_page";
} else {
    $query = "SELECT * FROM blog.news Where id >0  ORDER BY date DESC LIMIT $from, $size_page";
}

try {
    $res = $connection->prepare($query);
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

    <link rel="stylesheet" type="text/css" href="../resources/css/index.css">
    <div class="container mt-3">
        <div class="card" style="width: 1024px">
            <div class="row-3" id="title">
                <a href="http://localhost/ItBlog/Web/article.php?id=<?= $id; ?>"><h3><?= $title; ?></h3></a>
            </div>

            <img style="margin: 20px;" src="<?= $file_path; ?>">

            <div class="row-3" id="description">
                <p style="tab-size: 20px"><?= $description; ?></p>
            </div>
            <hr>
            <div class="row-3" id="date">
                <p>Дата публикации: <b><?= $Date; ?> </b></p>
            </div>
            <hr>
            <div class="row-3" id="button">
                <a href="http://localhost/ItBlog/Web/article.php?id=<?= $id; ?>" class="btn btn-outline-success" style="font-weight: bold">Читать далее &#x27a2;</a>
            </div>
        </div>
    </div>
    <br>

    <?php
}


if (isset($_GET['page']) or isset($_GET['page']) == null) {

    $query = 'SELECT COUNT(*) FROM blog.news ';
    try {
        $result = $connection->prepare($query);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $count_p = $result[0]['COUNT(*)'];
        $pagesCount = ceil($count_p / $size_page);
        ?>

        <div class="row text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a href="../../ItBlog/Web/index.php?page=1" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><a>
                    </li>
                    <?php for ($i = 1; $i <= $pagesCount; $i++) { ?>
                        <?php if($_GET['page'] == $i){?>
                            <li class="page-item active"><a href="../../ItBlog/Web/index.php?page=<?= $i; ?>" class="page-link"><?= $i ?></a></li>
                            <?php continue; ?>
                        <?php }?>
                        <li class="active"><a href="../../ItBlog/Web/index.php?page=<?= $i; ?>" class="page-link"><?= $i ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a href="../../ItBlog/Web/index.php?page=<?= $i = $i - 1; ?>" aria-label="Next" class="page-link">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    <?php
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }
}
?>
<?php include_once "../../ItBlog/Web/footer.php" ?>