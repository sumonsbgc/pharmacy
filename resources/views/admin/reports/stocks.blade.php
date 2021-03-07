@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Stock Reports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Stock Report</li>
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
                            <form action="{{ route('admin.report.stock') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="product_id" class="form-label">Product Name</label>
                                        <select name="product_id[]" id="product_id" class="form-control select2" multiple>
                                            <option value="">All</option>
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
                                        <label for="brand_id" class="form-label">Brand Name</label>
                                        <select name="brand_id[]" id="brand_id" class="form-control select2" multiple>
                                            <option value="">All</option>
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
                                        <select name="category_id[]" id="category_id" class="form-control select2" multiple>
                                            <option value="">All</option>
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
                                    <div class="col-md-3">
                                        <label for="supplier_id" class="form-label">Supplier Name</label>
                                        <select name="supplier_id[]" id="supplier_id" class="form-control select2" multiple>
                                            <option value="0">All</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}" {{ in_array($supplier->id, ( $supplier_id ?? [] )) ? 'selected' : '' }}>{{ $supplier->name }}</option>
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
                                    <div class="col-md-2 d-flex justify-content-between">
                                        <input type="submit" name="search" value="Search" class="btn btn-primary" style="width: 120px; margin-top: 1.9rem">
                                        <input type="submit" name="clear" value="Clear" class="btn btn-primary" style="width: 120px; margin-top: 1.9rem">
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
                        <div class="card-header">Stock Reports</div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Product Brand</th>
                                        <th>Product Quantity</th>
                                        <th>Product Expiry Date</th>
                                        <th>Product SKU</th>
                                        <th>Purchase Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sum = 0; ?>
                                    @forelse ($stocks as $stock)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $stock->name ?? '' }}</td>
                                        <td>{{ $stock->category->name ?? '' }}</td>
                                        <td>{{ $stock->brand->name ?? '' }}</td>
                                        <td>{{ $stock->total_quantity }}</td>
                                        <td>{{ $stock->expiry_date ?? '' }}</td>
                                        <td>{{ $stock->sku ?? '-' }}</td>
                                        <td align="right">{{ number_format($stock->purchases->last()->unit_price * ( $stock->total_quantity ?? 0 ), 2) ?? '-' }}</td>
                                    </tr>
                                    <?php $sum += $stock->purchases->last()->unit_price * ( $stock->total_quantity ?? 0 ); ?>
                                    @empty
                                        {{ __("No Product Found") }}
                                    @endforelse    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" style="text-align: right;">Total</th>
                                        <th style="text-align: right;">{{ number_format($sum, 2) }}</th>
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

@push('script')
<script>
    $('.select2').select2();
</script>
@endpush

{{-- Opening Stock:
    Last day of Month Closing Stock

Closing Stock:
    => Opening Stock + Whole Months Purchase - Current Month Total Sale --}}


{{-- tbl_stock
    id
    porudct_id
    opening_stock
    closing_stock
    date --}}
