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

        <h1>Manage Tickets</h1>

        <div>
             <?php
                $result = $mysqli->query("SELECT * FROM ticket_status");
                while( $row = mysqli_fetch_array($result) ){
                    echo "<div class='ticket'><span>#" . $row['movie_id'] ."</span>";
                    echo "<span>" . $row['movie_name'] . "</span>";
                    echo "<span><b>Time: </b>" . $row['time_date'] . "</span>";
                    echo "<span><b>Available Tickets: </b>" . $row['available_tickets'] . "/"  . $row['max_tickets'] . "</span>";
                    echo "<button type='submit' onclick='javascript:delete_ticket(" . $row['movie_id'] .")'>Delete</button>";
                    echo "</div>";
                }
             ?>
        </div>
    </div>
    <footer>
        Copyright, All Right Reserved, 2017
    </footer>
    <script src="jquery.min.js" charset="utf-8"></script>
    <script>
        function delete_ticket(x) {
            var data = {
                data_delete: x
            };
            $.post("admin-dashboard.php", data);
        }
    </script>
    <?php
        $data_delete = $_POST['data_delete'];
        $result = $mysqli->query("DELETE FROM ticket_status WHERE movie_id = '$data_delete'");
     ?>
</body>
</html>
<?php ob_end_flush(); ?>
