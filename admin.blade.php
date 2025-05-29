<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            line-height: 1.5;
        }
        
        /* Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #1e40af;
            color: white;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 10;
        }
        
        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .sidebar-header i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
        }
        
        .sidebar-header h1 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        
        .sidebar nav {
            flex: 1;
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar li {
            margin-bottom: 0.25rem;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: 0.5rem;
            color: white;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .sidebar a:hover {
            background-color: #1e3a8a;
        }
        
        .sidebar a.active {
            background-color: #2563eb;
        }
        
        .sidebar a i {
            margin-right: 0.75rem;
        }
        
        .sidebar-footer {
            margin-top: auto;
            padding-top: 2rem;
        }
        
        /* Main content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Top navigation */
        .top-nav {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1rem;
        }
        
        .top-nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-container {
            position: relative;
        }
        
        .search-input {
            padding: 0.5rem 1rem;
            padding-right: 2.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }
        
        .search-btn {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
        }
        
        .user-nav {
            display: flex;
            align-items: center;
        }
        
        .notifications {
            position: relative;
            margin-right: 1rem;
        }
        
        .notifications i {
            font-size: 1.25rem;
            color: #4b5563;
        }
        
        .notification-badge {
            position: absolute;
            top: -0.25rem;
            right: -0.25rem;
            background-color: #ef4444;
            color: white;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background-color: #e5e7eb;
            margin-right: 0.5rem;
        }
        
        /* Content area */
        .content {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }
        
        .page-header {
            margin-bottom: 1.5rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.25rem;
        }
        
        .page-subtitle {
            color: #6b7280;
        }
        
        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .stat-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-0.25rem);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }
        
        .stat-trend {
            font-size: 0.875rem;
        }
        
        .trend-up {
            color: #10b981;
        }
        
        .trend-down {
            color: #ef4444;
        }
        
        .icon-bg {
            padding: 0.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .icon-blue {
            background-color: #dbeafe;
            color: #2563eb;
        }
        
        .icon-green {
            background-color: #d1fae5;
            color: #10b981;
        }
        
        .icon-purple {
            background-color: #ede9fe;
            color: #8b5cf6;
        }
        
        .icon-orange {
            background-color: #ffedd5;
            color: #f97316;
        }
        
        /* Charts */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        @media (min-width: 1024px) {
            .charts-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .chart-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .chart-title {
            font-size: 1.125rem;
            font-weight: bold;
        }
        
        .chart-select {
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            font-size: 0.875rem;
        }
        
        .chart-container {
            height: 16rem;
        }
        
        /* Table */
        .table-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .table-title {
            font-size: 1.125rem;
            font-weight: bold;
        }
        
        .view-all-btn {
            background-color: #2563eb;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .view-all-btn:hover {
            background-color: #1d4ed8;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            text-align: left;
            padding: 0.75rem 1rem;
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            background-color: #f9fafb;
        }
        
        td {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            border-bottom: 1px solid #f3f4f6;
        }
        
        tr:hover {
            background-color: #f9fafb;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1;
        }
        
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .status-shipped {
            background-color: #ede9fe;
            color: #5b21b6;
        }
        
        .status-refunded {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .action-btn i {
            font-size: 1rem;
        }
        
        .action-view {
            color: #2563eb;
        }
        
        .action-view:hover {
            color: #1d4ed8;
        }
        
        .action-edit {
            color: #6b7280;
        }
        
        .action-edit:hover {
            color: #4b5563;
        }
        
        /* Activity and Products */
        .features-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        @media (min-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        .card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: bold;
        }
        
        .link-btn {
            color: #2563eb;
            font-size: 0.875rem;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .link-btn:hover {
            color: #1d4ed8;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .activity-icon {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background-color: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            color: #2563eb;
        }
        
        .activity-content p {
            font-size: 0.875rem;
        }
        
        .activity-time {
            color: #6b7280;
            font-size: 0.75rem;
        }
        
        .product-list {
            list-style: none;
        }
        
        .product-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background-color: #f9fafb;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
        }
        
        .product-info h4 {
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .product-sales {
            color: #6b7280;
            font-size: 0.75rem;
        }
        
        .product-revenue {
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .product-revenue i {
            font-size: 0.75rem;
            margin-left: 0.5rem;
        }
        
        .mobile-sidebar-toggle {
            background: none;
            border: none;
            color: #4b5563;
            font-size: 1.25rem;
            cursor: pointer;
            display: none;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-sidebar-toggle {
                display: block;
                margin-right: 1rem;
            }
        }

        /* For mobile view navigation */
        .mobile-nav {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem;
                background-color: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-chart-line"></i>
                <h1>AdminPro</h1>
            </div>
            
            <nav>
                <ul>
                    <li>
                        <a href="#" class="active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <a href="#">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <header class="top-nav">
                <div class="top-nav-container">
                    <div class="search-container">
                        <button id="sidebar-toggle" class="mobile-sidebar-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <input type="text" placeholder="Search..." class="search-input">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <div class="user-nav">
                        <div class="notifications">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">5</span>
                        </div>
                        
                        <div class="user-info">
                            <div class="user-avatar">
                                <i class="fas fa-user" style="display: flex; justify-content: center; padding-top: 0.5rem;"></i>
                            </div>
                            <span>Admin User</span>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content Area -->
            <main class="content">
                <div class="page-header">
                    <h2 class="page-title">Dashboard Overview</h2>
                    <p class="page-subtitle">Welcome back! Here's what's happening today.</p>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <p class="stat-label">Total Revenue</p>
                                <h3 class="stat-value" id="total-revenue">$0</h3>
                                <p class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> <span id="revenue-increase">0%</span> from last month</p>
                            </div>
                            <div class="icon-bg icon-blue">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <p class="stat-label">Total Users</p>
                                <h3 class="stat-value" id="total-users">0</h3>
                                <p class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> <span id="users-increase">0%</span> from last month</p>
                            </div>
                            <div class="icon-bg icon-green">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <p class="stat-label">Total Orders</p>
                                <h3 class="stat-value" id="total-orders">0</h3>
                                <p class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> <span id="orders-increase">0%</span> from last month</p>
                            </div>
                            <div class="icon-bg icon-purple">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <p class="stat-label">Total Products</p>
                                <h3 class="stat-value" id="total-products">0</h3>
                                <p class="stat-trend trend-down"><i class="fas fa-arrow-down"></i> <span id="products-decrease">0%</span> from last month</p>
                            </div>
                            <div class="icon-bg icon-orange">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts -->
                <div class="charts-grid">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Revenue Overview</h3>
                            <select id="revenue-timeframe" class="chart-select">
                                <option value="daily">Daily</option>
                                <option value="weekly" selected>Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="revenue-chart"></canvas>
                        </div>
                    </div>
                    
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">User Growth</h3>
                            <select id="user-timeframe" class="chart-select">
                                <option value="weekly">Weekly</option>
                                <option value="monthly" selected>Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="chart-container">
                            <canvas id="users-chart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders Table -->
                <div class="table-card">
                    <div class="table-header">
                        <h3 class="table-title">Recent Orders</h3>
                        <button class="view-all-btn">View All</button>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="orders-table-body">
                                <!-- Orders will be loaded dynamically via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Activity and Top Products -->
                <div class="features-grid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                            <button class="link-btn">View All</button>
                        </div>
                        
                        <ul id="activity-feed" class="activity-list">
                            <!-- Activity feed will be loaded dynamically via JavaScript -->
                        </ul>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Products</h3>
                            <button class="link-btn">View All</button>
                        </div>
                        
                        <ul id="top-products" class="product-list">
                            <!-- Top products will be loaded dynamically via JavaScript -->
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sample data for demonstration
        const dashboardData = {
            stats: {
                revenue: 48750,
                revenueIncrease: 12.5,
                users: 2468,
                usersIncrease: 8.3,
                orders: 1243,
                ordersIncrease: 5.7,
                products: 386,
                productsDecrease: 2.1
            },
            revenueData: {
                daily: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    data: [1200, 1900, 1500, 2100, 1700, 800, 1300]
                },
                weekly: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    data: [5800, 7200, 9400, 8300]
                },
                monthly: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    data: [15000, 21000, 18000, 24000, 27000, 25000]
                }
            },
            userData: {
                weekly: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    data: [120, 180, 210, 250]
                },
                monthly: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    data: [450, 580, 670, 790, 880, 950]
                },
                yearly: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    data: [850, 1250, 1650, 2100, 2468]
                }
            },
            recentOrders: [
                { id: 'ORD-7652', customer: 'John Smith', product: 'Premium Headphones', date: '2025-04-23', amount: 129.99, status: 'Completed' },
                { id: 'ORD-7651', customer: 'Lisa Johnson', product: 'Smart Watch', date: '2025-04-23', amount: 249.99, status: 'Processing' },
                { id: 'ORD-7650', customer: 'Michael Brown', product: 'Wireless Keyboard', date: '2025-04-22', amount: 59.99, status: 'Completed' },
                { id: 'ORD-7649', customer: 'Emma Wilson', product: 'Gaming Monitor', date: '2025-04-22', amount: 349.99, status: 'Shipped' },
                { id: 'ORD-7648', customer: 'David Lee', product: 'Bluetooth Speaker', date: '2025-04-21', amount: 79.99, status: 'Refunded' }
            ],
            recentActivity: [
                { user: 'Admin', action: 'added new product', target: 'Wireless Earbuds', time: '35 minutes ago' },
                { user: 'John Smith', action: 'purchased', target: 'Premium Headphones', time: '2 hours ago' },
                { user: 'Emma Wilson', action: 'left a review', target: '5 stars for Gaming Monitor', time: '3 hours ago' },
                { user: 'Customer Support', action: 'resolved issue for', target: 'David Lee', time: '5 hours ago' },
                { user: 'System', action: 'performed database backup', target: '', time: '12 hours ago' }
            ],
            topProducts: [
                { name: 'Premium Headphones', sales: 248, revenue: 32239.52, trend: 'up' },
                { name: 'Smart Watch', sales: 187, revenue: 46748.13, trend: 'up' },
                { name: 'Gaming Monitor', sales: 156, revenue: 54598.44, trend: 'up' },
                { name: 'Wireless Keyboard', sales: 142, revenue: 8518.58, trend: 'down' },
                { name: 'Bluetooth Speaker', sales: 137, revenue: 10958.63, trend: 'up' }
            ]
        };

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(amount);
        }

        // Format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return new Intl.DateTimeFormat('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            }).format(date);
        }

        // Initialize dashboard
        function initDashboard() {
            // Update stats
            document.getElementById('total-revenue').textContent = formatCurrency(dashboardData.stats.revenue);
            document.getElementById('revenue-increase').textContent = dashboardData.stats.revenueIncrease + '%';
            
            document.getElementById('total-users').textContent = dashboardData.stats.users.toLocaleString();
            document.getElementById('users-increase').textContent = dashboardData.stats.usersIncrease + '%';
        }
        document.getElementById('total-orders').textContent = dashboardData.stats.orders.toLocaleString();
            document.getElementById('orders-increase').textContent = dashboardData.stats.ordersIncrease + '%';
            
            document.getElementById('total-products').textContent = dashboardData.stats.products.toLocaleString();
            document.getElementById('products-decrease').textContent = dashboardData.stats.productsDecrease + '%';

            // Load recent orders
            loadRecentOrders();

            // Load recent activity
            loadRecentActivity();

            // Load top products
            loadTopProducts();

            // Initialize charts
            initCharts();
        