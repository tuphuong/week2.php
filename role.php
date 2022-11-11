<?php
require_once('helper/init.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db->execute("SELECT * FROM role");
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
            <script src="static/js/Addrole.js"></script>
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
                                            <input id="role-' . $row["role_number"] . '-id" value="' . $row["role_number"] . ' ">
                                        </td>
                                        <td>
                                            <input id="role-' . $row["role_number"] . '-name" value="' . $row["role_name"] . '">
                                        </td>
                                        <td>
                                            <i onclick="saveRole(' . "'" . $row["role_number"] . "'" . ')" id="floppy-o-' . $row["role_number"] . '"
                                            class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <i onclick="deleteRole(' . "'" . $row["role_number"] . "'" . ')" id="trash-' . $row["role_number"] . '"
                                            class="fa fa-trash" aria-hidden="true"></i>
                                        </td>
                                    </tr>';
    }
    echo '                          <tr>
                                        <td>
                                        <input id="role-add-id" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <input id="role-add-name" placeholder="here" value="">
                                        </td>
                                        <td>
                                            <i onclick="addRole(' . "'add'" . ')" id="floppy-o-add" class="fa fa-floppy-o" aria-hidden="true"></i>
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
    $role_number = $_POST["role_number"];
    $role_name = $_POST["role_name"];
    $action = $_POST["action"];
    if ($action == "save") {
        $db->execute("UPDATE role SET role_name='$role_name' WHERE role_number=$role_number");
        $resp = array("mesg" => "Chỉnh sửa thành công");

    } else if ($action == "delete") {
        $db->execute("DELETE FROM role WHERE role_number=$role_number");
        $resp = array("mesg" => "Xóa thành công");
    } else if ($action == "add") {
        $db->execute("INSERT INTO role (role_number, role_name) VALUES ($role_number, '$role_name')");
        $resp = array("mesg" => "Thêm thành công");
    }

    header('Content-Type: application/json');
    echo json_encode($resp);
}
?>