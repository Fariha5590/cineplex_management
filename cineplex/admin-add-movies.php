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
                <li><a href="admin-add-tickets.php">Add Movies</a></li>
                <li><a href="admin-view-users.php">View Users</a></li>
                <li><a href="logout.php?logout">Logout</a></li>
            </ul>
        </header>

        <h1>Add Movie</h1>
        <div>
           <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
               <p>Insert Movie Details:</p>
               <input type="text" name="movie_name" placeholder="Movie Name">
               <input type="datetime-local" name="time_date" placeholder="Quantity">
               <input type="number" name="max_tickets" placeholder="Seats">
               <input type="submit" name="submit-button" value="Confirm">
           </form>

           <?php
               if ( isset($_POST['submit-button']) ) {
                   $moviename = $_POST['movie_name'];
                   $date_time = $_POST['time_date'];
                   $maxticket = $_POST['max_tickets'];

                   $result = $mysqli->query("SELECT MAX(movie_id) AS max FROM ticket_status");
                   $row = $result->fetch_assoc();
                   $movieID = (int) $row['max'];
                   $movieID++;

                   $query = "INSERT INTO ticket_status VALUES('$movieID', '$moviename', '$date_time', '$maxticket', '$maxticket')";
                   $result = $mysqli->query($query);

                   header("Location: admin-dashboard.php");
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
