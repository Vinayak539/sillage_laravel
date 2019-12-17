@extends('layouts.admin-master')
@section('title', 'Edit Question')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Edit Question</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.products.all') }}">All Products</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.product-faqs.edit', $faq->id) }}">Go Back</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Product Name </label>
                            <input class="form-control" value="{{ $faq->product->title }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select Status--</option>
                                <option value="1" {{ $faq->status == true ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $faq->status == false ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question">Question <span class="text-danger">*</span></label>
                            <textarea name="question" id="question" rows="5" class="form-control"
                                required>{{ $faq->question }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="answer">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" id="answer" rows="5" class="form-control"
                                required>{{ $faq->answer }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 text-danger mt-5">
                        Note : All * Mark Fields are Compulsory !
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fas fa-pencil-alt"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection