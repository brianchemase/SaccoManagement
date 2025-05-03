<div class="row">
    <div class="col-md-6 mb-3">
        <label for="member_no">Member No</label>
        <input type="text" name="member_no" class="form-control" value="{{ old('member_no', $member->member_no ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $member->full_name ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $member->phone ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="id_number">ID Number</label>
        <input type="text" name="id_number" class="form-control" value="{{ old('id_number', $member->id_number ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="date_joined">Date Joined</label>
        <input type="date" name="date_joined" class="form-control" max="{{ date('Y-m-d') }}" value="{{ old('date_joined', isset($member) ? $member->date_joined : '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <option value="active" {{ (isset($member) && $member->status == 'active') ? 'selected' : '' }}>Active</option>
            <option value="dormant" {{ (isset($member) && $member->status == 'dormant') ? 'selected' : '' }}>Dormant</option>
            <option value="exited" {{ (isset($member) && $member->status == 'exited') ? 'selected' : '' }}>Exited</option>
        </select>
    </div>
</div>
