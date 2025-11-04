<!DOCTYPE html>
<html>
<head>
    <title>Email Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
     <img src="https://i.ibb.co/9mCQF3cf/Cover-Photo.png?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&h=300" alt="Pyrethrum Fields" class="hero-image" style="width: 100%; height: auto; border-radius: 5px 5px 0 0; margin: -30px -30px 30px -30px; display: block; max-width: none;">
    <h2>Email Registration Form</h2>
    <form action="{{ route('register.send') }}" method="POST">
        @csrf
        <div id="emailFields">
            <div class="row mb-3">
                <div class="col-md-5">
                    <input type="text" name="name[]" class="form-control" placeholder="Contact Name" required>
                </div>
                <div class="col-md-5">
                    <input type="email" name="email[]" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-field d-none">Remove</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="addField">Add Another</button><br>
        <button type="submit" class="btn btn-primary">Send Emails</button>
    </form>
</div>

<script>
    document.getElementById('addField').addEventListener('click', function () {
        const fieldGroup = document.createElement('div');
        fieldGroup.className = 'row mb-3';
        fieldGroup.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="name[]" class="form-control" placeholder="Contact Name" required>
            </div>
            <div class="col-md-5">
                <input type="email" name="email[]" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-field">Remove</button>
            </div>
        `;
        document.getElementById('emailFields').appendChild(fieldGroup);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-field')) {
            e.target.closest('.row').remove();
        }
    });
</script>
</body>
</html>
