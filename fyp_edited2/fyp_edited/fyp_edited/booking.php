<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Village - Booking & Accommodation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/booking.css"> -->


<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    line-height: 1.6;
    color: #333;
    
}

.container {
    width: 90%;
    max-width: 100%;
    margin: 0 auto;
    padding: 0 15px;
}

/* Modern CSS Variables - Matching mainpage.php */
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

/* Enhanced Floating Nav Bar - UPDATED WITH HOVER EFFECTS */
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
    white-space: nowrap;
}

/* FIXED NAVIGATION ALIGNMENT WITH ENHANCED HOVER EFFECTS */
nav ul {
    display: flex;
    list-style: none;
    align-items: center;
    gap: 10px;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin: 0;
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
    white-space: nowrap;
    text-align: center;
    display: block;
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

nav ul li a.active {
    background-color: var(--primary-red);
    color: var(--white);
}

/* Enhanced Room Type Navigation Hover Effects */
.room-type-nav .btn {
    border-radius: 25px !important;
    padding: 12px 25px;
    font-weight: 600;
    transition: var(--transition);
    border: 2px solid var(--primary-red);
    background-color: transparent;
    color: var(--primary-red);
    position: relative;
    overflow: hidden;
}

.room-type-nav .btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(231, 76, 60, 0.1), transparent);
    transition: left 0.5s;
}

.room-type-nav .btn:hover::before {
    left: 100%;
}

.room-type-nav .btn:hover,
.room-type-nav .btn.active {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}

/* Enhanced Book Button Hover Effects */
.book-room-btn {
    font-size: 1.2rem;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    transition: var(--transition);
    background: linear-gradient(135deg, var(--primary-red), #c0392b);
    border: none;
    color: var(--white);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    position: relative;
    overflow: hidden;
}

.book-room-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.book-room-btn:hover::before {
    left: 100%;
}

.book-room-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
    background: linear-gradient(135deg, #c0392b, #a23526);
}

/* Enhanced Room Image Hover Effects */
.room-image {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-hover);
    transition: transform 0.3s ease;
    border: 3px solid var(--primary-red);
}

.room-image:hover {
    transform: scale(1.03);
}

.room-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.room-image:hover img {
    transform: scale(1.05);
}

/* Enhanced Resource Card Hover Effects */
.resource-card {
    transition: var(--transition);
    display: flex;
    flex-direction: column;
    background: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    width: 300px;
    text-align: center;
    border: 3px solid transparent;
    box-shadow: var(--shadow);
    position: relative;
}

.resource-card::before {
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

.resource-card:hover::before {
    transform: scaleX(1);
}

.resource-card:hover {
    transform: translateY(-10px);
    border-color: var(--primary-red);
    box-shadow: var(--shadow-hover);
}

.resource-icon {
    transition: var(--transition);
    background: linear-gradient(135deg, #ffecec 0%, #ffd1d1 100%) !important;
    color: var(--primary-red) !important;
    padding: 40px;
    font-size: 3rem;
}

.resource-card:hover .resource-icon {
    transform: scale(1.1);
    background: linear-gradient(135deg, var(--primary-red) 0%, #c0392b 100%) !important;
    color: var(--white) !important;
}

.resource-card .btn {
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    transition: var(--transition);
    border: 2px solid var(--primary-red);
    color: var(--primary-red);
    background: transparent;
    margin-top: auto;
}

.resource-card .btn:hover {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}

/* Enhanced Quick Booking Button Hover Effects */
.quick-booking .btn-light {
    font-weight: 600;
    border-radius: 25px;
    padding: 15px 40px !important;
    transition: var(--transition);
    background-color: var(--white) !important;
    color: var(--primary-red) !important;
    border: 2px solid var(--white) !important;
    font-size: 1.1rem;
    box-shadow: 0 5px 15px rgba(255,255,255,0.2);
}

.quick-booking .btn-light:hover {
    background-color: var(--primary-red) !important;
    color: var(--white) !important;
    border-color: var(--primary-red) !important;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
}

/* Enhanced Footer Link Hover Effects */
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
    /* Ensure horizontal layout */
    flex-direction: row;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.social-icons a {
    display: flex;
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
    /* Perfect centering */
    text-align: center;
}

.social-icons a:hover {
    background: var(--primary-red);
    color: var(--white);
    transform: translateY(-5px) scale(1.1);
}
/* Additional centering for the icons */
.social-icons a i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    line-height: 1;
}

/* Arrow effect for social icons */
.social-icons a::before {
    content: '›';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: var(--transition);
    font-size: 1.5rem;
    font-weight: bold;
}



/* FORM HEADER COLORS UPDATED TO BLACK-RED GRADIENT */
.custom-blue-bg {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-red) 100%) !important;
    border: none !important;
}

.section-title {
   
    color: var(--white) !important;
    border: none !important;
}

.btn.custom-blue-btn {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-red) 100%) !important;
    border-color: var(--primary-red) !important;
    color: white;
    font-weight: 600;
    border-radius: 8px;
    transition: var(--transition);
}

.btn.custom-blue-btn:hover {
    background: linear-gradient(135deg, var(--primary-red) 0%, #c0392b 100%) !important;
    border-color: #c0392b !important;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}



/* Hero Section */
.hero {
    background-color: #f8f9fa;
    padding: 60px 0 80px;
}

.hero-image {
    width: 100%;
    max-width: 100%;
    margin: 0 auto 40px;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.hero-image img {
    width: 100%;
    height: 500px;
    display: block;
}

.hero-content {
    text-align: center;
    max-width: 1000px;
    margin: 0 auto;
}

.hero h1 {
    font-size: 35px;
    margin-bottom: 20px;
    line-height: 1.2;
    color: #404040;
}

.hero h1 span {
    font-weight: 300;
    font-size: 30px;
}

.hero p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: #7f8c8d;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
}

.btn {
    display: inline-block;
    background-color: #e74c3c;
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
}

.btn:hover {
    background-color: #c0392b;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
}

/* About Section */
.about {
    padding: 80px 0;
    background-color: #f9f9f9;
}

.section-title {
    text-align: center;
    margin-bottom: 50px;
}

.section-title h2 {
    font-size: 2.5rem;
    color: #404040;
    margin-bottom: 15px;
}

.section-title p {
    color: #7f8c8d;
    max-width: 700px;
    margin: 0 auto;
}

.about-content {
    display: flex;
    align-items: center;
    gap: 50px;
}

.about-text {
    flex: 1;
}

.about-text h3 {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #404040;
}

.about-text p {
    margin-bottom: 20px;
    color: #555;
}

.about-image {
    flex: 1;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.about-image img {
    width: 100%;
    height: auto;
    display: block;
}

/* Stats Section */
.stats {
    padding: 80px 0;
    background-color: #404040;
    color: white;
    text-align: center;
}

.stats-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.stat-item {
    margin: 20px;
}

.stat-number {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.stat-text {
    font-size: 1.2rem;
    color: #ecf0f1;
}

/* Process Section */
.process {
    padding: 80px 0;
}

.process-steps {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-top: 50px;
}

.step {
    flex: 0 0 30%;
    text-align: center;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s;
    background-color: #fff;
}

.step:hover {
    transform: translateY(-10px);
}

.step-content {
    position: relative;
    z-index: 1;
    transition: opacity 0.3s ease;
}

.step h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #404040;
}

.step p {
    color: #7f8c8d;
}

/* Image overlay (on top of text) */
.step-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    visibility: hidden;
    border-radius: 15px;
    transition: opacity 0.4s ease, visibility 0.4s ease;
    z-index: 2;
}

/* Reveal image on hover */
.step:hover .step-image {
    opacity: 1;
    visibility: visible;
}

/* Dim text when image appears */
.step:hover .step-content {
    opacity: 0.2;
}

/* Why Choose Us Section */
.why-choose {
    padding: 80px 0;
    background-color: #f9f9f9;
}

.features {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 50px;
}

.feature {
    flex: 0 0 48%;
    display: flex;
    margin-bottom: 30px;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s;
}

.feature:hover {
    transform: translateY(-5px);
}

.feature-icon {
    flex: 0 0 80px;
    background-color: #e74c3c;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
}

.feature-content {
    padding: 25px;
}

.feature-content h3 {
    margin-bottom: 15px;
    color: #404040;
}

.feature-content p {
    color: #7f8c8d;
}

/* Footer */
footer {
    background-color: #404040;
    color: white;
    padding: 60px 0 30px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.footer-column {
    flex: 0 0 30%;
    margin-bottom: 30px;
}

.footer-column h3 {
    margin-bottom: 20px;
    font-size: 1.3rem;
    color: var(--primary-red) !important; 
}

.footer-column p, .footer-column a {
    color: #bdc3c7;
    margin-bottom: 10px;
    display: block;
    text-decoration: none;
}

.copyright {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #34495e;
    color: #bdc3c7;
    font-size: 0.9rem;
}


/* Responsive Styles - UPDATED NAVIGATION */
@media (max-width: 992px) {
    .about-content {
        flex-direction: column;
    }
    
    .feature {
        flex: 0 0 100%;
    }
    
    .footer-column {
        flex: 0 0 48%;
    }
    
    .hero-image {
        width: 90%;
    }
    
    /* Navigation adjustment for tablet */
    nav ul {
        gap: 15px;
    }
    
    nav ul li a {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
}

@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.2rem;
    }
    
    .hero h1 span {
        font-size: 1.8rem;
    }
    
    .step {
        flex: 0 0 100%;
    }
    
    .footer-column {
        flex: 0 0 100%;
    }
    
    /* FIXED: Mobile navigation should be visible and properly aligned */
    nav ul {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }
    
    .mobile-menu-btn {
        display: none;
    }
    
    header {
        width: 95%;
        border-radius: 30px;
    }
    
    .header-container {
        padding: 12px 20px;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }
    
    .hero-image {
        width: 95%;
        border-radius: 20px;
    }
    
    /* Adjust logo for mobile */
    .logo {
        font-size: 18px;
    }

    nav ul {
        flex-direction: column;
        gap: 10px;
    }

    header {
        border-radius: 25px;
    }
}

@media (max-width: 576px) {
    .hero h1 {
        font-size: 1.8rem;
    }
    
    .hero h1 span {
        font-size: 1.5rem;
    }
    
    .hero p {
        font-size: 1rem;
    }
    
    .hero-image {
        border-radius: 15px;
    }
    
    header {
        border-radius: 25px;
    }
    
    /* Mobile navigation optimization */
    .header-container {
        flex-direction: column;
        gap: 10px;
        padding: 10px 15px;
    }
    
    nav ul {
        gap: 8px;
        justify-content: center;
    }
    
    nav ul li a {
        padding: 5px 10px;
        font-size: 0.85rem;
    }
    
    .logo {
        font-size: 16px;
        text-align: center;
    }
}

/* Extra small devices */
@media (max-width: 400px) {
    nav ul {
        flex-direction: column;
        gap: 5px;
    }
    
    nav ul li a {
        width: 100%;
        text-align: center;
    }
    
    .header-container {
        padding: 8px 10px;
    }
}



.hero-slider {
    position: relative;
    width: 100%;
    border-radius: 20px;
    padding-bottom: 20px;
}
.slide {
    display: none;
    width: 100%;
}
.slide img {
    width: 100%;
    height: 100%;
    border-radius: 20px;
}
.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 2rem;
    padding: 8px 14px;
    background: rgba(0,0,0,0.4);
    border-radius: 20%;
    cursor: pointer;
    user-select: none;
}
.prev:hover, .next:hover {
    background: rgba(0,0,0,0.7);
}
.prev { left: 10px; }
.next { right: 10px; }

html, body {
    overflow-x: hidden !important;
    max-width: 100% !important;
}

.container {
    max-width: 100% !important;
    overflow-x: hidden !important;
}

.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
}




/* MODAL BACKDROP */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.1) !important;
}

.modal-backdrop.show {
    opacity: 1 !important;
}

.modal-content {
    background-color: white !important;
    border: none !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.modal-header,
.modal-body,
.modal-footer {
    background-color: white !important;
}



/* Booking Page Specific Styles */
.booking-hero {
    background: linear-gradient(135deg, #2c3e50 0%, #e74c3c 100%);
    padding: clamp(50px, 8vw, 80px) 0;
    position: relative;
}

.booking-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
}

.booking-hero .container {
    position: relative;
    z-index: 2;
}

.breadcrumb {
    background: transparent;
    margin-bottom: 2rem;
}

.breadcrumb-item a {
    text-decoration: none;
    color: #ecf0f1;
}

.breadcrumb-item a:hover {
    color: #ffffff;
}

.breadcrumb-item.active {
    color: #ffffff !important;
}

/* Welcome Section */
.welcome-section {
    background: #f8f9fa;
}

.welcome-section h2 {
    color:  #2c3e50!important;
}

/* Room Type Navigation */
.room-type-nav .btn-group {
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
    justify-content: center;
}

.room-type-nav .btn {
    border-radius: 25px !important;
    padding: clamp(8px, 1.2vw, 12px) clamp(16px, 2vw, 24px);
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid #e74c3c;
    font-size: clamp(0.85rem, 1vw, 1rem);
    background-color: transparent;
    color: #e74c3c;
}

.room-type-nav .btn:hover,
.room-type-nav .btn.active {
    background-color: #e74c3c;
    border-color: #e74c3c;
    color: white;
    transform: none;
    box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
}

.room-type-nav .btn-outline-primary {
    background-color: transparent;
    color: #e74c3c;
}

.room-type-nav .btn-outline-primary:hover,
.room-type-nav .btn-outline-primary.active {
    background-color: #e74c3c;
    color: white;
}

/* Room Details */
.room-details {
    min-height: 60vh;
}

.room-info {
    display: none;
    animation: fadeIn 0.5s ease-in;
    padding: 2dvh 0;
}

.room-info.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Room Header */
.room-header {
    text-align: center;
    margin-bottom: 20px;
    padding: 2vh 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
}

.room-header h2 {
    font-size: clamp(1.8rem, 2.5vw, 2.5rem);
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

.room-header .subtitle {
    font-size: clamp(1rem, 1.5vw, 1.2rem);
    color: #e74c3c;
    font-weight: 500;
}

/* Room Content */
.room-content {
    background: white;
    border-radius: 15px;
    padding: clamp(20px, 4vw, 40px);
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    border: 1px solid #e9ecef;
}

.room-features ul li {
    padding: 8px 0;
    font-size: clamp(0.9rem, 1vw, 1.1rem);
    border-bottom: 1px solid #f8f9fa;
    color: #555;
}

.room-features ul li:last-child {
    border-bottom: none;
}

.room-features ul li i {
    color: #e74c3c;
}

.btn.btn-lg {
    background-color: #e74c3c;
    border-color: #e74c3c;
    color: white;
    font-weight: 600;
    padding: 12px 30px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn.btn-lg:hover {
    background-color: white;
    border-color: #e74c3c;
    color: #e74c3c;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
}

/* Vertical Rates Table - Medium Large Size */
.rates-table {
    background: white;
    padding: clamp(20px, 4vw, 35px);
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    margin-top: 35px;
    border: 2px solid #e74c3c;
}

.vertical-rates-table {
    width: 100%;
}

.rate-row {
    display: flex;
    border-bottom: 2px solid #e74c3c;
    transition: background-color 0.3s ease;
}

.rate-row:last-child {
    border-bottom: none;
}

.rate-row:hover {
    background-color: #fff8f8;
}

.rate-label {
    flex: 0 0 35%;
    background-color: #e74c3c;
    color: white;
    font-weight: 700;
    font-size: clamp(1rem, 1.2vw, 1.3rem);
    padding: clamp(14px, 1.8vw, 22px) clamp(16px, 1.8vw, 25px);
    display: flex;
    align-items: center;
}

.rate-value {
    flex: 0 0 65%;
    background-color: #fff;
    color: #2c3e50;
    font-size: clamp(0.95rem, 1.1vw, 1.2rem);
    font-weight: 500;
    padding: clamp(14px, 1.8vw, 22px) clamp(16px, 1.8vw, 25px);
    display: flex;
    align-items: flex-start;
    border-left: 2px solid #e74c3c;
    line-height: 1.6;
}

.rate-row:last-child .rate-value {
    display: block;
    align-items: normal;
}

.rate-row:last-child .rate-value a {
    display: inline-block;
    color: #e74c3c !important;
    font-weight: 600;
    text-decoration: underline !important;
    margin-top: 4px;
    transition: color 0.3s ease;
}

.rate-row:last-child .rate-value a:hover {
    color: #c0392b !important;
    text-decoration: none !important;
}

.rates-table h4 {
    font-size: clamp(1.5rem, 2vw, 2.2rem);
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 25px;
    text-align: center;
}

/* Resources Section - Fixed Centered Layout */
.resources-centered-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
    width: 100%;
}

.resource-card-wrapper {
    flex: 0 0 auto;
}

.resource-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.resource-content h4 {
    color: #2c3e50;
    margin-bottom: 10px;
    font-weight: 700;
}

.resource-content p {
    color: #7f8c8d;
    margin-bottom: 20px;
    flex-grow: 1;
}

#faqModal .custom-blue-bg {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-red) 100%) !important;
    border: none !important;
}

#formsModal .custom-blue-bg {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-red) 100%) !important;
    border: none !important;
}

