<?php
session_start();

// JSON-based Slider Manager with Image Upload
class SliderManager {
    private $dataFile = 'slider_data.json';
    private $uploadDir = 'uploads/slider/';
    
    public function __construct() {
        // Create data file if it doesn't exist
        if (!file_exists($this->dataFile)) {
            $this->saveData([]);
        }
        
        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }
    
    private function loadData() {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        $json = file_get_contents($this->dataFile);
        return json_decode($json, true) ?: [];
    }
    
    private function saveData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    
    public function getAllSlides() {
        return $this->loadData();
    }
    
    public function getActiveSlides() {
        $data = $this->loadData();
        return array_filter($data, function($slide) {
            return $slide['is_active'];
        });
    }
    
    public function uploadImage($file) {
        $targetFile = $this->uploadDir . uniqid() . '_' . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if image file is an actual image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new Exception("File is not an image.");
        }
        
        // Check file size (5MB max)
        if ($file["size"] > 5000000) {
            throw new Exception("Sorry, your file is too large.");
        }
        
        // Allow certain file formats
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        // Upload file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }
    }
    
    public function addSlide($image_file, $alt_text, $is_active = true) {
        $data = $this->loadData();
        $newId = count($data) > 0 ? max(array_keys($data)) + 1 : 1;
        
        // Upload image
        $image_path = $this->uploadImage($image_file);
        
        $data[$newId] = [
            'id' => $newId,
            'image_path' => $image_path,
            'alt_text' => $alt_text,
            'is_active' => $is_active,
            'display_order' => count($data) + 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->saveData($data);
        return $newId;
    }
    
    public function updateSlide($id, $image_file, $alt_text, $is_active) {
        $data = $this->loadData();
        if (isset($data[$id])) {
            // If new image is uploaded
            if ($image_file && $image_file['error'] == 0) {
                // Delete old image
                if (file_exists($data[$id]['image_path'])) {
                    unlink($data[$id]['image_path']);
                }
                // Upload new image
                $data[$id]['image_path'] = $this->uploadImage($image_file);
            }
            
            $data[$id]['alt_text'] = $alt_text;
            $data[$id]['is_active'] = $is_active;
            $data[$id]['updated_at'] = date('Y-m-d H:i:s');
            $this->saveData($data);
            return true;
        }
        return false;
    }
    
    public function deleteSlide($id) {
        $data = $this->loadData();
        if (isset($data[$id])) {
            // Delete image file
            if (file_exists($data[$id]['image_path'])) {
                unlink($data[$id]['image_path']);
            }
            unset($data[$id]);
            $this->saveData($data);
            return true;
        }
        return false;
    }
    
    public function getUploadedImages() {
        $images = [];
        if (is_dir($this->uploadDir)) {
            $files = glob($this->uploadDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            foreach ($files as $file) {
                $images[] = $file;
            }
        }
        return $images;
    }
}

// Initialize slider manager
$sliderManager = new SliderManager();

// Handle form actions
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['add_slide'])) {
            $alt_text = trim($_POST['alt_text']);
            $is_active = isset($_POST['is_active']) ? true : false;
            
            if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] != 0) {
                throw new Exception("Please select an image to upload.");
            }
            
            if ($sliderManager->addSlide($_FILES['image_file'], $alt_text, $is_active)) {
                $message = "Slide added successfully!";
            } else {
                throw new Exception("Error adding slide!");
            }
        } elseif (isset($_POST['update_slide'])) {
            $id = $_POST['id'];
            $alt_text = trim($_POST['alt_text']);
            $is_active = isset($_POST['is_active']) ? true : false;
            $image_file = isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0 ? $_FILES['image_file'] : null;
            
            if ($sliderManager->updateSlide($id, $image_file, $alt_text, $is_active)) {
                $message = "Slide updated successfully!";
            } else {
                throw new Exception("Error updating slide!");
            }
        } elseif (isset($_POST['delete_slide'])) {
            $id = $_POST['id'];
            
            if ($sliderManager->deleteSlide($id)) {
                $message = "Slide deleted successfully!";
            } else {
                throw new Exception("Error deleting slide!");
            }
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}

// Get all slides
$slides = $sliderManager->getAllSlides();
$active_slides = $sliderManager->getActiveSlides();
$uploaded_images = $sliderManager->getUploadedImages();

// Check if user is admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_manage_board.php");
    exit;
}

