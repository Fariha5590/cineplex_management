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

        <h1>Order Tickets</h1>

         <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p>Select Movie ID From The List:</p>
                <select name="movieID" placeholder="Movie ID">
                    <?php
                        $result = $mysqli->query("SELECT * FROM ticket_status");
                        while( $row = mysqli_fetch_array($result) ){
                            echo "<option value=" . $row['movie_id'] . ">" . $row['movie_id'] . " - " . $row['movie_name'] . "</option>"; }
                     ?>
                </select>
                <input type="number" name="quant" placeholder="Quantity">
                <input type="submit" name="submit-button" value="Confirm">
            </form>

            <?php
                if ( isset($_POST['submit-button']) ) {
                    $movieID = $_POST['movieID'];
                    $quant = $_POST['quant'];

                    $result = $mysqli->query("SELECT * FROM ticket_status WHERE movie_id='$movieID'");
                    $row = mysqli_fetch_array($result);

                    if($quant > $row['available_tickets']){
                        echo "Not Available Seats";
                    }

                    $inputUsername = $username;
                    $inputMovieID = $row['movie_id'];
                    $inputMovieName = $row['movie_name'];
                    $inputMovieTime = $row['time_date'];
                    $inputQuantity = $quant;

                    $query = "SELECT MAX(order_id) AS max FROM ticket_orders";
                    $result = $mysqli->query($query);
                    $row = $result->fetch_assoc();
                    $orderID = (int) $row['max'];
                    $orderID++;

                    $updateTicketNum = $mysqli->query("UPDATE ticket_status SET available_tickets = available_tickets - '$quant' WHERE movie_id = '$inputMovieID'");

                    $query = "INSERT INTO ticket_orders VALUES('$inputUsername', '$orderID', '$inputMovieName', '$inputMovieID', '$inputMovieTime', '$inputQuantity')";
                    $result = $mysqli->query($query);

                    header("Location: index.php");
                }
             ?>
         </div>
     </div>
   </body>

   <footer>
       Copyright, All Right Reserved, 2017
   </footer>
 </html>
<?php ob_end_flush(); ?>
