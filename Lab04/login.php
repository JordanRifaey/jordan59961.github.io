<!DOCTYPE html>
<!--
Author: Jordan Rifaey
Date:   3/7/2019
Project: Lab04
-->
<?php
require_once("LoginDataModel.php");
new LoginDataModel();
$error = false;
if (array_key_exists("username", $_POST) && array_key_exists("password", $_POST)) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    if (LoginDataModel::ValidateUser($username, $password) == true) {
        $errorMsg = "Valid credentials";
        include("fxCalc.php");
        exit();
    } else {
        $error = true;
    }
} else {
    $username = "";
    $password = "";
}
?>

<html>
    <body style="text-align:center">
        <script>
            if (<?php echo $error ?>) {
                alert("ACCESS DENIED! Tisk tisk tisk... it appears those are INVALID CREDENTIALS. Please try again.");
            }
        </script>
        <header>
            <h1><i>Money Banks Login</i></h1>
            <hr>
            <br>
        </header>
        <form name="<?php echo LoginDataModel::getIniLoginAttributes()[LoginDataModel::formHTMLNameAttribute] ?>" action="login.php" method="post">
            <label>Username:</label>
            <input type="text" name="<?php echo LoginDataModel::getIniLoginAttributes()[LoginDataModel::usernameHTMLNameAttribute] ?>" value="<?php echo $username ?>" />
            <br>
            <br>
            <label>Password:</label>
            <input type="password" name="<?php echo LoginDataModel::getIniLoginAttributes()[LoginDataModel::passwordHTMLNameAttribute] ?>" value="<?php echo $password ?>" />
            <br>
            <br>
            <button type="submit">Login</button>
            <button type="reset">Reset</button>
        </form>
    </body>
</html>