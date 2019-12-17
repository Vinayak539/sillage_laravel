@extends('layouts.admin-master')
@section('title', 'Add User')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Add User</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form method="post" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_type">Select User Type <span class="text-danger">*</span></label>
                        <select name="user_type" id="user_type" class="form-control" required>
                            <option value="">--Select User Type--</option>
                            <option value="admin" {{ old('user_type') == 'admin' ? 'selected': '' }}>Admin</option>
                            <option value="manager" {{ old('user_type') == 'manager' ? 'selected': '' }}>Manager
                            </option>
                            <option value="logistic" {{ old('user_type') == 'logistic' ? 'selected': '' }}>Logistic
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Enter Name" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Enter Email ID" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            value="{{ old('password') }}" placeholder="Enter Password" required>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit"> <i class="fas fa-pencil-alt"></i>
                        Add</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection