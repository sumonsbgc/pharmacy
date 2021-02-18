@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Expenses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Expenses</li>
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
                            <h3 class="card-title">All Expenses List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Account Name</th>
                                        <th>Account Code</th>
                                        <th>Expense Amount</th>
                                        <th>Transaction Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $expense->account_name }}</td>
                                            <td>{{ $expense->account_code }}</td>
                                            <td>{{ $expense->expense_amount }}</td>
                                            <td>{{ \Carbon\Carbon::create($expense->transaction_date)->format('d-m-Y') }}</td>
                                            <td width="300px">
                                                <a href="{{ route('admin.expense.edit', $expense->id) }}" class="btn btn-warning btn-edit" title="EDIT"><i class="fas fa-edit"></i></a>                                            
                                                <a href="{{ route('admin.expense.delete', $expense->id) }}" class="btn btn-danger btn-delete" title="DELETE" onclick="event.preventDefault(); document.getElementById('delete-expense-{{$expense->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="delete-expense-{{ $expense->id }}" action="{{ route('admin.expense.delete', $expense->id) }}" method="POST" class="d-none">
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
                                        <th>Account Name</th>
                                        <th>Account Code</th>
                                        <th>Expense Amount</th>
                                        <th>Transaction Date</th>
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