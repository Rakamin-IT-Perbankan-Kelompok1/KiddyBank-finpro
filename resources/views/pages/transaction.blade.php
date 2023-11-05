@extends('includes.layout')
@section('topbar')
    <h3 style="color: black">Recent Transactions</h3>
@endsection
@section('content')
    <div class="row d-flex justify-content-center">
        @if (session()->get('role') == 'parent')
            <div class="col-6">
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
                                @foreach ($transactions as $transaction) <!-- Ubah $transaction menjadi $transactions -->
                                    <tr>
                                        <td><img src="{{ $transaction->image }}" alt="Transaction Image"></td>
                                        <td>{{ $transaction->recipient_name }}</td>
                                        <td>{{ $transaction->transaction_date }}</td>
                                        <td>{{ $transaction->account_number }}</td>
                                        <td>${{ $transaction->amount }}</td>
                                        <td>{{ $transaction->transaction_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
