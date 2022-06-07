$(function () {
    $('#register').click(function () {
        window.location = 'http://localhost/ItBlog/Web/register.php';
    });

    $('#aut').click(function () {
        window.location = 'http://localhost/ItBlog/Web/aut.php';
    });

    $('#exit').click(function () {

        let destroy = $("#exit").val();

        $.ajax({
            url: "/ItBlog/Web/basic.php",
            method: "GET",
            data: {
                'destroy': destroy,
            },
            dataType: "json",
            success: function (data) {
                alert(data);
            }
        });
        window.location = 'http://localhost/ItBlog/Web/index.php';
    });


    $('#search').click(function () {
        let search = $('#val').val();
        $.ajax({
            url: "/ItBlog/Web/index.php",
            method: "GET",
            data: {
                'search': search,
            },
            dataType: "json",
            success: function (data) {
                alert(data);
            }
        });
    });
});