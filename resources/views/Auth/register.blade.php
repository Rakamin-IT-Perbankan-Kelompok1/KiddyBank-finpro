<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Register </title>
    {{-- <link rel="stylesheet" href="style.css"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>


{{-- <head>
    <title>Buat Akun Anak</title>
</head>
<body>
    <h1>Buat Akun Anak</h1>
    <form action="proses_pendaftaran.php" method="post">
        <label for="nama_anak">Nama Anak:</label>
        <input type="text" id="nama_anak" name="nama_anak" required><br><br>

        <label for="email_anak">Email Anak:</label>
        <input type="email" id="email_anak" name="email_anak" required><br><br>

        <label for="saldo_awal">Saldo Awal:</label>
        <input type="number" id="saldo_awal" name="saldo_awal" required><br><br>

        <input type="submit" value="Buat Akun">
    </form>
</body> --}}


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
        <div class="title">Registration</div>

        <form action="{{ url('/daftar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-center flex-column mx-auto">
                <div class="input-group mb-4 ">
                    <input type="text"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="username" placeholder="Username" aria-label="username" aria-describedby="basic-addon1" required>
                    @error('username')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="fullname" placeholder="Full Name" aria-label="fullname" aria-describedby="basic-addon1"
                        required>
                    @error('fullname')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1"
                        required>
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="number"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="telephone" placeholder="Telephone" aria-label="telephone" aria-describedby="basic-addon1"
                        required>
                    @error('telephone')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="text"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="address" placeholder="Address" aria-label="address" aria-describedby="basic-addon1"
                        required>
                    @error('address')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="password" placeholder="Password" aria-label="password" aria-describedby="basic-addon1"
                        required>
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="input-group mb-3">
                    <input type="password"
                        class="form-control-lg col-5 border border-0 shadow p-3 bg-body-tertiary rounded mx-auto"
                        name="con-password" placeholder="Confirmation Password" aria-label="con-password" aria-describedby="basic-addon1"
                        required>
                    @error('con-password')
                        <small>{{ $message }}</small>
                    @enderror
                </div> --}}
                <button type="button " class="btn btn-primary btn-lg rounded-pill mt-3 mb-5 col-5 mx-auto">Sign Up</button>

                <div class=" mx-auto">Already have an account?
                    <label class="text-decoration-underline mb-5">
                        <a href="{{ url('/') }}"> Log In
                    </label>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
