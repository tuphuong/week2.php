$("#signup-form").submit(function () {
    return false;
})

// Signup
function Signup() {
    let username = $("#username").val();
    let password = $("#password").val();
    let hashPwd = md5(password);
    let email = $("#email").val();
    let PhoneNumber = $("#PhoneNumber").val();
    let Address = $("#Address").val();
    console.log(username, password, hashPwd, email, PhoneNumber, Address);

    // send
    $.ajax({
        type: "POST",
        url: "/signup.php",
        data: {
            "username": username,
            "password": password,
            "email": email,
            "PhoneNumber": PhoneNumber,
            "Address": Address
        },
        success: function (resp) {
            console.log(resp);
            if (resp["mesg"] == 'Signup success') {
                alert(resp["mesg"]);
                setTimeout(() => {
                    location.href = 'login.php';
                }, 3000);
            }
            else {
                alert(resp["mesg"]);
            }
        }
    });
}