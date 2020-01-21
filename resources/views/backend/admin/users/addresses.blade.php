@extends('layouts.admin-master')
@section('title', 'User Address')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>User Detail</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.all') }}"> All Users</a></li>
{{--            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i--}}
{{--                        class="fas fa-plus"></i> Add Address</a></li>--}}
        </ol>
    </nav>


    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Address</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        @forelse($user->addresses as $add)
                        <li class="list-group-item">
                            <h5><span class="badge badge-secondary">{{ $add->type_of_address ? 'Office/Commercial' : 'Home' }}</span></h5>
                            <strong>{{ $add->name }}</strong><br>

                            <address>
                                {{ $add->address  }}, {{ $add->landmark }}, {{ $add->city }}, {{ $add->territory }} -
                                <strong>{{ $add->pincode }}</strong>
                            </address>
                        </li>

                        @empty

                        <li class="text-danger text-center">
                            <h3>No Address Found...</h3>
                        </li>

                        @endforelse
                    </ul>
                </div>
            </div>


        </div>
    </div>

</section>
@endsection
