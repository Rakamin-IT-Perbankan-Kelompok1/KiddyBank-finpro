@extends('includes.layout')
@section('topbar')
    <h3 style="color: black">Recent Transactions</h3>
@endsection
@section('content')
    <div class="row d-flex">
        {{-- @if (session()->get('role') == 'parent') --}}
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="container text-center">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Recipient Name</th>
                                    <th>Transaction Date</th>
                                    <th>Account Number</th>
                                    <th>Amount Cash</th>
                                    <th>Transaction Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Add rows (tr) and data (td) here for each transaction -->
                                <?php $i = 1; ?>
                                @foreach ($collection as $item)
                                    <tr>
                                        <td><img src={{ asset('assets/img/Janet.png') }} alt="Transaction Image"></td>
                                        <td>{{ $item->acountNumber }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->recipientAccount }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->transaction_status }}</td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
    </div>
@endsection
