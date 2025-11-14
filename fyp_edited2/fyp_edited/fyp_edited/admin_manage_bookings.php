

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dormitory Booking Management - Admin Panel</title>
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #34495e;
            --gray: #95a5a6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        h1 {
            font-size: 28px;
            font-weight: 600;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card h3 {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .tabs {
            display: flex;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .tab {
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            flex: 1;
            font-weight: 500;
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
        }
        
        .tab-content.active {
            display: block;
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
        
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
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
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 15px;
        }
        
        .search-box {
            flex: 1;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .stats {
                grid-template-columns: 1fr 1fr;
            }
            
            .tabs {
                flex-direction: column;
            }
            
            .search-filter {
                flex-direction: column;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1>Dormitory Booking Management</h1>
                <div>
                    <span>Welcome, Admin</span>
                </div>
            </div>
        </header>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Total Bookings</h3>
                <div class="number">
                    
                </div>
            </div>
            <div class="stat-card">
                <h3>Pending Requests</h3>
                <div class="number">
                    
                </div>
            </div>
            <div class="stat-card">
                <h3>Withdrawal Requests</h3>
                <div class="number">
                    
                </div>
            </div>
            <div class="stat-card">
                <h3>Renewal Requests</h3>
                <div class="number">
                    
                </div>
            </div>
        </div>
        
        <div class="tabs">
            <div class="tab active" data-tab="bookings">Booking Requests</div>
            <div class="tab" data-tab="withdrawals">Withdrawal Requests</div>
            <div class="tab" data-tab="renewals">Renewal Requests</div>
            <div class="tab" data-tab="rooms">Room Management</div>
        </div>
        
        <div class="search-filter">
            <div class="search-box">
                <i>🔍</i>
                <input type="text" id="searchInput" placeholder="Search...">
            </div>
            <select class="filter-select" id="statusFilter">
                <option value="all">All Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        
        <div class="tab-content active" id="bookings-tab">
            <div class="card">
                <div class="card-header">Booking Requests</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Room Type</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
        
        <div class="tab-content" id="withdrawals-tab">
            <div class="card">
                <div class="card-header">Withdrawal Requests</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Room Number</th>
                                <th>Reason</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM withdrawals ORDER BY created_at DESC";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['student_name'] . "</td>";
                                    echo "<td>" . $row['student_id'] . "</td>";
                                    echo "<td>" . $row['room_number'] . "</td>";
                                    echo "<td>" . $row['reason'] . "</td>";
                                    echo "<td>" . $row['created_at'] . "</td>";
                                    echo "<td><span class='status status-" . $row['status'] . "'>" . $row['status'] . "</span></td>";
                                    echo "<td class='action-buttons'>";
                                    if ($row['status'] == 'pending') {
                                        echo "<form method='POST' style='display:inline;'>";
                                        echo "<input type='hidden' name='withdrawal_id' value='" . $row['id'] . "'>";
                                        echo "<button type='submit' name='approve_withdrawal' class='btn btn-success'>Approve</button>";
                                        echo "</form>";
                                    } else {
                                        echo "<span>No actions</span>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No withdrawal requests found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="tab-content" id="renewals-tab">
            <div class="card">
                <div class="card-header">Renewal Requests</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Room Number</th>
                                <th>Current End Date</th>
                                <th>Requested End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM renewals ORDER BY created_at DESC";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['student_name'] . "</td>";
                                    echo "<td>" . $row['student_id'] . "</td>";
                                    echo "<td>" . $row['room_number'] . "</td>";
                                    echo "<td>" . $row['current_end_date'] . "</td>";
                                    echo "<td>" . $row['requested_end_date'] . "</td>";
                                    echo "<td><span class='status status-" . $row['status'] . "'>" . $row['status'] . "</span></td>";
                                    echo "<td class='action-buttons'>";
                                    if ($row['status'] == 'pending') {
                                        echo "<form method='POST' style='display:inline;'>";
                                        echo "<input type='hidden' name='renewal_id' value='" . $row['id'] . "'>";
                                        echo "<button type='submit' name='approve_renewal' class='btn btn-success'>Approve</button>";
                                        echo "</form>";
                                    } else {
                                        echo "<span>No actions</span>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No renewal requests found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="tab-content" id="rooms-tab">
            <div class="card">
                <div class="card-header">Room Management</div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Type</th>
                                <th>Capacity</th>
                                <th>Occupied</th>
                                <th>Available</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM rooms ORDER BY room_number";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $available = $row['capacity'] - $row['occupied'];
                                    $status = $available > 0 ? 'Available' : 'Full';
                                    
                                    echo "<tr>";
                                    echo "<td>" . $row['room_number'] . "</td>";
                                    echo "<td>" . $row['type'] . "</td>";
                                    echo "<td>" . $row['capacity'] . "</td>";
                                    echo "<td>" . $row['occupied'] . "</td>";
                                    echo "<td>" . $available . "</td>";
                                    echo "<td><span class='status status-" . strtolower($status) . "'>" . $status . "</span></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No room data found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
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
        
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const activeTable = document.querySelector('.tab-content.active table tbody');
            
            if (activeTable) {
                const rows = activeTable.getElementsByTagName('tr');
                
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const text = row.textContent.toLowerCase();
                    
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            }
        });
        
        // Status filter functionality
        document.getElementById('statusFilter').addEventListener('change', function() {
            const status = this.value;
            const activeTable = document.querySelector('.tab-content.active table tbody');
            
            if (activeTable) {
                const rows = activeTable.getElementsByTagName('tr');
                
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const statusCell = row.querySelector('.status');
                    
                    if (status === 'all' || !statusCell) {
                        row.style.display = '';
                    } else {
                        const rowStatus = statusCell.textContent.toLowerCase();
                        
                        if (rowStatus === status) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>