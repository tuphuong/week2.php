<?php

require_once('helper/init.php');
$username = $_COOKIE["username"];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // get role
    $db->execute("SELECT role FROM user WHERE username ='$username'");
    $role = $db->getData()[0];

    $db->execute("SELECT * FROM status WHERE username = '$username'");
    // $status = array();
    $status = $db->getAllData();
    if ($status == null) {
        $status = array();
    }
    echo '<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Dashboard</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="static/css/dashboard/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="static/css/dashboard/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="static/css/dashboard/navbar.css">
            <link rel="stylesheet" type="text/css" href="static/css/dashboard/animate.css">
            <link rel="stylesheet" type="text/css" href="static/css/dashboard/main_v2.css">
            <script src="static/js/jquery.min.js"></script>
            <script src="static/js/cookies.js"></script>
            <script src="static/js/status.js"></script>
        </head>

        <body>
            <ul style="z-index: 10">
                <li><a class="active" href="user.php">Thông tin cá nhân</a></li>';
    if ($role == '2') {
        echo '
                <li><a class="active" href="allUser.php">QL Người dùng</a></li>
                <li><a href="role.php">Quản lý quyền</a></li>';
    }
    echo '
                <li><a class="active" href="status.php">Status</a></li>
                <li><a href="#" onclick="Logout()">Đăng xuất</a></li>
            </ul>
            <div class="limiter">
                <div class="container-table100">
                    <div class="wrap-table100">
                        <div class="table-div">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Nội dung</th>
                                        <th>Đăng</th>
                                    </tr>
                                </thead>
                                <tbody>';
    foreach ($status as $stt) {
        echo '  
                                    <tr>
                                        <td>
                                            ' . $stt["id"] . '
                                        </td>
                                        <td>
                                            ' . $stt["content"] . '
                                             
                                        </td>
                                        <td>
                                            <i onclick="saveStatus(' . "'" . $stt["username"] . "'" . ')" id="floppy-o-' . $stt["username"] . '"
                                        class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </td>
                                    </tr>';
    }
    echo '                          <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <input id="stt-add-content" placeholder="here" value="">    
                                        </td>
                                        <td>
                                            <i onclick="addStatus(' . "'add'" . ')" id="floppy-o-add" class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>';

} else {
    $content = $_POST["content"];
    $action = $_POST["action"];

    if ($action == "add") {
        $db->execute("INSERT INTO status ( content, username) VALUES ('$content', '$username')");
        $resp = array("mesg" => "Đăng status thành công");
    } else {
        $resp = array("mesg" => "Đăng status thất bại");
    }
    header('Content-Type: application/json');
    echo json_encode($resp);
}
?>