@extends('dashboard.inc.master')


@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Savings Content -->
            <main class="p-6">
                <!-- Savings Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Savings</p>
                                <h3 class="text-3xl font-bold text-gray-800">KSH {{ number_format($totalSavings, 2) }}</h3>
                                
                            </div>
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-piggy-bank text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Withdrawals</p>
                                <h3 class="text-3xl font-bold text-gray-800">Total {{ number_format($totalWithdrawals, 2) }}</h3>
                                
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-hand-holding-usd text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">This Month's Savings</p>
                                <h3 class="text-3xl font-bold text-gray-800">KES {{ number_format($thisMonthSavings, 2) }}</h3>
                              
                            </div>
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Last Month's Savings</p>
                                <h3 class="text-3xl font-bold text-gray-800">KES {{ number_format($lastMonthSavings, 2) }}</h3>
                                
                            </div>
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-chart-bar text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                @include('dashboard.inc.display')                
                     
                
                <!-- Savings Actions and Filters -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">All Savings Accounts</h2>
                            <p class="text-gray-500">Manage member savings accounts and transactions</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">                           

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="fa fa-plus-circle"></i> Register Savings
                            </button>
                            @include('dashboard.modals.registersavingsmodal')                                                     
                           
                        </div>
                    </div>
                </div>
                
                <!-- Savings Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-fade-in">
                    <div class="overflow-x-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                <h5 class="card-title">Registered Savings</h5>
                                    <table id="example" class="table table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Member</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($savings as $index => $save)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $save->full_name }}</td>
                                                    <td>{{ number_format($save->amount, 2) }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $save->transaction_type == 'deposit' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($save->transaction_type) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($save->transaction_date)->format('d M Y') }}</td>
                                                    <td>{{ $save->remarks }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No savings recorded yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>                       
                            </div>
                        </div>
                    </div>
                  
                </div>
            </main>
        </div>

@endsection
