@extends('dashboard.inc.master')

@section('title', 'Dashboard')

@section('content')
<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Members</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $statusCounts['active'] ?? 0 }}</h3>
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
                                <h3 class="text-3xl font-bold text-gray-800">KSH {{ number_format($totalSavings, 2) }}</h3>
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
@endsection