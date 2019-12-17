@extends('layouts.admin-master')
@section('title', 'All Admins')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Add Admin</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                                    placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email') }}" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Password </label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{ old('password') }}" placeholder="Enter Password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit"> <i class="fa fa-plus"></i>
                        Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Model End --}}

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Admin</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal">Add Admin</a>
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
                        <th>Email</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        @if($admin->image_url)
                        <td>
                            <!-- <img src="/storage/images/admins/{{ $admin->image_url }}" class="img-responsive img-circle"
                                alt="{{ $admin->name }}" width="40"> -->
                                <img src="{!! asset('storage/images/admins/') !!}{{ $admin->image_url }}" class="img-responsive img-circle"
                                alt="{{ $admin->name }}" width="40">
                        </td>
                        @else
                        <td>
                            <!-- <img src="/admin/assets/images/admin2.png" alt="{{ $admin->name }}"
                                class="img-responsive img-circle" width="40"> -->
                                <img src="{!! asset('admin/assets/images/admin2.png') !!}" alt="{{ $admin->name }}"
                                class="img-responsive img-circle" width="40">
                        </td>
                        @endif
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ date('d-M-Y h:i A', strtotime($admin->created_at)) }}</td>
                        @if(auth('admin')->user()->super_admin == true || $admin->id == auth('admin')->user()->id)
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="dropdown-item"
                                        title="Edit Detail">
                                        <i class="fa fa-edit text-primary"></i> Edit
                                    </a>
                                    @if(auth('admin')->user()->super_admin == true)
                                    <button type="button" data-role="delete-obj" data-obj-id="{{$admin->id}}"
                                        class="dropdown-item delete-object" title="Delete Admin">
                                        <i class="fa fa-trash text-danger"></i> Delete
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                        @else
                        <td>
                            --
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td class="text-danger" colspan="6">
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
                        <th>Email</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
<form id="formDelete" method="POST" action="/adrana951/manage-admins/delete/">
    @csrf
</form>

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                var action = $("#formDelete").attr("action") + $(this).attr("data-obj-id");
                $("#formDelete").attr("action", action);
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });
    });

</script>
@endsection