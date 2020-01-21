@extends('layouts.admin-master')
@section('title', 'Customer Details')
@section('content')

    <section class="section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-dark text-white-all">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>View User Detail</li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.all') }}"> All Users</a></li>
            </ol>
        </nav>


        <div class="card">
            <div class="card-header bg-dark text-white-all">
                <h4>User Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 bg-white pt-20">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Image</th>
                                <td>
                                    @if($user->image_url && $user->provider)
                                        <img src="{{ $user->image_url }}" alt="{{ $user->name }}" width="40"
                                             class="img-responsive img-circle">
                                    @elseif($user->image_url)
                                        <img src="/storage/images/users/{{ $user->image_url }}" alt="{{ $user->name }}"
                                             width="40" class="img-responsive img-circle">
                                    @else
                                        <i class="fa fa-user-circle fa-3x" aria-hidden="true"></i>
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
                                <th>Country</th>
                                <td>{{ $user->country }}</td>
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
                            <tr>
                                <th>Source</th>
                                <td class="text-capitalize">{{ $user->provider ? $user->provider : 'Direct' }}</td>
                            </tr>
                            @if($user->provider)
                                <tr>
                                    <th>Provider ID</th>
                                    <td class="text-capitalize">{{ $user->provider_id }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
