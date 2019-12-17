@extends('layouts.admin-master')
@section('title', 'Manage Materials')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h3 class="modal-title text-light">Add Material</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" role="form" class="needs-validation" id="formAddMaterial">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="material_name">Material <span class="text-danger">*</span></label>
                                <input type="text" name="material_name" id="material_name" class="form-control"
                                    value="{{ old('material_name') }}" placeholder="Enter Material" required>
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

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Brands</li>
            <li class="breadcrumb-item">
                <a href="#addModal" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-plus"></i> Add Material
                </a>
            </li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Materials</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Material</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->material_name }} </td>
                            <td>
                                {{ $material->status == true ? 'Active' : 'Blocked' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($material->created_at)) }}</td>
                            <td>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.materials.edit', $material->id) }}"
                                            class="dropdown-item has-icon" title="Edit Detail">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="5">
                                <h5>No Record Found. <a href="#addModal" data-toggle="modal" data-target="#addModal">
                                        Click here to Add
                                    </a></h5>
                            </td>
                        </tr>
                        @endforelse
                        @if($materials->total() > 50)
                        <tr class="text-center">
                            <td colspan="5">
                                {{ $materials->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Material</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('extrajs')
<script>
    $(document).ready(function () {
    
            $("#formAddMaterial").validate({
             rules: {
    
                material_name: {
                   required: true
                },
             },
             messages: {
                material_name: {
                   required: "Please Enter Material Name"
                },
             },
             submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
             }
          });
    
        });
</script>
@endsection