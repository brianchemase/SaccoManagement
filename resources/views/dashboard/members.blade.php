@extends('dashboard.inc.master')

@section('title', 'Member Management')

@section('content')
<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
            <!-- Members Content -->
            <main class="p-6">
                <!-- Members Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Membeship</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $totalMembers }}</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-tasks mr-1"></i> General Count of members in the sacco
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Active Members</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $statusCounts['active'] ?? 0 }}</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-users mr-1"></i> Active Members in the sacco
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-user-check text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Exited Members</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $statusCounts['exited'] ?? 0 }}</h3>
                                <p class="text-red-500 flex items-center mt-1">
                                    <i class="fas fa-users mr-1"></i> Members who left the sacco
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <i class="fas fa-user-plus text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6 card-hover transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Inactive Members</p>
                                <h3 class="text-3xl font-bold text-gray-800">{{ $statusCounts['dormant'] ?? 0 }}</h3>
                                <p class="text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-down mr-1"></i> Members that are not active
                                </p>
                            </div>
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-user-clock text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @include('dashboard.inc.display')
                
                <!-- Members Actions and Filters -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">All Members</h2>
                            <p class="text-gray-500">Manage your Sacco members and their details</p>
                        </div>
                       
                        <div class="flex flex-col sm:flex-row gap-3">
                           
                                <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#createModal">
                                    + Register Member
                                </button>

                                {{-- Create Modal --}}
                                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('members.store') }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Register Member</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('dashboard.members.form')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Register Member</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>                           
                        </div>
                    </div>
                </div>
                             

                <br>

                <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="container mt-4">
                            <h2 class="mb-3">Search Member</h2>
                            
                            <!-- Search Input -->
                            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">

                            <!-- Table -->
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                    <th>Member No</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>ID Number</th>
                                    <th>Date Joined</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                @foreach($members as $member)
                                    <tr>
                                        <td>{{ $member->member_no }}</td>
                                        <td>{{ $member->full_name }}</td>
                                        <td>{{ $member->phone }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->id_number }}</td>
                                        <td>{{ $member->date_joined }}</td>
                                        <td>{{ ucfirst($member->status) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $member->id }}">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </button>
                                            
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal{{ $member->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $member->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('members.update', $member->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h2 class="modal-title"> <b>Update Sacco Member : {{ $member->full_name }} Details</b></h2>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('dashboard.members.form', ['member' => $member])
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
@endsection