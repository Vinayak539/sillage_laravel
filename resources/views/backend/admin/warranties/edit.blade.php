@extends('layouts.admin-master')
@section('title', 'Update Warranty')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Warranty</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.warranties.all') }}"> All Warranties</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Warranty</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditWarranty" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $warranty->title }}" placeholder="Enter Title" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span> </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $warranty->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $warranty->status == false ? 'selected': '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fas fa-pencil-alt"></i> Update
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection


@section('extrajs')
<script>
    $("#formEditWarranty").validate({

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
               required: "Please Enter Title"
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
