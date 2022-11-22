<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo '<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Classic Signup Form Example</title>
        <link href="https://fonts.googleapis.com/css?family=Assistant:400,700" rel="stylesheet">
        <link rel="stylesheet" href="static/css/signup.css">
        <script src="static/js/jquery.min.js"></script>
        <script src="static/js/md5.min.js"></script>
    </head>

    <body>
        <section class="signup" id="signup">
            <div class="head">
                <h1 class="company">SMTOWN &STORE</h1>
            </div>
            <p class="msg">Welcome</p>
            <div class="form">
                <form id="signup-form" action="./signup" method="POST" autocomplete="off">
                    <input type="text" placeholder="Username*" class="text" id="username" name="username" required><br>
                    <input type="password" placeholder="Password*" class="password" id="password" name="password"
                        required><br>
                    <input type="text" placeholder="Email*" class="text" id="email" name="email" required><br>
                    <input type="text" placeholder="PhoneNumber*" class="text" id="PhoneNumber" name="PhoneNumber" required><br>
                    <input type="text" placeholder="Address" class="text" id="Address" name="Address"><br>
                    <button class="btn-signup" type="submit" id="do-signup" style="cursor: pointer;"
                        onclick="Signup()">Signup</button>
                </form>
            </div>
        </section>
        <footer>
            <p>Made with <span class="heart">&hearts;</span> by TuPhuong(<a
                    href="https://github.com/tuphuong">@tuphuong</a>)</p>
        </footer>
        <script src="static/js/signup.js"></script>
    </body>

    </html>';
} else {
    // POST METHOD
    require_once('helper/DbConfig.php');
    require_once('helper/validation.php');
    $db = new Database();
    $db->connect();
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordErr = checkPassword($password);
    if ($passwordErr == "") {
        $email = $_POST["email"];
        $emailErr = checkEmail($email);
        if ($emailErr == "") {
            $PhoneNumber = $_POST["PhoneNumber"];
            $PhoneNumberErr = checkPhoneNumber($PhoneNumber);
            if ($PhoneNumberErr == "") {
                $Address = $_POST["Address"];
                $db->execute("SELECT * FROM user WHERE username='$username'");

                $data = $db->countRow();
                if ($data == 0) {
                    $hashPwd = md5($_POST["password"]);
                    // Signup success, then update db
                    $sql_cmd = "INSERT INTO user (username, password, email, PhoneNumber, Address) VALUES ('$username', '$hashPwd', '$email', '$PhoneNumber', '$Address')";
                    $db->execute($sql_cmd);
                    $resp = array(
                        "mesg" => "Signup success"
                    );
                } else {
                    $resp = array(
                        "mesg" => "Signup fail"
                    );
                }
            } else {
                $resp = array(
                    "mesg" => $PhoneNumberErr
                );
            }
        } else {
            $resp = array(
                "mesg" => $emailErr
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
?>