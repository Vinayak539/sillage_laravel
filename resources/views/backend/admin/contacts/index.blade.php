@extends('layouts.admin-master')
@section('title', 'Manage Contact Us')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Add Detail</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" role="form" class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter Email ID" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                    value="{{ old('mobile') }}" placeholder="Enter Mobile Number">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address<span class="text-danger">*</span></label>
                                <textarea name="address" id="address" rows="5" class="form-control"
                                    placeholder="Enter Address">{{ old('address') }}</textarea>
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
            <h5>Manage Contact Us</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal">Add Detail</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <div class="table-responsive dt-responsive">
            <table class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->mobile }}</td>
                        <td>{{ str_limit($contact->address, 25) }}</td>

                        <td>{{ date('d-M-Y h:i A', strtotime($contact->created_at)) }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="dropdown-item"
                                        title="Edit Contact Us">
                                        <i class="fa fa-edit text-primary"></i> Edit
                                    </a>
                                    <button type="button" data-role="delete-obj" data-obj-id="{{$contact->id}}"
                                        class="dropdown-item delete-object" title="Delete Contact Us">
                                        <i class="fa fa-trash text-danger"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td class="text-danger" colspan="6">
                            <h4>No Record Found..</h4>
                        </td>
                    </tr>
                    @endforelse
                    <tr class="text-center">
                        <td colspan="6">
                            {{ $contacts->links() }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
<form id="formDelete" method="POST" action="/adrana951/manage-contacts/delete/">
    @csrf
</form>

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm(
                    "Are you sure, You want to Delete ? ")) {
                var action = $("#formDelete").attr("action") + $(this).attr("data-obj-id");
                $("#formDelete").attr("action", action);
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });
    });

</script>
@endsection