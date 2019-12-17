@extends('layouts.admin-master')
@section('title', 'Customer Details')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Customer Details</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.users.all') }}">All Users</a>
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
                            <th>Image</th>
                            <td>
                                @if($user->image_url)
                                <img src="/storage/images/users/{{ $user->image_url }}" alt="{{ $user->name }}"
                                    width="40" class="img-responsive img-circle">
                                @else

                                <img src="/admin/assets/images/admin2.png" alt="{{ $user->name }}"
                                    class="img-responsive img-circle" width="40">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Customer ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
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
                            <th>Date of Birth</th>
                            <td>{{ $user->date_of_birth }}</td>
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
                        <tr>
                            <th>Status</th>
                            <td>{{ $user->status == true ? 'Active' : 'Inactive' }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
