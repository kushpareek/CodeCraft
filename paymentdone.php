<?php 
$courseid = $_GET['orderid'];
include('./dbConnection.php');
  session_start();
  $useremail = urldecode($_GET['useremail']);
  $amount = $_GET['unit_amount'];
  $courseid = $_GET['courseid'];
$sql = "UPDATE `courseorder` SET `status` = 'success' WHERE `courseorder`.`stu_email` = '$useremail' and `course_id` = '$courseid'";

		  // Prepare the statement
		  $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cashfree - PG Response Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>




<?php 
  
  include('./dbConnection.php');
  session_start();
  require 'stripe_config.php';
  if (isset($_GET['orderid'])) {
	  $orderid = $_GET['orderid'];
	  $amount = $_GET['unit_amount'];
	  $useremail = urldecode($_GET['useremail']);
	  
	  
  }
	  try {
		  \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

		  // Retrieve the order details from Stripe using the $courseid or any other identifier
		  // For this example, we are not storing the order details in the database.
		  // You should handle this part according to your project's requirements.
		  
		  
	  } catch (Exception $e) {
		  echo 'Error: ' . $e->getMessage();
	  }
  
	
	


	   
    ?>
    <div class="container"> 
	<div class="panel panel-success">
	  <div class="panel-heading">Signature Verification Successful</div>
	  <div class="panel-body">
	  	<!-- <div class="container"> -->
	 		<table class="table table-hover">
			    <tbody>
          <tr>
			        <td>Email</td>
			        <td><?php echo $_SESSION['stuLogEmail']; ?></td>
			      </tr>
			      <tr>
			        <td>Order ID</td>
			        <td><?php echo $orderid; ?></td>
			      </tr>
			      <tr>
			        <td>Order Amount</td>
			        <td><?php echo $amount/100; ?></td>
			      </tr>
			      <tr>
			        <td>Transaction Status</td>
			        <td><?php echo "Success"; ?></td>
			      </tr>
			      <tr>
			        <td>Payment Mode </td>
			        <td><?php echo "Card"; ?></td>
			      </tr>
			      <tr>
			        <td>Message</td>
			        <td><?php echo "Thank You for your purchase"; ?></td>
			      </tr>
			      
			    </tbody>
			</table>
		<!-- </div> -->

	   </div>
	</div>
	</div>
  <?php  
   
		echo "Redirecting to My Profile....";
		echo "<script> setTimeout(() => {
		 window.location.href = './Student/myCourse.php';
	   }, 9500); </script>";
	    
	   ?>
</body>
</html>