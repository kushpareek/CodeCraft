<?php
include('./dbConnection.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unsuccessful Payment</title>
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
  }
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .content {
    text-align: center;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  h2 {
    color: #FF5733;
    margin-bottom: 10px;
  }
  p {
    color: #777;
    font-size: 18px;
    margin-bottom: 20px;
  }
  a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #FF5733;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  a:hover {
    background-color: #C70039;
  }
  @media (max-width: 768px) {
    .content {
      padding: 10px;
    }
    p {
      font-size: 16px;
    }
  }
</style>
</head>
<body>
  <div class="container">
    <div class="content">
      <h2>Unsuccessful Payment</h2>
      <p>Sorry, your payment was not successful. Please try again later.</p>
      <a href="index.php">Go Back to Homepage</a>
    </div>
  </div>
</body>
</html>
<?php


?>