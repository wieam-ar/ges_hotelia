
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hôtelia.com</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        .loading-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            
        }

       

        .loading-content {
            text-align: center;
            color: white;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: logoGlow 2s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            from {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

            to {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.5), 2px 2px 4px rgba(0, 0, 0, 0.3);
            }
        }

        .loading-spinner {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 2rem auto;
        }

        .spinner-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 3px solid transparent;
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }

        .spinner-ring:nth-child(1) {
            border-top-color: #ffffff;
            animation-delay: 0s;
        }

        .spinner-ring:nth-child(2) {
            border-right-color: #d2bc77;
            animation-delay: 0.5s;
            width: 90%;
            height: 90%;
            top: 5%;
            left: 5%;
        }

        .spinner-ring:nth-child(3) {
            border-bottom-color: #ab8207;
            animation-delay: 1s;
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-text {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 1rem;
            animation: textPulse 2s ease-in-out infinite;
        }

        @keyframes textPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .progress-container {
            width: 300px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 4px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 8px;
            background: linear-gradient(90deg, #ffffff, #d4af37, #4e3b2a);
            border-radius: 20px;
            width: 0%;
            transition: width 0.3s ease;
            animation: progressGlow 2s ease-in-out infinite;
        }

        @keyframes progressGlow {

            0%,
            100% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            }
        }

        .loading-percentage {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 1rem;
            animation: numberCount 0.5s ease-out;
        }

        @keyframes numberCount {
            from {
                transform: scale(1.2);
            }

            to {
                transform: scale(1);
            }
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 10px;
            height: 10px;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 6px;
            height: 6px;
            left: 20%;
            animation-delay: 1s;
        }

        .particle:nth-child(3) {
            width: 8px;
            height: 8px;
            left: 30%;
            animation-delay: 2s;
        }

        .particle:nth-child(4) {
            width: 12px;
            height: 12px;
            left: 40%;
            animation-delay: 3s;
        }

        .particle:nth-child(5) {
            width: 7px;
            height: 7px;
            left: 50%;
            animation-delay: 4s;
        }

        .particle:nth-child(6) {
            width: 9px;
            height: 9px;
            left: 60%;
            animation-delay: 5s;
        }

        .particle:nth-child(7) {
            width: 11px;
            height: 11px;
            left: 70%;
            animation-delay: 0.5s;
        }

        .particle:nth-child(8) {
            width: 5px;
            height: 5px;
            left: 80%;
            animation-delay: 1.5s;
        }

        .particle:nth-child(9) {
            width: 13px;
            height: 13px;
            left: 90%;
            animation-delay: 2.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }

            50% {
                transform: translateY(-10px) rotate(180deg);
            }
        }

        .main-content {
            display: none;
            padding: 50px 0;
            text-align: center;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            margin: 2rem auto;
            max-width: 600px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .logo {
                font-size: 2rem;
            }

            .loading-text {
                font-size: 1.2rem;
            }

            .progress-container {
                width: 250px;
            }

            .welcome-card {
                margin: 1rem;
                padding: 2rem;
            }
        }
    </style>

</head>

