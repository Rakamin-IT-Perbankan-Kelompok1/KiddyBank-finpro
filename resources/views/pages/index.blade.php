@extends('includes/layout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h5 style="font-weight:300;">Have a great day! Good luck on your financial journey.</h5>

        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="row" style="height:1000px">
            <div class="col-6">
                <!-- Earnings (Monthly) Card Example -->
                <h3 class="mt-5 fst-italic">My Card</h3>
                <div class="col-xl-7 col-md-6 mb-4 ">
                    <div class="card box-sizing shadow h-100 py-2" style="border-radius: 20px; background:#0177FB;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center p-2 ml-3">
                                <div class="col mr-2">
                                    <div class="text-xl font-weight-light  text-capitalize mb-1">
                                        <div class="text-md font-weight-light  text-white text-capitalize mb-1">
                                            Name</div>
                                        <div class="h3 font-weight-light text-white text-capitalize mb-1">
                                            {{ session('fullname') }}</div>
                                        <div class="h5 mt-5 mb-0 font-weight-light text-white">
                                            @php
                                                $accountNumber = session('account_number');
                                                $codeBank = substr($accountNumber, 0, 4);
                                                $randomNumber = substr($accountNumber, 4, 5);
                                                $idNumber = substr($accountNumber, 9);
                                                $formattedAccountNumber = implode(' ', [$codeBank, $randomNumber, $idNumber]);
                                                echo $formattedAccountNumber;
                                            @endphp
                                        </div>
                                        <div class="text-xl font-weight-light text-white text-capitalize mb-1">
                                            Account Number</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class=""></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                </div>
                <h3 class="mt-5 fst-italic">Recent Transactions</h3>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="list-group-item text-center item-align-center border-0">
                                <?php $i = 1; ?>
                                @foreach ($transa as $data)
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-1">
                                            <img src="{{ asset('assets/img/Janet.png') }}" alt="User Avatar"
                                                class="img-fluid rounded-circle">
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="mb-3"> {{ $data->recepientName }}</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="mb-3"> {{ $data->created_at }}</p>
                                        </div>
                                        <div class="col-sm-3 text-end">
                                            <p class="mb-3">{{ $data->amount }}</p>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Add more rows as needed -->
                </div>
            </div>

            <div class="col-6  d-flex justify-content-end">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary px-2">Monthly </h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-chevron-down fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">January</a>
                                    <a class="dropdown-item" href="#">February</a>
                                    <a class="dropdown-item" href="#">March</a>
                                    <a class="dropdown-item" href="#">April</a>
                                    <a class="dropdown-item" href="#">June</a>
                                    <a class="dropdown-item" href="#">July</a>
                                    <a class="dropdown-item" href="#">August</a>
                                    <a class="dropdown-item" href="#">September</a>
                                    <a class="dropdown-item" href="#">October</a>
                                    <a class="dropdown-item" href="#">November</a>
                                    <a class="dropdown-item" href="#">December</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                    @if (session()->get('role') == 'parent')
                        <div class="card shadow py-2" style="border-radius: 20px; background:white;">
                            <summary div class="card-body">
                                <div class="row d-flex align-items-center p-2 ml-3">
                                    <div class="text-xl font-weight-light text-capitalize mb-1">
                                        <img src="{{ asset('assets/img/user-plus.svg') }}" alt="User Avatar"
                                            class="img-fluid rounded-circle">
                                    </div>

                                    <div class="col-md-6 text-end">
                                        <a class="mb-0 text-decoration-none text-dark" href="{{ url('registerKids') }}">ADD
                                            CHILD ACCOUNT</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class=""></i>
                                    </div>
                                </div>
                            </summary>
                        </div>
                    @endif

                </div>
            </div>
            <!-- Content Row -->

            {{-- <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Direct
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Social
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Referral
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        </div>
        <!-- /.container-fluid -->
    @endsection

    @section('topbar')
        <h3 class="text-capitalize" style="color : black">Hey There, {{ session('fullname') }}</h3>
    @endsection
