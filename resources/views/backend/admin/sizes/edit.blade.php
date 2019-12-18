@extends('layouts.admin-master')
@section('title', 'Update Size')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Size</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.sizes.all') }}"> All Sizes</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Size</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditSize" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Size <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $size->title }}"
                                placeholder="Enter Size" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span> </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $size->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $size->status == false ? 'selected': '' }}>Inactive</option>
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
    $("#formEditSize").validate({
             rules: {

                title: {
                   required: true
                },

                status: {
                   required: true
                },

             },
             messages: {
                title: {
                   required: "Please Enter Size"
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
