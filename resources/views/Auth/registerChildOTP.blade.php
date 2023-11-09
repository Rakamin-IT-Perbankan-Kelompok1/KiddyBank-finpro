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
        <div class="title">One Time Password</div>
        <p class="text-center">We have sent an OTP to your parents, please ask</p>
        <p class="text-center">them about the OTP that should be used</p>

     
        <form action="{{ url('/verifyOTP') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex justify-content-center flex-row mx-auto gap-4 mt-5 ">
                <div class="text-center shadow">
                    <input type="number" name="otp[]" class="form-control text-center fs-2" placeholder=" " required maxlength="1"
                        oninput="moveToNext(this, 'next-input')" style="width:80px;height:80px">
                </div>
                <div class="text-center shadow">
                    <input type="number" name="otp[]" class="form-control next-input text-center fs-2" placeholder=" " required maxlength="1"
                        oninput="moveToNext(this, 'next-input')" style="width:80px;height:80px">
                </div>
                <div class="text-center shadow">
                    <input type="number" name="otp[]" class="form-control next-input text-center fs-2" placeholder=" " required maxlength="1"
                        oninput="moveToNext(this, 'next-input')" style="width:80px;height:80px">
                </div>
                <div class="text-center shadow">
                    <input type="number" name="otp[]" class="form-control next-input text-center fs-2" placeholder=" " required maxlength="1"
                        oninput="moveToNext(this, 'next-input')" style="width:80px;height:80px">
                </div>
                <div class="text-center shadow">
                    <input type="number" name="otp[]" class="form-control next-input text-center fs-2" placeholder=" " required maxlength="1"
                        oninput="moveToNext(this, 'next-input')" style="width:80px;height:80px">
                </div>
                <div class="text-center shadow">
                    <input type="number" name="otp[]" class="form-control next-input text-center fs-2" placeholder=" " required maxlength="1"
                        oninput="moveToNext(this, 'next-input')" style="width:80px;height:80px">
                </div>
            </div>
            <button type="submit" class="d-flex justify-content-center align-items-center btn btn-primary btn-lg rounded-pill  mb-5 col-5 mx-auto" style="height: 60px; margin-top:100px;">Login</button>

        </form>
    </div>

    <script>
        function moveToNext(input, nextInputClass) {
            const maxLength = parseInt(input.getAttribute("maxlength"), 10);
            const value = input.value;

            if (value.length >= maxLength) { // Use greater than or equal to (>=) to allow only one digit
                input.value = value.charAt(0);
                
                const nextInput = input.parentElement.nextElementSibling.querySelector(`.${nextInputClass}`);
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }
    </script>


</body>

</html>
