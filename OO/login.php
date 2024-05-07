<?php

require_once("User.php");

$user = new User();
$authenticated = $user->authenticated();

if ($authenticated == false && $_POST) { 

    // Connect to the database 
    $mysqli = new mysqli("localhost", "mysql", "mysql", "login_system"); 

    // Check for errors 
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } 

    // Prepare and bind the SQL statement 
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); 

    // Get the form data 
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Execute the SQL statement 
    $stmt->execute();
    $stmt->store_result(); 

    // Check if the user exists 
    if ($stmt->num_rows > 0) { 

        // Bind the result to variables 
        $stmt->bind_result($id, $hashed_password); 

        // Fetch the result 
        $stmt->fetch(); 

        // Verify the password 
        if (password_verify($password, $hashed_password)) { 

            // // Set the session variables 
            // $_SESSION['loggedin'] = true; $_SESSION['id'] = $id; $_SESSION['username'] = $username; 

            $cookie_name = "login_cookie";
            $cookie_value = "Login";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30),"/");

            // Redirect to the user's dashboard 
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Incorrect password!"; 
        } 
    }
    // else {
    //     header("Location: login.php");
    // } 

    // Close the connection 
    $stmt->close(); $mysqli->close();
} elseif ($authenticated == true) {
    header("Location: dashboard.php");
}

?>

<form action="login.php" method="post">
  <label for="username">Username:</label>
  <input id="username" name="username" required="" type="text" />
  <label for="password">Password:</label> <input id="password" name="password" required="" type="password" />
  <input name="login" type="submit" value="Login" />
</form>