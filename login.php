<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo '<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Classic Login Form Example</title>
            <link href="https://fonts.googleapis.com/css?family=Assistant:400,700" rel="stylesheet">
            <link rel="stylesheet" href="static/css/login.css">
            <script src="static/js/jquery.min.js"></script>
            <script src="static/js/md5.min.js"></script>
            <script src="static/js/cookies.js"></script>
        </head>

        <body>
            <section class="login" id="login">
                <div class="head">
                    <h1 class="company">SMTOWN &STORE</h1>
                </div>
                <p class="msg">Welcome back</p>
                <div class="form">
                    <form id="login-form" action="./login" method="POST">
                        <input type="text" placeholder="Username" class="text" id="username" name="username" autocomplete="off" required><br>
                        <input type="password" placeholder="••••••••••••••" class="password" id="password" name="password"
                            autocomplete="off" required><br>
                        <button class="btn-login" type="submit" id="do-login" style="cursor: pointer;"
                            onclick="Login()">Login</button>
                        
                        <a href="signup.php" class="forgot">Create an account </a>
                        
                    </form>
                </div>
            </section>
            <footer>
                <p>Made with <span class="heart">&hearts;</span> by TuPhuong(<a
                        href="https://github.com/tuphuong">@tuphuong</a>)</p>
            </footer>
            <script src="static/js/login.js"></script>
        </body>

        </html>';
} else {
    // POST METHOD
    require_once('helper/DbConfig.php');
    require_once('helper/validation.php');
    require_once('helper/security.php');
    try {
        $db = new Database();
        $db->connect();

        $username = htmlentities(SQLfilter($_POST["username"]));
        $password = htmlentities(SQLfilter($_POST["password"]));

        $err1 = SQLi_Whitelist($username);
        $err2 = SQLi_Whitelist($password);
        if ($err1 == "" && $err2 == "") {
            $password = md5($password);
            $sql_cmd = "SELECT * FROM user WHERE username='$username' AND password='$password'";
            $db->execute($sql_cmd);

            $data = $db->getDataPreventSqli();
            if ($data) {
                // Login success, then update token
                $md5_token = md5("user=$username&pass=$password&time=" . date("Y-m-d H:i:s"));
                $sql_cmd = "INSERT INTO session (token, time, username) VALUES ('$md5_token', '" . date("Y-m-d H:i:s") . "', '$username')";
                $db->execute($sql_cmd);
                $resp = array(
                    "token" => $md5_token,
                    "mesg" => "Login success"
                );
            } else {
                $resp = array(
                    "token" => "",
                    "mesg" => "Login fail"
                );
            }
        } else {
            $resp = array(
                "token" => "",
                "mesg" => "Login fail"
            );
        }

    } catch (Exception $err) {
        $resp = array(
            "token" => "",
            "mesg" => "Login fail"
        );
    }
    header('Content-Type: application/json');
    echo json_encode($resp);
}