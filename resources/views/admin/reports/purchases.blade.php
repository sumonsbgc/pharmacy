@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Purchase Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Purchase Report</li>
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
                            <form action="{{ route('admin.report.purchase') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="product_id" class="form-label">Product Name</label>
                                        <select name="product_id" id="product_id" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ $product->id == ($product_id ?? '') ? 'selected' : '' }}>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
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
                                    <div class="col-md-3">
                                        <label for="supplier_id" class="form-label">Supplier Name</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}" {{ $supplier->id == ($supplier_id ?? '') ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("supplier_id")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <?php $status = ['Cash', 'Due', 'Cheque'];?>
                                        <select name="status" id="status" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($status as $st)
                                                <option value="{{ $st }}" {{ $st == ($oldStatus ?? '') ? 'selected' : '' }}>{{ $st }}</option>
                                            @endforeach
                                        </select>
                                        @error("supplier_id")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="brand_id" class="form-label">Brand Name</label>
                                        <select name="brand_id" id="brand_id" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id == ($brand_id ?? '') ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="category_id" class="form-label">Category Name</label>
                                        <select name="category_id" id="category_id" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == ($category_id ?? '') ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-between">
                                        <input type="submit" name="search" value="Search" class="btn btn-primary" style="width: 120px; margin-top: 1.9rem">
                                        <input type="submit" name="clear" value="Clear" class="btn btn-primary" style="width: 120px; margin-top: 1.9rem">
                                    </div>
                                </div>
                                {{-- <div class="row justify-content-end">
                                    
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Purchase Reports</div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>Supplier Name</th>
                                        <th>Transaction Type</th>
                                        <th>Total Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Due Paid Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_amount = 0; 
                                        $paid_amount = 0; 
                                        $due_amount = 0; 
                                    ?>
                                    @forelse ($purchases as $purchase)                                    
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $purchase->purchase_date ?? '' }}</td>
                                        <td>{{ $purchase->product->name  ?? '' }}</td>
                                        <td>{{ $purchase->supplier->name  ?? '' }}</td>
                                        <td>{{ $purchase->transaction_type  ?? '' }}</td>
                                        <td align="right">{{ $purchase->total_quantity  ?? '' }}</td>
                                        <td align="right">{{ number_format($purchase->total_amount, 2)  ?? '' }}</td>
                                        <td align="right">{{ number_format($purchase->paid_amount, 2)  ?? 0 }}</td>
                                        <td align="right">{{ number_format($purchase->due_amount, 2)  ?? 0 }}</td>
                                        <td>{{ $purchase->due_paid_date  ?? '' }}</td>
                                    </tr>
                                    <?php 
                                        $total_amount += $purchase->total_amount; 
                                        $paid_amount += $purchase->paid_amount; 
                                        $due_amount += $purchase->due_amount; 
                                    ?>
                                    @empty
                                        {{ __("No Record Found") }}
                                    @endforelse    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">Total</th>
                                        <th style="text-align: right;">{{ number_format($total_amount, 2) }}</th>
                                        <th style="text-align: right;">{{ number_format($paid_amount, 2) }}</th>
                                        <th style="text-align: right;">{{ number_format($due_amount, 2) }}</th>
                                        <th>Due Paid Date</th>
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