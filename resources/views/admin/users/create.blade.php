@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create User</li>
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
                            <h3 class="card-title">Add New User</h3>
                        </div>                    
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" class="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="first_name" class="form-label">First Name <small class="text-danger">*</small></label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="e.g: Jhon" value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name" class="form-label">Last Name <small class="text-danger">*</small></label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="e.g: Doe" value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4">
                                        <label for="username" class="form-label">User Name <small class="text-danger">*</small></label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="e.g: jhondoe" value="{{ old('username') }}" required>
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="e.g: jhon@mail.com" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mobile" class="form-label">Mobile No</label>
                                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="e.g: 01xxxxxxxxx" value="{{ old('mobile') }}">
                                        @error('mobile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password" class="form-label">Password <small class="text-danger">*</small></label>
                                        <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="e.g: ******" value="" required>
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label for="user_type" class="form-label">User Type <small class="text-danger">*</small></label>
                                        <input type="text" name="user_type" class="form-control @error('user_type') is-invalid @enderror" id="user_type" placeholder="e.g: employee" value="{{ old('user_type') }}" required>
                                        @error('user_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>
                                    <div class="col-md-4">
                                        <label for="birthdate" class="form-label">Birthdate</label>
                                        <input type="text" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" value="{{ old('birthdate') }}" placeholder="DD-MM-YYYY">
                                        @error('birthdate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <?php $gender_lists = [ 'male' => 'Male', 'female' => 'Female', 'others' => 'Others' ]; ?>
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="custom-select @error('gender') is-invalid @enderror">
                                            <option value="">Please Select Gender</option>
                                            @foreach ($gender_lists as $key => $gender)
                                                <option value="{{ $key }}" {{ $key === old('gender') ? 'selected' : '' }}>{{ $gender }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" id="country" placeholder="e.g: Bangladesh" value="{{ old('country') }}">
                                        @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="e.g: Chattogram" value="{{ old('city') }}">
                                        @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" name="save_user" value="Save User" class="btn btn-primary" style="width: 200px;">
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
