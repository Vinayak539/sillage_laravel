@extends('layouts.admin-master')
@section('title', 'Update Contact Detail')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Update Contact Detail</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.contacts.all') }}">Manage Contact Detail</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form method="post" class="needs-validation">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email ID"
                            value="{{ $contact->email }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $contact->mobile }}"
                            placeholder="Enter Mobile Number">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Address<span class="text-danger">*</span></label>
                        <textarea name="address" id="address" rows="5" class="form-control"
                            placeholder="Enter Address">{{ $contact->address }}</textarea>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fas fa-pencil-alt"></i> Update
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection