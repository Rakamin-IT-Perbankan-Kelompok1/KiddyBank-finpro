<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Login </title>
    {{-- <link rel="stylesheet" href="style.css"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="container-custom">
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif
        <div class="appName">
            <img src="{{ asset('assets/img/logo.png') }}" alt="KiddyBank">
            KiddyBank
        </div>
        <div class="title">Welcome Back</div>

        <form action="{{ url('login') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-center flex-column col-5 mx-auto">
                <div class="input-group mb-4">
                    <input type="email"
                        class="form-control-lg col-12 border border-0 shadow p-3 bg-body-tertiary rounded"
                        name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" required>
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password"
                        class="form-control-lg col-12 border border-0 shadow p-3 bg-body-tertiary rounded"
                        name="password" placeholder="Password" aria-label="password" aria-describedby="basic-addon1"
                        required>
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex flex-row-reverse mt-3 mb-3 text-decoration-underline">Forget Password
                </div>
                <button type="submit " class="btn btn-primary btn-lg rounded-pill mb-5">Log In</button>

                <div class=" mx-auto">Don't have an account?
                    <label class="text-decoration-underline mb-5">
                        <a href="{{ url('/signup') }}"> Signup now
                    </label>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
