@extends('layouts.admin-master')
@section('title', 'Manage Reviews')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Add Review</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_id">Product <span class="text-danger">*</span></label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="">--Select Product--</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                    placeholder="Enter Customer Name" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rating <span class="text-danger">*</span></label>
                                <div class="starability-grow">
                                    <input type="radio" id="growing-rate1" class="star" name="rating" checked value="1"
                                        {{old('rating')== 1 ? 'checked' : ''}}>
                                    <label for="growing-rate1" title="Terrible">1 star</label>

                                    <input type="radio" id="growing-rate2" class="star" name="rating" value="2"
                                        {{old('rating')== 2 ? 'checked' : ''}}>
                                    <label for="growing-rate2" title="Not good">2 stars</label>

                                    <input type="radio" id="growing-rate3" class="star" name="rating" value="3"
                                        {{old('rating')== 3 ? 'checked' : ''}}>
                                    <label for="growing-rate3" title="Average">3 stars</label>

                                    <input type="radio" id="growing-rate4" class="star" name="rating" value="4"
                                        {{old('rating')== 4 ? 'checked' : ''}}>
                                    <label for="growing-rate4" title="Very good">4 stars</label>

                                    <input type="radio" id="growing-rate5" class="star" name="rating" value="5"
                                        {{old('rating')== 5 ? 'checked' : ''}}>
                                    <label for="growing-rate5" title="Amazing">5 stars</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="review_date">Review Date <span class="text-danger">*</span></label>
                                <input type="date" name="review_date" id="review_date" class="form-control"
                                    placeholder="dd-mm-yyyy" value="{{ old('review_date') }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Write your Review <span class="text-danger">*</span></label>
                                <textarea name="comment" id="comment" rows="5" class="form-control"
                                    placeholder="Please Write Something..." required>{{ old('comment') }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Reviews</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal">Add Review</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Product Name</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Reviewed On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>
                            @if ($review->image_url)
                            <img src="/storage/images/reviews/{{ $review->image_url }}" alt="{{ $review->name }}"
                                class="img img-responsive img-circle" width="40px" height="40px" loading="lazy">
                            @else
                            <div class="review-alpha1">
                                <h3>{{ strtoupper(substr($review->name,0,2)) }}</h3>
                            </div>
                            @endif
                        </td>
                        <td>{{ $review->name }}</td>
                        <td>{{ str_limit($review->product->title, 20) }}</td>
                        <td>
                            @for($i = 1; $i<= $review->rating; $i++)
                                <i class="fa fa-star"></i>
                                @endfor
                                @for($i = 1; $i<= 5 - $review->rating; $i++)
                                    <i class="fa fa-star-o"></i>
                                    @endfor
                        </td>
                        <td>
                            {{ $review->status == true ? 'Active' : 'Blocked' }}
                        </td>
                        <td>{{ date('d-M-Y', strtotime($review->created_at)) }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.reviews.edit', $review->id) }}" class="dropdown-item"
                                        title="Edit Detail">
                                        <i class="fa fa-edit text-primary"></i> Edit
                                    </a>
                                    <button type="button" data-role="delete-obj" data-obj-id="{{$review->id}}"
                                        class="dropdown-item delete-object" title="Delete Review">
                                        <i class="fa fa-trash text-danger"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td class="text-danger" colspan="9">
                            <h4>No Record Found..</h4>
                        </td>
                    </tr>
                    @endforelse
                    <tr class="text-center">
                        <td colspan="9">
                            {{ $reviews->links() }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Product Name</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Reviewed On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
<form id="formDelete" method="POST" action="/adrana951/manage-reviews/delete/">
    @csrf
</form>

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm(
                    "Are you sure, You want to Delete? ")) {
                var action = $("#formDelete").attr("action") + $(this).attr("data-obj-id");
                $("#formDelete").attr("action", action);
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });
    });

</script>
@endsection