#checkinFormModal .custom-blue-bg {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-red) 100%) !important;
    border: none !important;
}

#bookingModal .file-upload-area {
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
    background: #f8f9fa;
    cursor: pointer;
}

#bookingModal .file-upload-area:hover {
    border-color: #3498db;
    background: #f0f8ff;
}

#bookingModal .file-input {
    display: none;
}

#bookingModal .upload-placeholder {
    pointer-events: none;
}

/* Checkbox fixes - preserve functionality */
.form-check-input {
    background-color: white !important;
    border-color: #ced4da !important;
}

.form-check-input:checked {
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
}

.form-check-input.is-valid,
.was-validated .form-check-input:valid {
    border-color: #198754 !important;
}

.form-check-input.is-invalid,
.was-validated .form-check-input:invalid {
    border-color: #dc3545 !important;
}


/* File upload area styling - modal specific */
#withdrawalFormModal .file-upload-area {
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
    background: #f8f9fa;
    cursor: pointer;
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#withdrawalFormModal .file-upload-area:hover {
    border-color: #3498db;
    background: #f0f8ff;
}

#withdrawalFormModal .file-input {
    display: none;
}

#withdrawalFormModal .upload-placeholder {
    pointer-events: none;
    text-align: center;
}

#withdrawalFormModal .upload-placeholder i {
    font-size: 3rem;
    margin-bottom: 10px;
}


/* ============================================= */
/* QUICK BOOKING SECTION FIXES */
/* ============================================= */

.quick-booking {
    background: linear-gradient(135deg, #2c3e50 0%, #404040 100%);
    position: relative;
    overflow: hidden;
    padding: clamp(40px, 6vw, 60px) 0;
    z-index: 1;
}

.quick-booking::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(231, 76, 60, 0.1) 0%, transparent 70%);
    z-index: -1;
}

.quick-booking .text-lg-end {
    position: relative;
    z-index: 2;
}

.quick-booking .btn {
    pointer-events: auto !important;
    z-index: 1000 !important;
}

.modal {
    z-index: 1060 !important;
}

.modal-backdrop {
    z-index: 1050 !important;
}

.section-title h2 {
    color: #2c3e50;
}

.section-title .lead {
    color: #e74c3c;
}

/* Allow scrolling but hide scrollbars in modal forms */
.modal-body {
    overflow-y: auto !important;
    overflow-x: hidden !important;
    scrollbar-width: none !important; /* Firefox */
    -ms-overflow-style: none !important; /* IE and Edge */
}

.modal-body::-webkit-scrollbar {
    display: none !important; /* Chrome, Safari and Opera */
}

.modal-content {
    overflow: hidden !important;
}

/* Ensure modal dialog allows scrolling */
.modal-dialog {
    max-height: 90vh !important;
    overflow: hidden !important;
}

/* Make sure form content is scrollable */
#checkinFormModal .modal-body,
#formsModal .modal-body,
#faqModal .modal-body {
    max-height: calc(90vh - 120px) !important;
    padding: 20px !important;
}

/* Custom styling for better scroll experience */
.modal-body {
    padding-right: 5px !important;
}

/* Optional: Add smooth scrolling */
.modal-body {
    scroll-behavior: smooth !important;
}

/* Ensure the form itself can be scrolled */
#checkinFormModal form,
#formsModal form {
    min-height: fit-content !important;
}

/* Booking Form Specific Fixes */
#bookingModal .modal-body {
    padding: 1rem !important;
}

#bookingModal .form-section {
    margin-bottom: 1.5rem !important;
}

#bookingModal .section-title {
    font-size: 1.1rem;
    margin-bottom: 1rem !important;
    padding: 0.75rem 1rem !important;
}

#bookingModal .row {
    margin-left: -0.5rem !important;
    margin-right: -0.5rem !important;
}

#bookingModal .row > [class*="col-"] {
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
}

#bookingModal .form-label {
    margin-bottom: 0.5rem;
    font-weight: 500;
}

#bookingModal .form-control,
#bookingModal .form-select {
    padding: 0.5rem 0.75rem;
}

#bookingModal .alert {
    margin-bottom: 1rem !important;
    padding: 0.75rem 1rem;
}

#bookingModal .text-center {
    margin-bottom: 1rem;
}

#bookingModal .text-center h4 {
    margin-bottom: 0.5rem;
}

#bookingModal .text-center p {
    margin-bottom: 0.5rem;
}

#bookingModal .text-center .btn {
    margin-top: 0.5rem;
}

/* File upload areas in booking form */
#bookingModal .file-upload-area {
    padding: 1.5rem !important;
}

#bookingModal .file-upload-area .upload-placeholder {
    padding: 0.5rem;
}

/* Withdrawal Form Specific Fixes */
#withdrawalFormModal .modal-body {
    padding: 1rem !important;
}

#withdrawalFormModal .form-section {
    margin-bottom: 1.5rem !important;
}

#withdrawalFormModal .section-title {
    font-size: 1.1rem;
    margin-bottom: 1rem !important;
    padding: 0.75rem 1rem !important;
}

#withdrawalFormModal .row {
    margin-left: -0.5rem !important;
    margin-right: -0.5rem !important;
}

#withdrawalFormModal .row > [class*="col-"] {
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
}

#withdrawalFormModal .form-label {
    margin-bottom: 0.5rem;
    font-weight: 500;
}

#withdrawalFormModal .form-control,
#withdrawalFormModal .form-select {
    padding: 0.5rem 0.75rem;
}

#withdrawalFormModal .alert {
    margin-bottom: 1rem !important;
    padding: 0.75rem 1rem;
}

#withdrawalFormModal .text-center {
    margin-bottom: 1rem;
}

#withdrawalFormModal .text-center h4 {
    margin-bottom: 0.5rem;
}

#withdrawalFormModal .text-center p {
    margin-bottom: 0.5rem;
}

#withdrawalFormModal .text-center .btn {
    margin-top: 0.5rem;
}

/* File upload areas in withdrawal form */
#withdrawalFormModal .file-upload-area {
    padding: 1.5rem !important;
    min-height: 120px !important;
}

#withdrawalFormModal .file-upload-area .upload-placeholder {
    padding: 0.5rem;
}

/* Form check spacing */
#bookingModal .form-check,
#withdrawalFormModal .form-check {
    margin-bottom: 0.5rem;
}

#bookingModal .form-check-input,
#withdrawalFormModal .form-check-input {
    margin-right: 0.5rem;
}

/* Accordion spacing in forms modal */
#formsModal .accordion-item {
    margin-bottom: 0.75rem !important;
}

#formsModal .accordion-button {
    padding: 0.75rem 1rem !important;
}

#formsModal .accordion-body {
    padding: 0.75rem 1rem !important;
}

/* Responsive adjustments for booking and withdrawal forms */
@media (max-width: 768px) {
    #bookingModal .modal-body,
    #withdrawalFormModal .modal-body {
        padding: 0.75rem !important;
    }
    
    #bookingModal .section-title,
    #withdrawalFormModal .section-title {
        padding: 0.5rem 0.75rem !important;
    }
    
    #bookingModal .file-upload-area,
    #withdrawalFormModal .file-upload-area {
        padding: 1rem !important;
    }
}

@media (max-width: 576px) {
    #bookingModal .modal-body,
    #withdrawalFormModal .modal-body {
        padding: 0.5rem !important;
    }
    
    #bookingModal .section-title,
    #withdrawalFormModal .section-title {
        padding: 0.5rem !important;
        font-size: 1rem;
    }
    
    #bookingModal .row,
    #withdrawalFormModal .row {
        margin-left: -0.25rem !important;
        margin-right: -0.25rem !important;
    }
    
    #bookingModal .row > [class*="col-"],
    #withdrawalFormModal .row > [class*="col-"] {
        padding-left: 0.25rem !important;
        padding-right: 0.25rem !important;
    }
    
    #bookingModal .file-upload-area,
    #withdrawalFormModal .file-upload-area {
        padding: 0.75rem !important;
        min-height: 100px !important;
    }
}

/* Additional form spacing improvements */
#bookingModal .mb-5,
#withdrawalFormModal .mb-5 {
    margin-bottom: 1.5rem !important;
}

#bookingModal .mb-4,
#withdrawalFormModal .mb-4 {
    margin-bottom: 1rem !important;
}

#bookingModal .mb-3,
#withdrawalFormModal .mb-3 {
    margin-bottom: 0.75rem !important;
}

/* Ensure proper text alignment */
#bookingModal .text-muted,
#withdrawalFormModal .text-muted {
    line-height: 1.4;
}

/* Fix for form sections that might be too wide */
#bookingModal .form-section,
#withdrawalFormModal .form-section {
    max-width: 100%;
    overflow: hidden;
}

/* Confirmed Check-in Form Specific Fixes */
#confirmedCheckinModal .modal-body {
    padding: 1rem !important;
}

#confirmedCheckinModal .form-section {
    margin-bottom: 1.5rem !important;
}

#confirmedCheckinModal .section-title {
    font-size: 1.1rem;
    margin-bottom: 1rem !important;
    padding: 0.75rem 1rem !important;
}

#confirmedCheckinModal .row {
    margin-left: -0.5rem !important;
    margin-right: -0.5rem !important;
}

#confirmedCheckinModal .row > [class*="col-"] {
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
}

#confirmedCheckinModal .form-label {
    margin-bottom: 0.5rem;
    font-weight: 500;
}

#confirmedCheckinModal .form-control,
#confirmedCheckinModal .form-select {
    padding: 0.5rem 0.75rem;
}

/* Time selection boxes - make them more compact */
#confirmedCheckinModal .row.g-2 {
    margin-left: -0.25rem !important;
    margin-right: -0.25rem !important;
}

#confirmedCheckinModal .row.g-2 > [class*="col-"] {
    padding-left: 0.25rem !important;
    padding-right: 0.25rem !important;
}

#confirmedCheckinModal .row.g-2 .form-select {
    font-size: 0.85rem;
    padding: 0.4rem 0.5rem;
    height: 38px;
    min-width: 70px;
}

/* Alert spacing */
#confirmedCheckinModal .alert {
    margin-bottom: 1rem !important;
    padding: 0.75rem 1rem;
}

/* Center the content better */
#confirmedCheckinModal .text-center {
    margin-bottom: 1rem;
}

#confirmedCheckinModal .text-center h4 {
    margin-bottom: 0.5rem;
}

#confirmedCheckinModal .text-center p {
    margin-bottom: 0.5rem;
}

/* Submit button spacing */
#confirmedCheckinModal .text-center .btn {
    margin-top: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #confirmedCheckinModal .modal-body {
        padding: 0.75rem !important;
    }
    
    #confirmedCheckinModal .section-title {
        padding: 0.5rem 0.75rem !important;
    }
    
    #confirmedCheckinModal .row.g-2 .form-select {
        font-size: 0.8rem;
        padding: 0.35rem 0.4rem;
    }
}

@media (max-width: 576px) {
    #confirmedCheckinModal .modal-body {
        padding: 0.5rem !important;
    }
    
    #confirmedCheckinModal .section-title {
        padding: 0.5rem !important;
        font-size: 1rem;
    }
    
    #confirmedCheckinModal .row.g-2 {
        margin-left: -0.125rem !important;
        margin-right: -0.125rem !important;
    }
    
    #confirmedCheckinModal .row.g-2 > [class*="col-"] {
        padding-left: 0.125rem !important;
        padding-right: 0.125rem !important;
    }
}
/* Responsive adjustments for centered layout */
@media (max-width: 1200px) {
    .resources-centered-container {
        gap: 25px;
    }
}

@media (max-width: 992px) {
    .resources-centered-container {
        gap: 20px;
    }
    
    .resource-card {
        width: 280px;
    }
}

