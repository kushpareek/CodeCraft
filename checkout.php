<?php 
include('./dbConnection.php');
session_start();
 if(!isset($_SESSION['stuLogEmail'])) {
  echo "<script> location.href='loginorsignup.php'; </script>";
 } else {
  $stuEmail = $_SESSION['stuLogEmail'];
  ?>
<!DOCTYPE html>
<html>
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <br>
    <br>
    <div class="container fluid">
      <center><h1>Checkout</h1></center>
            <form id="redirectForm" method="post" action="payscript.php">
       <!-- <div class="form-group">
          <label>App ID:</label><br>
          <input class="form-control" name="appId" value="214965d0b841669a3bc3411272569412"/>
        </div> -->
        <div class="form-group">
          <label>Order Id</label><br>
         
         <input id="ORDER_ID" class="form-control" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off"
          value="<?php echo  "ORDS" . rand(10000,99999999)?>" readonly>
        </div>
           
          <!--<div class="form-group">
          <label>Name:</label><br>
          <input class="form-control" name="customerName" placeholder="Enter your name here (Ex. John Doe)"/>
        </div>-->
        <div class="form-group">
          <label>Email:</label><br>
          <input id="email" name="customerEmail" class="form-control" tabindex="2" maxlength="12" size="12" name="email" autocomplete="off" value="<?php if(isset($stuEmail)){echo $stuEmail; }?>" readonly>
        </div>
        <div class="form-group">
          <label>Order Amount:</label><br>
          <input title="amt" class="form-control" tabindex="10"  type="text" name="amt" value="<?php if(isset($_POST['id'])){echo $_POST['id']; }?>" readonly>
        </div>
        <br>
      </form>
          <center>  
          <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_JZon5IOQxkNfMf" async> </script> </form>
          </center><br> 
       
    </div>
    <br>    
    <br>    
    <br>    
    <br>    
  </body>
</html>
<?php } ?>
