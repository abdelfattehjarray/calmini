<?php
include '../controller/ArticleC.php';
include '../controller/CommenterC.php';
include_once("../config.php");
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);
$articleC = new ArticleC();
$CommenterC = new CommenterC();
$IdArticle=$_GET["IdArticle"];
$IdCommenter=$_GET["IdCommenter"];
$listcommenter = $CommenterC->listCommenter($IdArticle);

$Article = $articleC->recupererArticle($IdArticle);
$Commenter = $CommenterC->recupererCommenter($IdCommenter);

// if (
//     isset($_POST["Title"]) &&
//     isset($_POST["content"]) &&
//     isset($_POST["image"])
// ) {
    
//         $article = new Article(
//             $_POST['Title'],
//             $_POST["content"],
//             'me',
//             $_POST["image"]
//         );
//         $articleC->updateArticle($article,$IdArticle);
//         header('Location:ArticlePanel.php');
  
// }
  
  if (
    isset($_POST["comment"]) 
) {
    
        $commenterr = new Commenter(
            $id,
            $_POST["comment"],
            $IdArticle
        );
        $CommenterC->updateCommenter($commenterr,$IdCommenter);
        header("Location:ArticleMod.php?IdArticle=$IdArticle");
  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CALMINI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/styleAhmed.css" rel="stylesheet">

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+012 345 6789</a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href=""><i class="bi bi-envelope me-2"></i>info@example.com</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-body px-2" href="https://facebook.com/freewebsitecode/">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-body px-2" href="https://freewebsitecode.com/">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-body px-2" href="https://freewebsitecode.com/">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-body px-2" href="https://freewebsitecode.com/">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-body ps-2" href="https://youtube.com/freewebsitecode/">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
          <nav class="navbar navbar-expand-sm bg-white navbar-light py-3 py-lg-0">
            <a href="index.php" class="navbar-brand logo">
              <img src="../img/logo2.png" alt="site-logo" class="site-logo" style="position: relative !important; right: 100px;">
              <span class="sr-only">Site Logo</span>
            </a>
            
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav ms-5 py-0">
                <li class="nav-item">
                  <a href="main.php" class="nav-link ">Accueil</a>
                </li>
                <li class="nav-item">
                  <a href="propos.php" class="nav-link "> Propos</a>
                </li>
                <li class="nav-item">
                    <a href="Evenement.php" class="nav-link ">Evenement</a>
                </li>
                <li class="nav-item">
                  <a href="Plan.php" class="nav-link ">Plan</a>
                </li>
                <li class="nav-item">
                  <a href="Medicins.php" class="nav-link ">Medicins</a>
                </li>
                <li class="nav-item">
                    <a href="Pharmacie.php" class="nav-link ">Pharmacie</a>
                  </li>
                <li class="nav-item">
                  <a href="Articles.php" class="nav-link active">Articles</a>
                </li>
                <li class="nav-item">
                  <a href="contact.php" class="nav-link">Contact</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    <!-- Navbar End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                <h2>Modify New Article</h2>

                <form  class="" action="" method="POST" >
                <div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" id="Title" name="Title" placeholder="<?php echo $Article['Title']; ?>"required>
                </div>

                <img class="img-fluid w-100 rounded mb-5" name="imag"  src="data:<?php echo $Article['image_type']; ?>;base64,<?php echo base64_encode($Article['image_data']); ?>"  >
                    <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" id="image" name="image" >
                 
                </div>
                <div class="form-group">
                  <label for="content">Content</label>
                  <textarea rows="15"  id="content" name="content" placeholder="<?php echo $Article['content'];?>" required></textarea>
                </div>
                <button >
                <a href="ArticlePanel.php">Cancel</a>    
                </button>
                <button type="submit">
                <a href="ArticlePanel.php">Submit</a>    

                </button>
                </form>
                    
                    <div class="d-flex justify-content-between bg-light rounded p-4 mt-4 mb-4">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle me-2" src="../img/user.jpg" width="40" height="40" alt="">
                            <span><?php echo $Article['user']; ?></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="ms-3"><i class="far fa-eye text-primary me-1"></i>12345</span>
                            <span class="ms-3"><i class="far fa-comment text-primary me-1"></i>123</span>
                        </div>
                    </div>
                </div>
                <!-- Blog Detail End -->

                <!-- Comment List Start -->


                <div class="mb-5">
<h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">3 Comments</h4>

                <?php
  
  foreach ($listcommenter as $commenter) {
   ?>
                    <div class="d-flex mb-4">
                        <img src="../img/user.jpg" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href=""><?php echo $commenter['user']; ?></a> <small><i><?php echo $commenter['time']; ?></i></small></h6>
                            <p><?php echo $commenter['comment']; ?></p>
                            <a class="btn btn-sm btn-light" name="modfier" >Modifier</a>
                            <a class="btn btn-sm btn-light" name="supprimer" >Supprimer</a>

                        </div>
                    </div>
                    
                    <?php
    }?>
                </div>
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="bg-light rounded p-5">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-white mb-4">Leave a comment</h4>
                    <form class="" id="myform" action="" method="POST" >
                        <div class="row g-3">
                
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" rows="5" id="commenter" name="comment" ><?php echo $commenter['comment'];?></textarea>
                                <span id="comment"></span>

                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Comment Form End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-3"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">Categories</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Web Design</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Web Development</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Web Development</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Keyword Research</a>
                        <a class="h5 bg-light rounded py-2 px-3 mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Email Marketing</a>
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">Recent Post</h4>
                    <div class="d-flex rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="../img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet consec adipis elit
                        </a>
                    </div>
                    <div class="d-flex rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="../img/blog-2.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet consec adipis elit
                        </a>
                    </div>
                    <div class="d-flex rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="../img/blog-3.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet consec adipis elit
                        </a>
                    </div>
                    <div class="d-flex rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="../img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet consec adipis elit
                        </a>
                    </div>
                    <div class="d-flex rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="../img/blog-2.jpg" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="" class="h5 d-flex align-items-center bg-light px-3 mb-0">Lorem ipsum dolor sit amet consec adipis elit
                        </a>
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <img src="../img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div>
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">Tag Cloud</h4>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-primary m-1">Design</a>
                        <a href="" class="btn btn-primary m-1">Development</a>
                        <a href="" class="btn btn-primary m-1">Marketing</a>
                        <a href="" class="btn btn-primary m-1">SEO</a>
                        <a href="" class="btn btn-primary m-1">Writing</a>
                        <a href="" class="btn btn-primary m-1">Consulting</a>
                        <a href="" class="btn btn-primary m-1">Design</a>
                        <a href="" class="btn btn-primary m-1">Development</a>
                        <a href="" class="btn btn-primary m-1">Marketing</a>
                        <a href="" class="btn btn-primary m-1">SEO</a>
                        <a href="" class="btn btn-primary m-1">Writing</a>
                        <a href="" class="btn btn-primary m-1">Consulting</a>
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div>
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 mb-4">Plain Text</h4>
                    <div class="bg-light rounded text-center" style="padding: 30px;">
                        <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                        <a href="" class="btn btn-primary py-2 px-4">Read More</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get In Touch</h4>
                    <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Location, City, Country</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@example.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Meet The Team</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://freewebsitecode.com/"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://facebook.com/freewebsitecode/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="https://freewebsitecode.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="https://youtube.com/freewebsitecode/"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-primary" href="https://freewebsitecode.com">Free Website Code</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script src="../js/ScriptAhmed.js"></script>
    
    </div>   
                <div class="item add-product">
                    <div>
                        <span class="material-symbols-sharp">
                            add
                            </span> 
                        <h3>Ajouter un produit</h3>
                    
                    </div>
                </div>               
            </div>
        </div>
    </div>
    <script src="../js/ScriptPanel.js"></script>
    <script>

let myForm = document.getElementById('myform');


myForm.addEventListener('submit' , function(e){
    let mycontent = document.getElementById('commenter');


  if(mycontent.value =='')
  {
    let error = document.getElementById('comment');
    error.innerHTML = "Le champs content est requis";
    error.style.color = 'red';
    e.preventDefault();
  }



})

      </script>
</body>

</html>