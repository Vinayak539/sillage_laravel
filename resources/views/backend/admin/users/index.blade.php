@extends('layouts.admin-master')
@section('title', 'Manage Customers')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Customers</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
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
                        <th>image</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        @if($user->image_url)
                        <td>
                            <img src="{{ $user->image_url }}" class="img-responsive img-circle"
                                alt="{{ $user->name }}" width="40">
                        </td>
                        @else
                        <td>
                            <img src="/admin/assets/images/admin2.png" alt="{{ $user->name }}"
                                class="img-responsive img-circle" width="40">
                        </td>
                        @endif
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->status == true ? 'Active' : 'Blocked' }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="dropdown-item"
                                        title="Edit Detail">
                                        <i class="fa fa-edit text-primary"></i> Edit Detail
                                    </a>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="dropdown-item"
                                        title="View Detail">
                                        <i class="fa fa-eye text-dark"></i> View Detail
                                    </a>
                                    <a href="{{ route('admin.users.orders', $user->id) }}" class="dropdown-item"
                                        title="Order History">
                                        <i class="fa fa-shopping-cart text-primary"></i> Order History
                                    </a>
                                    <a href="{{ route('admin.users.reviews', $user->id) }}" class="dropdown-item"
                                        title="Reviews">
                                        <i class="fa fa-star text-primary"></i> Reviews
                                    </a>
                                    @if($user->status == true)
                                    <button type="button" data-obj-id="{{ $user->id }}"
                                        class="dropdown-item block-object" title="Block User">
                                        <i class="fa fa-close text-danger"></i> Block
                                    </button>
                                    @else
                                    <button type="button" data-obj-id="{{ $user->id }}"
                                        class="dropdown-item unblock-object" title="Unblock User">
                                        <i class="fa fa-check text-success"></i> Unblock
                                    </button>
                                    @endif
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
                            {{ $users->links() }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>image</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<form id="formBlock" method="POST" action="/adrana951/manage-users/block/">
    @csrf
</form>
<form id="formUnblock" method="POST" action="/adrana951/manage-users/unblock/">
    @csrf
</form>
@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
      
        $(".block-object").click(function () {
            if (window.confirm("Are you sure, You want to Block ? ")) {
                var action = $("#formBlock").attr("action") + $(this).attr("data-obj-id");
                $("#formBlock").attr("action", action);
                $("#formBlock").submit();
                $(this).html('wait...');
            }
        });

        $(".unblock-object").click(function () {
            if (window.confirm("Are you sure, You want to Unblock ? ")) {
                var action = $("#formUnblock").attr("action") + $(this).attr("data-obj-id");
                $("#formUnblock").attr("action", action);
                $("#formUnblock").submit();
                $(this).html('wait...');
            }
        });
    });

</script>
@endsection
