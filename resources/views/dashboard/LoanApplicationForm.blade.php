@extends('dashboard.inc.master')

@section('title', 'Loan Register')

@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>

    <!-- Main Loan Registration Content -->
    <main class="p-6">

        @include('dashboard.inc.display')

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <form method="POST" action="{{ route('loans.store') }}">
                @csrf

                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Register New Loan</h2>
                        <p class="text-gray-500">Fill in the details to apply for a new loan</p>
                    </div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <!-- Member -->
                    <div>
                        <label for="member_id" class="block text-sm font-medium text-gray-700">Member</label>
                        <select name="member_id" id="member_id" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Member --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Loan Type -->
                    <div>
                        <label for="loan_type" class="block text-sm font-medium text-gray-700">Loan Type</label>
                        <input type="text" name="loan_type" id="loan_type" value="{{ old('loan_type') }}" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Amount Requested -->
                    <div>
                        <label for="amount_requested" class="block text-sm font-medium text-gray-700">Amount Requested (KSH)</label>
                        <input type="number" name="amount_requested" id="amount_requested" step="0.01" value="{{ old('amount_requested') }}" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Interest Rate -->
                    <div>
                        <label for="interest_rate" class="block text-sm font-medium text-gray-700">Interest Rate (%)</label>
                        <input type="number" name="interest_rate" id="interest_rate" step="0.01" value="{{ old('interest_rate') }}" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Amount to Repay -->
                    <div>
                        <label for="amount_to_repay" class="block text-sm font-medium text-gray-700">Amount to Repay (KSH)</label>
                        <input type="text" name="amount_to_repay" id="amount_to_repay" readonly class="mt-1 block w-full bg-gray-100 border rounded-lg px-3 py-2 text-gray-700 focus:outline-none">
                    </div>

                    <!-- Term Months -->
                    <div>
                        <label for="term_months" class="block text-sm font-medium text-gray-700">Term (Months)</label>
                        <input type="number" name="term_months" id="term_months" value="{{ old('term_months') }}" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Monthly Installment -->
                    <div>
                        <label for="monthly_installment" class="block text-sm font-medium text-gray-700">Monthly Installment (KSH)</label>
                        <input type="text" name="monthly_installment" id="monthly_installment" readonly class="mt-1 block w-full bg-gray-100 border rounded-lg px-3 py-2 text-gray-700 focus:outline-none">
                    </div>

                    <!-- Application Date -->
                    <div>
                        <label for="application_date" class="block text-sm font-medium text-gray-700">Application Date</label>
                        <input type="date" name="application_date" id="application_date" value="{{ old('application_date', now()->toDateString()) }}" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>


                    <!-- Member -->
                    <div>
                        <label for="member_id" class="block text-sm font-medium text-gray-700">First Guarantor</label>
                        <select name="first_guarantor" id="member_id" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Guarantor --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Member -->
                    <div>
                        <label for="member_id" class="block text-sm font-medium text-gray-700">Second Guarantor</label>
                        <select name="second_guarantor" id="member_id" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Guarantor --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Member -->
                    <div>
                        <label for="member_id" class="block text-sm font-medium text-gray-700">Third Guarantor</label>
                        <select name="third_guarantor" id="member_id" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Guarantor --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    

                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i> Submit Loan Application
                    </button>
                </div>

             

            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const amountInput = document.getElementById('amount_requested');
                const interestInput = document.getElementById('interest_rate');
                const repayInput = document.getElementById('amount_to_repay');
                const termInput = document.getElementById('term_months');
                const monthlyInput = document.getElementById('monthly_installment');

                function calculateLoanDetails() {
                    const amount = parseFloat(amountInput.value) || 0;
                    const interest = parseFloat(interestInput.value) || 0;
                    const term = parseInt(termInput.value) || 0;

                    const totalRepayment = amount + (amount * (interest / 100));
                    repayInput.value = totalRepayment.toFixed(2);

                    const monthly = term > 0 ? totalRepayment / term : 0;
                    monthlyInput.value = monthly.toFixed(2);
                }

                amountInput.addEventListener('input', calculateLoanDetails);
                interestInput.addEventListener('input', calculateLoanDetails);
                termInput.addEventListener('input', calculateLoanDetails);

                // Trigger on page load (useful if there's old input)
                calculateLoanDetails();
            });
        </script>

    </main>
</div>

@endsection
