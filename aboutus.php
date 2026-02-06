<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_loggedin']) || $_SESSION['user_loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: login-signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Transportation MS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Reset default margin and padding */
        

        /* Hero section styles */
        .hero-image {
            width: 100%;
            height: auto;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
        }

        .hero-heading {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        /* Mission and values section styles */
        .mission-values {
            background-color: #f9f9f9;
            padding: 40px 0;
            text-align: center;
        }

        .section-heading {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .section-text {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .values-list {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1000px;
            margin: 0 auto;
        }

        .value-item {
            flex: 0 1 30%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            text-align: left;
        }

        .value-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .value-description {
            font-size: 1.1rem;
        }

        /* Our story section styles */
        .our-story {
            background-color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        .our-story .section-text {
            font-size: 1.2rem;
        }

        /* Team section styles */
        .team {
            background-color: #f9f9f9;
            padding: 40px 0;
            text-align: center;
        }

        .team-list {
            display: flex;
            justify-content: space-evenly;
            /* flex-wrap: wrap; */
            max-width: 1000px;
            margin: 0 auto;
        }

        .team-member {
            flex: 0 1 30%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            text-align: center;
        }

        .team-photo {
            width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .team-name {
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .team-role {
            font-size: 1.1rem;
            color: #666;
        }

        /* Footer styles */
        .footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .social-links {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .social-links li {
            display: inline-block;
            margin-right: 10px;
        }

        .social-links li:last-child {
            margin-right: 0;
        }

        .social-links a {
            color: #fff;
        }

        .social-links img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .social-links img:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="about-us-container">
        <!-- Navigation Bar -->
        <div class="navbar-container">
            <?php include 'navbar4.php'; ?>
        </div>

        <!-- About Us Hero Section -->
        <div class="about-us-hero">
            <img src="vehicle-home.jpg" alt="About Us" class="hero-image">
            <div class="hero-content">
                <h1 class="hero-heading">About Us</h1>
                <p class="hero-text">
                    Learn more about our journey, mission, and the dedicated team driving Transportation MS.
                </p>
            </div>
        </div>

        <!-- Mission and Values Section -->
        <div class="mission-values">
            <div class="container">
                <h2 class="section-heading">Our Mission and Values</h2>
                <p class="section-text">
                    At Transportation MS, our mission is to provide reliable and efficient transportation services. We
                    are committed to integrity, innovation, and excellence in all that we do.
                </p>
                <div class="values-list">
                    <div class="value-item">
                        <h3 class="value-title">Integrity</h3>
                        <p class="value-description">We uphold the highest standards of integrity in all our actions.
                        </p>
                    </div>
                    <div class="value-item">
                        <h3 class="value-title">Innovation</h3>
                        <p class="value-description">We strive for innovation to meet our clients' evolving needs.</p>
                    </div>
                    <div class="value-item">
                        <h3 class="value-title">Excellence</h3>
                        <p class="value-description">We are dedicated to providing exceptional service and quality.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Story Section -->
        <div class="our-story">
            <div class="container">
                <h2 class="section-heading">Our Story</h2>
                <p class="section-text">
                    Founded in 2023, Transportation MS has grown from a small local service to a national
                    transportation provider. Our journey is marked by continuous growth, innovation, and commitment to
                    our clients.
                </p>
            </div>
        </div>

        <!-- Team Section -->
        <div class="team">
            <div class="container">
                <h2 class="section-heading">Meet Our Team</h2>
                <div class="team-list">
                    <div class="team-member">
                        <img src="team-member.jpg" alt="Team Member 1" class="team-photo">
                        <h3 class="team-name">Preeti </h3>
                        <p class="team-role">CEO</p>
                    </div>
                    <div class="team-member">
                        <img src="team-member.jpg" alt="Team Member 1" class="team-photo">
                        <h3 class="team-name">Rohini</h3>
                        <p class="team-role">CEO</p>
                    </div>
                    <div class="team-member">
                        <img src="team-member.jpg" alt="Team Member 1" class="team-photo">
                        <h3 class="team-name">Radhika </h3>
                        <p class="team-role">CEO</p>
                    </div>
                    <div class="team-member">
                        <img src="team-member.jpg" alt="Team Member 2" class="team-photo">
                        <h3 class="team-name">Manish</h3>
                        <p class="team-role">CEO</p>
                    </div>
                    <div class="team-member">
                        <img src="team-member.jpg" alt="Team Member 3" class="team-photo">
                        <h3 class="team-name">Divya</h3>
                        <p class="team-role">CEO</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <footer class="footer">
            <?php include 'footer.php'; ?>
        </footer>
    </div>
</body>

</html>