// $(function () {
//     $('#submit').click(function () {
//         $("#form1").css("display", "block");
//
//         let file = $('#file').val();
//
//         $.ajax({
//             url: "/ItBlog/Controller/newsAjax.php",
//             method: "POST",
//             data: {
//                 'file': file,
//             },
//             dataType: "json",
//             success: function (data) {
//                 alert("Отправка");
//             }
//         });
//     });
//
//     $('#cancel').click(function () {
//         $("#form1").css("display", "none");
//     })
//
//     $('#delete').click(function () {
//         let id = $('#delete').val();
//         let type = "delete";
//         window.location = "http://localhost/ItBlog/Web/index.php";
//         $.ajax({
//             url: "/ItBlog/Controller/newsAjax.php",
//             method: "GET",
//             data: {
//                 'id': id,
//                 'type': type,
//             },
//             dataType: "json",
//             success: function (data) {
//                 alert("Отправка");
//             }
//         });
//     });
//
//     $('#comment').click(function () {
//         $("#form2").css("display", "block");
//     });
//
//     $('#com_cancel').click(function () {
//         $("#form2").css("display", "none");
//     })
//
//     $('#comment_sub').click(function () {
//         let id = "<?=$id;?>";
//         let comments = $('#comments-text').val();
//         let date = $('#date').val();
//         let login = "<?=$login = $_SESSION['login'];?>";
//         let fio = "<?=$fio = $_SESSION['fio'];?>";
//
//
//         window.location = "http://localhost/ItBlog/Web/index.php";
//
//         $.ajax({
//             url: "/ItBlog/Controller/commentsAjax.php",
//             method: "POST",
//             data: {
//                 'id': id,
//                 'comments': comments,
//                 'date': date,
//                 'login': login,
//                 'fio': fio,
//             },
//             dataType: "json",
//             success: function (data) {
//                 alert("Отправка");
//             }
//         });
//
//     });
// });