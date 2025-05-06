<div class="sidebar bg-blue-800 text-white w-64 flex flex-col fixed h-full">
            <!-- Logo -->
            <div class="p-4 flex items-center justify-between border-b border-blue-700">
                <div class="flex items-center">
                    <i class="fas fa-piggy-bank text-2xl mr-3"></i>
                    <span class="sidebar-text font-bold text-xl">SaccoPro</span>
                </div>
                <button id="toggleSidebar" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <!-- Sidebar Navigation -->
                <nav class="flex-1 overflow-y-auto py-4">
                    <div class="px-4 space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-home mr-3"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                        <a href="{{ route('members') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-users mr-3"></i>
                            <span class="sidebar-text">Members</span>
                        </a>
                       
                        <a href="{{ route('savings') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-wallet mr-3"></i>
                            <span class="sidebar-text">Savings</span>
                        </a>

                        <a href="{{ route('savings.upload') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-file-invoice-dollar mr-3"></i>
                            <span class="sidebar-text">Upload Savings</span>
                        </a>

                        
                        <a href="{{ route('savings.statement') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-file-invoice-dollar mr-3"></i>
                            <span class="sidebar-text">Savings Statement</span>
                        </a>
                        
                           <!-- Dropdown Start -->
                            <div class="group">
                                <button class="flex items-center w-full px-4 py-3 bg-blue-700 rounded-lg text-white focus:outline-none">
                                    <i class="fas fa-hand-holding-usd mr-3"></i>
                                    <span class="sidebar-text flex-1 text-left">Loan Management</span>
                                    <i class="fas fa-chevron-down ml-auto"></i>
                                </button>
                                <div class="hidden group-hover:block ml-8 mt-2 space-y-1">
                                    <a href="{{ route('loans') }}" class="block px-4 py-2 rounded hover:bg-blue-600 text-white">Loan Dashboard</a>
                                    <a href="{{ route('loans.create') }}" class="block px-4 py-2 rounded hover:bg-blue-600 text-white">Loan Register</a>
                                    <a href="{{ route('repayments.create') }}" class="block px-4 py-2 rounded hover:bg-blue-600 text-white">Loan Repayment</a>
                                    <a href="{{ route('loan.statement') }}" class="block px-4 py-2 rounded hover:bg-blue-600 text-white"> Loan Statement</a>
                                </div>
                            </div>
                            <!-- Dropdown End -->
                        <a href="{{ route('loan.statement') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-file-invoice mr-3"></i>
                            <span class="sidebar-text">Loan Statement</span>
                        </a>
                        <a href="{{ route('transactions') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-exchange-alt mr-3"></i>
                            <span class="sidebar-text">Transactions</span>
                        </a>
                        <a href="{{ route('reports') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-chart-line mr-3"></i>
                            <span class="sidebar-text">Reports</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center px-4 py-3 hover:bg-blue-700 rounded-lg text-white">
                            <i class="fas fa-cog mr-3"></i>
                            <span class="sidebar-text">Settings</span>
                        </a>
                    </div>
                </nav>
            
            <!-- User Profile -->
            <div class="p-4 border-t border-blue-700">
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                    <div class="ml-3 sidebar-text">
                        <div class="font-medium">Jane Cooper</div>
                        <div class="text-sm text-blue-200">Admin</div>
                    </div>
                </div>
            </div>
        </div>