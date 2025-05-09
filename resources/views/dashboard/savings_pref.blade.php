@extends('dashboard.inc.master')


@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Savings Content -->
            <main class="p-6">
                

                             
                     
                
                <!-- Savings Actions and Filters -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">Members Savings Preference</h2>
                            <p class="text-gray-500">Register and update the member's prefered savings</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">                           

                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="fa fa-plus-circle"></i> Register Savings Preference
                            </button>
                            @include('dashboard.modals.registersavingsprefmodal')                                                     
                           
                        </div>
                    </div>
                </div>

                @include('dashboard.inc.display')  
                
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
                                                <th>Member Name</th>
                                                <th>Member No</th>
                                                <th>Email</th>
                                                <th>Preferred Amount</th>
                                                <th>Effective From</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($preferences as $pref)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pref->full_name }}</td>
                                                <td>{{ $pref->member_id }}</td>
                                                <td>{{ $pref->email }}</td>
                                                <td>KES {{ number_format($pref->preferred_amount, 2) }}</td>
                                                <td>{{ $pref->effective_from }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal{{ $pref->id }}">Edit</button>
                                                </td>
                                            </tr>

                                            <!-- Update Modal -->
                                           <!-- Update Modal -->
                                            <div class="modal fade" id="updateModal{{ $pref->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $pref->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form method="POST" action="{{ route('savings.preferences.update', $pref->id) }}">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Update Preference for {{ $pref->full_name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    <label>Member</label>
                                                                    <input type="text" class="form-control" value="{{ $pref->full_name }}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label>Preferred Amount</label>
                                                                    <input type="number" step="0.01" name="preferred_amount" value="{{ $pref->preferred_amount }}" class="form-control" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label>Effective From</label>
                                                                    <input type="date" name="effective_from" value="{{ $pref->effective_from }}" class="form-control" max="{{ date('Y-m-d') }}" required>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary">Update</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        @endforeach
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
