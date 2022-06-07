<?php include_once "../../ItBlog/web/basic.php"; ?>

    <link rel="stylesheet" type="text/css" href="../resources/css/new_form.css">
    <script src="../resources/js/plagin/ckeditor/ckeditor.js"></script>


    <div class="form-div">
        <form method="post" action="/../ItBlog/Controller/newsAjax.php" enctype="multipart/form-data">
            <div class="container mt-3">
                <div class="card" style="width:1200px">
                    <div class="form-group" style="display: none">
                        <input type="text" name="news_id" id="news_id">
                    </div>

                    <h2 style="text-align: center; padding-top: 30px">Добавить новую статью &#128221;</h2><br>

                    <div class="mb-3" id="content-style">
                        <label for="file" class="form-label" style="" id="text">Выбрать файл &#128194;</label>
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"
                               accept=".jpg, .jpeg, .png" placeholder="добавить файл">
                    </div>

                    <div class="mb-3" id="content-style">
                        <label for="title" class="form-label" id="text">Заголовок &#128195;</label>
                        <textarea class="form-control" name="title" id="title" rows="1"
                                  placeholder="Заголовок статьи"></textarea>
                    </div>


                    <div class="mb-3" id="content-style">
                        <label  class="form-label" id="text">Описание &#128214;</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3" id="content-style">
                        <label class="form-label" id="text">Контент &#128172;</label>
                        <textarea name="content" id="content" class="form-control"></textarea>

                    </div>

                    <div class="mb-3" id="content-style">
                        <label for="date" class="form-label" id="text">Дата &#128197;</label>
                        <input type="date" class="form-control" name="date" id="date" placeholder="">
                    </div>
                    <br>

                    <div class="mb-3" id="content-style">
                        <button type="submit" class="btn btn-outline-success" name="submit" id="submit"
                                style="font-weight: bold ">Отправить &#128190;
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>


<script>
    $(function () {
        let editor1 = CKEDITOR.replace('content');
        let editor2 = CKEDITOR.replace('description');

    });
</script>

<?php include_once "footer.php" ?>