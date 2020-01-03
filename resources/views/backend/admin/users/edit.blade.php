@extends('layouts.admin-master')
@section('title', 'Update User Detail')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit User Detail</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.all') }}"> All Users</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update User Status</h4>
        </div>
        <div class="card-body">
            <form method="post" class="needs-validation" id="formEditUser">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" value="{{ $user->name }}" disabled readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $user->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $user->status == false ? 'selected': '' }}>Block</option>
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
    $("#formEditUser").validate({
         rules: {

            status: {
               required: true
            },

         },
         messages: {

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
