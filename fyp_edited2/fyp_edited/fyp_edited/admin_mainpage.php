<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: mainpage.php");
    exit;
}

//this is me//
//hello//
//aisyah?? dpt tangga?//
$username = explode('@', $_SESSION['user'])[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Swinburne Student Village</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
            max-width: 1400px;
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

        /* NEW: Chart Container Styles */
        .chart-container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            border-left: 5px solid var(--primary-red);
            height: 100%;
        }

        .chart-container h5 {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* NEW: Room Availability Styles */
        .room-availability {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .room-availability-bar {
            flex-grow: 1;
            height: 12px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin: 0 15px;
        }

        .room-availability-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        /* Admin Hero Section */
        .admin-hero {
            background: linear-gradient(135deg, var(--light-gray) 0%, #f0f2f5 100%);
            padding: 150px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .admin-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23e74c3c" fill-opacity="0.02" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .admin-hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .admin-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            line-height: 1.2;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .admin-hero h1 span {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .admin-hero p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: var(--medium-gray);
            line-height: 1.8;
        }

        /* Admin Quick Stats */
        .admin-stats {
            padding: 80px 0;
            background: var(--white);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .stat-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            border-left: 5px solid var(--primary-red);
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .stat-card-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-red);
        }

        .stat-card-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-dark);
        }

        .stat-card-text {
            font-size: 1.1rem;
            color: var(--medium-gray);
            font-weight: 500;
        }

        /* Admin Actions Section */
        .admin-actions {
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

        /* Recent Activity Section */
        .recent-activity {
            padding: 80px 0;
            background: var(--white);
        }

        .activity-list {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-top: 30px;
        }

        .activity-item {
            padding: 20px 25px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: rgba(231, 76, 60, 0.05);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(231, 76, 60, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-red);
            font-size: 1.2rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-weight: 500;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }

        .activity-time {
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
            .admin-hero h1 {
                font-size: 2.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            nav ul {
                flex-direction: column;
                gap: 5px;
            }
        }

        @media (max-width: 480px) {
            .admin-hero h1 {
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
    <!-- Admin Header -->
    <header>
        <div class="container header-container">
            <div class="logo">Admin Dashboard</div>
            <nav>
                <ul>
                    <li><a href="admin_manage_board.php">Manage Board</a></li>
                    <li><a href="admin_manage_bookings.php">Manage Bookings</a></li>
                    <li><a href="admin_maintenance.php">Manage Maintenance</a></li>
                    <li><a href="admin_notifications.php">Manage Notifications</a></li>
                    <li class="user-menu">
                        <a href="#" class="user-btn">
                            <?php echo $username; ?> ▼
                        </a>
                        <div class="user-dropdown">
                            <a href="admin_mainpage.php">Dashboard</a>
                            <a href="admin_profile.php">My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="logout.php" class="logout-btn">Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Admin Hero Section -->
    <section class="admin-hero">
        <div class="container">
            <div class="admin-hero-content fade-in">
                <h1>Welcome to <span>Admin Dashboard</span></h1>
                <p>Manage student accommodations, bookings, maintenance requests, and system notifications from one centralized platform. Monitor real-time statistics and take quick actions.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="adminmanageaccount.php" class="btn btn-outline">
                        <i class="bi bi-people"></i>
                        Manage Users
                    </a>
                    <a href="admin_bookings.php" class="btn btn-outline">
                        <i class="bi bi-calendar-check"></i>
                        View Bookings
                    </a>
                    <a href="admin_bookings.php" class="btn btn-outline">
                        <i class="bi bi-bell"></i>
                        Admin Notification
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="admin-stats">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Quick Overview</h2>
                <p>Real-time statistics and system overview</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card fade-in">
                    <div class="stat-card-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-card-number">247</div>
                    <div class="stat-card-text">Total Students</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-card-icon">
                        <i class="bi bi-house-door"></i>
                    </div>
                    <div class="stat-card-number">156</div>
                    <div class="stat-card-text">Active Bookings</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-card-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div class="stat-card-number">12</div>
                    <div class="stat-card-text">Pending Maintenance</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-card-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <div class="stat-card-number">8</div>
                    <div class="stat-card-text">Unread Notifications</div>
                </div>
            </div>

            <!-- NEW: Analytics Section - Below Quick Overview -->
            <div class="row mt-5">
                <div class="col-lg-8 mb-4">
                    <div class="chart-container fade-in">
                        <h5 class="fw-bold mb-3">Booking Trends & Analytics</h5>
                        <canvas id="bookingChart" height="250"></canvas>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="chart-container fade-in">
                        <h5 class="fw-bold mb-3">Room Availability Status</h5>
                        
                        <div class="room-availability">
                            <span class="small">Standard Single</span>
                            <div class="room-availability-bar">
                                <div class="room-availability-fill bg-success" style="width: 92%"></div>
                            </div>
                            <span class="small">8/50</span>
                        </div>
                        
                        <div class="room-availability">
                            <span class="small">Standard Twin</span>
                            <div class="room-availability-bar">
                                <div class="room-availability-fill bg-warning" style="width: 65%"></div>
                            </div>
                            <span class="small">35/100</span>
                        </div>
                        
                        <div class="room-availability">
                            <span class="small">Standard Plus Single</span>
                            <div class="room-availability-bar">
                                <div class="room-availability-fill bg-danger" style="width: 95%"></div>
                            </div>
                            <span class="small">3/60</span>
                        </div>
                        
                        <div class="room-availability">
                            <span class="small">Standard Plus Twin</span>
                            <div class="room-availability-bar">
                                <div class="room-availability-fill bg-info" style="width: 78%"></div>
                            </div>
                            <span class="small">22/100</span>
                        </div>
                        
                        <div class="room-availability">
                            <span class="small">Premium King</span>
                            <div class="room-availability-bar">
                                <div class="room-availability-fill bg-primary" style="width: 88%"></div>
                            </div>
                            <span class="small">6/50</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admin Actions Section -->
    <section class="admin-actions">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Quick Actions</h2>
                <p>Manage different aspects of the student accommodation system</p>
            </div>
            <div class="actions-grid">
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Manage Accounts</h3>
                    <p>Create, edit, or deactivate user accounts. Manage student, tenant, and admin permissions.</p>
                    <a href="adminmanageaccount.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Manage Users
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3>Manage Bookings</h3>
                    <p>View, approve, or reject room booking requests. Manage room allocations and check-ins.</p>
                    <a href="admin_bookings.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        View Bookings
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3>Maintenance</h3>
                    <p>Handle maintenance requests, schedule repairs, and track ongoing maintenance tasks.</p>
                    <a href="admin_maintenance.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Manage Maintenance
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-bell"></i>
                    </div>
                    <h3>Notifications</h3>
                    <p>Send system-wide announcements, manage alerts, and communicate with users.</p>
                    <a href="admin_notifications.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        Send Notifications
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3>Reports & Analytics</h3>
                    <p>Generate occupancy reports, financial summaries, and system usage statistics.</p>
                    <a href="admin_reports.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        View Reports
                    </a>
                </div>
                <div class="action-card fade-in">
                    <div class="action-card-icon">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <h3>System Settings</h3>
                    <p>Configure system parameters, manage room types, and update accommodation policies.</p>
                    <a href="admin_settings.php" class="btn">
                        <i class="bi bi-arrow-right"></i>
                        System Settings
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Activity Section -->
    <section class="recent-activity">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Recent Activity</h2>
                <p>Latest system activities and user actions</p>
            </div>
            <div class="activity-list fade-in">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">New student registration: John Doe</div>
                        <div class="activity-time">2 minutes ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Booking approved for Room SV1-205</div>
                        <div class="activity-time">15 minutes ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Maintenance request submitted for Common Lounge</div>
                        <div class="activity-time">1 hour ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Payment received from Student ID: S12345</div>
                        <div class="activity-time">3 hours ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">New support ticket from Tenant: Room SV2-104</div>
                        <div class="activity-time">5 hours ago</div>
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
                    <h3>Admin Resources</h3>
                    <a href="admin_guide.php">Admin Guide</a>
                    <a href="system_logs.php">System Logs</a>
                    <a href="backup_restore.php">Backup & Restore</a>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <a href="admin_support.php">Admin Support</a>
                    <a href="documentation.php">Documentation</a>
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
                <p>&copy; 2025 Swinburne Student Village - Admin System. All rights reserved.</p>
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

        // NEW: Chart.js Integration
        class DashboardCharts {
            constructor() {
                this.bookingChart = null;
                this.init();
            }

            init() {
                this.initBookingChart();
            }

            initBookingChart() {
                const ctx = document.getElementById('bookingChart');
                if (!ctx) return;

                this.bookingChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Bookings',
                            data: [65, 59, 80, 81, 56, 55, 40, 50, 60, 70, 75, 80],
                            borderColor: '#e74c3c',
                            backgroundColor: 'rgba(231, 76, 60, 0.1)',
                            tension: 0.4,
                            fill: true
                        }, {
                            label: 'Check-ins',
                            data: [28, 48, 40, 19, 86, 27, 90, 60, 50, 70, 65, 75],
                            borderColor: '#3498db',
                            backgroundColor: 'rgba(52, 152, 219, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Students'
                                }
                            }
                        }
                    }
                });
            }
        }

        // Real-time Stats Update (Simulated)
        class StatsUpdater {
            constructor() {
                this.stats = {
                    students: 247,
                    bookings: 156,
                    maintenance: 12,
                    notifications: 8
                };
                this.init();
            }

            init() {
                // Simulate real-time updates every 30 seconds
                setInterval(() => {
                    this.updateStats();
                }, 30000);
            }

            updateStats() {
                // Simulate small changes in stats
                this.stats.students += Math.floor(Math.random() * 3) - 1;
                this.stats.bookings += Math.floor(Math.random() * 5) - 2;
                this.stats.maintenance += Math.floor(Math.random() * 2);
                this.stats.notifications += Math.floor(Math.random() * 3) - 1;

                // Ensure stats don't go below minimum values
                this.stats.students = Math.max(240, this.stats.students);
                this.stats.bookings = Math.max(150, this.stats.bookings);
                this.stats.maintenance = Math.max(8, this.stats.maintenance);
                this.stats.notifications = Math.max(5, this.stats.notifications);

                // Update DOM
                document.querySelectorAll('.stat-card-number')[0].textContent = this.stats.students;
                document.querySelectorAll('.stat-card-number')[1].textContent = this.stats.bookings;
                document.querySelectorAll('.stat-card-number')[2].textContent = this.stats.maintenance;
                document.querySelectorAll('.stat-card-number')[3].textContent = this.stats.notifications;
            }
        }

        // Initialize all functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ScrollAnimations();
            new HeaderScroll();
            new UserDropdown();
            new DashboardCharts();
            new StatsUpdater();

            // Add loading animation
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Enhanced hover effects for buttons and cards
        document.querySelectorAll('.btn, .action-card, .stat-card').forEach(element => {
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