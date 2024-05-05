<?php

$cookie_name = "login_cookie";
$cookie_value = "Login";

if (!isset($_COOKIE[$cookie_name])) {
    echo "Não logado!";
} else {
    echo "Logado";
}

?>