@media (max-width: 768px) {
    .room-type-nav .btn-group {
        flex-direction: column;
        width: 100%;
    }

    .room-type-nav .btn {
        width: 100%;
    }

    .quick-booking .text-lg-end {
        text-align: center !important;
        margin-top: 20px;
    }

    .rate-row {
        flex-direction: column;
        border-bottom: 1px solid #e74c3c;
    }
    
    .rate-label {
        font-size: clamp(1rem, 1.3vw, 1.3rem);
        padding: clamp(16px, 2vw, 25px) clamp(18px, 2vw, 30px);
    }
    
    .rate-value {
        font-size: clamp(0.95rem, 1.2vw, 1.2rem);
        padding: clamp(16px, 2vw, 25px) clamp(18px, 2vw, 30px);
    }
    
    .rates-table h4 {
        font-size: clamp(1.6rem, 2.2vw, 2.4rem);
        margin-bottom: 25px;
    }

    .resources-centered-container {
        gap: 20px;
    }
    
    .resource-card {
        width: 100%;
        max-width: 350px;
    }
}

@media (max-width: 576px) {
    .rate-row {
        flex-direction: column;
        border-bottom: 2px solid #e74c3c;
    }
    
    .rate-label,
    .rate-value {
        flex: 0 0 100%;
        width: 100%;
        font-size: clamp(1rem, 1.2vw, 1.2rem);
    }
    
    .rate-label {
        border-bottom: 2px solid #c0392b;
        padding: clamp(14px, 1.8vw, 22px) clamp(16px, 1.8vw, 25px);
    }
    
    .rate-value {
        border-left: none;
        border-top: 2px solid #e74c3c;
        padding: clamp(14px, 1.8vw, 22px) clamp(16px, 1.8vw, 25px);
    }
    
    .rates-table {
        padding: clamp(20px, 4vw, 35px);
    }
    
    .rates-table h4 {
        font-size: clamp(1.4rem, 2vw, 2rem);
        margin-bottom: 20px;
    }

    .resources-centered-container {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    
    .resource-card-wrapper {
        width: 100%;
        max-width: 350px;
    }
}

@media (max-width: 480px) {
    .resources-centered-container {
        gap: 15px;
    }
}



    
    
    </style>
</head>
<body>
<!-- Header - Matching mainpage.php -->
    <header>
        <div class="container header-container">
            <div class="logo">Swinburne Student Village</div>
            <nav>
                <ul>
                    <li><a href="booking.php" class="active">Bookings</a></li>
                    <li><a href="#">Accommodation</a></li>
                    <li><a href="#">Tell us</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="#">Connected</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="booking-hero bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-white">Students</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-white">Student Services</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Accommodation</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-4">Accommodation</h1>
                    <p class="lead mb-4">Hassle free city living</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Section -->
    <section class="welcome-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-primary mb-4">Welcome to Student Village!</h2>
                        <p class="lead text-muted">
                            Your hassle free on-campus accommodation in Swinburne Sarawak. Living on campus means easy access to classes and Uni facilities. 
                            Get ready to be part of a vibrant student community with a wide variety of activities hosted by the resident advisor along with clubs and societies. 
                            It's a great way to get to know new friends and it's all within a safe and supportive environment.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Living Options Section -->
    <section class="living-options py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="display-5 fw-bold">Your living options on Campus</h2>
            </div>

            <!-- Room Types Navigation -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="room-type-nav text-center">
                        <div class="btn-group" role="group" aria-label="Room types">
                            <button type="button" class="btn btn-outline-primary active" data-room="standard-single">Standard Single</button>
                            <button type="button" class="btn btn-outline-primary" data-room="standard-twin">Standard Twin</button>
                            <button type="button" class="btn btn-outline-primary" data-room="standard-plus-single">Standard Plus Single</button>
                            <button type="button" class="btn btn-outline-primary" data-room="standard-plus-twin">Standard Plus Twin</button>
                            <button type="button" class="btn btn-outline-primary" data-room="premium-king">Premium King (Single with A/C)</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Details -->
          <div class="room-details">
            <!-- Standard Single -->
                <div class="room-info active" id="standard-single">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="fw-bold mb-4">Standard Single</h3>
                            <p class="mb-4">
                                A room for students who wants to experience independent living and values privacy at the end of the day. 
                                Come back to your own space after a long day of attending classes and activities. 
                                The room comes with an individual shoe rack, wastepaper basket, access to 24 hours Wi-Fi, 
                                a mattress protector, storage space, wardrobe, study table and chair, and a comfy single bed.
                            </p>
                            <div class="room-features mb-4">
                                <h5 class="fw-bold mb-3">Room Features:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Individual shoe rack</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Wastepaper basket</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>24 hours Wi-Fi</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Comfy single bed</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Mattress protector</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Storage space & wardrobe</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Study table and chair</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg book-room-btn" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Room</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="room-image">
                                <img src="img/standard-single-room.jpg" alt="Standard Single Room" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Rates Table - Vertical Layout -->
                    <div class="rates-table mt-5">
                        <h4 class="fw-bold mb-4">Rates:</h4>
                        <div class="vertical-rates-table">
                            <div class="rate-row">
                                <div class="rate-label">Room Type</div>
                                <div class="rate-value">Standard Single (fan)</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Deposit (RM)</div>
                                <div class="rate-value">950</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Monthly rental (RM)</div>
                                <div class="rate-value">950</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure start date</div>
                                <div class="rate-value">Every 1st / 16th of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure end date</div>
                                <div class="rate-value">Every 15th / 30th / 31st of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Confirmation of room</div>
                                <div class="rate-value">Upon booking confirmation — full payment is required</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Remarks</div>
                                <div class="rate-value">Please note that booking confirmation is subjected to room availability and deposit</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Standard Twin -->
                <div class="room-info" id="standard-twin">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="fw-bold mb-4">Standard Twin</h3>
                            <p class="mb-4">
                                An affordable room suitable for you to experience a shared living space and interaction. 
                                Suitable for siblings and new-found friends. Enjoy socializing, studying or just chill. 
                                You'll never be short of company in your shared space. The room comes with an individual 
                                shoe rack, wastepaper basket, access to 24 hours Wi-Fi, a mattress protector, storage space, 
                                wardrobe, study table and chair, and a comfy single bed.
                            </p>
                            <div class="room-features mb-4">
                                <h5 class="fw-bold mb-3">Room Features:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Individual shoe rack</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Wastepaper basket</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>24 hours Wi-Fi</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Comfy single bed</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Mattress protector</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Storage space & wardrobe</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Study table and chair</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg book-room-btn" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Room</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="room-image">
                                <img src="img/standard-twin-room.jpg" alt="Standard Twin Room" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Rates Table - Vertical Layout -->
                    <div class="rates-table mt-5">
                        <h4 class="fw-bold mb-4">Rates:</h4>
                        <div class="vertical-rates-table">
                            <div class="rate-row">
                                <div class="rate-label">Room Type</div>
                                <div class="rate-value">Standard Twin (fan)</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Deposit (RM)</div>
                                <div class="rate-value">540</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Monthly rental (RM)</div>
                                <div class="rate-value">540</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure start date</div>
                                <div class="rate-value">Every 1st / 16th of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure end date</div>
                                <div class="rate-value">Every 15th / 30th / 31st of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Confirmation of room</div>
                                <div class="rate-value">Upon booking confirmation — full payment is required</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Remarks</div>
                                <div class="rate-value">Please note that booking confirmation is subjected to room availability and deposit</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Standard Plus Single -->
                <div class="room-info" id="standard-plus-single">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="fw-bold mb-4">Standard Plus Single</h3>
                            <p class="mb-4">
                                A room for students who wants to experience independent living and values privacy at the end of the day. 
                                Come back to your own space after a long day of attending classes and activities. 
                                The room comes with an individual pillow, table lamp, hangers, shoe rack, wastepaper basket, 
                                access to 24 hours Wi-Fi, a mattress protector, storage space, wardrobe, study table and chair, 
                                and a comfy single bed.
                            </p>
                            <div class="room-features mb-4">
                                <h5 class="fw-bold mb-3">Room Features:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Individual pillow</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Hangers</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Wastepaper basket</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Mattress protector</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Study table and chair</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Table lamp</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Shoe rack</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>24 hours Wi-Fi</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Storage space & wardrobe</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Comfy single bed</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg book-room-btn" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Room</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="room-image">
                                <img src="img/standard-plus-single-room.jpg" alt="Standard Plus Single Room" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Rates Table - Vertical Layout -->
                    <div class="rates-table mt-5">
                        <h4 class="fw-bold mb-4">Rates:</h4>
                        <div class="vertical-rates-table">
                            <div class="rate-row">
                                <div class="rate-label">Room Type</div>
                                <div class="rate-value">Standard Plus Single (A/C)</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Deposit (RM)</div>
                                <div class="rate-value">1,250</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Utilities deposit (RM)</div>
                                <div class="rate-value">500</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Monthly rental (RM)</div>
                                <div class="rate-value">1,250</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure start date</div>
                                <div class="rate-value">Every 1st / 16th of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure end date</div>
                                <div class="rate-value">Every 15th / 30th / 31st of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Confirmation of room</div>
                                <div class="rate-value">Upon booking confirmation — full payment is required</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Remarks</div>
                                <div class="rate-value">
                                    1. Please note that booking confirmation is subjected to room availability and deposit<br>
                                    2. Air-conditioning electricity is charged separately with the rental and "charge as per usage". Refer to
                                    <a href="https://www.swinburne.edu.my/wp-content/uploads/so-media/docs/SV-Resident-Handbook.pdf" target="_blank" class="text-decoration-underline">Resident Handbook</a> for details.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Standard Plus Twin -->
                <div class="room-info" id="standard-plus-twin">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="fw-bold mb-4">Standard Plus Twin</h3>
                            <p class="mb-4">
                                A room suitable for you to experience a shared living space and interaction. 
                                Suitable for siblings and new-found friends. Enjoy socializing, studying or just chill. 
                                You'll never be short of company in your shared space. The room comes with an individual 
                                pillow, table lamp, hangers, shoe rack, wastepaper basket, access to 24 hours Wi-Fi, 
                                a mattress protector, storage space, wardrobe, study table and chair, and a comfy single bed.
                            </p>
                            <div class="room-features mb-4">
                                <h5 class="fw-bold mb-3">Room Features:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Individual pillow</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Hangers</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Wastepaper basket</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Mattress protector</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Study table and chair</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Table lamp</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Shoe rack</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>24 hours Wi-Fi</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Storage space & wardrobe</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Comfy single bed</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg book-room-btn" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Room</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="room-image">
                                <img src="img/standard-plus-twin-room.jpg" alt="Standard Plus Twin Room" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Rates Table - Vertical Layout -->
                    <div class="rates-table mt-5">
                        <h4 class="fw-bold mb-4">Rates:</h4>
                        <div class="vertical-rates-table">
                            <div class="rate-row">
                                <div class="rate-label">Room Type</div>
                                <div class="rate-value">Standard Plus Twin (A/C)</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Deposit (RM)</div>
                                <div class="rate-value">950</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Utilities deposit (RM)</div>
                                <div class="rate-value">500</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Monthly rental (RM)</div>
                                <div class="rate-value">950</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure start date</div>
                                <div class="rate-value">Every 1st / 16th of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure end date</div>
                                <div class="rate-value">Every 15th / 30th / 31st of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Confirmation of room</div>
                                <div class="rate-value">Upon booking confirmation — full payment is required</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Remarks</div>
                                <div class="rate-value">
                                    1. Please note that booking confirmation is subjected to room availability and deposit<br>
                                    2. Air-conditioning electricity is charged separately with the rental and "charge as per usage". Refer to
                                    <a href="https://www.swinburne.edu.my/wp-content/uploads/so-media/docs/SV-Resident-Handbook.pdf" target="_blank" class="text-decoration-underline">Resident Handbook</a> for details.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premium King Single with A/C -->
                <div class="room-info" id="premium-king">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="fw-bold mb-4">Premium King Single with A/C</h3>
                            <p class="mb-4">
                                Experience the freedom of independent living in a spacious room designed for privacy and comfort. 
                                Perfect for students who value their personal space, this room features a comfy king bed, 
                                study essentials, ample storage, and 24/7 Wi-Fi to support your lifestyle. 
                                Enjoy the comfort and convenience of home, with everything you need to relax and focus on the end of the day.
                                The room also comes with an individual pillow, table lamp, hangers, shoe rack, wastepaper basket, 
                                access to 24 hours Wi-Fi, a mattress protector, wardrobe, study table and chair.
                            </p>
                            <div class="room-features mb-4">
                                <h5 class="fw-bold mb-3">Room Features:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Individual pillow</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Hangers</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Shoe rack</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>24 hours Wi-Fi</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Study table and chair</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Table lamp</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Wastepaper basket</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Mattress protector</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Wardrobe</li>
                                            <li><i class="bi bi-check-circle text-success me-2"></i>Comfy king bed</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg book-room-btn" data-bs-toggle="modal" data-bs-target="#bookingModal">Book This Room</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="room-image">
                                <img src="img/premium-king-single-room.jpg" alt="Premium King Single Room" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Rates Table - Vertical Layout -->
                    <div class="rates-table mt-5">
                        <h4 class="fw-bold mb-4">Rates:</h4>
                        <div class="vertical-rates-table">
                            <div class="rate-row">
                                <div class="rate-label">Room Type</div>
                                <div class="rate-value">Premium King (Single with A/C)</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Deposit (RM)</div>
                                <div class="rate-value">1,350</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Utilities deposit (RM)</div>
                                <div class="rate-value">500</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Monthly rental (RM)</div>
                                <div class="rate-value">1,350</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure start date</div>
                                <div class="rate-value">Every 1st / 16th of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Tenure end date</div>
                                <div class="rate-value">Every 15th / 30th / 31st of the month</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Confirmation of room</div>
                                <div class="rate-value">Upon booking confirmation — full payment is required</div>
                            </div>
                            <div class="rate-row">
                                <div class="rate-label">Remarks</div>
                                <div class="rate-value">
                                    1. Please note that booking confirmation is subjected to room availability and deposit<br>
                                    2. Air-conditioning electricity is charged separately with the rental and "charge as per usage". Refer to 
                                    <a href="https://www.swinburne.edu.my/wp-content/uploads/so-media/docs/SV-Resident-Handbook.pdf" target="_blank" class="text-decoration-underline">Resident Handbook</a> for details.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Resources Section -->
    <section class="resources-section py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2 class="display-5 fw-bold">Student Village Resources</h2>
                <p class="lead text-muted">
                    Everything you need to know about living at Student Village
                </p>
            </div>

            <!-- All cards in centered flexbox layout -->
            <div class="resources-centered-container">
                <?php
                $resources = [
                    [
                        'name' => 'RESIDENT HANDBOOK',
                        'icon' => 'bi-journal-text',
                        'description' => 'Complete guide to living at Student Village',
                        'type' => 'external',
                        'link' => 'https://www.swinburne.edu.my/wp-content/uploads/so-media/docs/SV-Resident-Handbook.pdf',
                        'target' => '_blank'
                    ],
                    [
                        'name' => 'FAQ',
                        'icon' => 'bi-question-circle',
                        'description' => 'Frequently asked questions about accommodation',
                        'type' => 'popup',
                        'popup_id' => 'faqModal'
                    ],
                    [
                        'name' => 'OUR FORMS',
                        'icon' => 'bi-file-earmark-text',
                        'description' => 'Downloadable forms for various requests',
                        'type' => 'popup',
                        'popup_id' => 'formsModal'
                    ],
                    [
                        'name' => 'ROOM TOUR',
                        'icon' => 'bi-camera-video',
                        'description' => 'Virtual tour of our accommodation rooms',
                        'type' => 'external',
                        'link' => 'https://www.youtube.com/watch?v=sRS4AGP7IlA&feature=youtu.be',
                        'target' => '_blank'
                    ],
                    [
                        'name' => 'STUDENT VILLAGE TOUR',
                        'icon' => 'bi-house-door',
                        'description' => 'Complete tour of Student Village facilities',
                        'type' => 'external',
                        'link' => 'https://www.youtube.com/watch?v=PAxyauvCjcM&feature=youtu.be',
                        'target' => '_blank'
                    ]
                ];

                foreach ($resources as $resource) {
                    echo '<div class="resource-card-wrapper">';
                    echo '<div class="resource-card text-center p-4 bg-white rounded-3 shadow-sm h-100 border-0">';
                    echo '<div class="resource-icon bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">';
                    echo '<i class="' . $resource['icon'] . '" style="font-size: 2rem;"></i>';
                    echo '</div>';
                    echo '<h5 class="fw-bold mb-3 text-dark">' . $resource['name'] . '</h5>';
                    echo '<p class="text-muted mb-4">' . $resource['description'] . '</p>';
                    
                    if ($resource['type'] === 'external') {
                        echo '<a href="' . $resource['link'] . '" target="' . $resource['target'] . '" class="btn btn-primary px-4 py-2 fw-semibold mt-auto">View More</a>';
                    } else if ($resource['type'] === 'popup') {
                        echo '<button class="btn btn-primary px-4 py-2 fw-semibold mt-auto" data-bs-toggle="modal" data-bs-target="#' . $resource['popup_id'] . '">View More</button>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

   <!-- FAQ Modal -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header custom-blue-bg text-white ">
                <h5 class="modal-title fw-bold" id="faqModalLabel">Frequently Asked Questions</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="faq-content">
                    <p class="text-muted mb-4">If your query has not been addressed, connect with us at: <a href="mailto:accommodation@swinburne.edu.my" class="text-primary fw-semibold">accommodation@swinburne.edu.my</a>.</p>

                    <div class="accordion" id="faqAccordion">
                        <!-- General Questions -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#faqGeneral">
                                    <i class="bi bi-info-circle me-2 text-primary"></i>General Questions
                                </button>
                            </h2>
                            <div id="faqGeneral" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">How do I pay for my fees?</h6>
                                        <p class="mb-0 text-muted">Swinburne caters to a variety of payment methods. The list of options are available <a href="https://www.swinburne.edu.my/current-students/manage-course/paying-fees/how-i-pay-my-fee/" target="_blank" class="text-primary fw-semibold">here</a>.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6 class="fw-bold text-primary mb-2">Is my Student Village accommodation guaranteed?</h6>
                                        <p class="mb-0 text-muted">The accommodation is guaranteed on "First Come First Served with Payment" basis. However, we are not able to guarantee the availability of your preferred room "location" or roommate preference.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Prior to Check-in -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#faqPriorCheckin">
                                    <i class="bi bi-calendar-check me-2 text-primary"></i>Prior to Check-in
                                </button>
                            </h2>
                            <div id="faqPriorCheckin" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">What do I need to bring with me?</h6>
                                        <p class="mb-0 text-muted">Before coming to Kuching, we recommend you bring all the essentials. <a href="https://www.swinburne.edu.my/wp-content/uploads/so-media/docs/guides/USVChecklist.pdf" target="_blank" class="text-primary fw-semibold">Check the essentials checklist here</a>.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">When and what time can I check in?</h6>
                                        <p class="mb-0 text-muted">Students are advised to arrive and check-in on the specified CHECK-IN date and time stated in the Student Village Room Confirmation (SVRC) letter. Check-in time is during office hours: 8.30 am – 5.00 pm (Monday to Friday). We are closed on Saturday, Sunday and public holidays. To ensure your check-in can be assisted accordingly, kindly fill in the confirmed check-in time and date form, 3 days before check-in date <a href="#" data-bs-toggle="modal" data-bs-target="#confirmedCheckinModal" class="text-primary fw-semibold">Confirmed Check-In Date Form</a>.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6 class="fw-bold text-primary mb-2">Is Student Village accommodation available for special needs students?</h6>
                                        <p class="mb-0 text-muted">If you have a physical disability, kindly indicate when applying and to provide Accommodation office with written documentation from registered physician.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrival/Check In -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#faqArrival">
                                    <i class="bi bi-door-open me-2 text-primary"></i>Arrival/Check In
                                </button>
                            </h2>
                            <div id="faqArrival" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="faq-item">
                                        <h6 class="fw-bold text-primary mb-2">Check in Form</h6>
                                        <p class="mb-0 text-muted">Upon checking in, the residents are asked to complete the Student Village Check-in and Declaration Form, understand and acknowledge the Student Villages Rules of Occupancy, and sign the form.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- During Stay -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#faqDuringStay">
                                    <i class="bi bi-house me-2 text-primary"></i>During My Stay
                                </button>
                            </h2>
                            <div id="faqDuringStay" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Can I have guests over?</h6>
                                        <p class="mb-0 text-muted">The Student Village is exclusively for residents only. Visiting guests must register at the Student Village security counter and residents can entertain their guests at the visitor lounge. Visiting guests are not allowed to enter students room and use facilities available at Student Village.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Is the Student Village allocation separated by gender?</h6>
                                        <p class="mb-0 text-muted">SV1 and SV3 are designated for our male residents, while SV2 is for our female residents.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Are there parking facilities on Campus?</h6>
                                        <p class="mb-0 text-muted">Yes, there are. If you decide to drive to campus, there are ample parking spaces on campus. You can choose to park at the multi-storey carpark or the outdoor parking.</p>
                                        <p class="mb-0 text-muted">You can find more information on parking <a href="https://www.swinburne.edu.my/facilities-services/parking/" target="_blank" class="text-primary fw-semibold">here</a>.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Am I allowed to cook / prepare my meals?</h6>
                                        <p class="mb-0 text-muted">Food is the key to everyone's heart and belly. You can show off your culinary skills at the Communal Kitchen located in the SV1 building. Microwave is available in the pantry on every floor for heating up food and drinks.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Where do we keep our perishable grocery? Do we have a refrigerator?</h6>
                                        <p class="mb-0 text-muted">You may store your groceries in the chiller, freezer or shelves at the Communal Kitchen or in the fridge available in the pantry on every floor. Be mindful as these are shared by all residents. We would advise you to store your food items in closed containers and label them. The management does not take responsibility for any damaged or missing items in the fridge. To ensure that the fridge is clean, a scheduled clean will take place every Saturday at 9.00 am.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Is there a laundry service available at the student village?</h6>
                                        <p class="mb-0 text-muted">A 24-hour coin-operated laundry service (wash and dryer) is available. Apart from the laundry service, there are designated washing and drying room available on every floor.</p>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">Is there a curfew I should observe?</h6>
                                        <p class="mb-0 text-muted">There is a strict noise curfew to control noise level as courtesy to other residents starting from 11.00 pm. As we are in a co-living space, please be respectful to one another.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6 class="fw-bold text-primary mb-2">Can I continue my stay in Student Village?</h6>
                                        <p class="mb-0 text-muted">Maximum stay is for one (1) year only. If the room is available, you must fill in the Tenure Renewal form and make full payment of rental for subsequent semester stay.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Check Out -->
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#faqCheckout">
                                    <i class="bi bi-box-arrow-right me-2 text-primary"></i>Check Out
                                </button>
                            </h2>
                            <div id="faqCheckout" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-white">
                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">What are the documents that I need to prepare before I check out from the hostel?</h6>
                                        <ul class="mb-0 text-muted">
                                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#withdrawalFormModal" class="text-primary fw-semibold">Student Village Withdrawal Form</a></li>
                                            <li><a href="https://servicedesk.swinburne.edu.my/app/fba_servicedesk/ui/requests/add" target="_blank" class="text-primary fw-semibold">Refund Request Form</a></li>
                                            <li>A copy of Malaysian bank details or statement. If you do not have Malaysia bank account, you can choose to contra the deposit to your tuition fees. Alternatively, you can use 3rd party account (Malaysian bank) with Authorisation letter</li>
                                        </ul>
                                    </div>

                                    <div class="faq-item mb-4">
                                        <h6 class="fw-bold text-primary mb-2">How long before I receive my deposit?</h6>
                                        <p class="mb-0 text-muted">Refund of hostel deposit will take approximately 4 - 6 weeks to process from the date the completed Student Village Withdrawal & Refund documents and door access card are returned to the Accommodation Office. For Standard Plus room, the charges for air-conditioning usage will be deducted from the Utility Deposit. Student can follow up with Finance Unit on the progress of the refund.</p>
                                    </div>

                                    <div class="faq-item">
                                        <h6 class="fw-bold text-primary mb-2">My tenancy period will end soon. Can I use my security deposit to offset my monthly rental?</h6>
                                        <p class="mb-0 text-muted">The security deposit cannot be used to offset the room rental. The following room rental should be paid before current tenancy period ended.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn custom-blue-btn btn-lg px-5" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Forms Modal -  -->
<div class="modal fade" id="formsModal" tabindex="-1" aria-labelledby="formsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header custom-blue-bg text-white">
                <h5 class="modal-title fw-bold" id="formsModalLabel">Student Village Forms</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="forms-content">
                    <p class="text-muted mb-4">All the forms related to the Student Village right here for your ease of reference.</p>
                    
                    <div class="accordion" id="formsAccordion">
                        <!-- Booking Form -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#bookingFormAccordion">
                                    <i class="bi bi-file-earmark-plus me-2 text-primary"></i>Student Village Booking Form
                                </button>
                            </h2>
                            <div id="bookingFormAccordion" class="accordion-collapse collapse" data-bs-parent="#formsAccordion">
                                <div class="accordion-body bg-white">
                                    <p class="text-muted mb-3">Application form for booking accommodation at Student Village</p>
                                    <a href="#" class="text-primary fw-semibold text-decoration-none" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#bookingModal"
                                       data-bs-dismiss="modal">
                                        View Form
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Check-in Form -->
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#checkinFormAccordion">
                                    <i class="bi bi-door-open me-2 text-primary"></i>Student Village Check-in and Declaration Form
                                </button>
                            </h2>
                            <div id="checkinFormAccordion" class="accordion-collapse collapse" data-bs-parent="#formsAccordion">
                                <div class="accordion-body bg-white">
                                    <p class="text-muted mb-3">Required form for check-in procedure and declaration</p>
                                    <a href="#" class="text-primary fw-semibold text-decoration-none" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#checkinFormModal"
                                       data-bs-dismiss="modal">
                                        View Form
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Withdrawal Form -->
                       <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#withdrawalFormAccordion">
                                    <i class="bi bi-box-arrow-right me-2 text-primary"></i>Student Village Withdrawal Form
                                </button>
                            </h2>
                            <div id="withdrawalFormAccordion" class="accordion-collapse collapse" data-bs-parent="#formsAccordion">
                                <div class="accordion-body bg-white">
                                    <p class="text-muted mb-3">Form for withdrawing from Student Village accommodation</p>
                                    <a href="#" class="text-primary fw-semibold text-decoration-none" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#withdrawalFormModal"
                                    data-bs-dismiss="modal">
                                        View Form
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-blue-btn btn-lg px-5" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>            

   
<!-- Booking Application Form Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header custom-blue-bg text-white">
                <h2 class="modal-title fw-bold" id="bookingModalLabel">Student Village Booking Form</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- University Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold custom-red-text">Swinburne University of Technology Sarawak</h4>
                    <p class="text-muted mb-3">
                        TYPE YOUR NAME AS IT APPEARS IN YOUR NRIC/PASSPORT. PLEASE WRITE IN BLOCK LETTERS.
                    </p>
                </div>

                <form id="bookingForm">
                    <!-- SECTION A: PERSONAL DETAILS -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">SECTION A: PERSONAL DETAILS</h4>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Family Name (as indicated in passport) *</label>
                                <input type="text" class="form-control" name="familyName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Given names *</label>
                                <input type="text" class="form-control" name="givenNames" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gender *</label>
                                <select class="form-select" name="gender" required>
                                    <option value="">Please Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Are you a new or current student? *</label>
                                <select class="form-select" name="studentType" required>
                                    <option value="">Please Select</option>
                                    <option value="new">New Student</option>
                                    <option value="current">Current Student</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student ID Number *</label>
                                <input type="text" class="form-control" name="studentId" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country *</label>
                                <select class="form-select" name="country" id="country" required>
                                    <option value="">Please Select</option>
                                    <option value="malaysia">Malaysia</option>
                                    <option value="china">China</option>
                                    <option value="india">India</option>
                                    <option value="indonesia">Indonesia</option>
                                    <option value="vietnam">Vietnam</option>
                                    <option value="bangladesh">Bangladesh</option>
                                    <option value="pakistan">Pakistan</option>
                                    <option value="nigeria">Nigeria</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Full Residential Address *</label>
                            <textarea class="form-control" name="address" rows="3" required></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student Email Address *</label>
                                <input type="email" class="form-control" name="studentEmail" placeholder="e.g. 123456789@students.swinburne.edu.my" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Personal Email Address *</label>
                                <input type="email" class="form-control" name="personalEmail" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Prefix *</label>
                                <select class="form-select" name="phonePrefix" required>
                                    <option value="">Select</option>
                                    <option value="+60">+60 (Malaysia)</option>
                                    <option value="+86">+86 (China)</option>
                                    <option value="+91">+91 (India)</option>
                                    <option value="+62">+62 (Indonesia)</option>
                                    <option value="+84">+84 (Vietnam)</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" name="phoneNumber" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Are you a Malaysian student? *</label>
                                <select class="form-select" name="malaysianStudent" id="malaysianStudent" required>
                                    <option value="">Please Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Religion</label>
                                <input type="text" class="form-control" name="religion">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Identification Card Number/Passport Number *</label>
                                <input type="text" class="form-control" name="idNumber" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Do you have any medical condition that requires attention? *</label>
                                <select class="form-select" name="medicalCondition" id="medicalCondition" required>
                                    <option value="">Please Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3" id="medicalDetails" style="display: none;">
                            <label class="form-label">Please provide details: *</label>
                            <textarea class="form-control" name="medicalDetails" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- SECTION B: PROGRAM INFORMATION -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">SECTION B: PROGRAM INFORMATION</h4>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Program Offered *</label>
                                <select class="form-select" name="program" id="program" required>
                                    <option value="">Please Select</option>
                                    <optgroup label="Foundation Studies">
                                        <option value="foundation-business">Swinburne Foundation Studies (Business)</option>
                                        <option value="foundation-design">Swinburne Foundation Studies (Design)</option>
                                        <option value="foundation-engineering">Swinburne Foundation Studies (Engineering/Science)</option>
                                        <option value="foundation-it">Swinburne Foundation Studies (Information Technology/Multimedia)</option>
                                    </optgroup>
                                    <optgroup label="Diploma Programs">
                                        <option value="diploma-accountancy">Diploma of Accountancy</option>
                                        <option value="diploma-business">Diploma of Business Management</option>
                                        <option value="diploma-childhood">Diploma of Early Childhood Education</option>
                                        <option value="diploma-media">Diploma of Digital Media Design</option>
                                        <option value="diploma-it">Diploma of Information Technology</option>
                                        <option value="diploma-quantity">Diploma of Quantity Surveying</option>
                                    </optgroup>
                                    <optgroup label="Bachelor's Degree Programs">
                                        <option value="bachelor-business">Bachelor of Business (Various Majors)</option>
                                        <option value="bachelor-computer">Bachelor of Computer Science</option>
                                        <option value="bachelor-ict">Bachelor of Information and Communication Technology</option>
                                        <option value="bachelor-engineering">Bachelor of Engineering (Various Majors)</option>
                                        <option value="bachelor-design">Bachelor of Design</option>
                                        <option value="bachelor-science">Bachelor of Science</option>
                                        <option value="bachelor-double">Double Degrees</option>
                                    </optgroup>
                                    <optgroup label="Postgraduate Programs">
                                        <option value="master-tesol">Master of Arts (TESOL)</option>
                                        <option value="master-mba">Master of Business Administration</option>
                                        <option value="master-construction">Master of Construction Management</option>
                                        <option value="master-hr">Master of Human Resource Management</option>
                                        <option value="master-it">Master of Information Technology</option>
                                        <option value="master-research">Master by Research</option>
                                        <option value="phd">Doctor of Philosophy (PhD)</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Semester *</label>
                                <select class="form-select" name="semester" id="semester" required>
                                    <option value="">Please Select</option>
                                    <option value="year1-sem1">Year 1 / Semester 1</option>
                                    <option value="year1-sem2">Year 1 / Semester 2</option>
                                    <option value="year2-sem3">Year 2 / Semester 3</option>
                                    <option value="year2-sem4">Year 2 / Semester 4</option>
                                    <option value="year3-sem5">Year 3 / Semester 5</option>
                                    <option value="year3-sem6">Year 3 / Semester 6</option>
                                    <option value="year4-sem7">Year 4 / Semester 7</option>
                                    <option value="year4-sem8">Year 4 / Semester 8</option>
                                    <option value="year5-sem9">Year 5 / Semester 9</option>
                                    <option value="year5-sem10">Year 5 / Semester 10</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Program commencement date *</label>
                                <input type="date" class="form-control" name="commencementDate" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Screenshot of Study Offer Acceptance *</label>
                            <div class="file-upload-area border rounded p-4 text-center">
                                <input type="file" class="file-input" name="studyOfferScreenshot" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="upload-placeholder">
                                    <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                    <p class="mt-2 mb-1">Browse Files</p>
                                    <p class="text-muted small">Drag and drop files here</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION C: ACCOMMODATION BOOKING -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">SECTION C: ACCOMMODATION BOOKING</h4>
                        
                        <div class="alert alert-info mb-4">
                            <strong>Note:</strong> Booking is subject to room availability and upon receiving the Student Village Room Confirmation (SVRC). For Standard Plus room options, air-conditioning (A/C) usage is "charge as per usage". You are deemed to have agreed that monthly A/C charges will be share equally with your roommate for residents in Standard Plus Twin (Sharing with A/C).
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student Village Room Option *</label>
                               <select name="roomType" class="form-select" required>
                                <option value="">Please Select</option>
                                <option value="standard-single">Standard Single</option>
                                <option value="standard-twin">Standard Twin</option>
                                <option value="standard-plus-single">Standard Plus Single</option>
                                <option value="standard-plus-twin">Standard Plus Twin</option>
                                <option value="premium-king">Premium King Single with A/C</option>
                            </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tenure Type *</label>
                                <select class="form-select" name="tenureType" id="tenureType" required>
                                    <option value="">Click to Select</option>
                                    <optgroup label="January Intake (Summer)">
                                        <option value="foundation-summer">(NEVI) Foundation. 16/12/24 - 28/02/25 (2.5 months)</option>
                                        <option value="acca-jan">(NEVI) ACCA. 1/01/25 - 15/07/25 (8.5 months)</option>
                                    </optgroup>
                                    <optgroup label="Feb/March Intake">
                                        <option value="elicos-feb">(NEVI) ELICOS. 1/02/25 - 15/05/25 (3.5 months)</option>
                                        <option value="foundation-feb">(NEVI) Foundation/Diploma/ Degree/ MCMP & MA Tesot. 16/02/25 - 30/06/25 (4.5 months)</option>
                                        <option value="mt-term1">(NEVI) MT Term 1 & Term 2. 16/02/25 - 31/07/25 (5.5 months)</option>
                                        <option value="mba-term1">(NEVI) MBA (i) Term 1. 16/02/25 - 15/05/25 (3.0 months)</option>
                                        <option value="isap-feb">(NEVI) ISAP (K). 16/02/25 - 15/07/25 (5.0 months)</option>
                                    </optgroup>
                                    <optgroup label="May Intake">
                                        <option value="foundation-may">(NEVI) Foundation MAY Intake. 01/05/25 - 31/08/25 (4.0 months)</option>
                                        <option value="mba-term2">(NEVI) MBA (i) Term 2. 16/05/25 - 31/07/25 (2.5 months)</option>
                                    </optgroup>
                                    <optgroup label="June Intake (Winter)">
                                        <option value="elicos-june">(NEVI) ELICOS. 1/06/25 - 31/08/25 (3.0 months)</option>
                                    </optgroup>
                                    <optgroup label="July Intake">
                                        <option value="acca-july">(NEVI) ACCA. 16/07/25 - 31/01/26 (6.5 months)</option>
                                        <option value="foundation-july">(NEVI) Foundation. 16/09/25 - 31/08/25 (2.5 months)</option>
                                        <option value="ma-tesol-july">(NEVI) MA TESOL Term 2. 16/07/25 - 15/10/25 (3.0 months)</option>
                                        <option value="mt-term3">(NEVI) MT Term 3 & Term 4. 16/07/25 - 31/12/25 (5.5 months)</option>
                                        <option value="mba-term3">(NEVI) MBA (i) Term 3. 1/08/25 - 15/10/25 (2.5 months)</option>
                                    </optgroup>
                                    <optgroup label="September Intake">
                                        <option value="foundation-sep">(NEVI) Foundation/Diploma/ Degree/ MCMP. 16/08/25 - 31/12/25 (4.5 months)</option>
                                        <option value="elicos-sep">(NEVI) ELICOS. 1/09/25 - 30/11/25 (3.0 months)</option>
                                    </optgroup>
                                    <optgroup label="October Intake">
                                        <option value="foundation-oct">(NEVI) Foundation. 16/09/25 - 31/12/25 (3.5 months)</option>
                                        <option value="ma-tesol-oct">(NEVI) MA TESOL Term 3. 16/10/25 - 31/12/25 (2.5 months)</option>
                                        <option value="mba-term4">(NEVI) MBA (i) Term 4. 16/10/25 - 31/12/25 (2.5 months)</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Are you a BP40 student? *</label>
                            <select class="form-select" name="bp40Student" required>
                                <option value="">Please Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- SECTION D: VISA (For International/Non-Malaysian Student Only) -->
                    <div class="form-section mb-5" id="visaSection" style="display: none;">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">SECTION D: VISA (For International/Non-Malaysian Student Only)</h4>
                        
                        <div class="alert alert-warning mb-4">
                            This section is to be completed by International/Non-Malaysian Student Only. You are encourage to obtained first your Visa Approval Letter and itinerary prior to booking.
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Have you obtained your Malaysia Visa Approval Letter/Visa Reference Letter (VRL)?</label>
                            <select class="form-select" name="visaApproval">
                                <option value="">Please Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- SECTION E: DOCUMENTS UPLOAD -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">SECTION E: DOCUMENTS UPLOAD</h4>
                        
                        <div class="mb-4">
                            <label class="form-label">DEPOSIT FEE RECEIPT *</label>
                            <div class="file-upload-area border rounded p-4 text-center">
                                <input type="file" class="file-input" name="depositReceipt" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="upload-placeholder">
                                    <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                    <p class="mt-2 mb-1">Browse Files</p>
                                    <p class="text-muted small">Drag and drop files here</p>
                                    <p class="text-muted small">Kindly check on your room and utility deposit fees via our Accommodation website. One month room deposit is chargeable to confirm your accommodation booking. Kindly upload your payment receipt here. Please take note that the deposit paid is not refundable upon Student Village Booking Confirmation (SVRC).</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4" id="bp40Upload" style="display: none;">
                            <label class="form-label">BP40 Eligibility Letter</label>
                            <div class="file-upload-area border rounded p-4 text-center">
                                <input type="file" class="file-input" name="bp40Letter" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="upload-placeholder">
                                    <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                    <p class="mt-2 mb-1">Browse Files</p>
                                    <p class="text-muted small">Drag and drop files here</p>
                                    <p class="text-muted small">Kindly provide a copy of your BP40 Eligibility Letter for verification purposes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Note:</strong> Full upfront payment is required on the payment due date (class commencement date). Kindly check your Student Village Booking Confirmation. For any booking made after the payment due date (class commencement date), full upfront payment is required. The Accommodation team may contact you.
                        </div>
                    </div>

                    <!-- PRIVACY STATEMENT -->
                    <div class="form-section mb-5">
                        <div class="alert alert-light border">
                            <h6 class="fw-bold custom-blue-text">GENERAL PRIVACY STATEMENT</h6>
                            <p class="small mb-2">
                                Information collected in this form will be utilised to process your accommodation booking request. The information will be processed in accordance to the Personal Data Protection Act (PDPA) 2010 and will only be disclosed to third parties with your consent or to meet statutory obligations.
                            </p>
                            <p class="small mb-2">
                                For more information, please refer to the University's Privacy Collection Notice at 
                                <a href="http://www.swinburne.edu.my/privacy/" target="_blank">http://www.swinburne.edu.my/privacy/</a>
                            </p>
                            <p class="small mb-0">
                                By submitting this form, you agree to be subjected to the Privacy Collection Notice of the University and have consented to the processing and disclosure of your personal data for the fulfillment of this application.
                            </p>
                        </div>
                    </div>

                    <!-- SECTION F: DECLARATION -->
                    <div class="form-section mb-4">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">SECTION F: DECLARATION *</h4>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="declaration" name="declaration" required>
                            <label class="form-check-label" for="declaration">
                                I hereby declare that the information provided in this form is true and correct to the best of my knowledge. I understand that any false information may result in the cancellation of my accommodation booking.
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn custom-blue-btn btn-lg px-5">Submit Booking Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Check-in & Declaration Form Modal --->
<div class="modal fade" id="checkinFormModal" tabindex="-1" aria-labelledby="checkinFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header custom-blue-bg text-white">
                <h2 class="modal-title fw-bold" id="checkinFormModalLabel">Student Village Check-in & Declaration Form</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- University Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold custom-red-text">Swinburne University of Technology Sarawak</h4>
                    <p class="text-muted mb-3">
                        A warm welcome to your room and we hope that your experience with us has been satisfactory. Please help us to complete this form which is expected to take 5 minutes of your time. You'll need to submit us the form within 3 days after your check in date so that we know that everything in your room is in order.
                    </p>
                </div>

                <form id="checkinForm">
                    <!-- CHECK-IN DETAILS -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">CHECK-IN DETAILS</h4>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student ID *</label>
                                <input type="text" class="form-control" name="studentId" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Check In Date *</label>
                                <input type="date" class="form-control" name="checkinDate" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Building *</label>
                                <select class="form-select" name="building" required>
                                    <option value="">Please Select</option>
                                    <option value="sv1">SV1</option>
                                    <option value="sv2">SV2</option>
                                    <option value="sv3">SV3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Room Type *</label>
                                <select class="form-select" name="roomType" required>
                                    <option value="">Please Select</option>
                                    <option value="standard-single">Standard Single</option>
                                    <option value="standard-twin">Standard Twin</option>
                                    <option value="standard-plus-single">Standard Plus Single</option>
                                    <option value="standard-plus-twin">Standard Plus Twin</option>
                                    <option value="premium-king">Premium King Single with A/C</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Room Number *</label>
                                <input type="text" class="form-control" name="roomNumber" required>
                            </div>
                        </div>
                    </div>

                    <!-- AMENITIES CHECK-LIST - FIXED STRUCTURE -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">AMENITIES CHECK-LIST</h4>
                        <p class="text-muted mb-4">PLEASE MARK THE ITEMS CONDITION DURING CHECK IN.</p>
                        
                        <!-- Row 1 - FIXED -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Divan Bed *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="divanBed" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="divanBed" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="divanBed" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Wardrobe *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="wardrobe" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="wardrobe" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="wardrobe" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2 - FIXED -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Bed side cabinet *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bedsideCabinet" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bedsideCabinet" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bedsideCabinet" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Study Table and Chair *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="studyTable" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="studyTable" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="studyTable" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 3 - FIXED -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Blind/Curtain *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="blindCurtain" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="blindCurtain" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="blindCurtain" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Wall Cabinet *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="wallCabinet" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="wallCabinet" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="wallCabinet" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 4 - FIXED -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Door Access Card *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessCard" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessCard" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessCard" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Ceiling Fan *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ceilingFan" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ceilingFan" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ceilingFan" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 5 - FIXED -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Room Lighting *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="roomLighting" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="roomLighting" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="roomLighting" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="amenity-item">
                                    <label class="form-label fw-bold">Mattress Protector *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mattressProtector" value="good" required>
                                        <label class="form-check-label">Available and in good condition</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mattressProtector" value="fixing">
                                        <label class="form-check-label">Available but need fixing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mattressProtector" value="not-available">
                                        <label class="form-check-label">Not available</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GENERAL PRIVACY STATEMENT -->
                    <div class="form-section mb-5">
                        <div class="alert alert-light border">
                            <h6 class="fw-bold custom-blue-text">GENERAL PRIVACY STATEMENT</h6>
                            <p class="small mb-2">
                                The information collected in this form is to process your Check-In & Declaration application. The information is processed in accordance with the Personal Data Protection Act (PDPA) 2010. It is only disclosed to third parties with your consent or to meet statutory obligations.
                            </p>
                            <p class="small mb-0">
                                For more information, please refer to the University's Privacy Collection Notice at 
                                <a href="https://www.swinburne.edu.my/privacy/privacy-collection-notice" target="_blank">https://www.swinburne.edu.my/privacy/privacy-collection-notice</a>
                            </p>
                        </div>
                    </div>

                    <!-- STUDENT'S AGREEMENT & ACKNOWLEDGEMENT -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">STUDENT'S AGREEMENT & ACKNOWLEDGEMENT</h4>
                        
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Please use Fill & Sign</strong>
                        </div>

                        <div class="agreement-content mb-4">
                            <p class="mb-3">1. I have checked the conditions of amenities provided to me in the Student Village and I do hereby agree to pay for any damages or loss to the items listed above due to my negligence.</p>
                            
                            <p class="mb-3">2. I confirmed that all the information provided above is correct and I acknowledge having read, understood, and voluntarily agree to all the terms and conditions contained in this form and Swinburne Sarawak Student Village Residents Handbook (Guide and Rules of Occupancy) including any other documents, attachments, or other materials referred to it.</p>
                            
                            <p class="mb-0">3. I undertake to abide by the Swinburne Sarawak Student Village Resident Handbook (Guide and Rules of Occupancy)</p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="fullName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">IC No/Passport No *</label>
                                <input type="text" class="form-control" name="idNumber" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student Email *</label>
                                <input type="email" class="form-control" name="studentEmail" placeholder="e.g. 123456789@students.swinburne.edu.my" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" name="submissionDate" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="text-center">
                        <button type="submit" class="btn custom-blue-btn btn-lg px-5">Submit Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Confirmed Check-in Date Form Modal -->
<div class="modal fade" id="confirmedCheckinModal" tabindex="-1" aria-labelledby="confirmedCheckinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header custom-blue-bg text-white">
                <h2 class="modal-title fw-bold" id="confirmedCheckinModalLabel">My Check In Time and Date</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- University Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold custom-red-text">Swinburne University of Technology Sarawak</h4>
                    <p class="text-muted mb-3">
                        Please let us know at least 3 days in advance so that we can make prior arrangement for you.
                    </p>
                </div>

                <form id="confirmedCheckinForm">
                    <!-- Check-in Details Section -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">CHECK-IN DETAILS</h4>
                        
                        <div class="alert alert-info mb-4">
                            <strong>Note:</strong> Check-in time is during office hours: 8.30 am – 5.00 pm (Monday to Friday). We are closed on Saturday, Sunday and public holidays.
                        </div>

                        <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">My confirmed date of check in to Student Village is *</label>
                            <input type="date" class="form-control" name="checkinDate" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">My confirmed time of check in to Student Village is *</label>
                            <div class="row g-2">
                                <div class="col-5">
                                    <select class="form-select" name="checkinHour" required>
                                        <option value="">Hour</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select class="form-select" name="checkinMinute" required>
                                        <option value="">Minutes</option>
                                        <option value="00">00</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="45">45</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="checkinAmPm" required>
                                        <option value="">--</option>
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">PERSONAL INFORMATION</h4>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="fullName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Student Email/Personal Email *</label>
                                <input type="email" class="form-control" name="email" placeholder="example@example.com" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student ID *</label>
                                <input type="text" class="form-control" name="studentId" required>
                            </div>
                        </div>
                    </div>

                    <!-- Declaration Section -->
                    <div class="form-section mb-4">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">DECLARATION *</h4>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="confirmedCheckinDeclaration" name="declaration" required>
                            <label class="form-check-label" for="confirmedCheckinDeclaration">
                                I hereby declare that the information provided in this form is true and correct to the best of my knowledge. I understand that any false information may affect my check-in process.
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn custom-blue-btn btn-lg px-5">Submit Check-In Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Withdrawal Form Modal -->
<div class="modal fade" id="withdrawalFormModal" tabindex="-1" aria-labelledby="withdrawalFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header custom-blue-bg text-white">
                <h2 class="modal-title fw-bold" id="withdrawalFormModalLabel">Student Village Withdrawal Form</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- University Header -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-dark">Swinburne University of Technology Sarawak</h4>
                    <p class="text-muted mb-3">
                        PLEASE FILL IN THIS FORM IF YOU NO LONGER STAYING AT STUDENT VILLAGE. THIS FORM IS TO BE SUBMITTED WITH REFUND REQUEST AND BANK DETAILS DOCUMENTS.
                    </p>
                </div>

                <form id="withdrawalForm">
                    <!-- DOCUMENTS UPLOAD SECTION -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">REQUIRED DOCUMENTS</h4>
                        
                        <div class="alert alert-info mb-4">
                            <strong>Note:</strong> Firstly, kindly fill in the Refund Request Form available in the Finance Treasury servicedesk and save in PDF or Jpeg before upload.
                            <br><a href="https://servicedesk.swinburne.edu.my/app/fba_servicedesk/ui/requests/add" target="_blank" class="fw-semibold text-primary">https://servicedesk.swinburne.edu.my/app/fba_servicedesk/ui/requests/add</a>
                        </div>

                        <!-- Finance Refund Request Form -->
                        <div class="mb-4">
                            <label class="form-label">Finance Refund Request form *</label>
                            <div class="file-upload-area border rounded p-4 text-center">
                                <input type="file" class="file-input" name="refundRequestForm" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="upload-placeholder">
                                    <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                    <p class="mt-2 mb-1">Browse Files</p>
                                    <p class="text-muted small">Drag and drop files here</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Details -->
                        <div class="mb-4">
                            <label class="form-label">Bank Details screenshot/ copy of bank statement *</label>
                            <div class="file-upload-area border rounded p-4 text-center">
                                <input type="file" class="file-input" name="bankDetails" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="upload-placeholder">
                                    <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                    <p class="mt-2 mb-1">Browse Files</p>
                                    <p class="text-muted small">Drag and drop files here</p>
                                    <p class="text-muted small">(Receiver's Bank Details screenshot/copy of your bank statement/online banking webpage)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RESIDENT'S INFORMATION -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">RESIDENT'S INFORMATION</h4>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Given Name *</label>
                                <input type="text" class="form-control" name="givenName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Family Name/ Surname</label>
                                <input type="text" class="form-control" name="familyName">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student ID No. *</label>
                                <input type="text" class="form-control" name="studentId" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Student Email *</label>
                                <input type="email" class="form-control" name="studentEmail" placeholder="e.g. 123456789@students.swinburne.edu.my" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" class="form-control" name="mobileNumber" required>
                            </div>
                        </div>
                    </div>

                    <!-- NOTICE OF WITHDRAWAL FROM STUDENT VILLAGE -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">NOTICE OF WITHDRAWAL FROM STUDENT VILLAGE</h4>
                        
                        <div class="alert alert-warning mb-4">
                            <strong>REFERENCE TO YOUR BOOKING CONFIRMATION YOUR CHECK OUT DATE IS END OF YOUR TENURE.</strong>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Building *</label>
                                <select class="form-select" name="building" required>
                                    <option value="">Please Select</option>
                                    <option value="sv1">SV1</option>
                                    <option value="sv2">SV2</option>
                                    <option value="sv3">SV3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Room Number *</label>
                                <input type="text" class="form-control" name="roomNumber" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Your current room options</label>
                            <select class="form-select" name="currentRoom">
                                <option value="">Please Select</option>
                                <option value="standard-single">Standard Single</option>
                                <option value="standard-twin">Standard Twin</option>
                                <option value="standard-plus-single">Standard Plus Single</option>
                                <option value="standard-plus-twin">Standard Plus Twin</option>
                                <option value="premium-king">Premium King Single with A/C</option>
                            </select>
                        </div>

                        <!-- Withdrawal Reason Dropdown -->
                        <div class="mb-3">
                            <label class="form-label">My withdrawal reason *</label>
                            <select class="form-select" name="withdrawalReason" id="withdrawalReason" required>
                                <option value="">Please select a reason</option>
                                <option value="End of Tenure">End of Tenure</option>
                                <option value="Personal Reason">Personal Reason</option>
                                <option value="Complete study">Complete study</option>
                                <option value="Unaffordable price">Unaffordable price</option>
                                <option value="Unsatisfactory facilities and services">Unsatisfactory facilities and services</option>
                                <option value="Unsafe environment">Unsafe environment</option>
                                <option value="Friend's preference">Friend's preference (follow friend move out, unable to tolerate roommate)</option>
                                <option value="Unable to adapt to Student Village culture">Unable to adapt to Student Village culture</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Other Reason Textbox (initially hidden) -->
                        <div class="mb-3" id="otherReasonContainer" style="display: none;">
                            <label class="form-label">Please specify your reason *</label>
                            <textarea class="form-control" name="otherReason" id="otherReason" rows="3" placeholder="Please describe your reason for withdrawal..."></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">My Check Out Date *</label>
                                <input type="date" class="form-control" name="checkoutDate" required>
                            </div>
                        </div>

                        <!-- Account to Refund Checkboxes -->
                        <div class="mb-3">
                            <label class="form-label">Account to refund *</label>
                            <div class="refund-accounts">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="refundAccount" value="Your personal account" id="account1" required>
                                    <label class="form-check-label" for="account1">Your personal account</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="refundAccount" value="3rd party account" id="account2">
                                    <label class="form-check-label" for="account2">3rd party account</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="refundAccount" value="Contra off to Tuition Fees" id="account3">
                                    <label class="form-check-label" for="account3">Contra off to Tuition Fees</label>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Note:</strong> Please note that your check out time is 12noon.
                            <br><br>
                            Refund of the rental deposit will be subject to the Hostel's Terms & Conditions. The refund process may take up to 4 weeks starting from your current end of Tenure Period.
                        </div>
                    </div>

                    <!-- STUDENT'S DECLARATION -->
                    <div class="form-section mb-5">
                        <h4 class="section-title custom-blue-bg text-white p-3 rounded mb-4">STUDENT'S DECLARATION (Please use Fill & Sign)</h4>
                        
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Please use Fill & Sign</strong>
                        </div>

                        <div class="agreement-content mb-4">
                            <p class="mb-3">I affirm that the documents are complete and the information contained within this form is correct. The university shall not be responsible for any loss due to misinformation provided and incomplete documents.</p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Student signature *</label>
                                <input type="text" class="form-control" name="studentSignature" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date *</label>
                                <input type="date" class="form-control" name="declarationDate" required>
                            </div>
                        </div>
                    </div>

                    <!-- GENERAL PRIVACY STATEMENT -->
                    <div class="form-section mb-5">
                        <div class="alert alert-light border">
                            <h6 class="fw-bold custom-blue-text">GENERAL PRIVACY STATEMENT</h6>
                            <p class="small mb-2">
                                Swinburne University of Technology Sarawak Campus collects, uses and destroys personal data in accordance with our Privacy Collection Notice at 
                                <a href="https://www.swinburne.edu.my/privacy/privacy-collection-notice" target="_blank" class="text-primary">https://www.swinburne.edu.my/privacy/privacy-collection-notice</a>
                            </p>
                        </div>
                    </div>

                    <!-- ROOM CLEARANCE AFTER CHECK-OUT -->
                    <div class="form-section mb-4">
                        <div class="alert alert-light border">
                            <h6 class="fw-bold custom-blue-text">ROOM CLEARANCE AFTER CHECK-OUT (for office only)</h6>
                            <p class="small mb-2 text-muted">This section is for office use only after check-out procedure.</p>
                        </div>
                    </div>

                    <!-- Final Note -->
                    <div class="alert alert-warning text-center mb-4">
                        <strong>PLEASE PROCEED TO CLICK SUBMIT BUTTON</strong>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn custom-blue-btn btn-lg px-5">Submit Withdrawal Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

   <!-- Quick Booking Section -->
<section class="quick-booking py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Ready to Book Your Room?</h3>
                <p class="mb-0">Start your accommodation journey at Swinburne Student Village today.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-light btn-lg px-5" data-bs-toggle="modal" data-bs-target="#bookingModal">
                    Start Booking Process
                </button>
            </div>
        </div>
    </div>
</section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>About Us</h3>
                    <a href="#">Our Story</a>
                    <a href="#">Campus Life</a>
                    <a href="#">Sustainability</a>
                    <a href="#">Careers</a>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <a href="#">Student Portal</a>
                    <a href="#">Academic Calendar</a>
                    <a href="#">Library</a>
                    <a href="#">Support Services</a>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <a href="#">+60 82 415 353</a>
                    <a href="#">studentvillage@swinburne.edu.my</a>
                    <a href="#">Visit Us</a>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                &copy; 2024 Swinburne University of Technology Sarawak Campus. All rights reserved.
            </div>
        </div>
    </footer>

    
      <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript Files -->
    <!-- <script src="script/booking-display.js"></script>
    <script src="script/booking-form.js"></script>
    <script src="script/checkin-form.js"></script>
    <script src="script/confirmed-checkin.js"></script>
    <script src="script/withdrawal-form.js"></script> -->
<script>

    //booking-display//
    // Room type navigation functionality
class BookingDisplay {
    constructor() {
        this.currentRoom = 'standard-single';
        this.init();
    }

    init() {
        this.setupRoomNavigation();
        this.setupSmoothScrolling();
    }

    setupRoomNavigation() {
        const roomButtons = document.querySelectorAll('.room-type-nav .btn');
        
        roomButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const roomType = e.target.getAttribute('data-room');
                this.switchRoom(roomType, e.target);
            });
        });
    }

    switchRoom(roomType, button) {
        // Update active button
        document.querySelectorAll('.room-type-nav .btn').forEach(btn => {
            btn.classList.remove('active');
        });
        button.classList.add('active');

        // Hide all room info
        document.querySelectorAll('.room-info').forEach(room => {
            room.classList.remove('active');
        });

        // Show selected room info
        const selectedRoom = document.getElementById(roomType);
        if (selectedRoom) {
            selectedRoom.classList.add('active');
            
          
        }

        this.currentRoom = roomType;
    }

    setupSmoothScrolling() {
        // Smooth scroll for internal links (kept for other navigation)
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

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    const bookingDisplay = new BookingDisplay();
    
    // Add loading state management
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.classList.contains('btn-primary') || this.classList.contains('btn-light')) {
                this.classList.add('loading');
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 2000);
            }
        });
    });
});







    // Booking Form Functionality //
