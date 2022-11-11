<?php
require_once('helper/init.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db->execute("SELECT * FROM user");
    $rows = $db->getAllData();

    // get role
    $username = $_COOKIE["username"];
    $db->execute("SELECT role FROM user WHERE username ='$username'");
    $role = $db->getData()[0];

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
            <script src="static/js/allUser.js"></script>
            <script src="static/js/cookies.js"></script>
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
                                        <th>ID</th>
                                        <th>Tài khoản</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Quyền</th>
                                        <th>Lưu</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>';

    foreach ($rows as $row) {
        echo '  
                                    <tr>
                                        <td>
                                            <input style="background: white" disabled id="user-' . $row["ID"] . '-id" placeholder="here" value="' . $row["ID"] . '">
                                        </td>
                                        <td>
                                            <input id="user-' . $row["ID"] . '-username" placeholder="here" value="' . $row["username"] . '">    
                                        </td>
                                        <td>
                                            <input id="user-' . $row["ID"] . '-PhoneNumber" placeholder="here" value="' . $row["PhoneNumber"] . '">
                                        </td>
                                        <td>
                                            <input id="user-' . $row["ID"] . '-email" placeholder="here" value="' . $row["email"] . '">
                                        </td>
                                        <td>
                                            <input id="user-' . $row["ID"] . '-Address" placeholder="here" value="' . $row["Address"] . '">
                                        </td>
                                        <td>
                                            <input id="user-' . $row["ID"] . '-Role" placeholder="here" value="' . $row["role"] . '">
                                        </td>
                                        <td>
                                            <i onclick="saveUser(' . "'" . $row["ID"] . "'" . ')" id="floppy-o-' . $row["ID"] . '" class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <i onclick="deleteUser(' . "'" . $row["ID"] . "'" . ')" id="trash-' . $row["ID"] . '" class="fa fa-trash" aria-hidden="true"></i>
                                        </td>
                                    </tr>';
    }
    echo '                          <tr>
                                        <td>
                                            <input id="user-add-id" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <input id="user-add-username" placeholder="here" value="">    
                                        </td>
                                        <td>
                                            <input id="user-add-PhoneNumber" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <input id="user-add-email" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <input id="user-add-Address" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <input id="user-add-Role" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <i onclick="addUser(' . "'add'" . ')" id="floppy-o-add" class="fa fa-floppy-o"  aria-hidden="true"></i>
                                        </td>
                                        <td></td>
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
    // get params
    $ID = $_POST["ID"];
    if (array_key_exists("role_number", $_POST)) {
        $role = $_POST["role_number"];
    }
    if (array_key_exists("username", $_POST)) {
        $username = $_POST["username"];
    }
    if (array_key_exists("email", $_POST)) {
        $email = $_POST["email"];
    }
    if (array_key_exists("PhoneNumber", $_POST)) {
        $PhoneNumber = $_POST["PhoneNumber"];
    }
    if (array_key_exists("Address", $_POST)) {
        $Address = $_POST["Address"];
    }
    if (array_key_exists("action", $_POST)) {
        $action = $_POST["action"];
    }


    // process
    if ($action == "save") {
        $sql_cmd = "UPDATE user SET username='$username', email='$email', PhoneNumber='$PhoneNumber', Address='$Address', role=$role WHERE ID=$ID";
        $db->execute($sql_cmd);
        $resp = array("mesg" => "Chỉnh sửa thành công");

    } else if ($action == "delete") {
        $db->execute("DELETE FROM user WHERE ID=$ID");
        $resp = array("mesg" => "Xóa thành công");
    } else if ($action == "add") {
        $db->execute("INSERT INTO user (username, email, PhoneNumber, Address, role) VALUES ('$username', '$email', '$PhoneNumber', '$Address', '$role')");
        $resp = array("mesg" => "Thêm thành công");
    }

    header('Content-Type: application/json');
    echo json_encode($resp);
}
?>