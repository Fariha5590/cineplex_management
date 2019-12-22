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

        <div>
            <h1>Cancel An Order</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p>Select an order to Cancel</p>
                <select name="order_value">
                <?php
                    $result = $mysqli->query("SELECT * FROM ticket_orders WHERE customer_name = '$username'");
                    if ( $result->num_rows == 0 ) { echo "<h2>No Orders Found</h2>"; }
                    while( $row = mysqli_fetch_array($result) ){
                        echo "<option value='" . $row['order_id'] . "'>" . $row['order_id'] . " | " . $row['movie_name'] . " | " . $row['quantity'] . "</option>";
                    }
                ?>
                </select>
                <input type="submit" name="submit_button" value="Confirm">
            </form>

            <?php
                if( isset($_POST['submit_button']) ) {
                    $result = $mysqli->query("SELECT * FROM ticket_orders WHERE customer_name = '$username'");
                    $row = mysqli_fetch_array($result);
                    $quant = $row['quantity'];
                    $movieID = $row['movie_id'];
                    $query = $mysqli->query("UPDATE ticket_status SET available_tickets = available_tickets + $quant WHERE movie_id = $movieID");
                    $query = $mysqli->query("DELETE FROM ticket_orders where order_ID = " . $_POST['order_value'] . "");

                    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
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
