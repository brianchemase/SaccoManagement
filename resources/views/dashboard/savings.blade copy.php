@extends('dashboard.inc.master')


@section('content')


<div class="container mt-8">

   <br>
   <br>
   <br>
   <br>
   @include('dashboard.inc.display')

    {{-- Card with Register Button --}}
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Savings Management</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                <i class="fa fa-plus-circle"></i> Register Savings
            </button>
        </div>
    </div>

    {{-- Savings Table --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Registered Savings</h5>
            <div class="table-responsive">
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
                                <td>{{ $save->transaction_date }}</td>
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

{{-- Modal for Register Savings --}}
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('savings.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register Savings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Member</label>
                        <select name="member_id" class="form-select" required>
                            <option value="">Select Member</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Transaction Type</label>
                        <select name="transaction_type" class="form-select" required>
                            <option value="deposit">Deposit</option>
                            <option value="withdrawal">Withdrawal</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="transaction_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control" placeholder="Optional"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
