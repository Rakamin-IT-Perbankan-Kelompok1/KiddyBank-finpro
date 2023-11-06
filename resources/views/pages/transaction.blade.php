@extends('includes.layout')
@section('topbar')
    <h3 style="color: black">Recent Transactions</h3>
@endsection
@section('content')
    <div class="row d-flex">
        @if (session()->get('role') == 'parent')
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <div class="table-borderless">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="h5 ">Image</th>
                                        <th class="h5 ">Recipient Name</th>
                                        <th class="h5 ">Transaction Date</th>
                                        <th class="h5 ">Account Number</th>
                                        <th class="h5 ">Amount Cash</th>
                                        <th class="h5 ">Transaction Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Add rows (tr) and data (td) here for each transaction -->
                                    <tr>
                                        <td><img src="transaction_image.jpg" alt="Transaction Image"></td>
                                        <td>John Doe</td>
                                        <td>2023-11-02</td>
                                        <td>1234567890</td>
                                        <td>$100.00</td>
                                        <td>Completed</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
