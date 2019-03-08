<?php

class LoginDataModel {

    const usernameHTMLNameAttribute = "username";
    const passwordHTMLNameAttribute = "password";
    const formHTMLNameAttribute = "form";

    private static $iniUsersArray;
    private static $iniLoginAttributesArray;

    function LoginDataModel() {
        define("iniLoginFile", "login.ini");
        define("iniUsersFile", "fxUsers.ini");
        self::$iniUsersArray = parse_ini_file(iniUsersFile);
        self::$iniLoginAttributesArray = parse_ini_file(iniLoginFile);
        //print_r(self::$iniArray);
    }

    public static function validateUser($username, $password) {
        if (array_key_exists($username, self::$iniUsersArray) && self::$iniUsersArray[$username] == $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function getIniLoginAttributes() {
        return self::$iniLoginAttributesArray;
    }

}
