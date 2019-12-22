<?php
    ob_start();
    session_start();
    require_once 'dbconnector.php';
    if ( !isset( $_SESSION['user'] ) ) {
        header("Location: index.php");
        exit;
    }
    $username = (string)$_SESSION['user'];
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
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="order_tickets.php">Order Tickets</a></li>
                <li><a href="view_tickets.php">View Tickets</a></li>
                <li><a href="cancel_orders.php">Cancel Orders</a></li>
                <li><a href="logout.php?logout">Logout</a></li>
            </ul>
        </header>

        <h1>Available Tickets List</h1>

         <div>
             <?php
                $result = $mysqli->query("SELECT * FROM ticket_status");
                while( $row = mysqli_fetch_array($result) ){
                    echo "<div class='ticket'><span>#" . $row['movie_id'] ."</span>";
                    echo "<span>" . $row['movie_name'] . "</span>";
                    echo "<span><b>Time: </b>" . $row['time_date'] . "</span>";
                    echo "<span><b>Available Tickets: </b>" . $row['available_tickets'] . "/"  . $row['max_tickets'] . "</span>";
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
