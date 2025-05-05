@extends('dashboard.inc.master')

@section('title', 'page title')

@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Loan Statement Content -->
            <main class="p-6">
               
                <!-- Statement Generation Form -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Generate Loan Statement</h2>
                    <form id="statementForm" class="space-y-4" action="{{ route('loan.statement') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="memberSelect" class="block text-sm font-medium text-gray-700">Select Loan Profile</label>
                                <select name="loan_id" id="memberSelect" class="member-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">-- Select Loan --</option>
                                        @foreach($systemloans as $loandata)
                                            <option value="{{ $loandata->id }}">{{ $loandata->full_name }} - {{ $loandata->id }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end">
                               
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                                    <i class="fas fa-file-download mr-2"></i> Generate Statement
                                </button>

                               </div>
                           
                        </div>
                       
                    </form>

                </div>

                @if($loanData->count())
                <div id="statementPreview" class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Loan Statement</h2>
                        <button id="printStatementBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                            <i class="fas fa-print mr-2"></i> Print Statement
                        </button>

                        <a href="{{ route('generateloan.statement', $loan->id) }}" class="btn btn-outline-primary mb-3">Generate Statement</a>
                    </div>
                    
                    <!-- Statement Header -->
                    <div class="statement-container rounded-lg overflow-hidden mb-6">
                        <div class="statement-header p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h1 class="text-2xl font-bold">SACCO System LOAN STATEMENT</h1>
                                    <p class="mt-2">Generated on: <span id="generationDate" class="font-medium">{{ \Carbon\Carbon::now()->format('F d, Y') }}</span></p>
                                </div>
                                <div class="text-right">
                                    <img src="logo/logo1.png" alt="Logo" class="h-12">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Member and Loan Details -->
                        <div class="p-6 border-b">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Member Information</h3>
                                    <p class="text-gray-600"><span class="font-medium">Name:</span> <span id="memberName">{{ $loan->full_name }}</span></p>
                                    <p class="text-gray-600"><span class="font-medium">Member ID:</span> <span id="memberId">{{ $loan->id_number }}</span></p>
                                    <p class="text-gray-600"><span class="font-medium">Account Number:</span> <span id="accountNumber">{{ $loan->id }}</span></p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Loan Information</h3>
                                    <p class="text-gray-600"><span class="font-medium">Loan Number:</span> <span id="loanNumber">{{ $loan->id }}</span></p>
                                    
                                    <p class="text-gray-600"><span class="font-medium">Loan Status:</span> <span id="loanStatus" class="loan-status status-active">{{ $loan->status }}</span></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loan Summary -->
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Loan Summary</h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Principal Amount</p>
                                    <p class="text-xl font-bold text-gray-800"> {{ number_format($loan->amount_approved, 2) }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Interest Rate</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $loan->interest_rate }}%</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Total Repaid</p>
                                    <p class="text-xl font-bold text-green-600"> {{ number_format($totalPaid, 2) }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Outstanding Balance</p>
                                    <p class="text-xl font-bold text-red-600"> {{ number_format($loanbalance, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- Payment History -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment History</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 statement-table">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid (KES)</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance After (KES)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($repayments as $repayment)
                                            <tr>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                                                    {{ \Carbon\Carbon::parse($repayment->payment_date)->format('d M Y') }}
                                                </td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-green-700 font-medium">
                                                    {{ number_format($repayment->amount_paid, 2) }}
                                                </td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $repayment->payment_method }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $repayment->remarks }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm {{ $repayment->balance_after > 0 ? 'text-red-600' : 'text-green-600' }}">
                                                    {{ number_format($repayment->balance_after, 2) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-gray-500 py-4">No repayments recorded.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Statement Footer -->
                        <div class="p-6 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Notes</h3>
                                    <p class="text-sm text-gray-600">This is an automatically generated statement. Please contact SACCOPRO support if you have any questions about your loan.</p>
                                    <p class="text-sm text-gray-600 mt-2">Penalty for late payment: 5% of installment amount.</p>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Authorized Signatory</h3>
                                    <div class="mt-8">
                                        <p class="text-sm text-gray-600 border-t pt-2 inline-block">Jane Cooper</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                
            </main>
        </div>




@endsection