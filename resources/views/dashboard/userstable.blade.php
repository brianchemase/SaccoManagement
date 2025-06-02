@extends('dashboard.inc.master')

@section('title', 'Member Management')

@section('content')
<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>
            <!-- Members Content -->
            <main class="p-6">
            
                @include('dashboard.inc.display')
                
                <!-- Members Actions and Filters -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">All Users</h2>
                            <p class="text-gray-500">Manage your Sacco Users and their details</p>
                        </div>
                       
                        <div class="flex flex-col sm:flex-row gap-3">
                           
                            <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModal">
                                + Register User
                            </button>

                            <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">User Registration Sacco Portal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Registration Form -->
                                            <form method="POST" action="{{ route('registerUser') }}" class="signin-form">
                            
                                            @csrf

                                            <div class="form-group mt-3">
                                                <label class="form-control-placeholder" for="names">Full Names</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                                
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-control-placeholder" for="email">Email Address</label>
                                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                                                
                                            </div>

                                            <div class="form-group mt-3">
                                                <label class="form-control-placeholder" for="phone">Phone no (country code)</label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                                                
                                            </div>

                                            

                                            <div class="form-group mt-3">
                                                <label class="form-control-placeholder" for="username">Role</label>
                                                <select class="form-control" name="role" required>
                                                    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>User</option>
                                                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Accountant</option>
                                                    <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Admin</option>
                                                    
                                                </select>
                                            </div>
                                            

                                                
                                        
                                            <div class="form-group">
                                                <label class="form-control-placeholder" for="password">Password</label>
                                                <input id="password-field" type="password" class="form-control" name="password" required>
                                                
                                                
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-placeholder" for="password">Confirm Password</label>
                                                <input id="password-field" type="password" class="form-control" name="password_confirmation" required>
                                                
                                                
                                            </div>

                                            <!-- Add other form fields here -->

                                            
                                            <div class="form-group d-md-flex">
                                            </div>
                                            
                                            <!-- End Registration Form -->
                                    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Register User</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                        
                        </div>
                    </div>
                </div>
                             

                <br>               

                <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-fade-in">
                    <div class="overflow-x-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                <h5 class="card-title">Registered Sacco Users</h5>
                                    <table id="example" class="table table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>                                           
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>												
                                                <th>Role</th>
                                                <th>Registered At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>                                            
                                                    <td>{{ $user->role }}</td>
                                                    <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td> 
                                                    <a href="#viewAgentModal{{$user->id}}" title="View Client" data-toggle="modal" class="btn btn-success"><i class="fa fa-eye"></i> </a> 
                                                    <a href="#editUserModal{{$user->id}}" title="Edit User" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="#changePasswordModal{{$user->id}}" title="Change Password" data-toggle="modal" class="btn btn-primary"><i class="fa fa-key"></i></a>

                                                        @include('dashboard.modals.editusermodal')
                                                    </td>
                                                </tr>
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