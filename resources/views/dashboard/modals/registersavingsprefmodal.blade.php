
{{-- Modal for Register Savings preference --}}
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('savings.preferences.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register New Savings Preference </h5>
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
                        <label> Preferred Amount</label>
                        <input type="number" step="0.01" name="preferred_amount" class="form-control" required>
                    </div>

                   

                    <div class="mb-3">
                        <label>Effective From</label>
                        <input type="date" name="effective_from" class="form-control" max="{{ date('Y-m-d') }}" required>
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