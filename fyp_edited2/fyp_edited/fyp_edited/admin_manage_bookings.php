<?php
session_start();

// Check if user is admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: mainpage.php");
    exit;
}

$username = explode('@', $_SESSION['user'])[0];

// Database connection (replace with your actual database connection)
$servername = "localhost";
$db_username = "username";
$db_password = "password";
$dbname = "hostel_management";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch all bookings with user information
    $sql = "SELECT 
                b.id, 
                b.user_id, 
                u.name as user_name, 
                u.email as user_email,
                b.room_type, 
                b.tenure_type, 
                b.checkin_date, 
                b.checkout_date, 
                b.status,
                b.created_at
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            ORDER BY b.created_at DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $bookings = [];
    $error = "Connection failed: " . $e->getMessage();
}

// Handle booking actions (approve, reject, cancel)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['booking_id'])) {
        $booking_id = $_POST['booking_id'];
        $action = $_POST['action'];
        
        try {
            // Update booking status based on action
            $sql = "UPDATE bookings SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($sql);
            
            switch($action) {
                case 'approve':
                    $stmt->execute(['status' => 'approved', 'id' => $booking_id]);
                    break;
                case 'reject':
                    $stmt->execute(['status' => 'rejected', 'id' => $booking_id]);
                    break;
                case 'cancel':
                    $stmt->execute(['status' => 'cancelled', 'id' => $booking_id]);
                    break;
            }
            
            // Refresh the page to show updated status
            header("Location: admin_bookings.php");
            exit;
            
        } catch(PDOException $e) {
            $error = "Failed to update booking: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - Admin Dashboard</title>
    
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

        /* Bookings Table Styles */
        .bookings-section {
            padding: 80px 0;
            background: var(--white);
        }

        .bookings-table-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-black) 100%);
            color: var(--white);
            padding: 20px 25px;
        }

        .table-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bookings-table th {
            background-color: #f8f9fa;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            border-bottom: 2px solid #e9ecef;
        }

        .bookings-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .bookings-table tr:last-child td {
            border-bottom: none;
        }

        .bookings-table tr:hover {
            background-color: #f8f9fa;
        }

        /* Status Badges */
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d1edff;
            color: #0c5460;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-cancelled {
            background-color: #e2e3e5;
            color: #383d41;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
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
            
            .bookings-table {
                display: block;
                overflow-x: auto;
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
            
            .action-buttons {
                flex-direction: column;
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
                    <li><a href="admin_bookings.php" class="active">Manage Bookings</a></li>
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
                <h1>Manage <span>Bookings</span></h1>
                <p>View, approve, reject, or cancel student accommodation bookings. Monitor booking status and manage room allocations.</p>
            </div>
        </div>
    </section>

    <!-- Bookings Section -->
    <section class="bookings-section">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Student Bookings</h2>
                <p>Manage all accommodation booking requests</p>
            </div>

            <div class="bookings-table-container fade-in">
                <div class="table-header">
                    <h3>All Bookings (<?php echo count($bookings); ?>)</h3>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger m-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (empty($bookings)): ?>
                    <div class="text-center p-5">
                        <i class="bi bi-calendar-x display-1 text-muted"></i>
                        <h4 class="mt-3 text-muted">No bookings found</h4>
                        <p class="text-muted">There are currently no booking requests to display.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="bookings-table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Room Type</th>
                                    <th>Tenure</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>#<?php echo $booking['id']; ?></td>
                                        <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['user_email']); ?></td>
                                        <td>
                                            <?php 
                                                $roomTypes = [
                                                    'standard-single' => 'Standard Single',
                                                    'standard-twin' => 'Standard Twin',
                                                    'standard-plus-single' => 'Standard Plus Single',
                                                    'standard-plus-twin' => 'Standard Plus Twin',
                                                    'premium-king' => 'Premium King'
                                                ];
                                                echo isset($roomTypes[$booking['room_type']]) ? $roomTypes[$booking['room_type']] : $booking['room_type'];
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($booking['tenure_type']); ?></td>
                                        <td><?php echo date('M j, Y', strtotime($booking['checkin_date'])); ?></td>
                                        <td><?php echo date('M j, Y', strtotime($booking['checkout_date'])); ?></td>
                                        <td>
                                            <?php
                                                $statusClass = '';
                                                switch($booking['status']) {
                                                    case 'pending':
                                                        $statusClass = 'status-pending';
                                                        break;
                                                    case 'approved':
                                                        $statusClass = 'status-approved';
                                                        break;
                                                    case 'rejected':
                                                        $statusClass = 'status-rejected';
                                                        break;
                                                    case 'cancelled':
                                                        $statusClass = 'status-cancelled';
                                                        break;
                                                    default:
                                                        $statusClass = 'status-pending';
                                                }
                                            ?>
                                            <span class="status-badge <?php echo $statusClass; ?>">
                                                <?php echo ucfirst($booking['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <?php if ($booking['status'] == 'pending'): ?>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                                        <input type="hidden" name="action" value="approve">
                                                        <button type="submit" class="btn-action btn-approve" onclick="return confirm('Are you sure you want to approve this booking?')">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                                        <input type="hidden" name="action" value="reject">
                                                        <button type="submit" class="btn-action btn-reject" onclick="return confirm('Are you sure you want to reject this booking?')">
                                                            Reject
                                                        </button>
                                                    </form>
                                                <?php elseif ($booking['status'] == 'approved'): ?>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                                        <input type="hidden" name="action" value="cancel">
                                                        <button type="submit" class="btn-action btn-cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted">No actions</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
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

        // Initialize all functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ScrollAnimations();
            new HeaderScroll();
            new UserDropdown();

            // Add loading animation
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>