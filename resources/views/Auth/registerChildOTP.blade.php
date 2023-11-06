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
    <div class="modal-body d-flex mx-auto text-center flex-column " style="width: 500px; height:500px;">
        <h1 style="color : black; font-weight:bold;">One Time Password</h1>
        <p>We have sent an OTP to your parents, please ask them about the OTP that should be used</p>
        {{-- <img src={{ asset('assets/img/success.png') }} alt="Success" /> --}}
        <form>
            <div class="form-row ">
                <div class="col text-center">
                    <input type="number" class="form-control" placeholder=" " required maxlength="1"
                        style="width:60px;height:60px">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder=" " required maxlength="1"
                        style="width:60px;height:60px">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder=" " required maxlength="1"
                        style="width:60px;height:60px">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder=" " required maxlength="1"
                        style="width:60px;height:60px">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder=" " required maxlength="1"
                        style="width:60px;height:60px">
                </div>
                <div class="col">
                    <input type="number" class="form-control" placeholder=" " required maxlength="1"
                        style="width:60px;height:60px">
                </div>
            </div>
        </form>

    </div>
</body>

</html>
