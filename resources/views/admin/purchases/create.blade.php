@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Purchase</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Purchase</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Purchase</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.purchase.store') }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="product_id" class="form-label">Product Name <small class="text-danger">*</small></label>
                                        <select name="product_id" id="product_id" class="form-control select2">
                                            <option value="">Please select a product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="supplier_id" class="form-label">Supplier Name <small class="text-danger">*</small></label>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                                            <option value="">Please select a supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="transaction_type" class="form-label">Transaction Type</label>
                                        <input type="text" name="transaction_type" class="form-control @error('transaction_type') is-invalid @enderror" id="transaction_type" placeholder="e.g: Cash/Due/Cheque" value="{{ old('transaction_type') }}">
                                        @error("transaction_type")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-3">
                                        <label for="unit" class="form-label">Unit</label>
                                        <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="e.g: Pieces/Packet/Package" value="{{ old('unit') }}">
                                        @error("unit")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="total_quantity" class="form-label">Total Quantity</label>
                                        <input type="number" name="total_quantity" class="form-control @error('total_quantity') is-invalid @enderror" id="total_quantity" placeholder="e.g: Total Quantity" value="{{ old('total_quantity') }}">
                                        @error("total_quantity")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="total_amount" class="form-label">Total Amount</label>
                                        <input type="number" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" id="total_amount" placeholder="e.g: Total Amount" value="{{ old('total_amount') }}">
                                        @error("total_amount")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unit_price" class="form-label">Unit Price</label>
                                        <input type="number" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" placeholder="e.g: Unit Price" value="{{ old('unit_price') }}">
                                        @error("unit_price")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label for="paid_amount" class="form-label">Paid Amount</label>
                                        <input type="number" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" id="paid_amount" placeholder="e.g: Paid Amount" value="{{ old('paid_amount') }}">
                                        @error("paid_amount")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="due_amount" class="form-label">Due Amount</label>
                                        <input type="number" name="due_amount" class="form-control @error('due_amount') is-invalid @enderror" id="due_amount" placeholder="e.g: Due Amount" value="{{ old('due_amount') }}">
                                        @error("due_amount")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="due_paid_date" class="form-label">Due Paid Date</label>
                                        <input type="date" name="due_paid_date" class="form-control @error('due_paid_date') is-invalid @enderror" id="due_paid_date" placeholder="e.g: Due Paid Date" value="{{ old('due_paid_date') }}">
                                        @error("due_paid_date")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="purchase_date" class="form-label">Purchase Date</label>
                                        <input type="date" name="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" placeholder="e.g: Due Paid Date" value="{{ old('purchase_date') }}">
                                        @error("purchase_date")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_purchase" value="Save Purchase" class="btn btn-primary" style="width: 200px;">
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
@push('script')
    <script>
        ;(function($){
            $(document).ready(function(){
                $('#total_amount').on('change', function(e){
                    var total_price = e.target.value;
                    var total_quantity = $('#total_quantity').val();
                    var unit_price = total_price / total_quantity

                    $('#unit_price').val(unit_price.toFixed(2));
                })
            });
            $('.select2').select2();
        })(jQuery);
    </script>
@endpush