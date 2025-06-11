<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hôtelia.com</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
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
        <div class="container  " >
            <video autoplay muted loop class="hero-section" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1; border-radius: 20px;">
                <source src="./pictures/3410663-uhd_2562_1440_30fps (2).mp4" type="video/mp4" >
            </video>
            <div class="row justify-content-center ">
                <div class="col-md-10 col-sm-12 centrehero mt-5 mx-auto">
 
                    <h1 class="hero-title" style="font-size: 3rem; margin-top: 15%;">Rencontre des voyageurs.</h1>
                    <p class="hero-subtitle">Choisir où te loger et on te montrera avec qui !</p>

                    <!-- Search Form -->
                    <div  >
                        <div class="row g-2 align-items-center">
                            <div class="col-md-12 col-sm some d-flex justify-content-center " id="search-form">
                                <form action="reservation.php" method="GET"  >
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

                                    <!-- Second slide -->
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
                                                    <div class="hotel-label">party</div>
                                                    <div class="hotel-icon"><i class="fas fa-cake"></i></div>
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
                            <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
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
                            <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
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
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
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
                            <p class="card-text">Profitez du luxe en bord de mer avec piscine, spa et plus encore.</p>
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
        function toggleFaq(button) {
            const item = button.parentElement;
            item.classList.toggle('active');
        }
    </script>

    <script src="./javascript/scrip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>