document.addEventListener('DOMContentLoaded', function() {
    console.log('Booking form script loaded');
    
    const bookingModal = document.getElementById('bookingModal');
    const bookingForm = document.getElementById('bookingForm');
    
    if (!bookingForm) {
        console.error('Booking form not found!');
        return;
    }

    console.log('Booking form found');

    // Test if Bootstrap is available
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap is not loaded!');
        return;
    }
    console.log('Bootstrap is available');

    // Room type selection
    const roomTypeSelect = document.querySelector('select[name="roomType"]');
    
    function setupRoomBookingButtons() {
        const bookButtons = document.querySelectorAll('.book-room-btn');
        
        bookButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Book button clicked');
                const roomInfo = this.closest('.room-info');
                const roomTitle = roomInfo.querySelector('h3.fw-bold').textContent.trim();
                
                if (roomTypeSelect) {
                    roomTypeSelect.disabled = false;
                    roomTypeSelect.style.backgroundColor = '';
                    
                    const options = roomTypeSelect.options;
                    let optionFound = false;
                    
                    // Normalize room titles for better matching
                    const normalizedRoomTitle = roomTitle.toLowerCase()
                        .replace('singe', 'single')
                        .replace('with a/c', '')
                        .replace('with ac', '')
                        .trim();
                    
                    // Try exact match first
                    for (let i = 0; i < options.length; i++) {
                        const optionText = options[i].text.toLowerCase();
                        if (optionText.includes(normalizedRoomTitle) || 
                            normalizedRoomTitle.includes(optionText)) {
                            roomTypeSelect.selectedIndex = i;
                            optionFound = true;
                            console.log('Matched option:', options[i].text);
                            break;
                        }
                    }
                    
                    // Try keyword matching if exact match fails
                    if (!optionFound) {
                        const keywordMap = {
                            'standard single': 'Standard Single',
                            'standard twin': 'Standard Twin',
                            'standard plus single': 'Standard Plus Single', 
                            'standard plus twin': 'Standard Plus Twin',
                            'premium king': 'Premium King Single'
                        };
                        
                        for (const [keyword, optionValue] of Object.entries(keywordMap)) {
                            if (normalizedRoomTitle.includes(keyword)) {
                                for (let i = 0; i < options.length; i++) {
                                    if (options[i].text.toLowerCase().includes(optionValue.toLowerCase())) {
                                        roomTypeSelect.selectedIndex = i;
                                        optionFound = true;
                                        console.log('Matched via keyword:', options[i].text);
                                        break;
                                    }
                                }
                                if (optionFound) break;
                            }
                        }
                    }
                    
                    roomTypeSelect.disabled = true;
                    roomTypeSelect.style.backgroundColor = '#f8f9fa';
                    
                    if (!optionFound) {
                        console.warn('No matching option found for:', roomTitle);
                    }
                }
            });
        });
    }

    setupRoomBookingButtons();

    // Visa section visibility
    const malaysianStudent = document.querySelector('select[name="malaysianStudent"]');
    const visaSection = document.getElementById('visaSection');
    
    if (malaysianStudent && visaSection) {
        malaysianStudent.addEventListener('change', function() {
            visaSection.style.display = this.value === 'no' ? 'block' : 'none';
        });
    }

    // Medical details visibility
    const medicalCondition = document.querySelector('select[name="medicalCondition"]');
    const medicalDetails = document.getElementById('medicalDetails');
    
    if (medicalCondition && medicalDetails) {
        medicalCondition.addEventListener('change', function() {
            const medicalTextarea = medicalDetails.querySelector('textarea[name="medicalDetails"]');
            if (this.value === 'yes') {
                medicalDetails.style.display = 'block';
                if (medicalTextarea) medicalTextarea.required = true;
            } else {
                medicalDetails.style.display = 'none';
                if (medicalTextarea) medicalTextarea.required = false;
            }
        });
    }

    // BP40 upload visibility
    const bp40StudentSelect = bookingForm.querySelector('select[name="bp40Student"]');
    const bp40Upload = document.getElementById('bp40Upload');
    
    if (bp40StudentSelect && bp40Upload) {
        bp40StudentSelect.addEventListener('change', function() {
            bp40Upload.style.display = this.value === 'yes' ? 'block' : 'none';
        });
    }

    // File upload handling
    function initializeFileUploads() {
        const fileInputs = document.querySelectorAll('#bookingModal .file-input');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const placeholder = this.closest('.file-upload-area').querySelector('.upload-placeholder');
                if (this.files.length > 0) {
                    placeholder.innerHTML = `
                        <i class="bi bi-check-circle text-success display-4"></i>
                        <p class="mt-2 mb-1 text-success">File Selected</p>
                        <p class="text-muted small">${this.files[0].name}</p>
                    `;
                }
            });
        });

        const fileAreas = document.querySelectorAll('#bookingModal .file-upload-area');
        fileAreas.forEach(area => {
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#3498db';
                this.style.background = '#f0f8ff';
            });

            area.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.background = '#f8f9fa';
            });

            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.background = '#f8f9fa';
                
                const input = this.querySelector('.file-input');
                if (input && e.dataTransfer.files.length > 0) {
                    input.files = e.dataTransfer.files;
                    const event = new Event('change', { bubbles: true });
                    input.dispatchEvent(event);
                }
            });

            area.addEventListener('click', function() {
                const input = this.querySelector('.file-input');
                if (input) input.click();
            });
        });
    }

    // Show success toast function
    function showSuccessToast() {
        console.log('Attempting to show toast...');
        
        // Remove any existing toasts first
        const existingToasts = document.querySelectorAll('.success-toast');
        existingToasts.forEach(toast => toast.remove());
        
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
            console.log('Toast container created');
        }
        
        // Create toast
        const toast = document.createElement('div');
        toast.className = 'toast success-toast align-items-center text-bg-success border-0';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Booking application submitted successfully!<br>
                    <small>We will contact you shortly with confirmation.</small>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        console.log('Toast element created and appended');
        
        try {
            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast, { 
                delay: 5000,
                autohide: true
            });
            
            bsToast.show();
            console.log('Toast shown successfully');
            
            // Remove toast from DOM after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
                console.log('Toast removed from DOM');
            });
        } catch (error) {
            console.error('Error showing toast:', error);
            // Fallback: manually show the toast with basic styling
            toast.style.display = 'block';
            toast.style.opacity = '1';
        }
    }

    // Form submission handling
    function initializeFormSubmission() {
        console.log('Initializing form submission');

        bookingForm.addEventListener('submit', function(e) {
            console.log('Form submission triggered');
            
            e.preventDefault();
            e.stopPropagation();
            
            if (!this.checkValidity()) {
                console.log('Form validation failed');
                this.classList.add('was-validated');
                const firstInvalid = this.querySelector(':invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                return;
            }

            console.log('Form validation passed');

            const submitBtn = this.querySelector('button[type="submit"]');
            if (!submitBtn) {
                console.error('Submit button not found');
                return;
            }

            const originalText = submitBtn.innerHTML;
            const originalState = submitBtn.disabled;

            // Show loading state
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Submitting...
            `;
            submitBtn.disabled = true;

            console.log('Submitting form...');

            // Simulate form processing (2 seconds)
            setTimeout(() => {
                console.log('Form simulated submit complete, showing toast');
                
                // Show success toast
                showSuccessToast();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = originalState;

                // Close modal and reset form after a short delay
                setTimeout(() => {
                    if (bookingModal) {
                        const modal = bootstrap.Modal.getInstance(bookingModal);
                        if (modal) modal.hide();
                    }

                    bookingForm.reset();
                    bookingForm.classList.remove('was-validated');

                    // Reset file upload placeholders
                    document.querySelectorAll('#bookingModal .upload-placeholder').forEach(placeholder => {
                        placeholder.innerHTML = `
                            <i class="bi bi-cloud-upload display-4 text-muted"></i>
                            <p class="mt-2 mb-1">Browse Files</p>
                            <p class="text-muted small">Drag and drop files here</p>
                        `;
                    });

                    // Reset dynamic sections
                    if (roomTypeSelect) {
                        roomTypeSelect.disabled = false;
                        roomTypeSelect.style.backgroundColor = '';
                    }
                    if (visaSection) visaSection.style.display = 'none';
                    if (medicalDetails) medicalDetails.style.display = 'none';
                    if (bp40Upload) bp40Upload.style.display = 'none';

                    console.log('Form reset complete');
                }, 1000); // Wait 1 second before closing modal
                
            }, 2000); // Simulate 2 second submission process
        });
    }

    // Reset when modal closed
    function initializeModalReset() {
        if (bookingModal) {
            bookingModal.addEventListener('hidden.bs.modal', function () {
                console.log('Modal closed, resetting form');
                
                if (bookingForm) {
                    bookingForm.reset();
                    bookingForm.classList.remove('was-validated');
                }

                if (roomTypeSelect) {
                    roomTypeSelect.disabled = false;
                    roomTypeSelect.style.backgroundColor = '';
                }

                document.querySelectorAll('#bookingModal .upload-placeholder').forEach(placeholder => {
                    placeholder.innerHTML = `
                        <i class="bi bi-cloud-upload display-4 text-muted"></i>
                        <p class="mt-2 mb-1">Browse Files</p>
                        <p class="text-muted small">Drag and drop files here</p>
                    `;
                });

                if (visaSection) visaSection.style.display = 'none';
                if (medicalDetails) medicalDetails.style.display = 'none';
                if (bp40Upload) bp40Upload.style.display = 'none';
            });
        }
    }


    
    // Initialize all functionality
    initializeFileUploads();
    initializeFormSubmission();
    initializeModalReset();
    
    console.log('Booking form initialization complete');
});

//checkin-form//
// Check-in Form Functionality - FIXED VERSION
document.addEventListener('DOMContentLoaded', function() {
    console.log('Check-in form script loaded');
    
    const checkinFormModal = document.getElementById('checkinFormModal');
    const checkinForm = document.getElementById('checkinForm');
    
    if (!checkinForm || !checkinFormModal) {
        console.log('Check-in form not found - this is normal if modal not open');
        return;
    }

    console.log('Check-in form found');

    // Function to reset form styles and remove grey backgrounds
    function resetFormStyles() {
        console.log('Resetting form styles...');
        
        if (checkinForm) {
            checkinForm.classList.remove('was-validated');
            
            // Reset all input backgrounds and colors
            const inputs = checkinForm.querySelectorAll('.form-control, .form-select, .form-check-input');
            inputs.forEach(input => {
                input.style.backgroundColor = 'white';
                input.style.color = '#212529';
                input.style.borderColor = '';
            });
            
            // Reset file upload areas
            const fileAreas = checkinForm.querySelectorAll('.file-upload-area');
            fileAreas.forEach(area => {
                area.style.backgroundColor = '#f8f9fa';
                area.style.borderColor = '';
            });
        }
    }

    // Use unique function names to avoid conflicts
    function showCheckinSuccessToast() {
        console.log('Showing check-in toast...');
        
        try {
            // Remove any existing toasts first
            const existingToasts = document.querySelectorAll('.checkin-success-toast');
            existingToasts.forEach(toast => toast.remove());
            
            // Create toast container if it doesn't exist
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                toastContainer.style.zIndex = '9999';
                document.body.appendChild(toastContainer);
            }
            
            // Create toast with unique class
            const toast = document.createElement('div');
            toast.className = 'toast checkin-success-toast align-items-center text-bg-success border-0';
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body fw-semibold">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Check-in form submitted successfully!<br>
                        <small>Your check-in has been processed successfully.</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            
            if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
                const bsToast = new bootstrap.Toast(toast, { 
                    delay: 5000,
                    autohide: true
                });
                bsToast.show();
            }
            
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
            });
            
        } catch (error) {
            console.error('Check-in toast error:', error);
        }
    }

    // Custom validation for radio buttons
    function validateRadioButtons() {
        const requiredRadios = [
            'divanBed', 'wardrobe', 'bedsideCabinet', 'studyTable', 
            'blindCurtain', 'wallCabinet', 'accessCard', 'ceilingFan', 
            'roomLighting', 'mattressProtector'
        ];
        
        let allRadiosSelected = true;
        
        requiredRadios.forEach(radioName => {
            const radioGroup = checkinForm.querySelectorAll(`input[name="${radioName}"]:checked`);
            if (radioGroup.length === 0) {
                allRadiosSelected = false;
                // Highlight the section that needs attention
                const amenityItem = checkinForm.querySelector(`input[name="${radioName}"]`).closest('.amenity-item');
                if (amenityItem) {
                    amenityItem.style.border = '2px solid #e74c3c';
                    amenityItem.style.background = '#fff5f5';
                }
            }
        });
        
        return allRadiosSelected;
    }

    // Remove highlights when radio is selected
    function initializeRadioValidation() {
        const radioButtons = checkinForm.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                const amenityItem = this.closest('.amenity-item');
                // Remove highlight when a selection is made
                if (amenityItem) {
                    amenityItem.style.border = '';
                    amenityItem.style.background = '';
                }
                
                // Also reset the individual radio button styles
                this.style.backgroundColor = 'white';
                this.style.color = '#212529';
            });
        });
    }

    // Form submission handling
    function initializeFormSubmission() {
        console.log('Initializing check-in form submission');

        checkinForm.addEventListener('submit', function(e) {
            console.log('Check-in form submission triggered');
            
            e.preventDefault();
            e.stopPropagation();
            
            const allRadiosSelected = validateRadioButtons();
            
            if (!this.checkValidity() || !allRadiosSelected) {
                console.log('Form validation failed');
                this.classList.add('was-validated');
                
                // Apply style fixes even when validation fails
                resetFormStyles();
                this.classList.add('was-validated'); // Re-add for validation display
                
                if (!allRadiosSelected) {
                    // Scroll to first invalid amenity item
                    const firstInvalidAmenity = checkinForm.querySelector('.amenity-item[style*="border: 2px solid rgb(231, 76, 60)"]');
                    if (firstInvalidAmenity) {
                        firstInvalidAmenity.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    const firstInvalid = this.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                }
                return;
            }

            console.log('Form validation passed');

            const submitBtn = this.querySelector('button[type="submit"]');
            if (!submitBtn) {
                console.error('Submit button not found');
                return;
            }

            const originalText = submitBtn.innerHTML;
            const originalState = submitBtn.disabled;

            // Show loading state
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Submitting...
            `;
            submitBtn.disabled = true;

            console.log('Submitting check-in form...');

            // Simulate form processing (2 seconds)
            setTimeout(() => {
                console.log('Check-in form simulated submit complete, showing toast');
                
                // Show success toast
                showCheckinSuccessToast();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = originalState;

                // Close modal and reset form after a short delay
                setTimeout(() => {
                    if (checkinFormModal) {
                        const modalInstance = bootstrap.Modal.getInstance(checkinFormModal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }

                    checkinForm.reset();
                    resetFormStyles(); // Use our reset function instead

                    // Reset amenity item highlights
                    checkinForm.querySelectorAll('.amenity-item').forEach(item => {
                        item.style.border = '';
                        item.style.background = '';
                    });

                    console.log('Check-in form reset complete');
                }, 1000);
                
            }, 2000);
        });
    }

    // Reset when modal closed
    function initializeModalReset() {
        if (checkinFormModal) {
            checkinFormModal.addEventListener('hidden.bs.modal', function () {
                console.log('Check-in modal closed, resetting form');
                
                if (checkinForm) {
                    checkinForm.reset();
                    resetFormStyles(); // Use our reset function
                }

                // Reset amenity item highlights
                const amenityItems = checkinForm?.querySelectorAll('.amenity-item');
                if (amenityItems) {
                    amenityItems.forEach(item => {
                        item.style.border = '';
                        item.style.background = '';
                    });
                }
            });
        }
    }

    // Also reset styles when modal opens (in case it was left in a bad state)
    function initializeModalOpenReset() {
        if (checkinFormModal) {
            checkinFormModal.addEventListener('show.bs.modal', function () {
                console.log('Check-in modal opening, ensuring clean state');
                setTimeout(() => {
                    resetFormStyles();
                }, 100);
            });
        }
    }

    // Only initialize if the form exists in DOM
    if (checkinForm && checkinFormModal) {
        initializeRadioValidation();
        initializeFormSubmission();
        initializeModalReset();
        initializeModalOpenReset();
        console.log('Check-in form initialization complete');
    }
});

