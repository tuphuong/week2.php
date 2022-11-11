// disabled-form
$("#forgot-form").submit(function () {
    return false;
})

function ChangePassword() {
    let username = getCookie("username");
    let curPassword = $("#cur-password").val();
    let newPassword = $("#new-password").val();
    let retypePassword = $("#retype-password").val();

    if (newPassword != retypePassword) {
        alert("Yêu cầu khớp mật khẩu");
        return;
    }
    else if (newPassword == curPassword) {
        alert("Yêu cầu mật khẩu mới phải khác mật khẩu hiện tại");
        return;
    }

    // console.log(email);
    // send
    $.ajax({
        type: "POST",
        url: "/user.php",
        data: {
            "username": username,
            "curPassword": md5(curPassword),
            "newPassword": newPassword
        },
        success: function (resp) {
            alert(resp["mesg"]);
        }
    });
}
