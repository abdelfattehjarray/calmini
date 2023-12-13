<?php
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id = $_SESSION["iduser"];
$nomUser = $UserC->recupererNom($id);
include '../controller/ArticleC.php';
$error = '';
$articleC = new ArticleC();

$listearticle = $articleC->listArticle($id);
$listemonarticle = $articleC->listmonArticle($id);

if (isset($_POST["Title"]) && isset($_POST["content"])) {
    if (!empty($_POST['Title']) && !empty($_POST["content"])) {


        if (!empty($_FILES['image']['tmp_name'])) {
            $image_data = file_get_contents($_FILES['image']['tmp_name']);
            $image_type = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        } else if (!is_null($imageData)) {
            $image_data = $imageData;
            $image_type = $imageType;
        }

        $article = new Article(
            $_POST['Title'],
            $_POST['content'],
            $id,
            $image_data,
            $image_type
        );
        $articleC->addArticle($article);
        header('Location:ArticlesClient.php');
    } else {
        $error = "Missing information";
    }
}
?>
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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../cssClient/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../cssClient/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-decoration-none text-body pe-3" href=""><i class="bi bi-telephone me-2"></i>+012
                            345 6789</a>
                        <span class="text-body">|</span>
                        <a class="text-decoration-none text-body px-3" href=""><i
                                class="bi bi-envelope me-2"></i>info@example.com</a>
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
                    <img src="../img/logo2.png" alt="site-logo" class="site-logo"
                        style="position: relative !important; right: 100px;">
                    <span class="sr-only">Site Logo</span>
                </a>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-5 py-0">
                        <li class="nav-item">
                            <a href="mainClient.php" class="nav-link ">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="proposClient.php" class="nav-link "> Propos</a>
                        </li>
                        <li class="nav-item">
                            <a href="EvenementClient.php" class="nav-link">Evenement</a>
                        </li>
                        <li class="nav-item">
                  <a href="mesrendezvous.php" class="nav-link ">Rendez vous</a>
                </li>
                <li class="nav-item">
                  <a href="mesordo.php" class="nav-link ">Ordonnonce</a>
                </li>
                        <li class="nav-item">
                            <a href="MedicinsClient.php" class="nav-link ">Medicins</a>
                        </li>
                        <li class="nav-item">
                            <a href="PharmacieClient.php" class="nav-link ">Pharmacie</a>
                        </li>
                        <li class="nav-item">
                            <a href="ArticlesClient.php" class="nav-link active">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a href="contactClient.php" class="nav-link">Contact</a>
                        </li>

                    </ul>
                    <ul class="navbar-nav ms-auto" style="padding:0px !important;">

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="padding:0px !important;">
                                <div class="d-flex align-items-center">
                                    <div class="profile-photo me-2">
                                        <img src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>"
                                            alt="profile photo" class="rounded-circle" style="width: 35px;">
                                    </div>
                                    <div class="info d-flex flex-column text-start">
                                        <p class="mb-0">Bonjour, <b>
                                                <?php echo $nomUser["FIRSTNAME"] ?>
                                            </b></p>
                                        <small class="text-muted">Utilisateur</small>
                                    </div>
                                </div>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="profileDropdown">
                                <li><a href="profile.php" class="dropdown-item">Mon profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a href="addUser.php" class="dropdown-item">Se déconnecter</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container-fluid py-5">
        <div class="container">
            <!-- Blog Start -->
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Articles</h5>

                <h1 class="display-4">Ajouter un articles médicaux</h1>
            </div>
            <form id="myForma" class="forum" action="" method="POST" enctype="multipart/form-data">
                <h2>Add New Article</h2>
                <div class="form-group">
                    <label for="Title" class="form-label">Title</label>
                    <input type="text" id="Title" name="Title" class="form-control">
                    <span id="titreerror"></span>
                </div>
                <div class="form-group">
                    <label for="content" class="form-label">Content</label>
                    <textarea rows="15" id="content" name="content" class="form-control"></textarea>
                    <span id="contenterror"></span>
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <span id="imageerror"></span>
                    <input type="hidden" name="image_type" id="image_type">
                </div>
                <div class="form-group">
                    <div id="drop-zone" class="border border-secondary py-3 text-center rounded">
                        <i class="bi bi-file-earmark-plus fs-1"></i>
                        <p class="mt-2">Drag and drop or click to upload a .docx file</p>
                    </div>
                    <img id="image-preview" class="mt-2" style="max-width: 100%;">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Articles</h5>
                <h1 class="display-4">votre articles médicaux</h1>
            </div>
            <div class="row g-5">
                <?php foreach ($listemonarticle as $Article) { ?>
                    <div class="col-xl-4 col-lg-6">
                        <div class="bg-light rounded overflow-hidden">
                            <img class="img-fluid w-100"
                                src="data:<?php echo $Article['image_type']; ?>;base64,<?php echo base64_encode($Article['image_data']); ?>"
                                alt="">
                            <div class="p-4">
                                <a class="h3 d-block mb-3" href="ArticleDetailClient.php?IdArticle=<?php echo $Article['IdArticle']; ?>">
                                    <?php echo $Article['Title']; ?>
                                </a>
                                <p class="m-0">
                                    <?php echo $Article['time']; ?>
                                </p>
                                <div class="actions">
                                    
                                    <a href="ArticleClientSupp.php?IdArticle=<?php echo $Article['IdArticle']; ?>"><i
                                            class="fas fa-trash"></i></a>
                                    <a href="ArticleClientMod.php?IdArticle=<?php echo $Article['IdArticle']; ?>"><i
                                            class="fas fa-edit"></i></a>
                                    <a id="btn" class="export-btn" data-title="<?php echo $Article['Title']; ?>"
                                        data-content="<?php echo $Article['content']; ?>"
                                        data-image="<?php echo base64_encode($Article['image_data']); ?>"
                                        data-type="<?php echo $Article['image_type']; ?>"><i
                                            class="fas fa-download"></i></a>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between border-top p-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-2"
                                        src="data:<?php echo $Article['image_type']; ?>;base64,<?php echo base64_encode($Article['image_data']); ?>"
                                        width="25" height="25" alt="">
                                    <small>
                                        <?php echo $Article['user']; ?>
                                    </small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>123</small>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Articles</h5>

                <h1 class="display-4">Nos derniers articles médicaux</h1>
            </div>
            <div class="row g-5">
                <?php foreach ($listearticle as $Article) { ?>
                    <div class="col-xl-4 col-lg-6">
                        <div class="bg-light rounded overflow-hidden">
                            <img class="img-fluid w-100"
                                src="data:<?php echo $Article['image_type']; ?>;base64,<?php echo base64_encode($Article['image_data']); ?>"
                                alt="">
                            <div class="p-4">
                                <a class="h3 d-block mb-3" href="ArticleDetailClient.php?IdArticle=<?php echo $Article['IdArticle']; ?>">
                                    <?php echo $Article['Title']; ?>
                                </a>
                                <p class="m-0">
                                    <?php echo $Article['time']; ?>
                                </p>
                                <div class="actions">
                                   
                                    <a id="btn" class="export-btn" data-title="<?php echo $Article['Title']; ?>"
                                        data-content="<?php echo $Article['content']; ?>"
                                        data-image="<?php echo base64_encode($Article['image_data']); ?>"
                                        data-type="<?php echo $Article['image_type']; ?>"><i
                                            class="fas fa-download"></i></a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between border-top p-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-2"
                                        src="data:<?php echo $Article['image_type']; ?>;base64,<?php echo base64_encode($Article['image_data']); ?>"
                                        width="25" height="25" alt="">
                                    <small>
                                        <?php echo $Article['user']; ?>
                                    </small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>123</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>

    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                        Entrer en contact</h4>
                    <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                        dolor</p>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Cite ElGhazala, Ariana,
                        Tunisie</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>CALMINI@gmail.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i>+216 53 273 182</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                        Liens rapides</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Accueil</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>À propos de nous</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Nos Evenement</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Rencontrer
                            l'équipe</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Dernier article</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contactez-nous</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                        Liens rapides</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Accueil</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>À propos de nous</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Nos Evenement</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Rencontrer
                            l'équipe</a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Dernier article</a>
                        <a class="text-light" href="#"><i class="fa fa-angle-right me-2"></i>Contactez-nous</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                        Bulletin</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>
                    <h6 class="text-primary text-uppercase mt-4 mb-3">Suivez-nous</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
                            href="https://freewebsitecode.com/"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
                            href="https://facebook.com/freewebsitecode/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
                            href="https://freewebsitecode.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded-circle"
                            href="https://youtube.com/freewebsitecode/"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-primary" href="#">Calmini</a>. Tous les droits sont
                        réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-primary" href="https://freewebsitecode.com">Free Website
                            Code</a></p>
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
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../jsClient/main.js"></script>
    <script src="../js/ScriptPanel.js"></script>
    <script src="../js/dad.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>

    <script>

        let myForma = document.getElementById('myForma');


        myForma.addEventListener('submit', function (e) {
            let mytest = document.getElementById('Title');
            let mycontent = document.getElementById('content');
            let myimage = document.getElementById('image');
            let regex = /^[a-zA-Z0-9]+$/;  // regular expression to match only alphabetic and numeric characters

            if (mytest.value == '') {
                let error = document.getElementById('titreerror');
                error.innerHTML = "Le champs titre est requis";
                error.style.color = 'red';
                e.preventDefault();
            }
            else if (!regex.test(mytest.value)) {
                let error = document.getElementById('titreerror');
                error.innerHTML = "Le champs titre ne doit contenir que des caractères alphanumériques";
                error.style.color = 'red';
                e.preventDefault();
            }
            if (mycontent.value == '') {
                let error = document.getElementById('contenterror');
                error.innerHTML = "Le champs content est requis";
                error.style.color = 'red';
                e.preventDefault();
            }
        })
    </script>
    <script>
        const exportBtns = document.querySelectorAll('.export-btn');

        // Add a click event listener to each button
        exportBtns.forEach(exportBtn => {
            exportBtn.addEventListener('click', () => {
                console.log('Button clicked!');

                // Extract the article data from the button's data attributes
                const articleData = {
                    title: exportBtn.dataset.title,
                    content: exportBtn.dataset.content,
                    type: exportBtn.dataset.type
                };

                console.log('Article data:', articleData);

                // Create a new HTML page that includes only the article content
                const exportPageHtml = `
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="UTF-8">
          <title>${articleData.title}</title>
        </head>
        <body>
          <h1>${articleData.title}</h1>
          <p>${articleData.content}</p>
          <br>
        </body>
      </html>
    `;

                // Create a Blob object from the HTML content
                const exportBlob = new Blob([exportPageHtml], { type: 'application/msword' });

                // Create a URL object from the Blob object
                const exportUrl = URL.createObjectURL(exportBlob);

                console.log('Export URL:', exportUrl);

                // Trigger the download process for the file
                const downloadLink = document.createElement('a');
                downloadLink.href = exportUrl;
                downloadLink.download = `${articleData.title}.doc`;
                downloadLink.click();

                // Release the URL object
                URL.revokeObjectURL(exportUrl);
            });
        });
        // Get the input field and article list
        const searchField = document.getElementById('search-field');
        const articleList = document.querySelector('.article-list');

        // Add event listener to the search input field
        searchField.addEventListener('keyup', () => {
            // Get the search term and convert to lowercase
            const searchTerm = searchField.value.toLowerCase();

            // Loop through each article in the list
            for (const article of articleList.children) {
                // Get the article title and date and convert to lowercase
                const articleTitle = article.querySelector('.article-info h3').textContent.toLowerCase();
                const articleDate = article.querySelector('.article-info .article-date').textContent.toLowerCase();

                // Show/hide the article depending on whether the search term is found in the title or date
                if (articleTitle.includes(searchTerm) || articleDate.includes(searchTerm)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            }
        });
        // Get the select element
        const sortSelect = document.getElementById('sort-select');

        // Get all the article list items
        const articleListItems = document.querySelectorAll('.article-list li');

        // Convert the article list items to an array
        const articleArray = Array.from(articleListItems);

        // Function to sort the articles based on the selected option
        function sortArticles() {
            // Get the selected option value
            const sortBy = sortSelect.value;

            // Sort the articles based on the selected option
            if (sortBy === 'title') {
                articleArray.sort((a, b) => {
                    const titleA = a.querySelector('h3').textContent.toUpperCase();
                    const titleB = b.querySelector('h3').textContent.toUpperCase();

                    if (titleA < titleB) {
                        return -1;
                    }
                    if (titleA > titleB) {
                        return 1;
                    }
                    return 0;
                });
            } else if (sortBy === 'date') {
                articleArray.sort((a, b) => {
                    const dateA = a.querySelector('.article-date').textContent.toUpperCase();
                    const dateB = b.querySelector('.article-date').textContent.toUpperCase();

                    if (dateA < dateB) {
                        return -1;
                    }
                    if (dateA > dateB) {
                        return 1;
                    }
                    return 0;
                });
            }

            // Append the sorted articles to the list
            const articleList = document.querySelector('.article-list');
            articleList.innerHTML = '';
            articleArray.forEach(article => articleList.appendChild(article));
        }

        // Add event listener for the select element
        sortSelect.addEventListener('change', sortArticles);


    </script>
</body>

</html>