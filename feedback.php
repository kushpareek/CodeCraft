<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $q = " INSERT INTO `contact`(`name`, `subject`, `email` ,`message`) VALUES ('$name', '$subject', '$email' , '$message')";
    $query = mysqli_query($conn,$q);
  }
?> 

<!--Start Contact Us-->
<div class="container mt-4" id="Contact">  <!--Start Contact Us Container-->
      <h2 class="text-center mb-4">Feedback</h2> <!-- Contact Us Heading -->
      <div class="row">  <!--Start Contact Us Row-->
        <div class="col-md-8"> <!--Start Contact Us 1st Column-->
          <form action="#" method="post" name="myForm">
            <input type="text" class="form-control" name="name" placeholder="Name"><br>

           <input type="email" class="form-control" name="email" placeholder="E-mail"><br>
           <input type="text" class="form-control" name="subject" placeholder="subject"><br>
            <textarea class="form-control" name="message" placeholder="Give us Your Feedback" style="height:150px;"></textarea><br>
            <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br>
          </form>
        </div> <!-- End Contact Us 1st Column-->

        <div class="col-md-4 stripe text-white text-center">  <!-- Start Contact Us 2nd Column-->
          <h4>iSchool</h4>
          <p> <br />
           </p>
        </div> <!-- End Contact Us 2nd Column-->
      </div> <!-- End Contact Us Row-->
    </div> <!-- End Contact Us Container-->
    <!-- End Contact Us -->
    <?php 
    include('./mainInclude/footer.php'); 
?>  