// Global form reset function for both booking and check-in forms
function resetAllFormStyles() {
    const forms = document.querySelectorAll('#bookingForm, #checkinForm');
    forms.forEach(form => {
        form.classList.remove('was-validated');
        
        // Reset all input backgrounds
        const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
        inputs.forEach(input => {
            input.style.backgroundColor = 'white';
            input.style.color = '#212529';
            input.style.borderColor = '';
        });
        
        // Reset file upload areas
        const fileAreas = form.querySelectorAll('.file-upload-area');
        fileAreas.forEach(area => {
            area.style.backgroundColor = '#f8f9fa';
            area.style.borderColor = '';
        });
    });
}

// Call this when any modal is closed
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('#bookingModal, #checkinFormModal');
    modals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            resetAllFormStyles();
        });
        
        // Also reset when modal opens
        modal.addEventListener('show.bs.modal', function() {
            setTimeout(() => {
                resetAllFormStyles();
            }, 100);
        });
    });
});

//confirmed-checkin form//
// Confirmed Check-In Form Functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Confirmed check-in form script loaded');
    
    const confirmedCheckinModal = document.getElementById('confirmedCheckinModal');
    const confirmedCheckinForm = document.getElementById('confirmedCheckinForm');
    
    if (!confirmedCheckinForm) {
        console.error('Confirmed check-in form not found!');
        return;
    }

    console.log('Confirmed check-in form found');

    // Show success toast function for confirmed check-in form
    function showConfirmedCheckinSuccessToast() {
        console.log('Attempting to show confirmed check-in toast...');
        
        // Remove any existing toasts first
        const existingToasts = document.querySelectorAll('.success-toast');
        existingToasts.forEach(toast => toast.remove());
        
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
            console.log('Toast container created');
        }
        
        // Create toast
        const toast = document.createElement('div');
        toast.className = 'toast success-toast align-items-center text-bg-success border-0';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Check-in details submitted successfully!<br>
                    <small>We look forward to welcoming you to Student Village.</small>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        console.log('Confirmed check-in toast element created and appended');
        
        try {
            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast, { 
                delay: 5000,
                autohide: true
            });
            
            bsToast.show();
            console.log('Confirmed check-in toast shown successfully');
            
            // Remove toast from DOM after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
                console.log('Confirmed check-in toast removed from DOM');
            });
        } catch (error) {
            console.error('Error showing confirmed check-in toast:', error);
            // Fallback: manually show the toast with basic styling
            toast.style.display = 'block';
            toast.style.opacity = '1';
        }
    }

    // Form submission handling for confirmed check-in form
    function initializeConfirmedCheckinFormSubmission() {
        console.log('Initializing confirmed check-in form submission');

        confirmedCheckinForm.addEventListener('submit', function(e) {
            console.log('Confirmed check-in form submission triggered');
            
            e.preventDefault();
            e.stopPropagation();
            
            if (!this.checkValidity()) {
                console.log('Confirmed check-in form validation failed');
                this.classList.add('was-validated');
                const firstInvalid = this.querySelector(':invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                return;
            }

            console.log('Confirmed check-in form validation passed');

            const submitBtn = this.querySelector('button[type="submit"]');
            if (!submitBtn) {
                console.error('Confirmed check-in submit button not found');
                return;
            }

            const originalText = submitBtn.innerHTML;
            const originalState = submitBtn.disabled;

            // Show loading state
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Submitting...
            `;
            submitBtn.disabled = true;

            console.log('Submitting confirmed check-in form...');

            // Simulate form processing (2 seconds)
            setTimeout(() => {
                console.log('Confirmed check-in form simulated submit complete, showing toast');
                
                // Show success toast
                showConfirmedCheckinSuccessToast();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = originalState;

                // Close modal and reset form after a short delay
                setTimeout(() => {
                    if (confirmedCheckinModal) {
                        const modal = bootstrap.Modal.getInstance(confirmedCheckinModal);
                        if (modal) modal.hide();
                    }

                    confirmedCheckinForm.reset();
                    confirmedCheckinForm.classList.remove('was-validated');

                    console.log('Confirmed check-in form reset complete');
                }, 1000); // Wait 1 second before closing modal
                
            }, 2000); // Simulate 2 second submission process
        });
    }

    // Reset when modal closed
    function initializeConfirmedCheckinModalReset() {
        if (confirmedCheckinModal) {
            confirmedCheckinModal.addEventListener('hidden.bs.modal', function () {
                console.log('Confirmed check-in modal closed, resetting form');
                
                if (confirmedCheckinForm) {
                    confirmedCheckinForm.reset();
                    confirmedCheckinForm.classList.remove('was-validated');
                }
            });
        }
    }

    // Initialize all functionality
    initializeConfirmedCheckinFormSubmission();
    initializeConfirmedCheckinModalReset();
    
    console.log('Confirmed check-in form initialization complete');
});

//withdrawal-form//
// Withdrawal Form Functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Withdrawal form script loaded');
    
    // Wait a bit to ensure DOM is fully ready
    setTimeout(initializeWithdrawalForm, 100);
});

function initializeWithdrawalForm() {
    const withdrawalModal = document.getElementById('withdrawalFormModal');
    const withdrawalForm = document.getElementById('withdrawalForm');
    
    console.log('Looking for withdrawal form...');
    console.log('Withdrawal modal found:', !!withdrawalModal);
    console.log('Withdrawal form found:', !!withdrawalForm);
    
    if (!withdrawalForm) {
        console.error('Withdrawal form not found!');
        console.log('Available forms:', document.querySelectorAll('form').length);
        return;
    }

    console.log('Withdrawal form elements:', withdrawalForm.elements.length);

    // File upload handling
    function initializeFileUploads() {
        console.log('Initializing file uploads...');
        const fileInputs = document.querySelectorAll('#withdrawalFormModal .file-input');
        console.log('File inputs found:', fileInputs.length);
        
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const placeholder = this.closest('.file-upload-area').querySelector('.upload-placeholder');
                if (this.files.length > 0) {
                    placeholder.innerHTML = `
                        <i class="bi bi-check-circle text-success display-4"></i>
                        <p class="mt-2 mb-1 text-success">File Selected</p>
                        <p class="text-muted small">${this.files[0].name}</p>
                    `;
                }
            });
        });

        const fileAreas = document.querySelectorAll('#withdrawalFormModal .file-upload-area');
        fileAreas.forEach(area => {
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#3498db';
                this.style.background = '#f0f8ff';
            });

            area.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.background = '#f8f9fa';
            });

            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.background = '#f8f9fa';
                
                const input = this.querySelector('.file-input');
                if (input && e.dataTransfer.files.length > 0) {
                    input.files = e.dataTransfer.files;
                    const event = new Event('change', { bubbles: true });
                    input.dispatchEvent(event);
                }
            });

            area.addEventListener('click', function() {
                const input = this.querySelector('.file-input');
                if (input) input.click();
            });
        });
    }

    // Handle withdrawal reason dropdown change
    function initializeWithdrawalReason() {
        console.log('Initializing withdrawal reason...');
        const withdrawalReasonSelect = document.getElementById('withdrawalReason');
        const otherReasonContainer = document.getElementById('otherReasonContainer');
        const otherReasonTextarea = document.getElementById('otherReason');

        console.log('Withdrawal reason select found:', !!withdrawalReasonSelect);
        console.log('Other reason container found:', !!otherReasonContainer);
        console.log('Other reason textarea found:', !!otherReasonTextarea);

        if (withdrawalReasonSelect && otherReasonContainer && otherReasonTextarea) {
            withdrawalReasonSelect.addEventListener('change', function() {
                console.log('Withdrawal reason changed to:', this.value);
                if (this.value === 'Other') {
                    otherReasonContainer.style.display = 'block';
                    otherReasonTextarea.required = true;
                } else {
                    otherReasonContainer.style.display = 'none';
                    otherReasonTextarea.required = false;
                    otherReasonTextarea.value = ''; // Clear the textarea
                }
            });
        }
    }

    // Show success toast function
    function showSuccessToast() {
        console.log('Attempting to show withdrawal toast...');
        
        // Remove any existing toasts first
        const existingToasts = document.querySelectorAll('.success-toast');
        existingToasts.forEach(toast => toast.remove());
        
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
            console.log('Toast container created');
        }
        
        // Create toast
        const toast = document.createElement('div');
        toast.className = 'toast success-toast align-items-center text-bg-success border-0';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Withdrawal form submitted successfully!<br>
                    <small>We will process your withdrawal request shortly.</small>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        console.log('Withdrawal toast element created and appended');
        
        try {
            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast, { 
                delay: 5000,
                autohide: true
            });
            
            bsToast.show();
            console.log('Withdrawal toast shown successfully');
            
            // Remove toast from DOM after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
                console.log('Withdrawal toast removed from DOM');
            });
        } catch (error) {
            console.error('Error showing withdrawal toast:', error);
            // Fallback: manually show the toast with basic styling
            toast.style.display = 'block';
            toast.style.opacity = '1';
        }
    }

    // Form submission handling
    function initializeFormSubmission() {
        console.log('Initializing withdrawal form submission...');

        // Check if event listener is already attached
        if (withdrawalForm._submitListenerAttached) {
            console.log('Submit listener already attached, skipping...');
            return;
        }

        withdrawalForm.addEventListener('submit', function(e) {
            console.log('=== WITHDRAWAL FORM SUBMIT EVENT TRIGGERED ===');
            console.log('Form validity:', this.checkValidity());
            console.log('Form elements:', this.elements.length);
            
            e.preventDefault();
            e.stopPropagation();
            
            // Check form validity
            if (!this.checkValidity()) {
                console.log('Withdrawal form validation failed');
                console.log('Invalid fields:', this.querySelectorAll(':invalid').length);
                
                this.classList.add('was-validated');
                
                // Find first invalid field and scroll to it
                const firstInvalid = this.querySelector(':invalid');
                if (firstInvalid) {
                    console.log('First invalid field:', firstInvalid.name);
                    firstInvalid.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    firstInvalid.focus();
                }
                return;
            }

            console.log('Withdrawal form validation passed');

            const submitBtn = this.querySelector('button[type="submit"]');
            if (!submitBtn) {
                console.error('Withdrawal submit button not found');
                return;
            }

            const originalText = submitBtn.innerHTML;
            const originalState = submitBtn.disabled;

            // Show loading state
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                Submitting...
            `;
            submitBtn.disabled = true;

            console.log('Submitting withdrawal form...');

            // Simulate form processing (2 seconds)
            setTimeout(() => {
                console.log('Withdrawal form simulated submit complete, showing toast');
                
                // Show success toast
                showSuccessToast();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = originalState;

                // Close modal and reset form after a short delay
                setTimeout(() => {
                    if (withdrawalModal) {
                        const modal = bootstrap.Modal.getInstance(withdrawalModal);
                        if (modal) {
                            modal.hide();
                            console.log('Withdrawal modal closed');
                        } else {
                            console.log('Bootstrap modal instance not found');
                        }
                    }

                    // Reset form
                    withdrawalForm.reset();
                    withdrawalForm.classList.remove('was-validated');

                    // Hide other reason container
                    const otherReasonContainer = document.getElementById('otherReasonContainer');
                    if (otherReasonContainer) {
                        otherReasonContainer.style.display = 'none';
                    }

                    // Reset file upload placeholders
                    document.querySelectorAll('#withdrawalFormModal .upload-placeholder').forEach(placeholder => {
                        placeholder.innerHTML = `
                            <i class="bi bi-cloud-upload display-4 text-muted"></i>
                            <p class="mt-2 mb-1">Browse Files</p>
                            <p class="text-muted small">Drag and drop files here</p>
                        `;
                    });

                    console.log('Withdrawal form reset complete');
                }, 1000); // Wait 1 second before closing modal
                
            }, 2000); // Simulate 2 second submission process
        });

        // Mark as attached to prevent duplicates
        withdrawalForm._submitListenerAttached = true;
        console.log('Submit listener attached successfully');
    }

    // Reset when modal closed
    function initializeModalReset() {
        if (withdrawalModal) {
            withdrawalModal.addEventListener('hidden.bs.modal', function () {
                console.log('Withdrawal modal closed, resetting form');
                
                if (withdrawalForm) {
                    withdrawalForm.reset();
                    withdrawalForm.classList.remove('was-validated');
                }

                // Hide other reason container
                const otherReasonContainer = document.getElementById('otherReasonContainer');
                if (otherReasonContainer) {
                    otherReasonContainer.style.display = 'none';
                }

                // Reset file upload placeholders
                document.querySelectorAll('#withdrawalFormModal .upload-placeholder').forEach(placeholder => {
                    placeholder.innerHTML = `
                        <i class="bi bi-cloud-upload display-4 text-muted"></i>
                        <p class="mt-2 mb-1">Browse Files</p>
                        <p class="text-muted small">Drag and drop files here</p>
                    `;
                });
            });
        }
    }

    // Initialize all functionality
    try {
        initializeFileUploads();
        initializeWithdrawalReason();
        initializeFormSubmission();
        initializeModalReset();
        
        console.log('Withdrawal form initialization complete');
    } catch (error) {
        console.error('Error initializing withdrawal form:', error);
    }
}
</script>

   

    
    
</body>
</html>