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
                                {{-- <
                                @foreach (session('role') === 'parent' ? $data_parent : $data_child as $item)
                                    <tr>
                                        <td><img src={{ asset('assets/img/Janet.png') }} alt="Transaction Image"></td>
                                        <td>{{ $item->recepientName }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->recipientAccount }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->transaction_status }}</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                   
                                @endforeach --}}
                                <?php $i = 1; ?>
                                @foreach (session('role') === 'parent' ? $data_parent : $data_child as $data)
                                {{-- {{ dd($data) }} --}}
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
                @if (session('role') === 'parent')
                <h3 class="mt-5 fst-italic">Child Account</h3>
                @endif  
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="list-group-item text-center item-align-center border-0">
                                {{-- <
                                @foreach (session('role') === 'parent' ? $data_parent : $data_child as $item)
                                    <tr>
                                        <td><img src={{ asset('assets/img/Janet.png') }} alt="Transaction Image"></td>
                                        <td>{{ $item->recepientName }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->recipientAccount }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->transaction_status }}</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                   
                                @endforeach --}}
                                @if (session('role') === 'parent')
                                    {{-- {{dd($data_account_child)}} --}}
                                    @foreach ($data_account_child as $data)
                                    {{-- {{dd( $data )}} --}}
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-1">
                                                <img src="{{ asset('assets/img/Janet.png') }}" alt="User Avatar"
                                                    class="img-fluid rounded-circle">
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="mb-3"> {{ $data->child_fullname }}</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="mb-3"> {{ $data->account_number }}</p>
                                            </div>
                                            <div class="col-sm-3 text-end">
                                                <p class="mb-3">{{ $data->balance }}</p>
                                            </div>
                                        </div>
                                       
                                    @endforeach
                                @endif
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
                                        <a class="mb-0 text-decoration-none text-dark"
                                            href="{{ url('registerKids') }}">ADD
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

         


        </div>
        <!-- /.container-fluid -->
    @endsection

    @section('topbar')
        <h3 class="text-capitalize" style="color : black">Hey There, {{ session('fullname') }}</h3>
    @endsection


    @push('scripts')
        @php

        @endphp
        <script>
            var ctx = document.getElementById("myAreaChart");
            var data = @json($data_pengeluaran);
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7", "Week 8"],
                    datasets: [{
                        label: "Earnings",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return 'Rp.' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
