@extends('layouts.admin-master')
@section('title', 'Update Review')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Update Review</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.reviews.all') }}">Manage Reviews</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body">
        <form method="post" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input value="{{ $review->email }}" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="product_id">
                            Product <span class="text-danger">*</span>
                        </label>
                        <select name="product_id" id="product_id" class="form-control">
                            <option value="">--Select Product</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $product->id == $review->product_id ? 'selected' : '' }}>
                                {{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $review->name }}"
                            placeholder="Enter Customer Name" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="review_date">Review Date <span class="text-danger">*</span></label>
                        <input type="date" name="review_date" id="review_date" class="form-control"
                            placeholder="dd-mm-yyyy" value="{{ date('Y-m-d', strtotime($review->created_at)) }}"
                            required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Rating <span class="text-danger">*</span></label>
                        <div class="starability-grow">
                            <input type="radio" id="growing-rate1" class="star" name="rating" checked value="1"
                                {{ $review->rating== 1 ? 'checked' : ''}}>
                            <label for="growing-rate1" title="Terrible">1 star</label>

                            <input type="radio" id="growing-rate2" class="star" name="rating" value="2"
                                {{ $review->rating== 2 ? 'checked' : ''}}>
                            <label for="growing-rate2" title="Not good">2 stars</label>

                            <input type="radio" id="growing-rate3" class="star" name="rating" value="3"
                                {{ $review->rating== 3 ? 'checked' : ''}}>
                            <label for="growing-rate3" title="Average">3 stars</label>

                            <input type="radio" id="growing-rate4" class="star" name="rating" value="4"
                                {{ $review->rating== 4 ? 'checked' : ''}}>
                            <label for="growing-rate4" title="Very good">4 stars</label>

                            <input type="radio" id="growing-rate5" class="star" name="rating" value="5"
                                {{ $review->rating== 5 ? 'checked' : ''}}>
                            <label for="growing-rate5" title="Amazing">5 stars</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="">--Select--</option>
                            <option value="1" {{ $review->status == true ? 'selected': '' }}>Active</option>
                            <option value="0" {{ $review->status == false ? 'selected': '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="comment">Write your Review <span class="text-danger">*</span></label>
                        <textarea name="comment" id="comment" rows="5" class="form-control"
                            placeholder="Please Write Something..." required>{{ $review->comment }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Profile Photo</label>
                        <div>
                            @if ($review->image_url)
                            <img src="/storage/images/reviews/{{ $review->image_url }}" alt="{{ $review->name }}"
                                class="img img-responsive img-thumbnail" width="120px">
                            @else
                            <div class="review-alpha">
                                <h1>{{ strtoupper(substr($review->name,0,2)) }}</h1>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="email" value="{{ $review->email }}">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit"> <i class="fas fa-pencil-alt"></i>
                        Update</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection