$("#login-form").submit(function () {
    return false;
})

// login
function Login() {
    let username = $("#username").val();
    let password = $("#password").val();
    let hashPwd = md5(password);
    console.log(username, password, hashPwd);

    // send
    $.ajax({
        type: "POST",
        url: "/login.php",
        data: {
            "username": username,
            "password": hashPwd
        },
        success: function (resp) {
            console.log(resp);
            if (resp["token"]) {
                // alert(resp["mesg"] + ". TOKEN: " + resp["token"]);
                alert(resp["mesg"]);
                clearCookies();
                setCookie('username', username);
                setCookie('token', resp['token']);
                setTimeout(() => {
                    location.href = '/user.php';
                }, 0);
            }
            else {
                alert(resp["mesg"]);
            }
        }
    });
}
