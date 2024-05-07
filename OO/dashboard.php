<?php

require_once("User.php");

$user = new User();
$authenticated = $user->authenticated();

echo $authenticated . "<br>";

if ($authenticated) {
    echo "Logado";
} else {
    header("Location: login.php");
}

if (isset($_POST['Logout'])) {
    $user->logout();
}

?>


<form action="dashboard.php" method="post">
   <input name="Logout" type="submit" value="Logout" />
</form>