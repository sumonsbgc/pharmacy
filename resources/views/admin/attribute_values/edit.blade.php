@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Attribute Values</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Attribute Values</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.attribute_value.update', $value->id) }}" class="row justify-content-center" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Attribute Value</h3>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value" class="form-label">Attribute Name <small class="text-danger">*</small></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="value" placeholder="e.g: 250" value="{{ old( 'name', $value->attribute->name ) }}" required>
                                        <input type="hidden" name="attribute_id" value="{{ $value->attribute->id }}">
                                        @error('value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value" class="form-label">Attribute Value Name <small class="text-danger">*</small></label>
                                        <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" id="value" placeholder="e.g: 250" value="{{ old( 'value', $value->value ) }}" required>
                                        @error('value')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="update_value" value="Update Attribute Value" class="btn btn-primary" style="width: 200px;">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
