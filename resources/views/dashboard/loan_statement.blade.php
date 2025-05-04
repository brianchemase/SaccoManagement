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
                    <form id="statementForm" class="space-y-4" action="{{ route('generateloan.statement', [$loan_id ?? 0]) }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="memberSelect" class="block text-sm font-medium text-gray-700">Select Loan Profile</label>
                                <select name="loan_id" id="memberSelect" class="member-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">-- Select Loan --</option>
                                        @foreach($loans as $loan)
                                            <option value="{{ $loan->id }}">{{ $loan->full_name }} - {{ $loan->id }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end">
                               
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                                    <i class="fas fa-file-download mr-2"></i> Generate Statement
                                </button>

                               </div>
                           
                        </div>
                        <div class="flex justify-end">
                            
                        </div>
                    </form>

                </div>
                
                
            </main>
        </div>




@endsection