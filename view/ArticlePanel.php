<?php 
include_once('../controller/UserC.php');
$UserC = new UserC();
session_start();
$id=$_SESSION["iduser"];
$nomUser=$UserC->recupererNomA($id);
include '../controller/ArticleC.php';
$error = '';
$articleC = new ArticleC();

$listearticle = $articleC->listallArticle();

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
            $nomUser["ID"],
            $image_data,
            $image_type
        );
        $articleC->addArticle($article);
        header('Location:ArticlePanel.php');
    } else {
        $error = "Missing information";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/stylePanel.css">
    <link rel="stylesheet" href="../css/styleAhmed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <img src="../img/logo2.png" alt="site-logo" class="site-logo"
                    style="position: relative !important; right: 100px;">

                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">
                        close
                    </span>

                </div>
            </div>
            <div class="sidebar">
                <a href="TableauPanel.php">
                    <span class="material-symbols-sharp">
                        grid_view
                    </span>
                    <h3>Tableau de bord</h3>
                </a>
                <a href="MedecinPanel.php">
                    <span class="material-symbols-sharp">
                        clinical_notes
                    </span>
                    <h3>Medecin</h3>
                </a>
                <a href="ConsultationPanel.php">
                    <span class="material-symbols-sharp">
                        meeting_room
                    </span>
                    <h3>Consultation</h3>
                </a>
                <a href="ordonnoncePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                        </span>
                        <h3>ordonnonce</h3>
                </a>
                <a href="PharamaciePanel.php">
                    <span class="material-symbols-sharp">
                        vaccines
                    </span>
                    <h3>Pharamacie</h3>
                </a>
                <a href="EvenementPanel.php">
                    <span class="material-symbols-sharp">
                        event
                    </span>
                    <h3>Evenement</h3>
                    <span class="message-count">26</span>
                </a> <a href="ArticlePanel.php" class="active">
                    <span class="material-symbols-sharp">
                        article
                    </span>
                    <h3>Article</h3>
                </a> <a href="AdminPanel.php">
                    <span class="material-symbols-sharp">
                        account_circle
                    </span>
                    <h3>Admin</h3>
                </a> <a href="ReclamationPanel.php">
                    <span class="material-symbols-sharp">
                        problem
                    </span>
                    <h3>Reclamation</h3>
                </a> <a href="ParametrePanel.php">
                    <span class="material-symbols-sharp">
                        settings
                    </span>
                    <h3>Paramètre</h3>
                </a>
                <a href="main.php">
                    <span class="material-symbols-sharp">
                        logout
                    </span>
                    <h3>Disconnecter</h3>
                </a>
            </div>
        </aside>
        <!----- end of aside -->
        <main class="mai">
            
    <form id="myForma" class="forum" action="" method="POST" enctype="multipart/form-data">
        <h2>Add New Article</h2>
        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" id="Title" name="Title">
            <span id="titreerror"></span>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="15" id="content" name="content"></textarea>
            <span id="contenterror"></span>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image">
            <span id="imageerror"></span>
            <input type="hidden" name="image_type" id="image_type">
        </div>
        <div class="form-group">
            <div id="drop-zone">Drop a .docx file here</div>
            <img id="image-preview">
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
    <section class="recent-articles">
    <h2>Recent Articles</h2>
        <div class="article-search">
            <input type="text" id="search-field" placeholder="Search..." name="search">
            <select id="sort-select">
                <option value="title">Title</option>
                <option value="date">Date</option>
            </select>
        </div>
     
        <ul class="article-list">
            <?php foreach ($listearticle as $Article) { ?>
            <li>
                <div class="article-info">
                    <h3>
                        <?php echo $Article['Title']; ?>
                    </h3>
                    <div class="actions">
                        <a href="ArticleSupp.php?IdArticle=<?php echo $Article['IdArticle']; ?>"><i
                                class="fas fa-trash"></i></a>
                        <a href="ArticleMod.php?IdArticle=<?php echo $Article['IdArticle']; ?>"><i
                                class="fas fa-edit"></i></a>
                        <a id="btn" class="export-btn" data-title="<?php echo $Article['Title']; ?>"
                            data-content="<?php echo $Article['content']; ?>"
                            data-image="<?php echo base64_encode($Article['image_data']); ?>"
                            data-type="<?php echo $Article['image_type']; ?>"><i
                                class="fas fa-download"></i></a>
                    </div>
                    <span class="article-date">
                        <?php echo $Article['time']; ?>
                    </span>
                </div>
                <div class="article-image">
                    <img src="data:<?php echo $Article['image_type']; ?>;base64,<?php echo base64_encode($Article['image_data']); ?>"
                        alt="<?php echo $Article['Title']; ?>">
                </div>
            </li>
            <?php } ?>
        </ul>
    </section>




</main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-sharp">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">
                        light_mode
                    </span>
                    <span class="material-symbols-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Bonjour, <b><?php echo $nomUser["FIRSTNAME"] ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                    <img  src="data:image/png;base64,<?php echo base64_encode($nomUser["PICTURE"]); ?>">
                    </div>
                </div>
            </div>
            <!---END OF TOP-->
            <div class="recent-updates">
                <h2>notification</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="../img/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> received his order of Night Lion tech GPS drone.</p>
                            <small class="text-muted">2 minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!----END OF RECENT UPDATES-->
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            shopping_cart
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes en ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            local_mall
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Commandes hors ligne</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>1100</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-symbols-sharp">
                            person
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>nouveaux clients</h3>
                            <small class="text-muted">Dernières 24 heures</small>
                        </div>
                        <h5 class="success">+25%</h5>
                        <h3>849</h3>
                    </div>
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