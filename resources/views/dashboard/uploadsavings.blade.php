@extends('dashboard.inc.master')

@section('title', 'Loan Register')

@section('content')

<div class="main-content flex-1 overflow-y-auto ml-64 main-content-container">
    <br>

    <!-- Main Loan Registration Content -->
    <main class="p-6">

        @include('dashboard.inc.display')

        @if(session('error'))
           
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


         
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Sacco Template</h2>
                                <p class="text-gray-500">Download the sacco template to use for transactions to upload bulk savings</p>
                            </div>
                       
                            <div class="flex flex-col sm:flex-row gap-3">
                                                               
                                    <a href="{{ route('members.download-template') }}" class="btn btn-outline-primary my-2">
                                        Download Template
                                    </a>
                            </div>                                                         
                        </div>
                    </div>
              
                          

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <form action="{{ route('savings.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Upload Savings Record</h2>
                        <p class="text-gray-500">Attach your filled template</p>
                    </div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                    <!-- file attachment -->
                    <div>
                        <label for="loan_type" class="block text-sm font-medium text-gray-700">Attach Savings File</label>
                        <input type="file" name="file" id="file"  required class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i> Upload Savings
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>

@endsection
