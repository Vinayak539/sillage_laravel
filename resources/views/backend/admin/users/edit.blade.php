@extends('layouts.admin-master')
@section('title', 'Update User Detail')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Update User Detail</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.users.all') }}">Manage Users</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body">
        <form method="post" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" value="{{ $user->name }}" disabled readonly>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email ID</label>
                        <input class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">--Select--</option>
                            <option value="1" {{ $user->status == true ? 'selected': '' }}>Active</option>
                            <option value="0" {{ $user->status == false ? 'selected': '' }}>Block
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit"> <i class="fas fa-pencil-alt"></i>
                        Update</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection