@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Receipt</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Receipt</li>
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
                            <h3 class="card-title">Edit Receipt</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.receipt.update', $receipt->id) }}" class="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="customer_id" class="form-label">Customer Name <small class="text-danger">*</small></label>
                                        <select name="customer_id" id="customer_id" class="select2 form-control" width="100%" >
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}"  {{ $customer->id == old('customer_id', $receipt->customer->id) ? 'selected' : '' }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="receipt_title" class="form-label">Receipt Title <small class="text-danger">*</small></label>
                                        <input type="text" name="receipt_title" class="form-control @error('receipt_title') is-invalid @enderror" id="receipt_title" placeholder="e.g: Outstanding Sales" value="{{ old('receipt_title', $receipt->receipt_title) }}" required>
                                        @error('receipt_title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="amount" class="form-label">Receipt Amount</label>
                                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" placeholder="e.g: 10000" value="{{ old('amount', $receipt->amount) }}">
                                        @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_receipt" value="Save Receipt" class="btn btn-primary" style="width: 200px;">
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
