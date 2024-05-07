<?php

class User {
 
    public function authenticated() {

        $cookie_name = "login_cookie";
        print_r($_COOKIE);
        if ($_COOKIE && $_COOKIE[$cookie_name] == "Login" ) {
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        setcookie("login_cookie", "Logout", time() - 360000, '/');
    }
}

?>