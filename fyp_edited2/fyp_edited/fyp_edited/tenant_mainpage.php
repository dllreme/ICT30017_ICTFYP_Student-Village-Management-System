<?php
session_start();

// Check if user is tenant
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'tenant') {
    header("Location: mainpage.php");
    exit;
}

$username = explode('@', $_SESSION['user'])[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard - Swinburne Student Village</title>
    
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

        /* Notification Styles */
        .notification-container {
            position: relative;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow-hover);
            width: 320px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
        }

        .notification-header {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .notification-header h3 {
            margin: 0;
            font-size: 1.2rem;
            color: var(--primary-dark);
        }

        .notification-badge {
            background: var(--primary-red);
            color: var(--white);
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .notification-list {
            padding: 0;
        }

        .notification-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f8f9fa;
            transition: var(--transition);
        }

        .notification-item.unread {
            background: rgba(231, 76, 60, 0.05);
        }

        .notification-item:hover {
            background: rgba(231, 76, 60, 0.08);
        }

        .notification-item p {
            margin: 0 0 5px 0;
            font-size: 0.9rem;
            color: var(--primary-dark);
        }

        .notification-time {
            font-size: 0.8rem;
            color: var(--medium-gray);
        }

        .notification-footer {
            padding: 15px 20px;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .notification-footer a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 600;
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

        .user-dropdown {
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

        .user-dropdown a {
            display: block;
            padding: 10px 20px;
            color: var(--primary-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .user-dropdown a:hover {
            background: rgba(231, 76, 60, 0.1);
            color: var(--primary-red);
        }

        .dropdown-divider {
            height: 1px;
            background: #e9ecef;
            margin: 5px 0;
        }

        .logout-btn {
            color: var(--primary-red) !important;
            font-weight: 600;
        }

        /* Tenant Dashboard Styles */
        .tenant-hero {
            background: linear-gradient(135deg, var(--light-gray) 0%, #f0f2f5 100%);
            padding: 150px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .tenant-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23e74c3c" fill-opacity="0.02" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .tenant-hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .tenant-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            line-height: 1.2;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .tenant-hero h1 span {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tenant-hero p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: var(--medium-gray);
            line-height: 1.8;
        }

        /* Tenant Quick Overview */
        .tenant-overview {
            padding: 80px 0;
            background: var(--white);
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .overview-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            border-left: 5px solid var(--primary-red);
        }

        .overview-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .overview-card-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-red);
        }

        .overview-card-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }

        .overview-card-text {
            font-size: 1.1rem;
            color: var(--medium-gray);
            font-weight: 500;
        }

        /* Tenant Actions Grid */
        .tenant-actions {
            padding: 80px 0;
            background: var(--light-gray);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .action-card {
            background: var(--white);
            padding: 40px 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-red), var(--primary-dark));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .action-card:hover::before {
            transform: scaleX(1);
        }

        .action-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-hover);
        }

        .action-card-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: var(--primary-red);
        }

        .action-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
            font-weight: 600;
        }

        .action-card p {
            color: var(--medium-gray);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary-red), #c0392b);
            color: var(--white);
            padding: 12px 25px;
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
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(231, 76, 60, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-red);
            color: var(--primary-red);
            box-shadow: none;
        }

        .btn-outline:hover {
            background: var(--primary-red);
            color: var(--white);
        }

        /* Recent Notifications Section */
        .recent-notifications {
            padding: 80px 0;
            background: var(--white);
        }

        .notifications-list {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-top: 30px;
        }

        .notification-item-large {
            padding: 20px 25px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            transition: var(--transition);
        }

        .notification-item-large:last-child {
            border-bottom: none;
        }

        .notification-item-large.unread {
            background: rgba(231, 76, 60, 0.05);
        }

        .notification-item-large:hover {
            background: rgba(231, 76, 60, 0.08);
        }

        .notification-icon-large {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(231, 76, 60, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-red);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .notification-content-large {
            flex: 1;
        }

        .notification-text-large {
            font-weight: 500;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }

        .notification-time-large {
            font-size: 0.9rem;
            color: var(--medium-gray);
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 15px;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .tenant-hero h1 {
                font-size: 2.5rem;
            }
            
            .overview-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            nav ul {
                flex-direction: column;
                gap: 5px;
            }
            
            .notification-dropdown {
                width: 280px;
                right: -50px;
            }
        }

        @media (max-width: 480px) {
            .tenant-hero h1 {
                font-size: 2rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .btn {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Tenant Header -->
    <header>
        <div class="container header-container">
            <div class="logo">Hello, Villager!</div>
            <nav>
                <ul>
                    <li><a href="booking.php">Bookings</a></li>
                    <li><a href="tenant_payments.php">Payments</a></li>
                    <li><a href="tenant_support.php">Tell us</a></li>
                    <li class="notification-container">
                        <a href="#" id="notificationBtn">Notification</a>
                        <div class="notification-dropdown" id="notificationDropdown">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                <span class="notification-badge">3</span>
                            </div>
                            <div class="notification-list">
                                <div class="notification-item unread">
                                    <p>Your booking request has been approved</p>
                                    <span class="notification-time">2 hours ago</span>
                                </div>
                                <div class="notification-item unread">
                                    <p>Payment due for March rent</p>
                                    <span class="notification-time">1 day ago</span>
                                </div>
                                <div class="notification-item">
                                    <p>Maintenance scheduled for common area</p>
                                    <span class="notification-time">3 days ago</span>
                                </div>
                            </div>
                            <div class="notification-footer">
                                <a href="tenant_notifications.php">View All Notifications</a>
                            </div>
                        </div>
                    </li>
                    <li class="user-menu">
                        <a href="#" class="user-btn">
                            <?php echo $username; ?> ▼
                        </a>
                        <div class="user-dropdown">
                            <a href="tenant_profile.php">My Profile</a>
                            <a href="tenant_settings.php">Settings</a>
                            <a href="tenant_support.php">Help & Support</a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="logout-btn">Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Tenant Hero Section -->
    <section class="tenant-hero">
        <div class="container">
            <div class="tenant-hero-content fade-in">
                <h1>Welcome to Your <span>Student Village</span></h1>
                <p>Hello <?php echo $username; ?>! Manage your accommodation, payments, and stay connected with your student community. Everything you need for a comfortable campus life is right here.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="tenant_bookings.php" class="btn">
                        <i class="bi bi-calendar-check"></i>
                        My Bookings
                    </a>
                    <a href="tenant_payments.php" class="btn btn-outline">
                        <i class="bi bi-credit-card"></i>
                        Make Payment
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tenant Quick Overview -->
    <section class="tenant-overview">
        <div class="container">
            <div class="section-title fade-in">
                <h2>My Accommodation Overview</h2>
                <p>Quick glance at your current accommodation status</p>
            </div>
            <div class="overview-grid">
                <div class="overview-card fade-in">
                    <div class="overview-card-icon">
                        <i class="bi bi-house-check"></i>
                    </div>
                    <div class="overview-card-number">SV1-205</div>
                    <div class="overview-card-text">Your Room</div>
                </div>
                <div class="overview-card fade-in">
                    <div class="overview-card-icon">
                        <i class="bi bi-calendar"></i>
                    </div>
                    <div class="overview-card-number">15 Aug 2025</div>
                    <div class="overview-card-text">Check-out Date</div>
                </div>
                <div class="overview-card fade-in">
                    <div class="overview-card-icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div class="overview-card-number">Paid</div>
                    <div class="overview-card-text">Current Status</div>
                </div>
                <div class="overview-card fade-in">
                    <div class="overview-card-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <div class="overview-card-number">3</div>
                    <div class="overview-card-text">New Notifications</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tenant Actions Section -->
    <section class="tenant-actions">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Quick Actions</h2>
                <p>Everything you need to manage your accommodation</p>
            </div>
            <div class="actions-grid">
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3>My Bookings</h3>
                    <p>View your current booking details, check-in/out dates, and room information. Request extensions if needed.</p>
                    <a href="tenant_bookings.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        View Bookings
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h3>Payments</h3>
                    <p>Make rent payments, view payment history, download receipts, and manage your payment methods.</p>
                    <a href="tenant_payments.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Manage Payments
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>Tell Us</h3>
                    <p>Report maintenance issues, provide feedback, or contact support for any accommodation-related queries.</p>
                    <a href="tenant_support.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Contact Support
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <h3>Notifications</h3>
                    <p>Stay updated with important announcements, maintenance schedules, and community events.</p>
                    <a href="tenant_notifications.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        View Notifications
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <h3>My Profile</h3>
                    <p>Update your personal information, emergency contacts, and accommodation preferences.</p>
                    <a href="tenant_profile.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Update Profile
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h3>Settings</h3>
                    <p>Manage your account settings, notification preferences, and privacy options.</p>
                    <a href="tenant_settings.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Account Settings
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Notifications Section -->
    <section class="recent-notifications">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Recent Notifications</h2>
                <p>Latest updates and important announcements</p>
            </div>
            <div class="notifications-list fade-in">
                <div class="notification-item-large unread">
                    <div class="notification-icon-large">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="notification-content-large">
                        <div class="notification-text-large">Your booking extension request for Room SV1-205 has been approved</div>
                        <div class="notification-time-large">2 hours ago</div>
                    </div>
                </div>
                <div class="notification-item-large unread">
                    <div class="notification-icon-large">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="notification-content-large">
                        <div class="notification-text-large">Payment reminder: March rent payment is due in 3 days</div>
                        <div class="notification-time-large">1 day ago</div>
                    </div>
                </div>
                <div class="notification-item-large">
                    <div class="notification-icon-large">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div class="notification-content-large">
                        <div class="notification-text-large">Maintenance scheduled: Common lounge will be closed for cleaning on Friday 2-4 PM</div>
                        <div class="notification-time-large">3 days ago</div>
                    </div>
                </div>
                <div class="notification-item-large">
                    <div class="notification-icon-large">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <div class="notification-content-large">
                        <div class="notification-text-large">Community event: Welcome BBQ for new students this Saturday at the central courtyard</div>
                        <div class="notification-time-large">5 days ago</div>
                    </div>
                </div>
                <div class="notification-item-large">
                    <div class="notification-icon-large">
                        <i class="bi bi-wifi"></i>
                    </div>
                    <div class="notification-content-large">
                        <div class="notification-text-large">Internet maintenance: Temporary disruption expected tonight from 2-4 AM</div>
                        <div class="notification-time-large">1 week ago</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Tenant Resources</h3>
                    <a href="tenant_guide.php">Accommodation Guide</a>
                    <a href="campus_map.php">Campus Map</a>
                    <a href="emergency_contacts.php">Emergency Contacts</a>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <a href="tenant_support.php">Contact Support</a>
                    <a href="faq.php">FAQ</a>
                    <a href="feedback.php">Feedback</a>
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
                <p>&copy; 2025 Swinburne Student Village - Tenant Portal. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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

        // Notification Dropdown Functionality
        class NotificationDropdown {
            constructor() {
                this.notificationBtn = document.getElementById('notificationBtn');
                this.notificationDropdown = document.getElementById('notificationDropdown');
                this.init();
            }

            init() {
                if (this.notificationBtn && this.notificationDropdown) {
                    this.notificationBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.notificationDropdown.style.display = 
                            this.notificationDropdown.style.display === 'block' ? 'none' : 'block';
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!e.target.matches('#notificationBtn') && 
                            !e.target.closest('.notification-dropdown')) {
                            this.notificationDropdown.style.display = 'none';
                        }
                    });
                }
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
                    const dropdown = this.userMenu.querySelector('.user-dropdown');

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

        // Mark notifications as read
        class NotificationManager {
            constructor() {
                this.notificationItems = document.querySelectorAll('.notification-item-large');
                this.init();
            }

            init() {
                this.notificationItems.forEach(item => {
                    item.addEventListener('click', () => {
                        if (item.classList.contains('unread')) {
                            item.classList.remove('unread');
                            this.updateNotificationCount();
                        }
                    });
                });
            }

            updateNotificationCount() {
                const unreadCount = document.querySelectorAll('.notification-item-large.unread').length;
                const badge = document.querySelector('.notification-badge');
                if (badge) {
                    badge.textContent = unreadCount;
                    if (unreadCount === 0) {
                        badge.style.display = 'none';
                    }
                }
            }
        }

        // Initialize all functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ScrollAnimations();
            new HeaderScroll();
            new NotificationDropdown();
            new UserDropdown();
            new NotificationManager();

            // Add loading animation
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Enhanced hover effects for buttons and cards
        document.querySelectorAll('.btn, .action-card, .overview-card').forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const x = e.pageX - this.offsetLeft;
                const y = e.pageY - this.offsetTop;
                
                this.style.setProperty('--x', x + 'px');
                this.style.setProperty('--y', y + 'px');
            });
        });
    </script>
</body>
</html>