<?php
    ob_start();
    session_start();
    require_once 'dbconnector.php';
    if ( isset($_SESSION['admin'])!="" ) {
        header("Location: admin-dashboard.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cineplex Management System</title>
    <link href="stylesheet.css" rel="stylesheet">
</head>
<body class="form-page">
    <div class="wrapper">
        <?php if ( isset($errMSG) ) { echo $errMSG; } ?>
        <h1>Admin Login</h1>
    	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    		<input type="text" name="username" placeholder="Username" maxlength="40">
    		<input type="password" name="password" placeholder="Your Password" maxlength="15">
    		<button type="submit" name="login-button">Sign In</button>
    	</form>
        <?php
            if( isset($_POST['login-button']) ) {
                $username = $_POST['username'];
                $pass = $_POST['password'];

                $query = $mysqli->query("SELECT username, password FROM admins WHERE username='$username'");
                $row = $query->fetch_array(MYSQLI_ASSOC);
                if( $query->num_rows === 1 && $row['password'] == $pass ) {
                    $_SESSION['admin'] = $row['username'];
                    header("Location: admin-dashboard.php");
                } else {
                    $errMSG = "Please insert correct login details";
                }
            }
        ?>
        <a href="index.php"><u>User Login Panel</u></a>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>
