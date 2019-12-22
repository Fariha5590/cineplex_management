<?php
    ob_start();
    session_start();
    require_once 'dbconnector.php';
    if ( !isset( $_SESSION['admin'] ) ) {
        header("Location: admin.php");
        exit;
    }
    unset($_SESSION['user']);
    $username = (string)$_SESSION['admin'];
 ?>
 <!DOCTYPE html>
 <html>
<head>
	<meta charset="utf-8">
	<title>Cineplex Management System</title>
    <link href="stylesheet.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <header>
            <ul>
                <h2>Hello <?php echo $username; ?></h2>
                <li><a href="admin-dashboard.php">Manage Movies</a></li>
                <li><a href="admin-add-movies.php">Add Movies</a></li>
                <li><a href="admin-view-users.php">View Users</a></li>
                <li><a href="logout.php?logout">Logout</a></li>
            </ul>
        </header>

        <h1>Users List</h1>
        <div>
             <?php
                $result = $mysqli->query("SELECT * FROM users");
                while( $row = mysqli_fetch_array($result) ){
                    echo "<div class='ticket'><span><b>Username: </b>" . $row['username'] ."</span>";
                    echo "<span>" . $row['name'] . "</span>";
                    echo "</div>";
                }
             ?>
        </div>
    </div>
    <footer>
        Copyright, All Right Reserved, 2017
    </footer>
</body>
</html>
<?php ob_end_flush(); ?>
