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

            {{-- @if($errors->any())
            <div class="row mb-2">
                <div class="col-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Sale</h3>            5
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.sale.store') }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- Product --}}
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label for="product_id" class="form-label">Product Name <small class="text-danger">*</small></label>
                                        <select name="product_id" id="product_id" class="form-control select2" multiple>
                                            <option value="">Please select a product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
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
                                        <input type="number" name="sales_price" value="{{ old('sales_price') }}" id="sales_price" class="form-control @error('sales_price') is-invalid @enderror" placeholder="Sale Price" min="0">
                                        @error('sales_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="quantity" class="form-label">Total Quantity <small class="text-danger">*</small></label>
                                        <input type="number" name="quantity" value="{{ old('quantity') }}" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity" min="0">
                                        @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="total_amount" class="form-label">Total Amount <small class="text-danger">*</small></label>
                                        <input type="number" name="total_amount" value="{{ old('total_amount') }}" id="total_amount" class="form-control @error('total_amount') is-invalid @enderror" placeholder="Total amount" min="0">
                                        @error('total_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="" class="form-label"></label>
                                        <button class="btn btn-primary mt-4"><i class="fa fa-plus"></i></button>
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
                                                <option value="{{ $type }}" {{ old('transaction_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
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
                                        <input type="number" name="paid_amount" value="{{ old('paid_amount') }}" id="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" placeholder="Paid amount" min="0">
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
                                        <input type="number" name="due_amount" id="due_amount" value="{{ old('due_amount') }}" class="form-control @error('due_amount') is-invalid @enderror" placeholder="Due amount" min="0" readonly>
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
                                        <label for="is_new_customer" class="form-label"><input type="checkbox" id="is_new_customer" name="is_new_customer" {{ !empty(old('is_new_customer')) ? 'checked' : '' }}> New Customer</label>
                                    </div>

                                    <div class="col-md-12" id="old-customer-fields">
                                        <label for="customer_id" class="form-label">Customer Name <small class="text-danger">*</small></label>
                                        <select name="customer_id" id="customer_id" class="form-control select2">
                                            <option value="">Please select a supplier</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') === $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
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
                                        <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}" class="form-control @error('transaction_id') is-invalid @enderror" placeholder="Transaction ID">
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

                });

                function showCustomerFields(ele){
                    var isChecked = $(ele).prop('checked');
                    if(isChecked){
                        $('#old-customer-fields').hide('fast');
                        $('#new-customer-fields').show('fast').removeClass('d-none');
                    }else{
                        $('#new-customer-fields').hide('fast');
                        $('#old-customer-fields').show('fast');
                    }
                }

                function showDueFields(ele){
                    var trx_type = $(ele).val();

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
                }

                showCustomerFields('#is_new_customer');
                showDueFields("#transaction_type");

                $('#transaction_type').on('change', function(e){
                   showDueFields("#transaction_type");
                });

                $('#is_new_customer').on('change', function(e){
                    showCustomerFields('#is_new_customer');
                });

                $('#quantity').on('change', function(e){
                    var quantity = e.target.value;
                    var sales_price = $('#sales_price').val();
                    var total_amount = quantity * sales_price;
                    
                    $('#total_amount').val(total_amount);
                });

                $("#paid_amount").on('change', function (e) {

                    var paid_amount = e.target.value;
                    var total_amount = $('#total_amount').val();

                    if (paid_amount > total_amount) {

                        Swal.fire({
                            'title': 'Wrong Input!',
                            'text': 'You enter greater amount than total amount',
                            'icon': 'info',
                        });

                        $(this).val('');
                        $("#due_amount").val('');

                    }else{
                        var trx_type = $("#transaction_type option:selected").val();
                        if(trx_type == 'Due'){
                            var due_amount = total_amount - paid_amount;
                            $("#due_amount").val(due_amount);
                        }
                    }

                })
            });

            $('.select2').select2();
        })(jQuery);
    </script>
@endpush