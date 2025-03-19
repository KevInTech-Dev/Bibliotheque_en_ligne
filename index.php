<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moteur de recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <style>
        .content {
            position: relative;
            z-index: 1; 
            color: black;
            text-align: center;
            padding: 30px;
        }
        .navbar, .container { font-family: "Trirong", serif; }
        .custom-line {
            border-top: 2px solid black; 
            margin: 20px 0;
        }
        .title {
            font-size: 60px;
            font-weight: bold;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black; 
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .carousel-inner img {
            border-radius: 15px;
            border: 2px solid #ccc; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            filter: blur(1px); 
            z-index: -1;
        }
        .carousel-caption h5 {
            color: rgb(3, 2, 59); 
            font-size: 30px; 
            font-weight: bold;
        }
        .carousel-caption p {
            color: rgb(3, 2, 59); 
            font-size: 16px; 
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light text-light bg-light sticky-top">
        <a href="#"><img src="image/w-a.png" style="height: 100px; width:auto; margin-left: 30px;"></a>
        <button type="button" class="navbar-toggler bg-light" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-between" id="nav">
            <ul class="navbar-nav" style="margin-left: 20px;">
                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="propos.php">À propos</a></li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Explorer</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#inscription">Catégorie de livre</a>
                        <a class="dropdown-item" href="#inscription">Chercher un livre</a>
                        <a class="dropdown-item" href="#inscription">Lire un livre</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#inscription">Commencer</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
            <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher un livre" aria-label="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn bg-opacity-25 btn-outline-dark"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <main class="container pt-2">
        <div class="content">
            <h1 class="title">Bienvenue dans votre bibliothèque numérique :</h1>
            <div class="custom-line"></div>
            <div class="container mt-5">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="display-4" style="font-weight:bold">Explorez une vaste collection de livres</h2>
                        <p class="lead">
                            Notre bibliothèque numérique vous offre un accès illimité à une sélection diversifiée de livres, 
                            allant des classiques de la littérature aux ouvrages contemporains.
                        </p>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="image/biblio9.jpg" alt="Collection de livres" class="img-fluid rounded">
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; margin-top: 20px;">
                <div id="carouselExampleCaptions" class="carousel slide" style="flex: 1; max-width: 600px; margin-right: 20px;">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="image/pl1.jpg" class="d-block w-100" alt="image_carousel1" style="max-height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Stimulation d’imagination</h5>
                                <p>Stimuler l’imagination et la créativité.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="image/pl2.jpg" class="d-block w-100" alt="carousel_image2" style="max-height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Réduction du stress</h5>
                                <p>Réduire le stress et favoriser la détente.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="image/pl3.jpg" class="d-block w-100" alt="carousel_image3" style="max-height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Amélioration de concentration</h5>
                                <p>Améliorer la concentration et la mémorisation.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div style="flex: 1; padding: 10px; text-align: justify;">
                    <h3 style="font-size: 40px; font-weight: bold;">Pourquoi lire ?</h3>
                    <p>
                        La lecture stimule votre imagination, améliore votre concentration et élargit vos horizons.
                        Avec chaque livre, vous découvrez de nouvelles idées et perspectives.
                    </p>
                </div>
            </div>

            <div style="margin-top:30px;">
                <h3 style="font-size: 40px; font-weight: bold;">Comment s'inscrire ?</h3>
                <p>Pour profiter de tous ces avantages, il vous suffit de créer un compte. C'est simple et rapide !</p>
                <div class="row" style="margin-top:30px;">
                    <div class="col-md-6">
                        <h2 id="inscription" style="font-weight: bold;">LECTEUR(TRICE) ?</h2>
                        <p>Faites un grand pas vers votre culture en vous inscrivant dans notre bibliothèque numérique.</p>
                        <a class="btn btn-lg" href="inscritlecteur.php" role="button" style="background-color: #ff5757; color: white;">Un clic pour débuter</a>
                    </div> 
                    <div class="col-md-6">
                        <h2 id="inscription" style="font-weight: bold;">ADMINISTRATEUR ?</h2>
                        <p>Gérez notre collection de livres et contribuez à l'enrichissement de notre bibliothèque.</p>
                        <a class="btn btn-lg" href="inscritadmin.php" role="button" style="background-color: #ff5757; color: white;">Demander l'accès</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-black bg-opacity-75 text-white pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <p>&copy; 2024 websearchersgroup</p>
            </div>
            <div class="col-md-3 col-6">
                <p><a href="propos.php" class="text-white">Qui sommes-nous ?</a></p>
            </div>
            <div class="col-md-3 col-6">
                <p>Adresse E-mail :</p>
                <p><a href="mailto:websearchersgroup@gmail.com" class="text-white">websearchersgroup@gmail.com</a></p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <p>Contactez-nous :</p>
                <ul class="list-unstyled">
                    <li>96-79-60-72</li>
                    <li>91-49-68-37</li>
                    <li>96-15-92-57</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


https://kevintech-dev.github.io/web_searches/
