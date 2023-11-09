@extends('includes.layout')
@section('topbar')
    <h3 style="color : black">Transfer</h3>
@endsection
@section('content')
    <div class="row">
        {{-- @if (session()->get('role') == 'parent')
            <div class="col-3 border ">
                <div class="h1 text-center">To Kids</div>
                <div class="d-flex justify-content-center ml-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="list-group-item text-center item-align-center border-0">
                                    <div class="row d-flex align-items-center my-3 p-3 ">
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/img/Janet.png') }}" alt="User Avatar"
                                                class="img-fluid rounded-circle" style="widht:300px;">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="mb-0">{{ session('fullname') }}</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="{{ asset('assets/img/plus-circle.svg') }}" alt="User Avatar"
                                                class="img-fluid rounded-circle" style="height:50px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more rows as needed -->
                    </div>
                </div>
            </div>
        @endif --}}

        <div class="container-fluid d-flex justify-content-center col-9">
            <!-- Page Heading -->

            <!-- DataTales Example -->
            <div class="card w-75">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <form action="{{ url('/transfer') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" row" style="margin-left: 75px; margin-bottom:50px;">
                                <label for="acountNumber" class="col-form-label"
                                    style="padding-left: 0px; padding-right: 20px; font-weight:700; ">From
                                    Account Number </label>
                                <div class="col-form-label">
                                    <label for="acountNumber" class="col-sm-7"
                                        style="padding-left: 0px; padding-right: 20px;">
                                        :
                                    </label>
                                </div>
                                <div class="col-sm-7 border-bottom" style="padding: 0px">
                                    <input type="text" class="form-control-plaintext" id="acountNumber"
                                        name="acountNumber" placeholder="">
                                </div>
                            </div>
                            
                            <div class=" row" style="margin-left: 75px; margin-bottom:50px;">
                                <label for="amount" class="col-form-label"
                                    style="padding-left: 0px; padding-right: 20px; font-weight:700">Rp
                                </label>
                                <div class="col-form-label">
                                    <label for="amount" class="col-sm-7"
                                        style="padding-left: 145px; padding-right: 20px;">
                                        :
                                    </label>
                                </div>
                                <div class="col-sm-7 border-bottom" style="padding: 0px">
                                    <input type="text" class="form-control-plaintext" id="amount" name="amount"
                                        placeholder=" ">
                                </div>
                            </div>
                            <div class=" row" style="margin-left: 75px; margin-bottom:50px;">
                                <label for="recipientAccount" class="col-form-label"
                                    style="padding-left: 0px; padding-right: 20px; font-weight:700">To Account Number
                                </label>
                            </div>
                            <div class="d-flex align-items-center form-check row"
                                style="margin-left: 75px; margin-bottom:50px;">
                                <input class="form-check-input" type="radio" name="recipientAccount" id="fromlist">
                                <label class="form-check-label" for="fromlist">
                                    From List
                                </label>
                                <div class="col-form-label ">
                                    <label for="fromlistInput" style="padding-left: 100px; padding-right: 20px;">
                                        :
                                    </label>
                                </div>
                                <div class="col-sm-7 border-bottom" style="padding: 0px">
                                    <input type="text" class="form-control-plaintext" id="fromlistInput"
                                        name="recipientAccount" placeholder=" " readonly disabled>
                                </div>
                            </div>
                            <div class="d-flex align-items-center form-check row"
                                style="margin-left:75px;margin-bottom:50px;">
                                <input class="form-check-input" type="radio" name="recipientAccount" id="recipient">
                                <label class="form-check-label" for="recipient">
                                    Recipient
                                </label>
                                <div class="col-form-label ">
                                    <label for="recipientInput" class="col-sm-"
                                        style="padding-left: 100px; padding-right: 20px;">
                                        :
                                    </label>
                                </div>
                                <div class="col-sm-7 border-bottom" style="padding: 0px">
                                    <input type="text" class="form-control-plaintext" id="recipientInput"
                                        name="recipientAccount" placeholder=" " readonly disabled>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 75px;margin-bottom:50px;">
                                <label for="recepientName" class="col-form-label"
                                    style="padding-left: 0px; padding-right: 50px; font-weight:700">Recepient Name
                                </label>
                                <div class="col-form-label">
                                    <label for="recepientName" class="col-sm-7"
                                        style="padding-left: 15px; padding-right: 20px;">
                                        :
                                    </label>
                                </div>
                                <div class="col-sm-7 border-bottom" style="padding: 0px">
                                    <select class="form-control-plaintext" id="recepientName" name="recepientName">
                                        @foreach ($child as $data)
                                            <option value="{{ $data->child_fullname }}">
                                                {{ $data->child_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" class="form-control-plaintext" id="senderName"
                                        name="senderName" value="{{session('fullname')}}" placeholder="" hidden>
                            </div>
                            <div class="row" style="margin-left: 75px;margin-bottom:50px;">
                                <label for="customerReferences" class="col-form-label"
                                    style="padding-left: 0px; padding-right: 20px; font-weight:700">Customer References
                                </label>
                                <div class="col-form-label">
                                    <label for="customerReferences" class="col-sm-7"
                                        style="padding-left: 15px; padding-right: 20px;">
                                        :
                                    </label>
                                </div>
                                <div class="col-sm-7 border-bottom" style="padding: 0px">
                                    <input type="text" class="form-control-plaintext" id="customerReferences"
                                        name="customerReferences" placeholder=" ">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-5">
                                <button class=" btn btn-primary" style="width:150px; margin-right:50px;" type="submit"
                                    data-toggle="modal" data-target="">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="successModal" tabindex="-1" role="dialog"
            aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex mx-auto flex-column">
                        <h1 style="color : black; font-weight:bold;">Transaction Successful</h1>
                        <img src={{ asset('assets/img/success.png') }} alt="Success" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade bd-example-modal-lg" id="failedModal" tabindex="-1" role="dialog"
        aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body d-flex mx-auto flex-column">
                    <h1 style="color : black; font-weight:bold;">Transaction Failed</h1>
                    <img src={{ asset('assets/img/success.png') }} alt="Success" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div> --}}
        {{-- <div class="modal fade bd-example-modal-lg" id="otpModel" tabindex="-1" role="dialog"
            aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex mx-auto text-center flex-column " style="width: 500px; height:500px;">
                        <h1 style="color : black; font-weight:bold;">One Time Password</h1>
                        <p>We have sent an OTP to your parents, please ask them about the OTP that should be used</p>
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
                    <div class="modal-footer d-flex mx-auto">
                        <button class="btn btn-primary" style="width:300px;" type="submit"
                            data-dismiss="modal">Confirmation</button>
                    </div>
                </div>
            </div>
        </div> --}}

        <style>
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type="number"] {
                -moz-appearance: textfield;
            }

            .form-control {
                text-align: center;
                /* Center text horizontally */
            }

            form {
                margin-top: 2rem;
                margin-right: 0px;

            }
        </style>



        <script>
            // Get references to the radio buttons and input fields
            const fromlistRadio = document.getElementById('fromlist');
            const recipientRadio = document.getElementById('recipient');
            const fromlistInput = document.getElementById('fromlistInput');
            const recipientInput = document.getElementById('recipientInput');

            // Add event listeners to the radio buttons
            fromlistRadio.addEventListener('change', function() {
                if (this.checked) {
                    fromlistInput.readOnly = false;
                    fromlistInput.disabled = false;
                    recipientInput.readOnly = true;
                    recipientInput.disabled = true;
                    recipientInput.value = " ";
                }
            });

            recipientRadio.addEventListener('change', function() {
                if (this.checked) {
                    recipientInput.readOnly = false;
                    recipientInput.disabled = false;
                    fromlistInput.readOnly = true;
                    fromlistInput.disabled = true;
                    fromlistInput.value = " ";
                }
            });
        </script>
    @endsection
