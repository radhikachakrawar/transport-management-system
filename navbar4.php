<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transportation MS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />
    <style data-tag="reset-style-sheet">
        /* Your existing reset styles */
    </style>
    <style data-tag="default-style-sheet">
        /* Your existing default styles */
    </style>
    <style>
        :root {
            --background-purple: #EEEEEE;
            --subtle-white: #f9f9f9;
            --subtle-grey: #f2f2f2;
            --masked-grey: #333;
            --blue: #F03861;
            --open-sans: 'Open Sans', sans-serif;
        }

        *,
        *:before,
        *:after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            background-color: var(--background-purple);
        }

        // page container
        .container {
            width: 100%;
            height: 100%;
            position: relative;
            z-index: 0;
        }

        // tutorial start
        .tutorial {
            width: 80%;
            margin: 5% auto 0 auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: var(--subtle-white);
            max-width: 800px;
            z-index: 1;
        }

        .slider {
            width: 100%;
            height: 300px;
            background-color: var(--blue);
        }

        .information {
            width: 100%;
            padding: 20px 50px;
            margin-bottom: 30px;
            font-family: var(--open-sans);
        }

        .information h1 {
            color: var(--masked-grey);
            font-size: 1.5rem;
            padding: 0px 10px;
            border-left: 3px solid var(--blue);
        }

        .information h3 {
            color: darken(var(--subtle-grey), 7%);
            font-size: 1rem;
            font-weight: 300;
            padding: 0px 10px;
            border-left: 3px solid var(--blue);
        }

        .information p {
            padding: 10px 0px;
        }

        ul {
            font-size: 0;
            list-style-type: none;
        }

        ul li {
            font-family: var(--open-sans);
            font-size: 1rem;
            font-weight: 400;
            color: var(--masked-grey);
            display: inline-block;
            padding: 15px;
            position: relative;
        }

        ul li ul {
            display: none;
        }

        ul li:hover {
            cursor: pointer;
            background-color: var(--subtle-grey);
        }

        ul li:hover ul {
            display: block;
            margin-top: 15px;
            width: 500px;
            left: 0;
            position: absolute;
            z-index: 2;
        }

        ul li ul li {
            display: block;
            background-color: darken(var(--subtle-white), 7%);
        }

        ul li ul li span {
            float: right;
            color: var(--subtle-white);
            background-color: var(--blue);
            padding: 2px 5px;
            text-align: center;
            font-size: .8rem;
            border-radius: 3px;
        }

        ul li ul li:hover {
            background-color: darken(var(--subtle-white), 10%);
        }

        ul li ul li:hover span {
            background-color: darken(var(--blue), 5%);
        }

        /* Additional styles for dropdown menu */
        .dropdown {
            position: relative;
            display: inline-block;
            z-index: 3;
        }

        .dropdown span.thq-link {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        .dropdown ul {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 10px;
            display: none;
            z-index: 999;
        }

        .dropdown li {
            margin-bottom: 10px;
        }

        .dropdown li a {
            color: #333;
            text-decoration: none;
        }

        .dropdown li a:hover {
            background-color: #f0f0f0;
        }

        .dropdown:hover ul {
            display: block;
        }

        span.thq-link:hover {
            text-decoration: underline;
            color: orange;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/animate.css@4.1.1/animate.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet" href="https://unpkg.com/@teleporthq/teleport-custom-scripts/dist/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=1" />
    <link href="components\navbar4.CSS" rel="stylesheet" />
</head>

<body>
    <header data-thq="thq-navbar" class="navbar4-navbar-interactive">
        <img src="public/logo-colored-jpg-thumb-removebg-preview-200h.png" alt="image" id="nav-logo"
            class="navbar4-image" />
        <div data-thq="thq-navbar-nav" class="navbar4-desktop-menu">
            <nav id="nav-nav" class="navbar4-links">
                <span class="thq-link thq-body-small"><a href="index.php" class="home">Home</a></span>
                <div class="dropdown">
                    <span class="thq-link thq-body-small">
                        <a href="index.php">Services</a>
                    </span>
                    <ul>
                        <li><a href="booking.php">Ticket Booking</a></li>
                        <li><a href="vehicle_booking.php">Vehicle Booking</a></li>
                        <li><a href="goods_transport.php">Goods Transport</a></li>
                    </ul>
                </div>
                <span class="thq-link thq-body-small">
                    <a href="carrier-network.php" class="CN">Carrier Network</a>
                </span>
                <span class="thq-link thq-body-small "><a href="aboutus.php" class="aboutus">About Us</a></span>
                <span class="thq-link thq-body-small">
                    <a href="contactus.php" class="contactus">Contact Us</a>
                </span>
            </nav>
            <div class="navbar4-buttons">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="navbar4-username"><?php echo $_SESSION['username']; ?></span>
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <form action="logout.php" method="post" style="display: inline;">
                        <button type="submit" class="thq-button-filled" style="background-color:#D1510A">
                            <span>Logout <i class="fa-solid fa-right-from-bracket"></i></span>
                        </button>
                    </form>
                <?php else: ?>
                    <a href="login-signup.php" class="thq-button-filled" style="text-decoration:none;">
    <span>Login / Sign Up</span>
</a>

                   <a href="admins/login.php" class="admin-login thq-button-filled">
    <span>Admin Login</span>
</a>

                <?php endif; ?>
            </div>
        </div>
        <div data-thq="thq-burger-menu" class="navbar4-burger-menu">
            <svg viewBox="0 0 1024 1024" class="navbar4-icon">
                <path
                    d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z">
                </path>
            </svg>
        </div>
        <div data-thq="thq-mobile-menu" class="navbar4-mobile-menu">
            <div class="navbar4-nav">
                <div class="navbar4-top">
                    <img alt="Transportation Management System"
                        src="public/logo-colored-jpg-thumb-removebg-preview-200h.png" class="navbar4-logo" />
                    <div data-thq="thq-close-menu" class="navbar4-close-menu">
                        <svg viewBox="0 0 1024 1024" class="navbar4-icon2">
                            <path
                                d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z">
                            </path>
                        </svg>
                    </div>
                </div>
                <nav class="navbar4-links1">
                    <span class="thq-link thq-body-small"><span>Home</span></span>
                    <span class="thq-link thq-body-small"><span>Services</span></span>
                    <span class="thq-link thq-body-small"><span>About Us</span></span>
                    <span class="thq-link thq-body-small"><span>Contact Us</span></span>
                    <span class="thq-link thq-body-small"><span>Carrier Network</span></span>
                </nav>
            </div>
            <div class="navbar4-buttons1">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="navbar4-username"><?php echo $_SESSION['username']; ?></span>
                    <form action="logout.php" method="post" style="display: inline;">
                        <button type="submit" class="thq-button-filled" style="background-color:#D1510A">
                            <span>Logout</span>
                        </button>
                    </form>
                <?php else: ?>
                    <button class="thq-button-filled">Login</button>
                    <button class="thq-button-outline">Register</button>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the "Ticket Booking" link
            var ticketBookingLink = document.querySelector('a[href="booking.php"]');

            // Add click event listener
            ticketBookingLink.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent the default action of the link

                // Check if the user is logged in
                <?php if (isset($_SESSION['username'])): ?>
                    // If user is logged in, redirect to booking.php
                    window.location.href = "booking.php";
                <?php else: ?>
                    // If user is not logged in, redirect to login-signup.php
                    window.location.href = "login-signup.php";
                <?php endif; ?>
            });
        });
    </script>


    <script src="index.js" defer></script>
</body>

</html>