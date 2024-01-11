<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  
  include('./mainInclude/header.php'); 
  if(!isset($_SESSION['stuLogEmail'])) {
    echo "<script> location.href='loginorsignup.php'; </script>";
   } else {
?> 
<style>
        body {
    font-family: Arial, sans-serif;
    background-color: #191a1e;
    margin: 0;
    padding: 0;
    transition: background-color 0.3s ease;
}

.container {
    max-width: 600px;
    margin: 40px auto;
    background-color: #191a1e;
    color:beige;

    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    
    transition: color 0.3s ease;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
    font-weight: bold;
}

select,
textarea{
    margin-top: 5px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

select:focus,
textarea:focus {
    border-color: #007bff;
    background-color: #f5f5f5;
}

/* Existing styles... */

/* Style the custom file input container */
.custom-file-upload {
    position: relative;
    overflow: hidden;
    display: inline-block;
    background-color: #00ADB5;
    color: black;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.custom-file-upload:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

/* Style the actual file input to be hidden */
.custom-file-upload input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    cursor: pointer;
}

/* Style the file name display */
.file-name {
    margin-top: 5px;
    color: #555;
    font-size: 14px;
}


.subbutton {
    margin-top: 20px;
    padding: 12px 24px;
    background-color: #ED7B7B;
    color: #fff;
    
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.subbutton:hover {
    background-color: #0056b3;
    transform: scale(1.02);
}


    </style>
    <div class="container">
        <h1>Contact Us</h1>
        <form action="submit.php" method="POST" enctype="multipart/form-data">
            <label for="issue">Choose an Issue:</label>
            <select name="issue" id="issue" required>
                <option value="query">Query</option>
                <option value="problem">Problem</option>
                <option value="payment">Payment</option>
            </select>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="screenshot" class="custom-file-upload">
                Upload Screenshot
                <input type="file" name="screenshot" id="screenshot">
            </label>

            <button class="subbutton" type="submit">Submit</button>
        </form>
    </div>
</body>

    <?php 
   }
    
?>  