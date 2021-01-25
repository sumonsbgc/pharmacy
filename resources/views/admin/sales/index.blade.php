@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Purchases</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Purchases</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Purchase List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Supplier Name</th>
                                        <th>Total Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Unit Price</th>
                                        <th>Transaction Type</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $purchase->product->name }}</td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->total_quantity }}</td>
                                            <td>{{ $purchase->total_amount }}</td>
                                            <td>{{ $purchase->unit_price }}</td>
                                            <td>{{ $purchase->transaction_type }}</td>
                                            <td>{{ $purchase->paid_amount }}</td>
                                            <td>{{ $purchase->due_amount }}</td>
                                            <td>{{ $purchase->purchase_date }}</td>
                                            <td width="300px">
                                                <a href="{{ route('admin.purchase.edit', $purchase->id) }}" class="btn btn-info btn-edit" title="EDIT"><i class="fas fa-edit"></i></a>                                                                                            
                                                <a href="{{ route('admin.purchase.delete', $purchase->id) }}" class="btn btn-danger btn-delete" title="DELETE" onclick="event.preventDefault(); document.getElementById('delete-purchase-{{$purchase->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="delete-purchase-{{ $purchase->id }}" action="{{ route('admin.purchase.delete', $purchase->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Supplier Name</th>
                                        <th>Total Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Unit Price</th>
                                        <th>Transaction Type</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection