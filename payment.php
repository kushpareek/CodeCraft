<?php 
include('./dbConnection.php');

$orderID = "ORDS" . rand(10000,99999999);

include('./mainInclude/header.php');
 if(!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='loginorsignup.php'; </script>";
 } else {
  $stuEmail = $_SESSION['stuLogEmail'];
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    
   <title>Checkout</title>
  </head>
  <body>
  <div class="container mt-5">
    <div class="row">
    <div class="col-sm-6 offset-sm-3 ">
    <h3 class="mb-5">Complete Your Payment</h3>
    <form method="post" action="process_payment.php" id="myform">
    
      <div class="form-group row">
       <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID</label>
       <div class="col-sm-8">
         <input id="ORDER_ID" class="form-control" tabindex="1" maxlength="20" size="20" name="orderId" autocomplete="off"
          value="<?php echo $orderID;?>" readonly>
       </div>
      </div>
      
      <div class="form-group row">
       <label for="OrderCurrency" class="col-sm-4 col-form-label">Order Currency:</label>
       <div class="col-sm-8">
         <input class="form-control" tabindex="2" maxlength="12" size="12" name="orderCurrency" autocomplete="off" value="INR" readonly>
       </div>
      </div>
      <div class="form-group row">
       <label for="CUST_phone" class="col-sm-4 col-form-label">Student Phone</label>
       <div class="col-sm-8">
         <input id="CUST_phone" class="form-control" tabindex="3" maxlength="12" size="12" name="customerPhone" autocomplete="off" >
       </div>
 </div>
    

       <div class="form-group row">
       <label for="Courseid" class="col-sm-4 col-form-label">CourseID:</label>
       <div class="col-sm-8">
        <input title="courseid" class="form-control" tabindex="4" maxlength="12" size="12"
          type="text" name="courseID" value="<?php if(isset($_POST['id1'])){echo $_POST['id1']; }?>" readonly>
       </div>
      </div>
      <div class="form-group row">
       <label for="CUST_ID" class="col-sm-4 col-form-label">Student Email</label>
       <div class="col-sm-8">
         <input id="CUST_ID" class="form-control" tabindex="5" maxlength="12" size="12" name="customerEmail" autocomplete="off" value="<?php if(isset($stuEmail)){echo $stuEmail; }?>" readonly>
       </div>
      </div>
      <div class="form-group row">
       <label for="TXN_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
       <div class="col-sm-8">
        <input title="TXN_AMOUNT" class="form-control" tabindex="6" maxlength="12" size="12"
          type="text" name="orderAmount" value="<?php if(isset($_POST['id'])){echo $_POST['id']; }?>" readonly>
       </div>
      </div>
      <div class="text-center">
     
      <button class="custom-button" id="custom-stripe-button">Pay with Card</button>
      <script src="https://checkout.stripe.com/checkout.js"></script>
        <script>
    document.getElementById("custom-stripe-button").addEventListener("click", function() {
      var handler = StripeCheckout.configure({
        key: 'pk_test_51NSt17SDYmcNpPnxwmY3eMsTTlDr4lpsW9yf5tQZ4LwQPFylJCIYgFLTuVPH1pcRrfMuphq5QyLSl0um5sLGG6Bj002BlFseB4', // Your Stripe Public Key
        image: 'your-logo.png', // Your logo
        locale: 'auto',
        token: function(token) {
          // You can handle the token here
          console.log(token);
        }
      });

      handler.open({
        name: 'Loan Repayment',
        description: 'Loan Repayment',
        amount: <?php echo ($monthly + $penalty)*100 ?>,
        currency: 'INR'
      });
    });
  </script>
 </form>
 <form method="post" action="phonepe.php" id="phonepeForm">
  <!-- Add necessary input fields for PhonePe payment -->
  <input type="hidden" name="ORDER_ID" value="<?php echo  $orderID;?>">
  <input type="hidden" name="ORDER_CURRENCY" value="INR">
  
  <input type="hidden" name="COURSE_ID" value="<?php if(isset($_POST['id1'])){echo $_POST['id1']; }?>">
  <input type="hidden" name="CUST_ID" value="<?php if(isset($stuEmail)){echo $stuEmail; }?>">
  <input type="hidden" name="TXN_AMOUNT" value="<?php if(isset($_POST['id'])){echo $_POST['id']; }?>">

  <!-- Add the "Pay with PhonePe" button -->
  <button type="submit" class="custom-button1">Pay with PhonePe</button>
</form>
 <style>
  .custom-button {
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  .custom-button1 {
    background-color: #000;
    color: #fff;
    margin:5px;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  .custom-button1:hover {
    background-color: #333; /* Hover color */
  }
  .custom-button:hover {
    background-color: #333; /* Hover color */
  }
  body {
      background-color: #040D12;
      color: #fff;
    }
    .container {
      margin-top: 5%;
    }
    
    
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      color: #fff;
      font-weight: bold;
    }
    .form-control {
      background-color: ;
      border: none;
      color: #000;
    }
    .custom-button {
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
    .custom-button:hover {
      background-color: #333;
    }
 </style>
        <!-- Set up a container element for the button -->
        
		<!--<form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_JUHmP2oaEGJjyo" async> </script> </form>
     </form>-->
	 
     <small class="form-text text-muted">Note: Complete Payment by Clicking Checkout Button</small>
     </div>
    </div>
  </div>
  <!-- Include the Stripe JavaScript SDK -->
  

 
    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="js/all.min.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="js/custom.js"></script>

  </body>
  </html>
 <?php } ?>

