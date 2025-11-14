<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Swinburne Student Village'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        /* Modern CSS Variables */
        :root {
            --primary-red: #e74c3c;
            --primary-dark: #404040;
            --primary-black: #2c3e50;
            --light-gray: #f8f9fa;
            --medium-gray: #7f8c8d;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --shadow-hover: 0 20px 40px rgba(0,0,0,0.15);
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --border-radius: 20px;
        }

        /* Enhanced Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            line-height: 1.7;
            color: var(--primary-dark);
            background: var(--white);
            overflow-x: hidden;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Enhanced Floating Nav Bar */
        header {
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow);
            position: fixed;
            width: 90%;
            max-width: 1200px;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 50px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            transition: var(--transition);
        }

        header.scrolled {
            top: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        nav ul {
            display: flex;
            list-style: none;
            align-items: center;
            margin: 0;
            padding: 0;
            gap: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--primary-dark);
            font-weight: 600;
            transition: var(--transition);
            padding: 10px 20px;
            border-radius: 25px;
            position: relative;
            overflow: hidden;
        }

        nav ul li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(231, 76, 60, 0.1), transparent);
            transition: left 0.5s;
        }

        nav ul li a:hover::before {
            left: 100%;
        }

        nav ul li a:hover {
            color: var(--primary-red);
            background: rgba(231, 76, 60, 0.05);
            transform: translateY(-2px);
        }

        /* Login Popup Styles */
        .login-popup {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .login-box {
            background: rgba(255,255,255,0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: var(--shadow-hover);
            width: 400px;
            position: relative;
            text-align: center;
            backdrop-filter: blur(20px);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            color: var(--primary-dark);
            cursor: pointer;
            transition: var(--transition);
        }

        .close-btn:hover {
            color: var(--primary-red);
            transform: scale(1.1);
        }

        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .input-group input {
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            outline: none;
            transition: var(--transition);
            font-size: 14px;
        }

        .input-group input:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .demo-credentials {
            background: rgba(231, 76, 60, 0.05);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: left;
        }

        .demo-credentials h3 {
            font-size: 14px;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }

        .demo-credentials p {
            font-size: 12px;
            margin-bottom: 5px;
            color: var(--medium-gray);
        }

        /* Enhanced Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--light-gray) 0%, #f0f2f5 100%);
            padding: 150px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23e74c3c" fill-opacity="0.02" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .hero-slider {
            position: relative;
            width: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-hover);
            margin-bottom: 50px;
        }

        .slide {
            display: none;
            width: 100%;
            position: relative;
        }

        .slide.active {
            display: block;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: scale(1.05); }
            to { opacity: 1; transform: scale(1); }
        }

        .slide img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .slide:hover img {
            transform: scale(1.02);
        }

        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: var(--white);
            font-size: 2.5rem;
            padding: 15px 20px;
            background: rgba(231, 76, 60, 0.8);
            border-radius: 50%;
            cursor: pointer;
            user-select: none;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.3);
        }

        .prev:hover, .next:hover {
            background: var(--primary-red);
            transform: translateY(-50%) scale(1.1);
        }

        .prev { left: 25px; }
        .next { right: 25px; }

        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 25px;
            line-height: 1.2;
            color: var(--primary-dark);
            font-weight: 300;
        }

        .hero h1 span {
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: block;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: var(--medium-gray);
            line-height: 1.8;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary-red), #c0392b);
            color: var(--white);
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.3);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(231, 76, 60, 0.4);
        }

        /* Enhanced About Section */
        .about {
            padding: 100px 0;
            background: var(--white);
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 3rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-red), var(--primary-dark));
            border-radius: 2px;
        }

        .section-title p {
            color: var(--medium-gray);
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text h3 {
            font-size: 2.2rem;
            margin-bottom: 25px;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .about-text p {
            margin-bottom: 25px;
            color: var(--medium-gray);
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .about-image {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-hover);
            position: relative;
            transition: var(--transition);
        }

        .about-image:hover {
            transform: translateY(-10px);
        }

        .about-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        /* Enhanced Stats Section */
        .stats {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-black) 100%);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle fill="%23e74c3c" fill-opacity="0.05" cx="500" cy="500" r="400"/></svg>');
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            padding: 40px 20px;
            background: rgba(255,255,255,0.05);
            border-radius: var(--border-radius);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.1);
        }

        .stat-number {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--primary-red), var(--white));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-text {
            font-size: 1.3rem;
            color: #ecf0f1;
            font-weight: 500;
        }

        /* Enhanced Process Section */
        .process {
            padding: 100px 0;
            background: var(--light-gray);
        }

        .process-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .step {
            background: var(--white);
            padding: 40px 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            min-height: 300px;
            display: flex;
            align-items: center;
        }

        .step::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-red), var(--primary-dark));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            z-index: 3;
        }

        .step:hover::before {
            transform: scaleX(1);
        }

        .step:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-hover);
        }

        .step h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .step p {
            color: var(--medium-gray);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        /* Image overlay */
        .step-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            border-radius: var(--border-radius);
            transition: opacity 0.4s ease;
            z-index: 2;
        }

        /* Text content */
        .step-content {
            position: relative;
            z-index: 1;
            transition: opacity 0.3s ease;
            width: 100%;
        }

        /* Hover effects */
        .step:hover .step-image {
            opacity: 1;
        }

        .step:hover .step-content {
            opacity: 0.2;
        }
        /* Enhanced Why Choose Us Section */
        .why-choose {
            padding: 100px 0;
            background: var(--white);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .feature {
            display: flex;
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }

        .feature:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            flex: 0 0 80px;
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 2rem;
            font-weight: bold;
        }

        .feature-content {
            padding: 30px;
            flex: 1;
        }

        .feature-content h3 {
            margin-bottom: 15px;
            color: var(--primary-dark);
            font-size: 1.4rem;
            font-weight: 600;
        }

        .feature-content p {
            color: var(--medium-gray);
            line-height: 1.7;
        }

        /* Enhanced Footer */
        footer {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-black) 100%);
            color: var(--white);
            padding: 80px 0 30px;
            position: relative;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-column h3 {
            margin-bottom: 25px;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .footer-column a {
            color: #bdc3c7;
            margin-bottom: 12px;
            display: block;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            padding-left: 0;
        }

        .footer-column a::before {
            content: '›';
            position: absolute;
            left: -15px;
            opacity: 0;
            transition: var(--transition);
        }

        .footer-column a:hover {
            color: var(--primary-red);
            padding-left: 15px;
        }

        .footer-column a:hover::before {
            opacity: 1;
            left: 0;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            color: var(--white);
            border-radius: 50%;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .social-icons a:hover {
            background: var(--primary-red);
            color: var(--white);
            transform: translateY(-5px) scale(1.1);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #bdc3c7;
            font-size: 0.9rem;
        }

        /* Scroll Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* User Menu Styles */
        .user-menu {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow-hover);
            padding: 10px 0;
            min-width: 180px;
            z-index: 1000;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: var(--primary-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .dropdown-menu a:hover {
            background: rgba(231, 76, 60, 0.1);
            color: var(--primary-red);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .about-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .features {
                grid-template-columns: 1fr;
            }
            
            .process-steps {
                grid-template-columns: 1fr;
            }
            
            nav ul {
                flex-direction: column;
                gap: 5px;
            }
            
            .prev, .next {
                padding: 10px 15px;
                font-size: 2rem;
            }

            .login-box {
                width: 90%;
                margin: 20px;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 2.2rem;
            }
            
            .btn {
                padding: 12px 25px;
            }
        }
    </style>
</head>
<body>
    <!-- Enhanced Header -->
    <header>
        <div class="container header-container">
            <div class="logo">Swinburne Student Village</div>
            <nav>
                <ul>
                    <li><a href="booking.php">Bookings</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="user-menu">
                            <a href="#" class="user-btn">
                                Welcome, <?php echo $_SESSION['user']; ?> (<?php echo $_SESSION['role']; ?>)
                            </a>
                            <div class="dropdown-menu">
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <a href="adminmainpage.php">Admin Dashboard</a>
                                <?php elseif ($_SESSION['role'] === 'student'): ?>
                                    <a href="mainpage.php">Student Dashboard</a>
                                <?php elseif ($_SESSION['role'] === 'tenant'): ?>
                                    <a href="tenantmainpage.php">Tenant Dashboard</a>
                                <?php endif; ?>
                                <a href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="#" id="loginBtn" class="login-btn">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Login Popup -->
    <div id="loginPopup" class="login-popup">
        <div class="login-box">
            <span id="closeLogin" class="close-btn">&times;</span>
            <h2>Login</h2>
            <form method="POST" action="login_handler.php">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <p class="error" style="color: var(--primary-red); margin-bottom: 15px;"><?php echo htmlspecialchars($_GET['error']); ?></p>
                <?php endif; ?>
                <button type="submit" class="btn" style="width: 100%; justify-content: center;">Login</button>
            </form>
            
            <!-- Demo Credentials -->
            <div class="demo-credentials">
                <h3>Demo Credentials:</h3>
                <p><strong>Admin:</strong> admin@example.com / 123456</p>
                <p><strong>Student:</strong> student1@example.com / student123</p>
                <p><strong>Tenant:</strong> tenant1@example.com / tenant123</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-slider" id="heroSlider">
            <!-- Slides will be dynamically loaded here -->
            <div class="slide active">
                <img src="img/header.png" alt="Student Village Main Building">
            </div>
            
            <div class="prev">&#10094;</div>
            <div class="next">&#10095;</div>
        </div>

        <div class="hero-content fade-in">
            <h1><span>Hassle free city living</span></h1>
            <p>Welcome to Student Village! Your hassle free on-campus accommodation in Swinburne Sarawak. Living on campus means easy access to classes and Uni facilities. Get ready to be part of a vibrant student community with a wide variety of activities hosted by the resident advisor along with clubs and societies.</p>
            <a href="#" class="btn">
                <i class="bi bi-house-door"></i>
                Living Options on Campus
            </a>
        </div>
    </div>
</section>

    <!-- Enhanced About Section -->
    <section class="about">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Book Now!</h2>
                <p>To book your room at the Student Village, please complete the Student Village Booking form.</p>
            </div>
            <div class="about-content">
                <div class="about-text fade-in">
                    <h3>Selamat Datang to the Student Village</h3>
                    <p>Staying on campus is all about building community and could possibly be one of the most exciting times in your University journey. Regardless of your room choice, you will be part of a close-knit, vibrant and sustainable community.</p>
                    <p>From managing your own time for studies, keeping your space clean and comfortable to making lifelong friends. There's so much to experience.</p>
                    <a href="#" class="btn">
                        <i class="bi bi-pencil-square"></i>
                        Student Village Booking Form
                    </a>
                </div>
                <div class="about-image fade-in">
                    <img src="img/sv1.jpg" alt="Student Village Interior">
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Stats Section -->
    <section class="stats">
        <div class="container stats-container">
            <?php
            $stats = [
                ['number' => '150+', 'text' => 'Rooms Availability'],
                ['number' => '5', 'text' => 'Room Options'],
                ['number' => '9+', 'text' => 'Facilities']
            ];
            
            foreach ($stats as $stat) {
                echo '<div class="stat-item fade-in">';
                echo '<div class="stat-number">' . $stat['number'] . '</div>';
                echo '<div class="stat-text">' . $stat['text'] . '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <!-- Enhanced Process Section -->
<section class="process">
    <div class="container">
        <div class="section-title fade-in">
            <h2>Our Facilities</h2>
            <p>Here at the residence, we strive to provide a space where our students can feel comfortable and enjoy their time. No matter how long they stay, we want them to feel at home and at ease.</p>
        </div>
        <div class="process-steps">
            <?php
            $steps = [
                ['title' => 'Kitchen', 'desc' => 'Savour the freedom of preparing your own meals with our communal kitchen at SV1 building. It is equipped with all the amenities you need — cooking stove, chiller, freezer and storage space, to keep your mealtime simple!', 'img' => 'img/kitchen2.jpeg'],
                ['title' => 'Dining Hall', 'desc' => 'Our dining hall is the place to gather and reconnect with your friends. This is a space where you can enjoy delectable meals, relax, and connect over conversation.', 'img' => 'img/dining2.jpeg'],
                ['title' => 'Bicycle Shade', 'desc' => 'Live comfortably and ride comfortably. Student Village bike shade will keep your ride safe, dry and protected as you go about your day.', 'img' => 'img/bike1.jpeg'],
                ['title' => 'Central Foyer & Outdoor', 'desc' => 'Designed for relaxation and enjoyment, the central foyer and outdoor area provides a tranquil retreat. These spaces are comfortable enough where students can enjoy their morning coffee or study session.', 'img' => 'img/foyer.jpeg'],
                ['title' => 'Accommodation Office', 'desc' => 'It is a pleasure to welcome you to our Accommodation Office. Our office is conveniently located at the ground floor of SV1 building. Student who wish to check-in or visitors that wish to inquire can walk in.', 'img' => 'img/off.jpeg'],
                ['title' => 'Common Lounge', 'desc' => 'Want to watch a movie, play video games or just chat with your friends? The common lounge is the place for you. It is also equipped with a microwave and water dispenser.', 'img' => 'img/lounge1.jpeg'],
                ['title' => 'Security Surveillance', 'desc' => 'Student Village is a gated residence within the vicinity of the campus and has multi-tier security surveillance to ensure students safety at all times.', 'img' => 'img/security2.jpeg'],
                ['title' => 'Communal Washroom', 'desc' => 'Located on every floor, the shared washroom comes with hot and cold shower for your comfort and convenience.', 'img' => 'img/wash.jpeg'],
                ['title' => 'Laundry', 'desc' => 'A laundromat is available and conveniently located within the compounds of the Student Village. You can do your laundry right after sports activities.', 'img' => 'img/laundry.jpeg']
            ];
            
            foreach ($steps as $step) {
                echo '<div class="step fade-in">';
                echo '<div class="step-content">';
                echo '<h3>' . $step['title'] . '</h3>';
                echo '<p>' . $step['desc'] . '</p>';
                echo '</div>';
                echo '<img src="' . $step['img'] . '" alt="' . $step['title'] . ' Image" class="step-image">';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
    <!-- Enhanced Why Choose Us Section -->
    <section class="why-choose">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Why Choose Student Village</h2>
                <p>Discover what sets us apart in student accommodation</p>
            </div>
            <div class="features">
                <?php
                $features = [
                    ['title' => 'Prime Location', 'desc' => 'Located right on campus with easy access to classes, libraries, and university facilities. Save time on commuting and focus on your studies.'],
                    ['title' => 'Vibrant Community', 'desc' => 'Join a diverse community of students from around the world. Participate in events, clubs, and activities organized by resident advisors.'],
                    ['title' => 'Modern Facilities', 'desc' => 'Enjoy state-of-the-art facilities including high-speed internet, study rooms, recreational areas, and 24/7 security.'],
                    ['title' => 'All-Inclusive Living', 'desc' => 'No hidden costs. Your accommodation includes utilities, wifi, maintenance, and access to all common facilities.']
                ];
                
                foreach ($features as $feature) {
                    echo '<div class="feature fade-in">';
                    echo '<div class="feature-icon">✓</div>';
                    echo '<div class="feature-content">';
                    echo '<h3>' . $feature['title'] . '</h3>';
                    echo '<p>' . $feature['desc'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>About Swinburne</h3>
                    <a href="https://www.swinburne.edu.my/about-us/history-of-swinburne">About</a>
                    <a href="https://www.swinburne.edu.my/contact">Contact Us</a>
                    <a href="https://www.swinburne.edu.my/privacy/privacy-collection-notice">Privacy</a>
                </div>
                <div class="footer-column">
                    <h3>Student Resources</h3>
                    <a href="https://www.swinburne.edu.my/current-students">Students</a>
                    <a href="https://www.swinburne.edu.my/feedback">Feedback</a>
                    <a href="https://www.swinburne.edu.my/servicedesk">Servicedesk</a>
                </div>
                <div class="footer-column">
                    <h3>Connect with Swinburne</h3>
                    <div class="social-icons">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/swinburnesarawak" target="_blank" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <!-- Twitter -->
                        <a href="https://x.com/Swinburne_Swk" target="_blank" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/swinburnesarawak" target="_blank" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <!-- LinkedIn -->
                        <a href="https://my.linkedin.com/school/swinburne-university-of-technology-sarawak-campus" target="_blank" title="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <!-- YouTube -->
                        <a href="https://www.youtube.com/user/swinburnesarawakweb" target="_blank" title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Swinburne Student Village. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Enhanced Slider Functionality
class ModernSlider {
    constructor() {
        this.slideIndex = 0;
        this.slides = [];
        this.autoSlideInterval = null;
        this.sliderContainer = document.getElementById('heroSlider');
        this.init();
    }

    async init() {
        await this.loadSlides();
        this.showSlide(this.slideIndex);
        this.startAutoSlide();
        this.addEventListeners();
    }

    async loadSlides() {
        try {
            const response = await fetch('get_slides.php');
            this.slides = await response.json();
            
            // Clear existing slides (except navigation buttons)
            const existingSlides = this.sliderContainer.querySelectorAll('.slide:not(.prev):not(.next)');
            existingSlides.forEach(slide => slide.remove());
            
            // Add dynamic slides
            if (this.slides.length > 0) {
                this.slides.forEach((slide, index) => {
                    const slideElement = document.createElement('div');
                    slideElement.className = `slide ${index === 0 ? 'active' : ''}`;
                    slideElement.innerHTML = `
                        <img src="${slide.image_path}" alt="${slide.alt_text}">
                    `;
                    this.sliderContainer.insertBefore(slideElement, this.sliderContainer.querySelector('.prev'));
                });
            } else {
                // Fallback to default slides if no slides are found
                const defaultSlides = [
                    { image_path: 'img/header.png', alt_text: 'Student Village Main Building' },
                    { image_path: 'img/ad1.jpeg', alt_text: 'Campus Facilities' },
                    { image_path: 'img/ad2.jpeg', alt_text: 'Student Life' },
                    { image_path: 'img/ad3.jpeg', alt_text: 'Accommodation' },
                    { image_path: 'img/ad4.jpeg', alt_text: 'Community Areas' }
                ];
                
                defaultSlides.forEach((slide, index) => {
                    const slideElement = document.createElement('div');
                    slideElement.className = `slide ${index === 0 ? 'active' : ''}`;
                    slideElement.innerHTML = `
                        <img src="${slide.image_path}" alt="${slide.alt_text}">
                    `;
                    this.sliderContainer.insertBefore(slideElement, this.sliderContainer.querySelector('.prev'));
                });
                
                this.slides = defaultSlides;
            }
            
            // Update slides reference
            this.slides = this.sliderContainer.getElementsByClassName("slide");
        } catch (error) {
            console.error('Error loading slides:', error);
            this.loadDefaultSlides();
        }
    }

    loadDefaultSlides() {
        const defaultSlides = [
            { image_path: 'img/header.png', alt_text: 'Student Village Main Building' },
            { image_path: 'img/ad1.jpeg', alt_text: 'Campus Facilities' },
            { image_path: 'img/ad2.jpeg', alt_text: 'Student Life' },
            { image_path: 'img/ad3.jpeg', alt_text: 'Accommodation' },
            { image_path: 'img/ad4.jpeg', alt_text: 'Community Areas' }
        ];
        
        defaultSlides.forEach((slide, index) => {
            const slideElement = document.createElement('div');
            slideElement.className = `slide ${index === 0 ? 'active' : ''}`;
            slideElement.innerHTML = `
                <img src="${slide.image_path}" alt="${slide.alt_text}">
            `;
            this.sliderContainer.insertBefore(slideElement, this.sliderContainer.querySelector('.prev'));
        });
        
        this.slides = this.sliderContainer.getElementsByClassName("slide");
    }

    showSlide(n) {
        if (this.slides.length === 0) return;
        
        if (n >= this.slides.length) this.slideIndex = 0;
        if (n < 0) this.slideIndex = this.slides.length - 1;

        // Remove active class from all slides
        for (let slide of this.slides) {
            slide.classList.remove("active");
        }

        // Add active class to current slide
        this.slides[this.slideIndex].classList.add("active");
    }

    changeSlide(n) {
        this.showSlide(this.slideIndex += n);
        this.resetAutoSlide();
    }

    startAutoSlide() {
        if (this.slides.length > 1) {
            this.autoSlideInterval = setInterval(() => {
                this.changeSlide(1);
            }, 5000);
        }
    }

    resetAutoSlide() {
        clearInterval(this.autoSlideInterval);
        this.startAutoSlide();
    }

    addEventListeners() {
        // Previous/Next buttons
        const prevBtn = this.sliderContainer.querySelector('.prev');
        const nextBtn = this.sliderContainer.querySelector('.next');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => this.changeSlide(-1));
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.changeSlide(1));
        }

        // Pause on hover
        this.sliderContainer.addEventListener('mouseenter', () => {
            if (this.autoSlideInterval) {
                clearInterval(this.autoSlideInterval);
            }
        });
        
        this.sliderContainer.addEventListener('mouseleave', () => {
            if (this.slides.length > 1) {
                this.startAutoSlide();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.changeSlide(-1);
            if (e.key === 'ArrowRight') this.changeSlide(1);
        });

        // Touch swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        this.sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        this.sliderContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        });

        this.handleSwipe = () => {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    this.changeSlide(1); // Swipe left - next
                } else {
                    this.changeSlide(-1); // Swipe right - previous
                }
            }
        };
    }

    // Method to refresh slides (can be called when admin updates slides)
    async refreshSlides() {
        await this.loadSlides();
        this.slideIndex = 0;
        this.showSlide(this.slideIndex);
        this.resetAutoSlide();
    }
}
        // Scroll Animations
        class ScrollAnimations {
            constructor() {
                this.elements = document.querySelectorAll('.fade-in');
                this.init();
            }

            init() {
                this.checkVisibility();
                window.addEventListener('scroll', () => this.checkVisibility());
                window.addEventListener('resize', () => this.checkVisibility());
            }

            checkVisibility() {
                const triggerBottom = window.innerHeight * 0.85;

                this.elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;

                    if (elementTop < triggerBottom) {
                        element.classList.add('visible');
                    }
                });
            }
        }

        // Header Scroll Effect
        class HeaderScroll {
            constructor() {
                this.header = document.querySelector('header');
                this.init();
            }

            init() {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        this.header.classList.add('scrolled');
                    } else {
                        this.header.classList.remove('scrolled');
                    }
                });
            }
        }

        // Smooth Scrolling
        class SmoothScroll {
            constructor() {
                this.init();
            }

            init() {
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            }
        }

        // Login Popup Functionality
        class LoginPopup {
            constructor() {
                this.loginBtn = document.getElementById("loginBtn");
                this.loginPopup = document.getElementById("loginPopup");
                this.closeLogin = document.getElementById("closeLogin");
                this.init();
            }

            init() {
                if (this.loginBtn) {
                    this.loginBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.loginPopup.style.display = "flex";
                    });
                }

                this.closeLogin.addEventListener('click', () => {
                    this.loginPopup.style.display = "none";
                });

                window.addEventListener('click', (e) => {
                    if (e.target === this.loginPopup) {
                        this.loginPopup.style.display = "none";
                    }
                });
            }
        }

        // User Dropdown Functionality
        class UserDropdown {
            constructor() {
                this.userMenu = document.querySelector('.user-menu');
                this.init();
            }

            init() {
                if (this.userMenu) {
                    const userBtn = this.userMenu.querySelector('.user-btn');
                    const dropdown = this.userMenu.querySelector('.dropdown-menu');

                    userBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                    });

                    document.addEventListener('click', (e) => {
                        if (!e.target.matches('.user-btn') && !e.target.closest('.user-btn')) {
                            dropdown.style.display = 'none';
                        }
                    });
                }
            }
        }

        // Initialize all functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const slider = new ModernSlider();
    new ScrollAnimations();
    new HeaderScroll();
    new SmoothScroll();
    new LoginPopup();
    new UserDropdown();

    // Add loading animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);

    // Enhanced hover effects for buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', function(e) {
            const x = e.pageX - this.offsetLeft;
            const y = e.pageY - this.offsetTop;
            
            this.style.setProperty('--x', x + 'px');
            this.style.setProperty('--y', y + 'px');
        });
    });

    // Optional: Auto-refresh slides every 30 seconds to get updates
    setInterval(() => {
        slider.refreshSlides();
    }, 30000);
});
    </script>
</body>
</html>