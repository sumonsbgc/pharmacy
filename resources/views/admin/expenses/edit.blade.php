@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Expense</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Expense</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Expense</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.expense.update', $expense->id) }}" class="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="account_name" class="form-label">Account Name <small class="text-danger">*</small></label>
                                        <input type="text" name="account_name" class="form-control @error('account_name') is-invalid @enderror" id="account_name" placeholder="Expense Title" value="{{ old('account_name', $expense->account_name) }}" required>
                                        @error('account_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="account_code" class="form-label">Account Code</label>
                                        <input type="text" name="account_code" class="form-control @error('account_code') is-invalid @enderror" id="account_code" placeholder="e.g: jhon@mail.com" value="{{ old('account_code', $expense->account_code) }}">
                                        @error('account_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="expense_amount" class="form-label">Expense Amount <small class="text-danger">*</small></label>
                                        <input type="number" name="expense_amount" class="form-control @error('expense_amount') is-invalid @enderror" id="expense_amount" placeholder="e.g: 1000" value="{{ old('expense_amount', $expense->expense_amount) }}" required>
                                        @error('expense_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="transaction_date" class="form-label">Transaction Date <small class="text-danger">*</small></label>
                                        <input type="text" name="transaction_date" id="transaction_date" class="form-control @error('narration') is-invalid @enderror" value="{{old('transaction_date', \Carbon\Carbon::create($expense->transaction_date)->format('d-m-Y') )}}" required>
                                        @error('narration')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="narration" class="form-label">Expense Narration</label>
                                        <textarea name="narration" id="narration" class="form-control @error('narration') is-invalid @enderror">{{old('narration', $expense->narration)}}</textarea>
                                        @error('narration')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_expense" value="Save Expense" class="btn btn-primary" style="width: 200px;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
