@extends('layouts.admin-master')
@section('title', 'Customer Order History')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Customer Order History</h5>
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
                <h2 class="text-dark mb-30">Order Information</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City</th>
                            <th>Pincode</th>
                            <th>Total</th>
                            <th>Tax</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                            <th>Ordered Date</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>
                        @forelse ($user->orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->city }}</td>
                            <td>{{ $order->pincode }}</td>
                            <td>{{ $order->tbt }}</td>
                            <td>{{ $order->tax }}</td>
                            <td>{{ $order->total }}</td>
                            <td class="text-capitalize">{{ $order->status }}</td>
                            <td>{{ date('d-m-Y h:m A' , strtotime($order->created_at)) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary"
                                    title="View Detail">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="10">
                                <h4>No Order Found..</h4>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection
