@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Sale</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Sale</li>
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
                            <h3 class="card-title">Add New Sale</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.sale.store') }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- Product --}}
                                <div class="row mb-4">
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
                                    <div class="col-md-2">
                                        <label for="sales_price" class="form-label">Sale Price (Per Unit) <small class="text-danger">*</small></label>
                                        <input type="number" name="sales_price" id="sales_price" class="form-control @error('sales_price') is-invalid @enderror" placeholder="Sale Price">
                                        @error('sales_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity" class="form-label">Total Quantity <small class="text-danger">*</small></label>
                                        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="total_amount" class="form-label">Total Amount <small class="text-danger">*</small></label>
                                        <input type="number" name="total_amount" id="total_amount" class="form-control @error('total_amount') is-invalid @enderror" placeholder="Total amount">
                                        @error('total_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Sale Related --}}
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <?php $trnx_types = ['Cash', 'Cheque', 'Due', 'Mobile Banking']; ?>
                                        <label for="transaction_type" class="form-label">Transaction Type <small class="text-danger">*</small></label>
                                        <select name="transaction_type" id="transaction_type" class="form-control select2" required>
                                            <option value="">Select a Transaction Type</option>
                                            @foreach ($trnx_types as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('transaction_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="paid_amount" class="form-label">Paid Amount</label>
                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" placeholder="Paid amount">
                                        @error('paid_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Due Sale Related --}}
                                <div class="row mb-4 d-none" id="due_sales_info_row">
                                    <div class="col-md-6">
                                        <label for="due_amount" class="form-label">Due Amount </label>
                                        <input type="number" name="due_amount" id="due_amount" class="form-control @error('due_amount') is-invalid @enderror" placeholder="Due amount">
                                        @error('due_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pay_back_date" class="form-label">Pay Back Date</label>
                                        <input type="date" name="pay_back_date" class="form-control @error('pay_back_date') is-invalid @enderror" id="pay_back_date" placeholder="e.g: Pay Back Date" value="{{ old('pay_back_date') }}">
                                        @error("pay_back_date")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Customer  --}}
                                <div class="row mb-4">

                                    <div class="col-md-12 mb-2">
                                        <label for="new_customer" class="form-label"><input type="checkbox" id="new_customer" name="is_new_customer"> New Customer</label>
                                    </div>

                                    <div class="col-md-12" id="old-customer-fields">
                                        <label for="customer_id" class="form-label">Customer Name <small class="text-danger">*</small></label>
                                        <select name="customer_id" id="customer_id" class="form-control select2">
                                            <option value="">Please select a supplier</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 d-none" id="new-customer-fields">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="customer_name" class="form-label">Customer Name <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" placeholder="Customer Name" value="{{ old('customer_name') }}">
                                                @error('customer_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="customer_mobile" class="form-label">Customer Mobile<small class="text-danger">*</small></label>
                                                <input type="text" class="form-control @error('customer_mobile') is-invalid @enderror" name="customer_mobile" placeholder="Customer Mobile" value="{{ old('customer_mobile') }}">
                                                @error('customer_mobile')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="customer_address" class="form-label">Customer Address</label>
                                                <input type="text" class="form-control @error('customer_address') is-invalid @enderror" name="customer_address" placeholder="Customer Address" value="{{ old('customer_address') }}">
                                                @error('customer_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- Sales Note --}}
                                <div class="row mb-4">                                    
                                    <div class="col-md-12">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" placeholder="Sales Note">{{ old('note') }}</textarea>                                        
                                        @error('note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4 d-none" id="transaction_id_row">
                                    <div class="col-md-12">
                                        <label for="transaction_id" class="form-label">Transaction Id</label>
                                        <input type="number" name="transaction_id" id="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror" placeholder="Transaction ID">
                                        @error('transaction_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_sale" value="Save Sale" class="btn btn-primary" style="width: 200px;">
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

                $('#transaction_type').on('change', function(e){
                    var trx_type = e.target.value;
                    if(trx_type == 'Due'){
                        $('#due_sales_info_row').addClass('d-flex').removeClass('d-none');
                    }else{
                        $('#due_sales_info_row').hide('fast').removeClass('d-flex');
                    }

                    if(trx_type == 'Mobile Banking'){
                        $('#transaction_id_row').addClass('d-flex').removeClass('d-none');
                    }else{
                        $('#transaction_id_row').hide('fast').removeClass('d-flex');
                    }

                });

                $('#new_customer').on('change', function(e){
                    var isChecked = $(this).prop('checked');

                    if(isChecked){
                        $('#old-customer-fields').hide('fast');
                        $('#new-customer-fields').show('fast').removeClass('d-none');
                    }else{
                        $('#new-customer-fields').hide('fast');
                        $('#old-customer-fields').show('fast');
                    }
                })

                $('#product_id').on('change', function(e){
                    var product_id = e.target.value;
                    var route = "{{ route('product.get', 'id') }}";
                        route = route.replace('id', product_id);

                    $.ajax({
                        url: route,
                        type: "GET",
                        success: function(res){
                            console.log(res);
                            if(res.status === 'success'){
                                var product = res.product
                                if(product.total_quantity > 0){
                                    $('#sales_price').val(product.sales_price);
                                }else{
                                    Swal.fire({
                                        'title': 'Not Found!',
                                        'text': 'The product is not in stock',
                                        'icon': 'info',
                                    })
                                }
                            }else{
                                Swal.fire({
                                    'title': 'Not Found!',
                                    'text': 'There is no product for this specific id',
                                    'icon': 'info',
                                })
                            }
                        },
                        error: function(err){
                            Swal.fire({
                                'title': err.statusText,
                                'text': 'Sorry! There is some problem',
                                'icon': 'error',
                            })
                        }
                    })

                })

                $('#quantity').on('change', function(e){
                    var quantity = e.target.value;
                    var sales_price = $('#sales_price').val();
                    var total_amount = quantity * sales_price;
                    
                    $('#total_amount').val(total_amount);
                })
            });

            $('.select2').select2();
        })(jQuery);
    </script>
@endpush