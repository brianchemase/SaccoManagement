<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacco Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .main-content {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed + .main-content {
            margin-left: 70px;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .progress-bar {
            transition: width 1s ease-in-out;
        }
        .header-container {
            position: fixed;
            top: 0;
            right: 0;
            left: 256px;
            z-index: 10;
            transition: all 0.3s ease;
        }
        .sidebar.collapsed ~ .header-container {
            left: 70px;
        }
        .main-content-container {
            margin-top: 72px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
            @include('dashboard.inc.sidebar')
        
        <!-- Header -->
            @include('dashboard.inc.header')
        
        
        <!-- Main Content -->
        <div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Members</p>
                                <h3 class="text-3xl font-bold text-gray-800">1,248</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i> 12.5% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Savings</p>
                                <h3 class="text-3xl font-bold text-gray-800">$2.4M</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i> 8.2% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-wallet text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Active Loans</p>
                                <h3 class="text-3xl font-bold text-gray-800">$1.8M</h3>
                                <p class="text-red-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-down mr-1"></i> 3.1% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-hand-holding-usd text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Loan Default Rate</p>
                                <h3 class="text-3xl font-bold text-gray-800">4.2%</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-down mr-1"></i> 1.3% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-exclamation-triangle text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Savings vs Loans Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Savings vs Loans</h2>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-lg">Monthly</button>
                                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">Quarterly</button>
                                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">Yearly</button>
                            </div>
                        </div>
                        <canvas id="savingsLoansChart" height="250"></canvas>
                    </div>
                    
                    <!-- Member Growth Chart -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Member Growth</h2>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-lg">Monthly</button>
                                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">Quarterly</button>
                                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">Yearly</button>
                            </div>
                        </div>
                        <canvas id="memberGrowthChart" height="250"></canvas>
                    </div>
                </div>
                
                <!-- Recent Activity and Loan Applications -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Transactions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Transactions</h2>
                            <button class="text-blue-600 hover:text-blue-800">View All</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Savings Deposit</p>
                                        <p class="text-sm text-gray-500">John Doe • 10 min ago</p>
                                    </div>
                                </div>
                                <span class="font-medium text-green-600">+$1,200</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-red-100 text-red-600 mr-3">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Loan Repayment</p>
                                        <p class="text-sm text-gray-500">Jane Smith • 25 min ago</p>
                                    </div>
                                </div>
                                <span class="font-medium text-red-600">-$350</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Savings Deposit</p>
                                        <p class="text-sm text-gray-500">Robert Johnson • 1 hour ago</p>
                                    </div>
                                </div>
                                <span class="font-medium text-green-600">+$800</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-red-100 text-red-600 mr-3">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Loan Disbursement</p>
                                        <p class="text-sm text-gray-500">Sarah Williams • 2 hours ago</p>
                                    </div>
                                </div>
                                <span class="font-medium text-red-600">-$5,000</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Loan Applications -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Pending Loan Applications</h2>
                            <button class="text-blue-600 hover:text-blue-800">View All</button>
                        </div>
                        <div class="space-y-4">
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium">Michael Brown</p>
                                        <p class="text-sm text-gray-500">Applied: 2 days ago</p>
                                    </div>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-600">Amount: <span class="font-medium">$12,000</span></p>
                                        <p class="text-gray-600">Purpose: <span class="font-medium">Business Expansion</span></p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-sm">Approve</button>
                                        <button class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm">Reject</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium">Emily Davis</p>
                                        <p class="text-sm text-gray-500">Applied: 1 day ago</p>
                                    </div>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-600">Amount: <span class="font-medium">$8,500</span></p>
                                        <p class="text-gray-600">Purpose: <span class="font-medium">Education Fees</span></p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-sm">Approve</button>
                                        <button class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm">Reject</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium">David Wilson</p>
                                        <p class="text-sm text-gray-500">Applied: 3 days ago</p>
                                    </div>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-600">Amount: <span class="font-medium">$15,000</span></p>
                                        <p class="text-gray-600">Purpose: <span class="font-medium">Home Renovation</span></p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-sm">Approve</button>
                                        <button class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('ml-64');
            document.querySelector('.main-content').classList.toggle('ml-16');
        });

        // Savings vs Loans Chart
        const savingsLoansCtx = document.getElementById('savingsLoansChart').getContext('2d');
        const savingsLoansChart = new Chart(savingsLoansCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'Savings',
                        data: [12000, 19000, 15000, 18000, 21000, 19000, 23000],
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderRadius: 4
                    },
                    {
                        label: 'Loans',
                        data: [8000, 12000, 10000, 15000, 18000, 14000, 16000],
                        backgroundColor: 'rgba(153, 102, 255, 0.7)',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value/1000 + 'k';
                            }
                        }
                    }
                }
            }
        });

        // Member Growth Chart
        const memberGrowthCtx = document.getElementById('memberGrowthChart').getContext('2d');
        const memberGrowthChart = new Chart(memberGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'New Members',
                        data: [45, 60, 55, 70, 80, 75, 90],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.3,
                        fill: true,
                        borderWidth: 2
                    },
                    {
                        label: 'Total Members',
                        data: [950, 1010, 1065, 1135, 1215, 1290, 1380],
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.1)',
                        tension: 0.3,
                        fill: true,
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: false,
                        grid: {
                            drawBorder: false
                        }
                    }
                }
            }
        });

        // Simulate loading animation for cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>