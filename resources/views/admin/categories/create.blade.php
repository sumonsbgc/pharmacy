@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.category.store') }}" class="row justify-content-center" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Category</h3>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Category Name <small class="text-danger">*</small></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="e.g: Syrup" value="{{ old( 'name' ) }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label for="parent_category" class="form-label">Parent Category</label>
                                        <select name="parent_category" id="parent_category" class="form-control">
                                            <option value="">Please Select Parent Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_category" value="Save Category" class="btn btn-primary" style="width: 200px;">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
