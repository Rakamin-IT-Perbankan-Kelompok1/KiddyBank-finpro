@extends('includes.layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive2">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data as $item)
                                @if ($item->name != 'admin')
                                    <tr>
                                        <td> {{ $i }}</td>
                                        <td> {{ $item->fullname }}</td>
                                        <td> {{ $item->email }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('topbar')
    <h3 style="color : black">User</h3>
@endsection
