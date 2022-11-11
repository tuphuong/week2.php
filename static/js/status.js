function addStatus() {
    // let token = getCookie("token");
    let payload = {
        'content': $('#stt-add-content').val(),
        'action': 'add'
    }
    if (!payload["content"]) {
        alert("Điền nội dung status");
        return;
    }
    console.log(payload);
    postRole(payload);
}

function postRole(payload) {
    $.ajax({
        type: "POST",
        url: "/status.php",
        data: payload,
        success: function (resp) {
            alert(resp["mesg"]);
            location.reload();
        }
    });
}