@extends('layouts.admin-master')
@section('title', 'Update Material')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Material</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.materials.all') }}"> All Materials</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Material</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditMaterial" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="material_name">Material <span class="text-danger">*</span></label>
                            <input type="text" name="material_name" id="material_name" class="form-control"
                                value="{{ $material->material_name }}" placeholder="Enter Material" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span> </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $material->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $material->status == false ? 'selected': '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit"> <i class="fas fa-pencil-alt"></i>
                            Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('extrajs')
<script>
    $("#formEditMaterial").validate({
             rules: {
    
                material_name: {
                   required: true
                },
               
                status: {
                   required: true
                },
    
             },
             messages: {
                material_name: {
                   required: "Please Enter Material Name"
                },
                
                status: {
                   required: "Please Select Status"
                },
    
             },
             submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
             }
          });
</script>
@endsection