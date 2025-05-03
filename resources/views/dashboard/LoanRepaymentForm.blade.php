@extends('dashboard.inc.master')

@section('title', 'Loan Repayment')

@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>

    <!-- Loan Repayment Registration -->
    <main class="p-6">

        @include('dashboard.inc.display')

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <form method="POST" action="{{ route('repayments.store') }}">
                @csrf

                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Register Loan Repayment</h2>
                        <p class="text-gray-500">Record a repayment made towards a loan</p>
                    </div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <!-- Select Loan -->
                    <div>
                        <label for="loan_id" class="block text-sm font-medium text-gray-700">Loan</label>
                        <select name="loan_id" id="loan_id" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Loan --</option>
                            @foreach($loans as $loan)
                                <option value="{{ $loan->id }}" {{ old('loan_id') == $loan->id ? 'selected' : '' }}>
                                    {{ $loan->full_name }} - KSH {{ number_format($loan->amount_approved, 2) }} ({{ $loan->loan_type }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount Paid -->
                    <div>
                        <label for="amount_paid" class="block text-sm font-medium text-gray-700">Amount Paid (KSH)</label>
                        <input type="number" name="amount_paid" id="amount_paid" step="0.01" value="{{ old('amount_paid') }}" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Date of Payment -->
                    <div>
                        <label for="payment_date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                        <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', now()->toDateString()) }}" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select name="payment_method" id="payment_method" required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Method --</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="mpesa" {{ old('payment_method') == 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                        </select>
                    </div>

                    <!-- Optional Remarks -->
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                        <textarea name="remarks" id="remarks" rows="3" class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('remarks') }}</textarea>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <i class="fas fa-check-circle mr-2"></i> Submit Repayment
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>

@endsection
