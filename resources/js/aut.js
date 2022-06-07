function showPassword() {
    let password = document.getElementById("password");
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

$(function () {
    $('#submit').click(function () {
        let login = $('#login').val();
        let password = $('#password').val();

        if (login.length === 0) {
            alert('Логин:\nполе для заполнения');

        }
        if (password.length === 0) {
            alert('Пароль:\nполе для заполнения');
        }

        if (login !== '' && password !== '') {
            $.ajax({
                url: "/ItBlog/Web/aut.php",
                method: "POST",
                data: {
                    'login': login,
                    'password': password,
                },
                dataType: "json",
                success: function (data) {
                    alert("Отправка");
                }
            });
        }

    });
});