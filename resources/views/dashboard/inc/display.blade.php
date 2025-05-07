@if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>

                <script>
                    sweetAlert("Success", "{{ Session::get("success") }}", "success");
                </script>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Please fix the following errors:
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        sweetAlert("Oops...", "Something went wrong!", "error");
    </script>
@endif

                