<body>
    <!-- Écran de Chargement -->
    <div class="loading-container" id="loadingScreen">
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="loading-content">
            <div class="logo">
                <i class="fas fa-gem"></i> Hôtelia

            </div>

            <div class="loading-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
                <div class="spinner-ring"></div>
            </div>

            <div class="loading-text">Préparation d'une expérience exceptionnelle...</div>

            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>

            <div class="loading-percentage" id="loadingPercentage">0%</div>
        </div>
    </div>






    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <nav class="navbar navbar-expand-lg ">
                        <a class="navbar-brand" href="#">
                            <img src="./pictures/image-removebg-preview (2).png" alt="logo" style="width: 190px;">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <!-- mx-auto to center links -->
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section1">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section2">Opportunités</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section3">Hotels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section4">Booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section5">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section6">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="#section7">Map</a>
                                </li>
                            </ul>
                            <div class="btn-group">
                                <a href="login.php" class="btn  me-2">Login</a>
                                <a href="adminlogin.php" class="btn ">Admin</a>
                            </div>
                        </div>
                    </nav>


                </div>
            </div>
        </div>
    </header>
    <!-- Section 1 -->
    <section id="section1" class="mt-5 " style="height:100vh; ">
        <div class="container  ">
            <video autoplay muted loop class="hero-section" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1; border-radius: 20px;">
                <source src="./pictures/3410663-uhd_2562_1440_30fps (1).mp4" type="video/mp4">
            </video>
            <div class="row justify-content-center ">
                <div class="col-md-10 col-sm-12 centrehero mt-5 mx-auto">

                    <h1 class="hero-title" style="font-size: 3rem; margin-top: 15%;">Rencontre des voyageurs.</h1>
                    <p class="hero-subtitle">Choisir où te loger et on te montrera avec qui !</p>

                    <!-- Search Form -->
                    <div>
                        <div class="row g-2 align-items-center">
                            <div class="col-md-12 col-sm some d-flex justify-content-center " id="search-form">
                            
                                <form action="reservation.php" method="GET">
                                    <div class="input-group ml-3">
                                        <span class="input-group-text border-0">
                                            <i class="fas fa-map-marker-alt icon-location"></i>
                                        </span>
                                        <input type="text" name="ville" id="ville" class="form-control search-input border-0" placeholder="Nom hotel vous aller allerOù vous aller aller, réserver ?">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text border-0">
                                            <i class="fas fa-calendar icon-calendar"></i>
                                        </span>
                                        <input type="date" name="date_arrivee" id="date_arrivee" class="form-control search-input border-0" placeholder="Départ">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text border-0">
                                            <i class="fas fa-calendar icon-calendar"></i>
                                        </span>
                                        <input type="date" name="date_depart" id="date_depart" class="form-control search-input border-0" placeholder="Arrivée">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text border-0">
                                            <i class="fas fa-users icon-users"></i>
                                        </span>
                                        <input type="number" name="personnes" id="personnes" class="form-control search-input border-0" placeholder="Personnes">
                                    </div>

                                    <button type="submit" class="btn search-btn w-100">
                                        Affons-y! <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    <!-- nos opportunités -->
    <section id="section2 " style=" height:100vh;">
        <div class="container ">

            <div class="row ">
                <div class="col-md-12 col-sm">
                    <h1 class="text-center text-light p-5">Découvrez nos opportunités</h1>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12 col-sm">
                    <div class="hotel-section">
                        <div class="container ">


                            <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <!-- First slide -->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-2 col-sm mb-3 ">
                                                <div class="hotel-card1 hotel-spa" style="  background-image:url('pictures/chambre1.jpg');background-repeat:no-repeat;   background-position:center; background-size:cover; ">
                                                    <div class="hotel-label">room</div>
                                                    <div class="hotel-icon"><i class="fas fa-bed"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-piscine " style="  background-image:url('pictures/picine.jpg');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">Piscine</div>
                                                    <div class="hotel-icon"><i class="fas fa-swimming-pool"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <div class="hotel-card1 hotel-terrace " style="  background-image:url('pictures/terrase.jpg');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">Terasse</div>
                                                    <div class="hotel-icon"><i class="fas fa-umbrella-beach"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-bedroom " style="  background-image:url('pictures/picine2.avif');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">partys</div>
                                                    <div class="hotel-icon"><i class="fas fa-cake"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-terasse2 " style="  background-image:url('pictures/chambre3.jpg');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">solo room</div>
                                                    <div class="hotel-icon"><i class="fas fa-bed"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- second slide -->
                                    <div class="carousel-item">
                                        <div class="row">

                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-spa" style="  background-image:url('pictures/picine2.avif');background-repeat:no-repeat;   background-position:center; background-size:cover; ">
                                                    <div class="hotel-label">picine</div>
                                                    <div class="hotel-icon"><i class="fas fa-swimming-pool"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-piscine " style="  background-image:url('pictures/terrase.jpg');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">terrasse</div>
                                                    <div class="hotel-icon"><i class="fas fa-tree"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm mb-3">
                                                <div class="hotel-card1 hotel-terrace " style="  background-image:url('pictures/chambre3.jpg');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">chambre</div>
                                                    <div class="hotel-icon"><i class="fas fa-bed"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-bedroom " style="  background-image:url('pictures/party.png');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">swiming pool</div>
                                                    <div class="hotel-icon"><i class="fas fa-swiming-pool"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm mb-3">
                                                <div class="hotel-card1 hotel-terasse2 " style="  background-image:url('pictures/food.png');background-repeat:no-repeat;   background-position:center; background-size:cover;">
                                                    <div class="hotel-label">food</div>
                                                    <div class="hotel-icon"><i class="fas fa-meet"></i></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>

    </section>

    <!-- les hotels-->
    <section id="section3" style="width: 100%; height:110vh;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm">
                    <div class="decorative-circles ml-5">
                        <!-- Orange circles -->
                        <div class="circle circle-orange" style="width: 15px; height: 15px; top: 10%; left: 5%;"></div>
                        <div class="circle circle-orange" style="width: 25px; height: 25px; top: 15%; left: 12%;"></div>
                        <div class="circle circle-orange" style="width: 35px; height: 35px; top: 8%; left: 3%;"></div>
                        <div class="circle circle-orange" style="width: 20px; height: 20px; top: 20%; right: 5%;"></div>
                        <div class="circle circle-orange" style="width: 30px; height: 30px; top: 12%; right: 14%;"></div>
                        <div class="circle circle-orange" style="width: 18px; height: 18px; bottom: 25%; right: 5%;"></div>

                        <!-- Black circles -->
                        <div class="circle circle-black" style="width: 12px; height: 12px; top: 25%; left: 8%;"></div>
                        <div class="circle circle-black" style="width: 18px; height: 18px; top: 18%; right: 12%;"></div>
                        <div class="circle circle-black" style="width: 22px; height: 22px; bottom: 30%; right: 12%;"></div>

                        <!-- Outline circles -->
                        <div class="circle circle-outline" style="width: 40px; height: 40px; top: 5%; left: 1%;"></div>
                        <div class="circle circle-outline" style="width: 50px; height: 50px; top: 25%; right: 3%;"></div>
                        <div class="circle circle-outline" style="width: 35px; height: 35px; bottom: 20%; right: 8%;"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center p-5">
                <div class="col-md-12 col-sm">
                    <div class="header-section">
                        <h1 class="main-title">Découvrir notre Hoteles de Luxe autour du monde !</h1>
                        <div class="subtitle">Biscuit Découvrir notre hoteles !</div>
                    </div>

                    <div class="hotel-grid">
                        <div class="hotel-card">
                            <img src="./pictures/london.avif" alt="Modern Luxury Hotel" class="hotel-image">
                        </div>

                        <div class="hotel-card">
                            <img src="./pictures/hotelmarina.avif" alt="Beach Resort" class="hotel-image">
                        </div>

                        <div class="hotel-card">
                            <img src="./pictures/nom1.avif" alt="Night Pool View" class="hotel-image">
                        </div>

                        <div class="hotel-card">
                            <img src="./pictures/hotel2.avif" alt="Tropical Resort" class="hotel-image">

                        </div>
                    </div>

                    <div class="bottom-section d-flex justify-content-between align-items-center p-3 mt-5">
                        <div class="reviews-section">
                            <div class="customer-avatars">
                                <div class="avatar" style="background-image: url('./pictures/boy.png');"></div>
                                <div class="avatar" style="background-image: url('./pictures/girl.png');"></div>
                                <div class="avatar" style="background-image: url('./pictures/man.png');"></div>
                            </div>
                            <div class="reviews-text">
                                <a href="reviews.php" style="text-decoration: none;">
                                    <span class="reviews-count">+100 Reviews</span><br>
                                </a>
                                <small>Customers are satisfied</small>
                            </div>
                        </div>
                        <div class="website-logo">
                            Hôtelia
                        </div>

                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>




    <!-- Reservations -->
    <section id="section4" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center text-white">
                    <h2 class="display-4 fw-bold">Réserver Maintenant</h2>
                    <p class="lead">Trouvez votre hébergement de rêve au meilleur prix</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden">
                        <div class="card-img-container position-relative">
                            <img src="./pictures/osais.png"
                                class="card-img-top" alt="Hôtel Oasis" style="height: 220px; object-fit: cover;">
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2 px-3 py-2">
                                <i class="fas fa-tag me-1"></i>700 MAD/nuit
                            </span>
                        </div>
                        <div class="card-body text-dark bg-white">
                            <div class="star-rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-2 text-muted">(4.5)</span>
                            </div>
                            <h5 class="card-title fw-bold">Hôtel Oasis</h5>
                            <div class="amenities">
                                <i class="fas fa-wifi amenity-icon" title="WiFi gratuit"></i>
                                <i class="fas fa-swimming-pool amenity-icon" title="Piscine"></i>
                                <i class="fas fa-car amenity-icon" title="Parking"></i>
                                <i class="fas fa-utensils amenity-icon" title="Restaurant"></i>
                            </div>
                            <p class="card-text">Vue magnifique, espace calme et détente assurée pour toute la famille.</p>
                            <a href="login.php" class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden">
                        <div class="card-img-container position-relative">
                            <img src="./pictures/riadmarakech.png"
                                class="card-img-top" alt="Riad Marrakech" style="height: 220px; object-fit: cover;">
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2 px-3 py-2">
                                <i class="fas fa-tag me-1"></i>550 MAD/nuit
                            </span>
                        </div>
                        <div class="card-body text-dark bg-white">
                            <div class="star-rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span class="ms-2 text-muted">(4.0)</span>
                            </div>
                            <h5 class="card-title fw-bold">Riad Marrakech</h5>
                            <div class="amenities">
                                <i class="fas fa-wifi amenity-icon" title="WiFi gratuit"></i>
                                <i class="fas fa-spa amenity-icon" title="Spa"></i>
                                <i class="fas fa-concierge-bell amenity-icon" title="Service concierge"></i>
                                <i class="fas fa-mosque amenity-icon" title="Architecture traditionnelle"></i>
                            </div>
                            <p class="card-text">Un séjour traditionnel et authentique au cœur de la médina.</p>
                            <a href="login.php" class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden">
                        <div class="card-img-container position-relative">
                            <img src="./pictures/farah.png"
                                class="card-img-top" alt="Plage Paradis" style="height: 220px; object-fit: cover;">
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2 px-3 py-2">
                                <i class="fas fa-tag me-1"></i>950 MAD/nuit
                            </span>
                        </div>
                        <div class="card-body text-dark bg-white">
                            <div class="star-rating mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="ms-2 text-muted">(5.0)</span>
                            </div>
                            <h5 class="card-title fw-bold">Plage Paradis</h5>
                            <div class="amenities">
                                <i class="fas fa-wifi amenity-icon" title="WiFi gratuit"></i>
                                <i class="fas fa-swimming-pool amenity-icon" title="Piscine"></i>
                                <i class="fas fa-spa amenity-icon" title="Spa"></i>
                                <i class="fas fa-umbrella-beach amenity-icon" title="Accès plage"></i>
                            </div>
                            <p class="card-text">Profitez du luxe en hotel farah .</p>
                            <a href="login.php" class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- les services    -->
    <section id="section5" style="width: 103%; height:100vh; ">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-12 col-sm mb-5">
                    <h2 class="service-title " style="color: #c89e52;   text-align: center;margin-bottom: 2rem;font-size: 4rem;font-weight: 600;">Cofiences of our services </h2>
                    <p class="parag-service text-center text-white">
                        We welcome all types of travelers—whether individuals, families,
                        or teams—for both short-term daily stays and long-term accommodations
                    </p>
                </div>
            </div>
            <div class="row p-5 ">
                <div class="col-md-3 col-sm">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3 class="service-title">
                            One-day WiFi service
                        </h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="service-title">
                            24/7 customer support
                        </h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm">
                    <div class="service-card highlight">
                        <div class="service-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3 class="service-title">
                            Fully equipped kitchen
                        </h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="service-title">
                            Late checkout available<br>upon request
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FQA -->
    <section id="section6" class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 col-sm">
                    <div class="faq-header">
                        <div class="section-subtitle" style=" color:rgb(179, 173, 94);font-size: 1rem;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;margin-bottom: 1rem;">Got Questions?</div>
                        <h2 class="faq-title">Frequently Asked Questions</h2>
                        <p class="faq-titles ">Find answers to the most common questions about our services, booking process, and policies. <br> If you need more help, don't hesitate to contact us.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="faq-accordion">

                        <!-- FAQ Item 1 -->
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <div class="faq-question-content">
                                    <i class="fas fa-bed faq-icon"></i>
                                    <span>What room types do you offer?</span>
                                </div>
                                <i class="fas fa-chevron-down faq-toggle"></i>
                            </button>
                            <div class="faq-answer">
                                We offer a variety of room types including Standard Rooms, Deluxe Rooms, Junior Suites, Executive Suites, and Presidential Suites.
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <div class="faq-question-content">
                                    <i class="fas fa-mobile-alt faq-icon"></i>
                                    <span>Can I book directly from my phone?</span>
                                </div>
                                <i class="fas fa-chevron-down faq-toggle"></i>
                            </button>
                            <div class="faq-answer">
                                Absolutely! Our mobile-friendly website and app allow full access to all features.
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <div class="faq-question-content">
                                    <i class="fas fa-clock faq-icon"></i>
                                    <span>What are check-in and check-out times?</span>
                                </div>
                                <i class="fas fa-chevron-down faq-toggle"></i>
                            </button>
                            <div class="faq-answer">
                                Standard check-in time is 3:00 PM and check-out time is 12:00 PM.
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <div class="faq-question-content">
                                    <i class="fas fa-car faq-icon"></i>
                                    <span>Is parking available at the hotel?</span>
                                </div>
                                <i class="fas fa-chevron-down faq-toggle"></i>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    Yes, we offer both self-parking and valet parking services. Self-parking is complimentary for hotel guests in our secure garage. Premium valet parking is available 24/7 for an additional fee with same-day service.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <div class="faq-question-content">
                                    <i class="fas fa-paw faq-icon"></i>
                                    <span>Do you allow pets?</span>
                                </div>
                                <i class="fas fa-chevron-down faq-toggle"></i>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    We are a pet-friendly hotel! We welcome dogs and cats with a reasonable pet fee. Please inform us during booking about your furry companion. We provide pet beds, bowls, and treats. Review our pet policy for size restrictions and guidelines.
                                </div>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <div class="faq-question-content">
                                    <i class="fas fa-utensils faq-icon"></i>
                                    <span>Is breakfast included?</span>
                                </div>
                                <i class="fas fa-chevron-down faq-toggle"></i>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-content">
                                    Breakfast inclusion depends on your room package. Many of our rates include complimentary continental or full breakfast buffet, while others offer it as an optional add-on. Check your booking confirmation for specific details about your package.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section map -->
    <section id="section8" style="width: 103%; height: 100vh; background-color:rgb(0, 0, 0);">
        <div class="container-fluid p-0 h-100">
            <div class="row h-100">
                <div class="col-md-12 col-sm h-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d52982.43340340054!2d-6.914048!3d33.9050496!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sma!4v1748896871886!5m2!1sfr!2sma"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- footer  -->
    <?php include 'includes/footer.php'; ?>
    <script>
        // loading page 
        // Animation de Chargement
        let progress = 0;
        const progressBar = document.getElementById('progressBar');
        const loadingPercentage = document.getElementById('loadingPercentage');
        const loadingScreen = document.getElementById('loadingScreen');
        const mainContent = document.getElementById('mainContent');

        // Messages de chargement
        const loadingMessages = [
            'Préparation d\'une expérience exceptionnelle...',
            'Chargement du contenu de luxe...',
            'Mise en place d\'une interface unique...',
            'Tout est prêt pour vous...',
            'Dernières retouches en cours...'
        ];

        let messageIndex = 0;
        const loadingText = document.querySelector('.loading-text');

        // Mettre à jour le message de chargement
        function updateLoadingMessage() {
            loadingText.style.animation = 'none';
            setTimeout(() => {
                loadingText.textContent = loadingMessages[messageIndex];
                loadingText.style.animation = 'textPulse 2s ease-in-out infinite';
                messageIndex = (messageIndex + 1) % loadingMessages.length;
            }, 100);
        }

        // Mettre à jour la progression
        function updateProgress() {
            if (progress < 100) {
                // Incrément aléatoire entre 1 et 5
                const increment = Math.random() * 4 + 1;
                progress = Math.min(progress + increment, 100);

                progressBar.style.width = progress + '%';
                loadingPercentage.textContent = Math.floor(progress) + '%';

                // Animation du pourcentage
                loadingPercentage.style.animation = 'none';
                setTimeout(() => {
                    loadingPercentage.style.animation = 'numberCount 0.5s ease-out';
                }, 10);

                // Changer le message tous les 20%
                if (Math.floor(progress) % 20 === 0 && Math.floor(progress) !== 0) {
                    updateLoadingMessage();
                }

                // Continuer le chargement
                setTimeout(updateProgress, Math.random() * 200 + 100);
            } else {
                // Chargement terminé
                setTimeout(completeLoading, 1000);
            }
        }

        // Terminer le chargement et afficher le contenu principal
        function completeLoading() {
            loadingScreen.style.opacity = '0';
            loadingScreen.style.transition = 'opacity 1s ease-out';

            setTimeout(() => {
                loadingScreen.style.display = 'none';
                mainContent.style.display = 'block';
                document.body.style.overflow = 'auto';

                // Animation du contenu principal
                mainContent.style.opacity = '0';
                mainContent.style.transform = 'translateY(50px)';
                mainContent.style.transition = 'all 1s ease-out';

                setTimeout(() => {
                    mainContent.style.opacity = '1';
                    mainContent.style.transform = 'translateY(0)';
                }, 100);
            }, 1000);
        }

        // Démarrer l'animation de chargement
        setTimeout(() => {
            updateProgress();
        }, 1000);

        // Mettre à jour le message toutes les 2 secondes
        setInterval(updateLoadingMessage, 2000);



        // faq script 
        function toggleFaq(button) {
            const item = button.parentElement;
            item.classList.toggle('active');
        }
    </script>

    <script src="./javascript/scrip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>