<?php
function checkPassword($password)
{
    $passwordErr = "";
    if (strlen($password) <= 8) {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
    } else if (!preg_match("#[0-9]+#", $password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
    } else if (!preg_match("#[A-Z]+#", $password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
    } else if (!preg_match("#[a-z]+#", $password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    } else if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Special Character!";
    }
    return $passwordErr;
}
function checkPhoneNumber($PhoneNumber)
{
    $PhoneNumberErr = "";
    $pattern = '(^(09|08|03)[0-9]{8}$)';
    if (!preg_match($pattern, $PhoneNumber)) {
        $PhoneNumberErr = "Invalid Phone Number format ";
    }
    return $PhoneNumberErr;
}

function checkEmail($email)
{
    $emailErr = "";
    $pattern = '(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)';
    if (!preg_match($pattern, $email)) {
        $emailErr = "Invalid email format ";
    }
    return $emailErr;
}
?>