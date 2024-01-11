<?php
include('./dbConnection.php');
// Header Include from mainInclude 
include('./mainInclude/header.php');
?>
<head>
  <link rel="icon" href="./image/favicon.ico">
</head>
<script src= "main.js"></script>
<script src="https://kit.fontawesome.com/36c6fdaaa7.js" crossorigin="anonymous"></script>
<style>
  body{
    color:white;
  }
  .container-fluid1{
    padding: 2% 7% 12%;
    height:100%;
    margin-top:10%;

}
.Download-button{
    margin: 5% 3% 5% 0;
}
h1{
    font-family: 'Montserrat', sans-serif;
    font-size: 3.5rem;
    line-height: 1.5;
    font-weight: 900;
    color:beige;
}
.logothe{
    color:red
}
.Title-Image{
    width: 70%;
    transform: rotate(0);
    position: absolute;
    right:20%;
    mix-blend-mode: difference;
    
}
.card-img-top {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
@media (max-width: 1028px ) {
  h1{
    font-size:2.0rem;
        font-weight:700;
  }
    #title{
      margin-top:200px;
        text-align:center;
        margin-bottom:200px
        
    }
    .Title-Image{
        display:none;
    }
    iframe{
      display:none;
    }
    

    
}
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


.card-01 .height-fix .card-img-top{width:auto!imporat;}

#testimonials{
   padding-top:10%;
   
   text-align: center;
   background-color:#ef8172;
   color: #fff;

}
.testimonial-image{
    width: 150px;
    height:150px ;
    border-radius: 100%;
    margin:20px;
}
.carousel-item{
    padding:7% 15%; 
}
#marque{
  display: grid;
  padding-top:60px;
  
    align-items: center;
    justify-items: center;
    background-color:#fff;
    width: 100%;
    margin: auto;
    padding-bottom: 50px;
}
.marqimg{
  width:30%;
aspect-ratio:3/2;
padding:10px;

}
h2{
  font-family: 'Montserrat', sans-serif;
  color:beige;
  font-weight:900;
  padding-bottom:50px;
}
  @import url('https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Maven+Pro&family=Poppins&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
</style>
 <!-- End Video Background -->

<section id ="title">
<div class="container-fluid1">
<div class="row">
        <div class="col-lg-6">
          <h1><span class="logothe">//</span>CodeCraft</h1>
          <h1>Coding Never Been This Easy Before.</h1>
          <?php
          
          if (isset($_SESSION['is_login'])) {
            echo '<a href="Student/studentProfile.php"><button class="btn btn-dark Download-button" type="button">My Profile</button></a>';
          } else {
            echo '<a href="loginorsignup.php"><button class="btn btn-dark Download-button" type="button">Enroll Now</button></a>';
          }
          ?>
          
        </div>

        <div class="col-lg-6">
          <img class="Title-Image" src="img/titleimg.png" alt="iphone-mockup">
        </div>
      </div>
    </div>

</section>
<style>
  #cent{
    text-align:center;
  }
</style>


<div class="container-fluid1">
<div class="row">
        <div class="col-lg-6">
          <h2>Why CodeCraft </h2>
          <p>CodeCraft is your gateway to cutting-edge industrial training, seamlessly blending the latest technologies with the insights of seasoned industrial experts. Our platform offers an immersive learning experience, empowering you to master the skills demanded by the ever-evolving tech landscape. Whether you're a novice or an experienced professional, CodeCraft equips you with the practical knowledge and expertise necessary to excel in the modern industrial environment.</p>
          
        </div>

        <div class="col-lg-6">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/LAP23XbhIUs?si=oK7Nj1-osrjGO9Lw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
</div>
 <!-- End Text Banner -->
 <section id="cent">
<h2>Certificates</h2>
</section>
<section id= "marque">
       
        <marquee behavior="alternate" >
          <img class = "marqimg" src="image/img1.jpg">
          <img class = "marqimg" src="image/img2.jpeg">
          <img class = "marqimg" src="image/img3.jpeg">
          <img class = "marqimg" src="image/img4.jpeg">
          <img class = "marqimg" src="image/img5.jpeg">
          <img class = "marqimg" src="image/img6.png">
          <img class = "marqimg" src="image/img7.jpeg">
        </marquee>
    </section>

<div class="container mt-5"> <!-- Start Most Popular Course -->
  <h1 class="text-center" id="title_pc">Popular Course</h1>
  <div class="row" id="cards_c"> <!-- Start Most Popular Course 1st Card Deck -->
    <?php
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
  
    $sql = "SELECT * FROM course LIMIT 3";
    $result = $conn->query($sql);
    if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
    }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
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
  </div> <!-- End Most Popular Course 1st Card Deck -->
   
    
    
    
  </div> <!-- End Most Popular Course 2nd Card Deck -->
  <div class="text-center m-2">
    <a class="btn btn-dark Download-button" href="courses.php">View All Course</a>
  </div>
</div> <!-- End Most Popular Course -->
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Owl Carousel JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


<section id="testimonials">
<h1> Student's Feedback </h1>
    <div id="testimonial-carousel" class="carousel slide" data-ride="false">
      <div class="carousel-inner">
      <?php
        $sql = "SELECT s.stu_name, s.stu_occ, s.stu_img, f.f_content FROM student AS s JOIN feedback AS f ON s.stu_id = f.stu_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $s_img = $row['stu_img'];
            $n_img = str_replace('../', '', $s_img);
        ?>
        <div class="carousel-item active">
          <h2><?php echo $row['f_content']; ?></h2>
          <img class="testimonial-image" src="<?php echo $n_img; ?>" alt="dog-profile">
          <em><?php echo $row['stu_name']; ?></em>
        </div>
        <?php }
        } ?>
        <div class="carousel-item">

          <h2 class="testimonial-text">"As a busy professional, I needed a flexible way to upskill and advance my career. This platform offered a variety of courses that I could take at my own pace. The quality of content and the support from the community made my learning journey enjoyable and rewarding</h2>
          <img class="testimonial-image" src="image/img2.jpeg" alt="lady-profile">
          <em>Beverly, Illinois</em>
        </div>
      </div>
      <a href="#testimonial-carousel" class="carousel-control-prev" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a href="#testimonial-carousel" class="carousel-control-next" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
<!-- Start Students Testimonial -->

      </section>


 <!-- End Students Testimonial -->



<style>
  /* Footer Styles */


</style>




 <!-- End About Section -->

<?php
// Footer Include from mainInclude 
include('./mainInclude/footer.php');

?>