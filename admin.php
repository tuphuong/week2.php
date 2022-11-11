<?php
require_once('helper/init.php');
$username = $_COOKIE["username"];
$db->execute("SELECT role FROM user WHERE username ='$username'");
$checkRole = $db->getData()[0];
if ($checkRole != '2') {
    header("Location: /user.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $db->execute("SELECT * FROM user WHERE username='$username'");
        $user = $db->getData();
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
            <script src="static/js/md5.min.js"></script>
            <script src="static/js/cookies.js"></script>
            <script src="static/js/change_password.js"></script>
        </head>

        <body>
            <ul style="z-index: 10">
                <li><a class="active" href="user.php">Thông tin cá nhân</a></li>
                <li><a class="active" href="allUser.php">QL Người dùng</a></li>
                <li><a href="role.php">Quản lý quyền</a></li>
                <li><a href="#" onclick="Logout()">Đăng xuất</a></li>
            </ul>
            <div class="limiter">
                <div class="container-table100">
                    <div class="wrap-table100">
                        <div class="table-div">
                            <table>
                                <thead><tr>
                                    <th style="width: 50%">Tài khoản</th>
                                </tr></thead>
                                <tbody><tr>
                                    <td style="width: 50%">' . $user["username"] . '</td>
                                </tr></tbody>
                            </table>
                            <table>
                                <thead><tr>
                                    <th style="width: 50%">Email</th>
                                </tr></thead>
                                <tbody><tr>
                                    <td style="width: 50%">' . $user["email"] . '</td>
                                </tr></tbody>
                            </table>
                            <table>
                                <thead><tr>
                                    <th style="width: 50%">SĐT</th>
                                </tr></thead>
                                <tbody><tr>
                                    <td style="width: 50%">' . $user["PhoneNumber"] . '</td>
                                </tr></tbody>
                            </table>
                            <table>
                                <thead><tr>
                                    <th style="width: 50%">Địa chỉ</th>
                                </tr></thead>
                                <tbody><tr>
                                    <td style="width: 50%">' . $user["Address"] . '</td>
                                </tr></tbody>
                            </table>
                            <table>
                                <thead><tr>
                                    <th>Đổi mật khẩu</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr></thead>
                                <tbody><tr>
                                    <td>
                                        <input id="cur-password" placeholder="Mật khẩu hiện tại" type="password">
                                    </td>
                                    <td>
                                        <input id="new-password" placeholder="Mật khẩu mới" type="password">
                                    </td>
                                    <td>
                                        <input id="retype-password" placeholder="Nhập lại mật khẩu" type="password">
                                    </td>
                                    <td>
                                        <i style="cursor:pointer" onclick="ChangePassword()" id="floppy-o-add" class="fa fa-floppy-o"  aria-hidden="true"></i>
                                    </td>
                                </tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>';

    } else {
        require_once('helper/DbConfig.php');
        require_once('helper/validation.php');
        $db = new Database();
        $db->connect();
        $curPassword = $_POST["curPassword"];
        $newPassword = $_POST["newPassword"];
        $passwordErr = checkPassword($newPassword);
        if ($passwordErr == "") {
            $db->execute("SELECT * FROM user WHERE username='$username' AND password='$curPassword'");

            $count_acc = $db->countRow();
            if ($count_acc == 0) {
                $resp = array(
                    "mesg" => "Change password fail"
                );
            } else {
                $hashPwd = md5($_POST["newPassword"]);
                // Signup success, then update db
                $sql_cmd = "UPDATE user SET password='$hashPwd' WHERE username='$username' AND password='$curPassword'";
                $db->execute($sql_cmd);
                $resp = array(
                    "mesg" => "Change password success"
                );
            }
        } else {
            $resp = array(
                "mesg" => $passwordErr
            );
        }

        header('Content-Type: application/json');
        echo json_encode($resp);
    }
}
?>