<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Statement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}" type="text/css">

    
    <style>
        body {
            background-color: #f8f9fa;
            font-size: 14px;
        }
        .statement-header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .summary-box {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #0d6efd;
        }
        .highlight-balance {
            font-size: 16px;
            font-weight: bold;
        }
        .text-danger {
            color: #dc3545 !important;
        }
        .text-success {
            color: #198754 !important;
        }
    </style>
</head>
<body>

<div class="container my-5">

    <div class="statement-header text-center mb-4">
        <h3 class="mb-0">Loan Statement</h3>
        <small>{{ now()->format('F j, Y') }}</small>
    </div>

    <div class="summary-box">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Member Name:</strong> {{ $loan->full_name }}</p>
                <p><strong>Loan ID:</strong> {{ $loan->id }}</p>
                <p><strong>Loan Type:</strong> {{ $loan->loan_type }}</p>
                <p><strong>Application Date:</strong> {{ \Carbon\Carbon::parse($loan->application_date)->format('d M Y') }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Loan Amount:</strong> KES {{ number_format($loan->amount_requested, 2) }}</p>
                <p><strong>Interest Rate:</strong> {{ $loan->interest_rate }}%</p>
                <p><strong>Term (Months):</strong> {{ $loan->term_months }}</p>
                <p>
                    <strong>Outstanding Balance:</strong>
                    <span class="highlight-balance {{ $balance > 0 ? 'text-danger' : 'text-success' }}">
                        KES {{ number_format($balance, 2) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <strong>Repayment History</strong>
        </div>
        <div class="card-body p-0">
        <table class="table table-sm table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Amount Paid (KES)</th>
                    <th>Payment Method</th>
                    <th>Remarks</th>
                    <th>Balance After (KES)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($repayments as $repayment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($repayment->payment_date)->format('d M Y') }}</td>
                        <td>{{ number_format($repayment->amount_paid, 2) }}</td>
                        <td>{{ $repayment->payment_method }}</td>
                        <td>{{ $repayment->remarks }}</td>
                        <td class="{{ $repayment->balance_after > 0 ? 'text-danger' : 'text-success' }}">
                            {{ number_format($repayment->balance_after, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No repayments recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
