<?php
// Assuming you have a database connection established
include('./dbConnection.php'); // Include your database connection file
include('./mainInclude/header.php'); 
  if(!isset($_SESSION['stuLogEmail'])) {
    echo "<script> location.href='loginorsignup.php'; </script>";
   } else {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $issue = $_POST['issue'];
    $description = $_POST['description'];
    $stuEmail = $_SESSION['stuLogEmail'];
   
    // Get logged in student's email and name (assuming you have this data stored in session)
    $studentEmail = isset($stuEmail) ? $stuEmail : '';
    $studentName = isset($stuName) ? $stuName : '';

    // Process the uploaded screenshot
    $screenshotName = '';
    if ($_FILES['screenshot']['name']) {
        $screenshotName = $_FILES['screenshot']['name'];
        $screenshotTempName = $_FILES['screenshot']['tmp_name'];
        move_uploaded_file($screenshotTempName, "img/" . $screenshotName); // Upload to a folder named 'uploads'
    }

    // Insert data into the 'contact' table
    $sql = "INSERT INTO contact1 (student_name, student_email, issue, description, screenshot)
            VALUES ('$studentName', '$studentEmail', '$issue', '$description', '$screenshotName')";

    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
}
?>
