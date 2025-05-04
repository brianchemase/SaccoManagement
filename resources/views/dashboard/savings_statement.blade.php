@extends('dashboard.inc.master')

@section('title', 'page title')

@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Savings Statement Content -->
            <main class="p-6">
                <!-- Statement Generation Form -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Generate Savings Statement</h2>
                    <form id="statementForm" class="space-y-4" action="{{ route('savings.statement') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="memberSelect" class="block text-sm font-medium text-gray-700">Select Member</label>
                                <select name="member_id" id="memberSelect" class="member-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">-- Select Member --</option>
                                    @foreach($members as $memberdata)
                                        <option value="{{ $memberdata->id }}" {{ $selected_member == $memberdata->id ? 'selected' : '' }}>
                                            {{ $memberdata->full_name }} ({{ $memberdata->member_no }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" id="startDate" name="from_date" value="{{ request('start_date') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" id="endDate" name="to_date" value="{{ request('end_date') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                                <i class="fas fa-file-download mr-2"></i> Generate Statement
                            </button>
                        </div>
                    </form>

                </div>

                @if($savings->count())
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Transaction Type</th>
                                <th>Amount (KES)</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($savings as $save)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($save->transaction_date)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $save->transaction_type == 'deposit' ? 'success' : 'danger' }}">
                                            {{ ucfirst($save->transaction_type) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($save->amount, 2) }}</td>
                                    <td>{{ $save->remarks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
                <!-- Sample Statement -->
                <div id="statementPreview" class="bg-white rounded-xl shadow-sm p-6 ">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg no-print font-semibold text-gray-800">Savings Statement</h2>
                        <button id="printStatementBtn" class="no-print px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                            <i class="fas fa-print mr-2"></i> Print Statement
                        </button>

                        <a href="{{ route('singlememberstatement', ['memberno' => $member->id]) }}"
                            class="no-print px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"><i class="fas fa-file mr-2"></i>
                                View Statement
                        </a>
                    </div>
                    
                    <!-- Statement Header -->
                    <div class="statement-container rounded-lg overflow-hidden mb-6">
                        
                        <div class="statement-header p-6 text-center">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <div>
                                    <img src="https://portal.sucdiagency.com/logo/logo.png" alt="Logo" class="h-12 mx-auto">
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold">SACCO NAME SAVINGS STATEMENT</h1>
                                    <p class="mt-2">Generated on: <span id="generationDate" class="font-medium">{{ $now->toDayDateTimeString() }}</span></p>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- Member Details -->
                        <div class="p-6 border-b">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Member Information</h3>
                                    <p class="text-gray-600"><span class="font-medium">Name:</span> <span id="memberName">{{ $member->full_name ?? 'N/A' }} </p>
                                    <p class="text-gray-600"><span class="font-medium">Member ID:</span> <span id="memberId">{{ $member->id_number ?? 'N/A' }}</span></p>
                                    
                                </div>
                              

                                @if($fromDate && $toDate)
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Statement Period</h3>
                                        <p class="text-gray-600">
                                            <span id="statementStartDate">{{ \Carbon\Carbon::parse($fromDate)->toFormattedDateString() }}</span>
                                        </p>
                                        <p class="text-gray-600">
                                            <span id="statementEndDate">{{ \Carbon\Carbon::parse($toDate)->toFormattedDateString() }}</span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Account Summary -->
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Summary</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Total Savings</p>
                                    <p class="text-xl font-bold text-gray-800">KSH {{ number_format($totalDeposits, 2) }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Total Withdrawals</p>
                                    <p class="text-xl font-bold text-red-600">KSH {{ number_format($totalWithdrawals, 2) }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500">Current Balance</p>
                                    <p class="text-xl font-bold text-blue-600">KSH {{ number_format($currentBalance, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Transaction Details -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Transaction Summary</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 statement-table">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>                                          
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deposits</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Withdrawals</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php $balance = 0; @endphp
                                        @foreach($savings as $saving)
                                            @php
                                                $deposit = $saving->transaction_type === 'deposit' ? $saving->amount : 0;
                                                $withdrawal = $saving->transaction_type === 'withdrawal' ? $saving->amount : 0;
                                                $balance += $deposit - $withdrawal;
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> {{ \Carbon\Carbon::parse($saving->transaction_date)->format('d M Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $saving->remarks }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">
                                                    {{ $deposit ? number_format($deposit, 2) : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-medium">
                                                    {{ $withdrawal ? number_format($withdrawal, 2) : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                    {{ number_format($balance, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>

                @elseif($selected_member)
                    <div class="alert alert-warning">No savings records found for the selected member.</div>
                @endif
            </main>
        </div>

        <script>
    document.getElementById('printStatementBtn').addEventListener('click', function () {
        const printContent = document.getElementById('statementPreview').innerHTML;
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload(); // optional: refresh to restore JS events and full layout
    });
</script>


@endsection