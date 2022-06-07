$('#submit').click(function () {
    let fio = $('#fio').val();
    let login = $('#login').val();
    let password = $('#password').val();
    let email = $('#email').val();

    if (fio.length === 0) {
        alert('Tile:\nfield to fill');
    }

    if (login.length === 0) {
        alert('Tile:\nfield to fill');
    }

    if (password.length === 0) {
        alert('Tile:\nfield to fill');
    }

    if (email.length === 0) {
        alert('Tile:\nfield to fill');
    }

    let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(email) === false) {
        alert('Введите корректный e-mail');
    }

    if (fio !== '' && login !== '' && password !== '' && email !== '') {
        window.location = "http://localhost/ItBlog/Web/index.php";
        $.ajax({
            url: "/ItBlog/Controller/registerAjax.php",
            method: "POST",
            data: {
                'fio': fio,
                'login': login,
                'password': password,
                'email': email,
            },
            dataType: "json",
            success: function (data) {
                if (data != null){
                    s(data);
                }
            }
        });
    }
});

function showPassword() {
    let password = document.getElementById("password");
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

