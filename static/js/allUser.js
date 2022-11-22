
function saveUser(ID) {
    let payload = {
        'ID': $('#user-' + ID + '-id').val(),
        'username': $('#user-' + ID + '-username').val(),
        'PhoneNumber': $('#user-' + ID + '-PhoneNumber').val(),
        'email': $('#user-' + ID + '-email').val(),
        'Address': $('#user-' + ID + '-Address').val(),
        'role_number': $('#user-' + ID + '-Role').val(),
        'action': 'save'
    }
    if (!payload["username"]) {
        alert("Điền tên tài khoản cho người dùng");
        return;
    }
    if (!payload["PhoneNumber"]) {
        alert("Điền số điện thoại cho người dùng");
        return;
    }
    if (!payload["email"]) {
        alert("Điền email cho người dùng");
        return;
    }
    if (!payload["role_number"]) {
        alert("Điền ID quyền cho người dùng");
        return;
    }
    console.log(payload);
    postRole(payload);
}

function deleteUser(ID) {
    let payload = {
        'ID': $('#user-' + ID + '-id').val(),
        'action': 'delete'
    }
    console.log(payload);
    postRole(payload);
}

function addUser() {
    let payload = {
        'ID': $('#user-add-ID').val(),
        'username': $('#user-add-username').val(),
        'PhoneNumber': $('#user-add-PhoneNumber').val(),
        'email': $('#user-add-email').val(),
        'Address': $('#user-add-Address').val(),
        'role_number': $('#user-add-Role').val(),
        'action': 'add'
    }
    if (!payload["username"]) {
        alert("Điền tên tài khoản cho người dùng");
        return;
    }
    if (!payload["PhoneNumber"]) {
        alert("Điền số điện thoại cho người dùng");
        return;
    }
    if (!payload["email"]) {
        alert("Điền email cho người dùng");
        return;
    }
    if (!payload["role_number"]) {
        alert("Điền ID quyền cho người dùng");
        return;
    }
    console.log(payload);
    postRole(payload);
}

function postRole(payload) {
    $.ajax({
        type: "POST",
        url: "/allUser.php",
        data: payload,
        success: function (resp) {
            alert(resp["mesg"]);
            location.reload();
        }
    });
}