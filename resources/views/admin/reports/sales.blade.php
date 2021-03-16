@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Sales Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
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
                            <form action="{{ route('admin.report.sales') }}" method="POST">
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
                                        <label for="customer_id" class="form-label">Customer Name</label>
                                        <select name="customer_id" id="customer_id" class="form-control select2">
                                            <option value="0">All</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == ($customer_id ?? '') ? 'selected' : '' }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error("customer_id")
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
                        <div class="card-header">Sales Reports</div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Transaction Type</th>
                                        <th>Product Name</th>
                                        <th>Total Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Gross Amount</th>
                                        <th>Discount Amount</th>
                                        <th>Net Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $gross_amount = 0; 
                                        $discount_amount = 0; 
                                        $net_amount = 0; 
                                        $paid_amount = 0; 
                                        $due_amount = 0; 
                                    ?>
                                    @forelse ($sales as $sale)
                                        @if($sale->products->isNotEmpty())
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sale->created_at ?? '' }}</td>                                            
                                            <td>{{ $sale->customer->name  ?? '' }}</td>
                                            <td>{{ $sale->sales_type  ?? '' }}</td>
                                            <td class="p-0">
                                                <table class="table table-bordered">
                                                    @foreach($sale->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td align="right" class="p-0">
                                                <table class="table table-bordered mb-0">
                                                    @foreach($sale->products as $product)
                                                    <tr>
                                                        <td>{{ $product->pivot->quantity }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td align="right" class="p-0">
                                                <table class="table table-bordered mb-0">
                                                    @foreach($sale->products as $product)
                                                    <tr>
                                                        <td>{{ $product->pivot->total_amount }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td align="right">{{ number_format($sale->gross_amount, 2)  ?? '' }}</td>
                                            <td align="right">{{ number_format($sale->discount_amount, 2)  ?? 0 }}</td>

                                            <td align="right">{{ number_format($sale->net_amount, 2)  ?? 0 }}</td>
                                            <td align="right">{{ number_format($sale->paid_amount, 2)  ?? 0 }}</td>
                                            <td align="right">{{ number_format($sale->due_amount, 2)  ?? 0 }}</td>
                                        </tr>
                                        <?php 
                                            $gross_amount += $sale->gross_amount; 
                                            $discount_amount += $sale->discount_amount; 
                                            $net_amount += $sale->net_amount; 
                                            $paid_amount += $sale->paid_amount; 
                                            $due_amount += $sale->due_amount; 
                                        ?>
                                        @endif
                                    @empty
                                        {{ __("No Record Found") }}
                                    @endforelse    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" style="text-align: right;">Total</th>
                                        <th style="text-align: right;">{{ number_format($gross_amount, 2) }}</th>
                                        <th style="text-align: right;">{{ number_format($discount_amount, 2) }}</th>
                                        <th style="text-align: right;">{{ number_format($net_amount, 2) }}</th>
                                        <th style="text-align: right;">{{ number_format($paid_amount, 2) }}</th>
                                        <th style="text-align: right;">{{ number_format($due_amount, 2) }}</th>
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