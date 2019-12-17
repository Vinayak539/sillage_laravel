@extends('layouts.admin-master')
@section('title', 'Customer Reviews')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Customer Reviews</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.users.all') }}">All Customers</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.reviews.all') }}">All Reviews</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.users.all') }}">Go Back</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 bg-white pt-20">
                <h2 class="text-dark mb-30">Customer Information</h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $user->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>Landmark</th>
                            <td>{{ $user->landmark }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $user->city }}</td>
                        </tr>
                        <tr>
                            <th>Territory</th>
                            <td>{{ $user->territory }}</td>
                        </tr>
                        <tr>
                            <th>Pincode</th>
                            <td>{{ $user->pincode }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 bg-white pt-20">
                <h2 class="text-dark mb-30">Reviews Information</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Product Name</th>
                            <th>Rating</th>
                            <th>Verified</th>
                            <th>Status</th>
                            <th>Reviewed On</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        @forelse ($user->reviews as $review)
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
                            <td>{{ $review->product->title }}</td>
                            <td>
                                @for($i = 1; $i<= $review->rating; $i++)
                                    <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i = 1; $i<= 5 - $review->rating; $i++)
                                        <i class="fa fa-star-o"></i>
                                        @endfor
                            </td>
                            <td>
                                {{ $review->verified == true ? 'Yes' : 'No' }}
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

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Product Name</th>
                            <th>Rating</th>
                            <th>Verified</th>
                            <th>Status</th>
                            <th>Reviewed On</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection
