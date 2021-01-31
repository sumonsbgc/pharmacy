@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Products</li>
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
                            <h3 class="card-title">All Product List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->total_quantity }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td width="300px">
                                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-info btn-edit" title="EDIT"><i class="fas fa-edit"></i></a>                                            
                                                <a href="{{ route('admin.product.trash', $product->id) }}" class="btn btn-warning btn-trash" title="TRASH" onclick="event.preventDefault(); document.getElementById('trash-product-{{$product->id}}').submit();">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                                <form id="trash-product-{{ $product->id }}" action="{{ route('admin.product.trash', $product->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                
                                                <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger btn-delete" title="DELETE" onclick="event.preventDefault(); document.getElementById('delete-product-{{$product->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="delete-product-{{ $product->id }}" action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            @if($trashedProducts->isNotEmpty())
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Trash Product List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashedProducts as $product)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->total_quantity }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td width="300px">
                                                <a href="{{ route('admin.product.restore', $product->id) }}" class="btn btn-info btn-edit" title="RE STORE"><i class="fas fa-plus"></i></a>                                                                                        
                                                <a href="{{ route('admin.product.remove', $product->id) }}" class="btn btn-danger btn-delete" title="DELETE" onclick="event.preventDefault(); document.getElementById('remove-product-{{$product->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <form id="remove-product-{{ $product->id }}" action="{{ route('admin.product.remove', $product->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
