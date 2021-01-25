@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product->id ) }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Product Name <small class="text-danger">*</small></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="e.g: Gmax" value="{{ old('name', $product->name) }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label for="brand" class="form-label">Brand <small class="text-danger">*</small></label>
                                        <select name="brand" id="brand" class="custom-select @error('brand') is-invalid @enderror" required>
                                            <option value="">Please Select brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id === old('brand', $product->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="category" class="form-label">Category <small class="text-danger">*</small></label>
                                        <select name="category" id="category" class="custom-select @error('category') is-invalid @enderror" required>
                                            <option value="">Please Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id === old('category', $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sku" class="form-label">Product Sku</label>
                                        <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku" placeholder="e.g: AXIR343GE" value="{{ old('sku', $product->sku) }}">
                                        @error("sku")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label for="barcode" class="form-label">Product barcode</label>
                                        <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" id="barcode" placeholder="e.g: barcode" value="{{ old('barcode', $product->barcode) }}">
                                        @error("barcode")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="unit" class="form-label">Product Unit</label>
                                        <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="e.g: unit" value="{{ old('unit', $product->unit) }}">
                                        @error("unit")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label for="total_quantity" class="form-label">Total Quantity <small class="text-danger">*</small></label>
                                        <input type="text" name="total_quantity" class="form-control @error('total_quantity') is-invalid @enderror" id="total_quantity" placeholder="e.g: Total Quantity" value="{{ old('total_quantity', $product->total_quantity) }}" required>
                                        @error("total_quantity")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="total_price" class="form-label">Total Price <small class="text-danger">*</small></label>
                                        <input type="text" name="total_price" class="form-control @error('total_price') is-invalid @enderror" id="total_price" placeholder="e.g: Total Price" value="{{ old('total_price', $product->total_price) }}" required>
                                        @error("total_price")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="unit_price" class="form-label">Unit Price <small class="text-danger">*</small></label>
                                        <input type="text" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" placeholder="e.g: Unit Price" value="{{ old('unit_price', $product->unit_price) }}" required>
                                        @error("unit_price")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label for="sales_price" class="form-label">Sales Price <small class="text-danger">*</small></label>
                                        <input type="text" name="sales_price" class="form-control @error('sales_price') is-invalid @enderror" id="sales_price" placeholder="e.g: Sale Price" value="{{ old('sales_price', $product->sales_price) }}" required>
                                        @error("sales_price")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="thumbnail" class="form-label">Product Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail">
                                        @error("thumbnail")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="status" class="form-label">Status <small class="text-danger">*</small></label>
                                        <?php $status = ['Pending', 'Draft', 'Publish']; ?>
                                        <select name="status" id="status" class="custom-select @error('status') is-invalid @enderror" required>
                                            <option value="">Please Select Status</option>
                                            @foreach ($status as  $stat)
                                                <option value="{{ $stat }}" {{ $stat === old('status', $product->status) ? 'selected' : '' }}>{{ $stat }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="update_product" value="Update Product" class="btn btn-primary" style="width: 200px;">
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
                
                $('#total_quantity').on('change', function(e){                    
                    var total_quantity = e.target.value;
                    var total_price = $('#total_price').val();
                    
                    $(this).val(total_quantity);
                    
                    if(total_price){
                        var unit_price = total_price /total_quantity;
                        $('#unit_price').val(unit_price);
                    }

                });

                $('#total_price').on('change', function(e){
                    var total_price = e.target.value;
                    var total_quantity = $('#total_quantity').val();
                    var unit_price = total_price / total_quantity

                    $('#unit_price').val(unit_price);
                })
            });
        })(jQuery);
    </script>
@endpush