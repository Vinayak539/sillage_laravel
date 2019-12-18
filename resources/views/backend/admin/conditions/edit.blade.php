@extends('layouts.admin-master')
@section('title', 'Update Condition')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Condition</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.conditions.all') }}"> All Conditions</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Condition</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditCondition" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="condition">Condition <span class="text-danger">*</span></label>
                            <input type="text" name="condition" id="condition" class="form-control"
                                value="{{ $condition->condition }}" placeholder="Enter Condition" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span> </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $condition->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $condition->status == false ? 'selected': '' }}>Inactive</option>
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

    @endsection

    @section('extrajs')
    <script>
        $("#formEditCondition").validate({
         rules: {

            condition: {
               required: true
            },

            status: {
               required: true
            },

         },
         messages: {
            condition: {
               required: "Please Enter Product Condition"
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
