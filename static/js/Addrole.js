
function saveRole(role_number) {
    let payload = {
        'role_number': $('#role-' + role_number + '-id').val(),
        'role_name': $('#role-' + role_number + '-name').val(),
        'action': 'save'
    }
    console.log(payload);
    postRole(payload);
}

function deleteRole(role_number) {
    let payload = {
        'role_number': $('#role-' + role_number + '-id').val(),
        'role_name': $('#role-' + role_number + '-name').val(),
        'action': 'delete'
    }
    console.log(payload);
    postRole(payload);
}

function addRole() {
    let payload = {
        'role_number': $('#role-add-id').val(),
        'role_name': $('#role-add-name').val(),
        'action': 'add'
    }
    if (!payload["role_number"]) {
        alert("Điền ID cho quyền");
        return;
    }
    if (!payload["role_name"]) {
        alert("Điền tên cho quyền");
        return;
    }
    console.log(payload);
    postRole(payload);
}

function postRole(payload) {
    $.ajax({
        type: "POST",
        url: "/role.php",
        data: payload,
        success: function (resp) {
            alert(resp["mesg"]);
            location.reload();
        }
    });
}