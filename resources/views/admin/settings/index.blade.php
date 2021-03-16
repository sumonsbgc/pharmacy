@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Setting Lists</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.settings.save') }}" class="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Company Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="e.g: Jhon Pharmacy" value="{{ old('name', $option->get('name') ) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label for="logo" class="form-label">Company Logo</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" placeholder="e.g: Upload Company Logo" value="{{ old('logo') }}">
                                        @error('logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ Storage::url($option->get('logo')) }}" alt="" class="img-fluid">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Profit Margin</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="profit_margin" class="form-control @error('profit_margin') is-invalid @enderror" id="profit_margin" placeholder="e.g: 10%" value="{{ old('profit_margin', $option->get('profit_margin') ) }}">
                                        @error('profit_margin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_settings" value="Save Settings" class="btn btn-primary" style="width: 200px;">
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
