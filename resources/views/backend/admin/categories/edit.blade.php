@extends('layouts.admin-master')
@section('title', 'Update Category')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Category</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.all') }}"> All Categories</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Category</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditCategory" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"
                                placeholder="Enter Category Name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="parent_id">Parent Category Name <span class="text-danger">*</span></label>
                            <select name="parent_id" id="parent_id" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="0" {{ $category->parent_id == '0' ? 'selected' : '' }}>Parent Category
                                </option>
                                @foreach($allCategories as $cate)
                                <option value="{{ $cate->id }}"
                                    {{ $category->parent_id == $cate->id ? 'selected': '' }}>
                                    {{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span> </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $category->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $category->status == false ? 'selected': '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fas fa-pencil-alt"></i>
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
    $("#formEditCategory").validate({
         rules: {

            name: {
               required: true
            },
            
            parent_id: {
               required: true
            },
            
            status: {
               required: true
            },

         },
         messages: {
            name: {
               required: "Please Enter Category Name"
            },
            
            parent_id: {
               required: "Please Select Parent Category Name"
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