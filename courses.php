<?php
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); 
?>

<style>
  body{
    color:white;
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

.card-01 .height-fix .card-img-top{width:auto!imporat;}

</style>
<div class="container mt-5"> <!-- Start All Course -->
  <h1 class="text-center">All Courses</h1>
  <?php
if (isset($_SESSION['is_login'])) {
  $stuEmail = $_SESSION['stuLogEmail'];
  }
  function hasCourseInOrder($conn, $course_id, $student_email) {
    $orderedQuery = "SELECT * FROM courseorder WHERE course_id = '$course_id' AND stu_email = '$student_email' AND status = 'success'";
    $orderedResult = $conn->query($orderedQuery);

    if ($orderedResult === false) {
        // Handle the SQL query error
        return false; // Return false indicating error
    }

    if ($orderedResult->num_rows > 0) {
        return true; // User has the course in courseorder table
    } else {
        return false; // User does not have the course in courseorder table
    }
}
    $sql = "SELECT DISTINCT category FROM course";
    $category_result = $conn->query($sql);
    if ($category_result->num_rows > 0) {
      while ($category_row = $category_result->fetch_assoc()) {
        $category = $category_row['category'];

  ?>
  <h2 class="text-center mt-4"><?php echo $category; ?> Courses</h2>
  <div class="row"> <!-- Start All Course Row -->
    <?php
        $course_sql = "SELECT * FROM course WHERE category='$category'";
        $course_result = $conn->query($course_sql);
        if ($course_result->num_rows > 0) {
          while ($row = $course_result->fetch_assoc()) {
            $course_id = $row['course_id'];
            if (isset($_SESSION['is_login'])) {
              $userHasCourse = hasCourseInOrder($conn, $course_id, $stuEmail);
              }
    ?>
    <div class="col-md-4 mb-4">
      <div class="card card-01">
        <img src="<?php echo str_replace('..', '.', $row['course_img']); ?>" class="card-img-top" alt="<?php echo $row['course_name']; ?>" />
        <div class="card-body">
        <h3 class="card-title"><?php echo $row['course_name']; ?></h3>
        
       
          <p class="card-text">Price: <del>&#8377 <?php echo $row['course_original_price']; ?></del> <span class="font-weight-bolder">&#8377 <?php echo $row['course_price']; ?></span></p>
          <?php
          if (isset($_SESSION['is_login'])) {
            if($userHasCourse){
              echo '<a href="Student/watchcourse.php?course_id='.$course_id.'"><button class="btn btn-dark Download-button" type="button">Join Now</button></a>';
            }else{
             
              echo '<a class="Download-button btn-dark btn" href="coursedetails.php?course_id='.$course_id.'">Enroll</a>';
            }
            
          } else {
            echo '<a class="Download-button btn-dark btn" href="coursedetails.php?course_id='.$course_id.'">Enroll</a>';
          }
          ?>
          </div>
      </div>
    </div>
    <?php
          }
        }
    ?> 
  </div><!-- End All Course Row -->
  <?php
      }
    }
  ?>
</div><!-- End All Course -->

<?php 
  // Footer Include from mainInclude 
  include('./mainInclude/footer.php'); 
?>

