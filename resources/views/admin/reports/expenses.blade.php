@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Expenses Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expenses Report</li>
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
                            Filter Your Option
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.report.expense') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="expense_id" class="form-label">Account Name</label>
                                        <select name="expense_id" id="expense_id" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($allExpenses as $exp)
                                                <option value="{{ $exp->id }}">{{ $exp->account_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('expense_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="from" class="form-label">From</label>
                                        <input type="date" name="from" class="form-control @error('from') is-invalid @enderror" id="from" placeholder="e.g: " value="{{ old('from', $from ?? '') }}">
                                        @error("from")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="to" class="form-label">To</label>
                                        <input type="date" name="to" class="form-control @error('to') is-invalid @enderror" id="to" placeholder="e.g: " value="{{ old('to', $to ?? '') }}">
                                        @error("to")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-between">
                                        <input type="submit" name="search" value="Search" class="btn btn-primary" style="width: 190px; margin-top: 1.9rem">
                                        <input type="submit" name="clear" value="Clear" class="btn btn-primary" style="width: 190px; margin-top: 1.9rem">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Expense Reports</div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Date</th>
                                        <th>Account Code</th>
                                        <th>Account Name</th>
                                        <th style="text-align: right;">Amount</th>
                                        <th>Narration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sum = 0; ?>
                                    @forelse ($expenses as $expense)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $expense->transaction_date ?? '' }}</td>
                                        <td>{{ $expense->account_code  ?? '' }}</td>
                                        <td>{{ $expense->account_name ?? '' }}</td>
                                        <td align="right">{{ number_format($expense->expense_amount, 2)  }}</td>
                                        <td>{{ $expense->narration  ?? '' }}</td>
                                    </tr>
                                    <?php $sum += $expense->expense_amount ?>
                                    @empty
                                        {{ __("No Record Found") }}
                                    @endforelse    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align: right;">Total</th>
                                        <th style="text-align: right;">{{ number_format($sum, 2) }}</th>
                                        <th>Narration</th>
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