$username = explode('@', $_SESSION['user'])[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Image Management</title>
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

        
        /* User Menu Styles */
        .user-menu {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            text-decoration: none;
            color: var(--dark);
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            padding: 10px 0;
            min-width: 180px;
            z-index: 1000;
        }

        .user-dropdown a {
            display: block;
            padding: 10px 20px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .user-dropdown a:hover {
            background: rgba(52, 152, 219, 0.1);
            color: var(--primary);
        }

        .dropdown-divider {
            height: 1px;
            background: #e9ecef;
            margin: 5px 0;
        }

        .logout-btn {
            color: var(--danger) !important;
            font-weight: 600;
        }

        .user-menu:hover .user-dropdown {
            display: block;
        }
        
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            line-height: 1.2;
            color: var(--primary-dark);
            font-weight: 700;
            margin-top: 80px;
            padding-top: 40px;
            padding-bottom: 30px;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-red), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .message {
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .card-header {
            padding: 15px 20px;
            background: var(--light);
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
        }
        
        .checkbox-group input {
            margin-right: 10px;
        }
        
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
        }
        
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        th {
            background-color: var(--light);
            font-weight: 600;
        }
        
        tr:hover {
            background-color: #f9f9f9;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-active {
            background-color: #d1edff;
            color: #0c5460;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .preview-img {
            max-width: 150px;
            max-height: 100px;
            border-radius: 4px;
            object-fit: cover;
        }
        
        .tabs {
            display: flex;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background: var(--primary-red);
        }
        
        .tab {
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            flex: 1;
            font-weight: bold;
        }
        
        .tab.active {
            background: var(--primary);
            color: white;
        }
        
        .tab:hover:not(.active) {
            background: var(--light);
        }
        
        .tab-content {
            display: none;
            text-align: center;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .current-slider-preview {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .preview-header {
            font-size: 20px;
            margin-bottom: 15px;
            text-align: center;
            color: var(--secondary);
        }
        
        .slider-preview {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            height: 400px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .slider-preview .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        
        .slider-preview .slide.active {
            opacity: 1;
        }
        
        .slider-preview .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-upload-preview {
            max-width: 200px;
            max-height: 150px;
            margin: 10px 0;
            border-radius: 4px;
            display: none;
        }
        
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .slider-preview {
                height: 250px;
            }
            
            nav ul {
                flex-direction: column;
                gap: 5px;
            }
            
            .header-container {
                flex-direction: column;
                padding: 10px;
            }
        }

        /* Notification Pop-up Styles */
.notification {
    position: fixed;
    top: 100px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    z-index: 9999;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translateX(400px);
    opacity: 0;
    transition: all 0.3s ease;
    max-width: 300px;
}

.notification.show {
    transform: translateX(0);
    opacity: 1;
}

.notification.success {
    background-color: var(--success);
    border-left: 4px solid #27ae60;
}

.notification.error {
    background-color: var(--danger);
    border-left: 4px solid #c0392b;
}

.notification.info {
    background-color: var(--primary);
    border-left: 4px solid #2980b9;
}

.notification .close-btn {
    position: absolute;
    top: 8px;
    right: 10px;
    background: none;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification .message-content {
    padding-right: 25px;
}
    </style>
</head>

<body>
    <div class="container">
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
        
        <h1>Slider Image Management</h1>
        
        <div class="tabs">
            <div class="tab active" data-tab="manage">Manage Slides</div>
            <div class="tab" data-tab="add">Add New Slide</div>
            <div class="tab" data-tab="uploads">Uploaded Images</div>
        </div>
        
        <div class="tab-content active" id="manage-tab">
            <div class="card">
                <div class="card-header">Current Slides</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Preview</th>
                                <th>Filename</th>
                                <th>Alt Text</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($slides)): ?>
                                <?php foreach($slides as $slide): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($slide['id']); ?></td>
                                        <td>
                                            <?php if (file_exists($slide['image_path'])): ?>
                                                <img src="<?php echo htmlspecialchars($slide['image_path']); ?>" alt="Preview" class="preview-img">
                                            <?php else: ?>
                                                <span style="color: var(--danger);">Image not found</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars(basename($slide['image_path'])); ?></td>
                                        <td><?php echo htmlspecialchars($slide['alt_text']); ?></td>
                                        <td>
                                            <span class="status status-<?php echo $slide['is_active'] ? 'active' : 'inactive'; ?>">
                                                <?php echo $slide['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td class="action-buttons">
                                            <button class="btn btn-primary edit-slide" 
                                                    data-id="<?php echo htmlspecialchars($slide['id']); ?>"
                                                    data-alt="<?php echo htmlspecialchars($slide['alt_text']); ?>"
                                                    data-active="<?php echo $slide['is_active'] ? '1' : '0'; ?>">
                                                Edit
                                            </button>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($slide['id']); ?>">
                                                <button type="submit" name="delete_slide" class="btn btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this slide?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No slides found. Add some slides to get started.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="tab-content" id="add-tab">
            <div class="card">
                <div class="card-header">Add New Slide</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image_file">Upload Image *</label>
                            <input type="file" id="image_file" name="image_file" accept="image/*" required>
                            <img id="image_preview" class="image-upload-preview" alt="Image preview">
                        </div>
                        <div class="form-group">
                            <label for="alt_text">Alt Text *</label>
                            <input type="text" id="alt_text" name="alt_text" placeholder="e.g., Student Village Main Building" required>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label for="is_active">Active (Show in slider)</label>
                            </div>
                        </div>
                        <button type="submit" name="add_slide" class="btn btn-success">Add Slide</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="tab-content" id="uploads-tab">
            <div class="card">
                <div class="card-header">Uploaded Images</div>
                <div class="card-body">
                    <div class="uploaded-images-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
                        <?php if (!empty($uploaded_images)): ?>
                            <?php foreach($uploaded_images as $image): ?>
                                <div style="border: 1px solid #ddd; border-radius: 8px; padding: 10px; text-align: center;">
                                    <img src="<?php echo htmlspecialchars($image); ?>" alt="Uploaded image" style="max-width: 100%; height: 120px; object-fit: cover; border-radius: 4px;">
                                    <div style="margin-top: 8px; font-size: 12px; word-break: break-all;">
                                        <?php echo htmlspecialchars(basename($image)); ?>
                                    </div>
                                    <div style="margin-top: 5px; font-size: 11px; color: #666;">
                                        <?php echo date('Y-m-d H:i', filemtime($image)); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No images uploaded yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Edit Slide Modal -->
        <div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; width: 90%; max-width: 500px;">
                <h2 style="margin-bottom: 20px;">Edit Slide</h2>
                <form method="POST" id="editForm" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_image_file">Update Image (Optional)</label>
                        <input type="file" id="edit_image_file" name="image_file" accept="image/*">
                        <img id="edit_image_preview" class="image-upload-preview" alt="Image preview">
                    </div>
                    <div class="form-group">
                        <label for="edit_alt_text">Alt Text</label>
                        <input type="text" id="edit_alt_text" name="alt_text" required>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="edit_is_active" name="is_active" value="1">
                            <label for="edit_is_active">Active (Show in slider)</label>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 20px;">
                        <button type="submit" name="update_slide" class="btn btn-success">Update Slide</button>
                        <button type="button" id="cancelEdit" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="current-slider-preview">
            <div class="preview-header">Current Slider Preview</div>
            <div class="slider-preview">
                <?php if (!empty($active_slides)): ?>
                    <?php $first = true; ?>
                    <?php foreach($active_slides as $slide): ?>
                        <div class="slide<?php echo $first ? ' active' : ''; ?>">
                            <?php if (file_exists($slide['image_path'])): ?>
                                <img src="<?php echo htmlspecialchars($slide['image_path']); ?>" alt="<?php echo htmlspecialchars($slide['alt_text']); ?>">
                            <?php else: ?>
                                <div style="display: flex; justify-content: center; align-items: center; height: 100%; background: #f0f0f0; color: #666;">
                                    Image not found
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $first = false; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="slide active">
                        <div style="display: flex; justify-content: center; align-items: center; height: 100%; background: #f0f0f0; color: #666;">
                            No active slides to display
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        
        // Notification System
class NotificationSystem {
    constructor() {
        this.container = this.createContainer();
    }

    createContainer() {
        const container = document.createElement('div');
        container.id = 'notification-container';
        container.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        `;
        document.body.appendChild(container);
        return container;
    }

    show(message, type = 'success', duration = 3000) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        
        notification.innerHTML = `
            <div class="message-content">${message}</div>
            <button class="close-btn">&times;</button>
        `;

        // Add close functionality
        const closeBtn = notification.querySelector('.close-btn');
        closeBtn.addEventListener('click', () => {
            this.hide(notification);
        });

        this.container.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Auto hide after duration
        if (duration > 0) {
            setTimeout(() => {
                this.hide(notification);
            }, duration);
        }

        return notification;
    }

    hide(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
}

<?php if (!empty($message)): ?>
    // Show notification from PHP
    document.addEventListener('DOMContentLoaded', function() {
        const message = "<?php echo addslashes($message); ?>";
        const type = "<?php echo (strpos($message, 'Error') !== false || strpos($message, 'Sorry') !== false) ? 'error' : 'success'; ?>";
        notifier.show(message, type, 3000);
    });
<?php endif; ?>

// Global notification instance
const notifier = new NotificationSystem();
        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab
                tab.classList.add('active');
                
                // Show corresponding content
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId + '-tab').classList.add('active');
            });
        });
        
        // Image preview functionality
        function setupImagePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            });
        }
        
        // Setup image previews
        setupImagePreview('image_file', 'image_preview');
        setupImagePreview('edit_image_file', 'edit_image_preview');
        
        // Edit slide modal functionality
        document.querySelectorAll('.edit-slide').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const alt = button.getAttribute('data-alt');
                const active = button.getAttribute('data-active');
                
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_alt_text').value = alt;
                document.getElementById('edit_is_active').checked = active === '1';
                
                // Clear file input and preview
                document.getElementById('edit_image_file').value = '';
                document.getElementById('edit_image_preview').style.display = 'none';
                
                document.getElementById('editModal').style.display = 'block';
            });
        });
        
        document.getElementById('cancelEdit').addEventListener('click', () => {
            document.getElementById('editModal').style.display = 'none';
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        
        // Slider preview functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-preview .slide');
        
        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        
        // Auto-advance slides every 5 seconds if there are multiple slides
        if (slides.length > 1) {
            setInterval(() => {
                showSlide(currentSlide + 1);
            }, 5000);
        }

        // User dropdown functionality
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.user-menu')) {
                document.querySelectorAll('.user-dropdown').forEach(dropdown => {
                    dropdown.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>