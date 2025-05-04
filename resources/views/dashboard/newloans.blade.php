@extends('dashboard.inc.master')

@section('title', 'page title')

@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Loans Content -->
            <main class="p-6">
                <!-- Loans Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Loans</p>
                                <h3 class="text-3xl font-bold text-gray-800">KSH {{ number_format($totalLoansIssued, 2) }}</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i> 8.5% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-hand-holding-usd text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Active Loans</p>
                                <h3 class="text-3xl font-bold text-gray-800">KSH {{ number_format($totalApprovedLoans, 2) }}</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i> 5.2% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Overdue Loans</p>
                                <h3 class="text-3xl font-bold text-gray-800">KSH {{ number_format($totalDefaultedLoans, 2) }}</h3>
                                <p class="text-red-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i> 1.8% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <i class="fas fa-exclamation-triangle text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Loan Applications</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $totalLoanCount }}</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-down mr-1"></i> 3.1% from last month
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-file-alt text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
              
                <!-- Loans Actions and Filters -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">All Loans</h2>
                            <p class="text-gray-500">Manage loan applications and active loans</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button id="newLoanBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center justify-center">
                                <i class="fas fa-plus mr-2"></i> New Loan
                            </button>
                            <div class="flex gap-3">
                                <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Filter by Status</option>
                                    <option>Active</option>
                                    <option>Pending</option>
                                    <option>Overdue</option>
                                    <option>Completed</option>
                                </select>
                                <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Sort by</option>
                                    <option>Newest First</option>
                                    <option>Oldest First</option>
                                    <option>Amount (High-Low)</option>
                                    <option>Amount (Low-High)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <br>

                <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="container mt-4">
                            <h2 class="mb-3">Loaning Summary</h2>
                            <div class="container">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member</th>
                                            <th>Loan Type</th>
                                            <th>Amount Requested</th>
                                            <th>Status</th>
                                            <th>Application Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($loans as $index => $loan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $loan->full_name }}</td>
                                            <td>{{ $loan->loan_type ?? '-' }}</td>
                                            <td>KSH {{ number_format($loan->amount_requested, 2) }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($loan->status === 'approved') bg-success 
                                                    @elseif($loan->status === 'rejected') bg-danger 
                                                    @elseif($loan->status === 'pending') bg-warning text-dark
                                                    @else bg-secondary 
                                                    @endif">
                                                    {{ ucfirst($loan->status) }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($loan->application_date)->toFormattedDateString() }}</td>
                                            <td>
                                                <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-primary">View</a>
                                                <a href="{{ route('generateloan.statement', $loan->id) }}" class="btn btn-outline-primary mb-3">Generate Statement</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No loan applications found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Member</th>
                                            <th>Loan Type</th>
                                            <th>Amount Requested</th>
                                            <th>Status</th>
                                            <th>Application Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                </div>
                
            </main>
        </div>

        <!-- New Loan Modal -->
    <div id="newLoanModal" class="fixed inset-0 overflow-y-auto hidden z-50">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">New Loan Application</h3>
                                <button id="closeLoanModalBtn" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="mt-2">
                                <form class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="loanMember" class="block text-sm font-medium text-gray-700">Member</label>
                                            <select id="loanMember" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <option>Select Member</option>
                                                <option>Michael Johnson</option>
                                                <option>Sarah Williams</option>
                                                <option>Robert Kimani</option>
                                                <option>Grace Muthoni</option>
                                                <option>David Ochieng</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="loanType" class="block text-sm font-medium text-gray-700">Loan Type</label>
                                            <select id="loanType" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <option>Select Loan Type</option>
                                                <option>Business Loan</option>
                                                <option>Personal Loan</option>
                                                <option>Education Loan</option>
                                                <option>Emergency Loan</option>
                                                <option>Home Loan</option>
                                                <option>Vehicle Loan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="loanAmount" class="block text-sm font-medium text-gray-700">Loan Amount</label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 sm:text-sm">$</span>
                                                </div>
                                                <input type="text" id="loanAmount" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="interestRate" class="block text-sm font-medium text-gray-700">Interest Rate</label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <input type="text" id="interestRate" class="focus:ring-blue-500 focus:border-blue-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0">
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 sm:text-sm">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="issueDate" class="block text-sm font-medium text-gray-700">Issue Date</label>
                                            <input type="date" id="issueDate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label for="dueDate" class="block text-sm font-medium text-gray-700">Due Date</label>
                                            <input type="date" id="dueDate" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="paymentFrequency" class="block text-sm font-medium text-gray-700">Payment Frequency</label>
                                        <select id="paymentFrequency" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Bi-weekly</option>
                                            <option>Quarterly</option>
                                            <option>One-time</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="loanPurpose" class="block text-sm font-medium text-gray-700">Purpose of Loan</label>
                                        <textarea id="loanPurpose" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Brief description of what the loan will be used for"></textarea>
                                    </div>
                                    <div>
                                        <label for="collateral" class="block text-sm font-medium text-gray-700">Collateral (if any)</label>
                                        <textarea id="collateral" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Description of collateral provided"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Submit Application
                    </button>
                    <button id="cancelLoanModalBtn" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('ml-64');
            document.querySelector('.main-content').classList.toggle('ml-16');
        });

        // Loan Modal handling
        const loanModal = document.getElementById('newLoanModal');
        const openLoanModalBtn = document.getElementById('newLoanBtn');
        const closeLoanModalBtn = document.getElementById('closeLoanModalBtn');
        const cancelLoanModalBtn = document.getElementById('cancelLoanModalBtn');

        openLoanModalBtn.addEventListener('click', () => {
            loanModal.classList.remove('hidden');
        });

        closeLoanModalBtn.addEventListener('click', () => {
            loanModal.classList.add('hidden');
        });

        cancelLoanModalBtn.addEventListener('click', () => {
            loanModal.classList.add('hidden');
        });

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === loanModal) {
                loanModal.classList.add('hidden');
            }
        });

        // Initialize select2
        $(document).ready(function() {
            $('select').select2({
                minimumResultsForSearch: Infinity
            });
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
            
            // Animate progress bars
            const progressBars = document.querySelectorAll('.progress-bar-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });
    </script>

@endsection