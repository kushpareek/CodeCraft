<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
?>  
  <!-- End Course Page Banner -->
<style>
  /* Reset some default styles */
body, h1, h2, h3, h4, h5, h6, p {
  margin: 0;
  padding: 0;
  color:white;
}

/* Style for the course details section */
.course-details {
  padding: 50px 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -15px;
}

.col-md-6 {
  flex: 0 0 50%;
  max-width: 50%;
  padding: 0 15px;
}

/* Style for course image */
.course-image {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
}

/* Style for course title */
.course-title {
  font-size: 24px;
  margin-top: 20px;
  margin-bottom: 10px;
}

/* Style for course description */
.course-description {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 30px;
}

/* Style for purchase button */
.purchase-button {
  background-color: #040D12;
  color: #fff;
  
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
}

.purchase-button:hover {
  background-color: #031019;
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 960px;
    margin: 0 auto;
    padding: 20px;
  }

  .course-image {
    max-width: 100%;
    height: auto;
  }

  .course-title {
    font-size: 24px;
    margin-top: 20px;
  }

  .course-description {
    margin-top: 10px;
    line-height: 1.6;
  }

  .buy-now-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #040D12;
    color: #fff;
    border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
    
    margin-top: 20px;
  }
  .buy-now-button:hover {
    display: inline-block;
    padding: 10px 20px;
    background-color: #fff;
    color: #040D12;
    border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
    
    margin-top: 20px;
  }

  @media screen and (max-width: 768px) {
    .container {
      padding: 10px;
    }
  }
  .card{
  box-shadow:2px 2px 20px rgba(0,0,0,0.3); border:none; margin-bottom:30px;
  margin-top:30px;
  background-color:#191a1e;
}
.card:hover{
  transform: scale(1.05);
  transition: all 0.5s ease;
  z-index: 999;
}
.card-01 .card-body{
  position:relative; padding-top:40px;
}
.card-01 .badge-box{
  position:absolute; 
  top:-20px; left:50%; width:100px; height:100px;margin-left:-50px; text-align:center;
}
.card-01 .badge-box i{
  background:#006EFF; color:#fff; border-radius:50%;  width:50px; height:50px; line-height:50px; text-align:center; font-size:20px;
}
.card-01 .height-fix{
  height:455px; overflow:hidden;
}
.Download-button{
    margin: 5% 3% 5% 0;
    color:white
}
.card-img-top {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
body {
    font-family: 'Montserrat', sans-serif;
    color:white;
  }
.heading{
  font-size: 2.0rem;
    line-height: 1.5;
    font-weight: 900;
    color:beige;
}

.card-01 .height-fix .card-img-top{width:auto!imporat;}

/* Style for header and footer (adjust as needed) */


</style>
<div class="container mt-5">
  <?php
    if(isset($_GET['course_id'])){
      $course_id = $_GET['course_id'];
      $_SESSION['course_id'] = $course_id;
      $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){
          $currentCourseCategory = $row['category'];
  ?>
  
  <div class="container">
    <img class="course-image" src="<?php echo str_replace('..', '.', $row['course_img'])?>" alt="Course Image">
    <h2 class="course-title"><?php echo $row['course_name']?></h2>
    <p class="course-description">
    <?php echo $row['course_desc']?>
    </p>
    <h5>Course Duration: <?php echo $row['course_duration']?> Months</h5>
    <form action="payment.php" method="post">
            <input type="hidden" name="id" value='<?php echo $row["course_price"]; ?>'>
            <input type="hidden" name="id1" value='<?php echo $row["course_id"]; ?>'>
            <button type="submit" class="buy-now-button" name="buy">Buy Now</button>
          </form>
  </div>
 
  <?php
        }
      }
    }
  ?>   
</div>
<div class="suggested-courses">
  <h2 class="text-center heading">Suggested Courses</h2>
  <div class="row">
  <?php
   // Get the category of the current course
  $suggestedQuery = "SELECT * FROM course WHERE category = '$currentCourseCategory' AND course_id != '$course_id' LIMIT 3";
  $suggestedResult = $conn->query($suggestedQuery);

  if ($suggestedResult->num_rows > 0) {
    while ($suggestedRow = $suggestedResult->fetch_assoc()) {
      $suggestedCourseId = $suggestedRow['course_id'];
      ?>
      
      <div class= "col-md-4 mb-4">
      <div class="card card-01">
        <img class="card-img-top" src="<?php echo str_replace('..', '.', $suggestedRow['course_img']); ?>" alt="Suggested Course">
        <div class="card-body">
          <h4 class="card-title"><?php echo $suggestedRow['course_name']; ?></h4>
          <p class="card-text">Price: <del>&#8377 <?php echo $suggestedRow['course_original_price']; ?></del> <span class="font-weight-bolder">&#8377 <?php echo $suggestedRow['course_price']; ?></span></p>
        </div>
        <a class="btn btn-dark Download-button" href="coursedetails.php?course_id=<?php echo $suggestedCourseId; ?>">Enroll Now</a>
      </div>
      </div>
      <?php
    }
  } else {
    echo '<p>No suggested courses available.</p>';
  }
  ?>
</div>
</div>

     <?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?>  
