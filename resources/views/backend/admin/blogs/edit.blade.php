@extends('layouts.admin-master')
@section('title', 'Update Blog')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="blog"><i class="fas fa-list"></i>Edit Blog</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.blogs.all') }}"> All Blogs</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Blog</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditSize" action="{{route('admin.blogs.update', $blog->id)}}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" required id="title" class="form-control"
                                        placeholder="Enter Title" value="{{ $blog->title }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image </label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span> </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <option value="1" {{ $blog->status == true ? 'selected': '' }}>Active</option>
                                        <option value="0" {{ $blog->status == false ? 'selected': '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" required class="form-control summernote"
                                            placeholder="Write Something here..." >{!! $blog->description !!} </textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <div>
                                    <label>Existing Image </label>
                                </div>
                                <img src="{{ asset('storage/images/blogs/' . $blog->image) }}" alt="{{$blog->title}}"
                                    class="img img-responsive img-thumbnail" width="350px">
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

                description: {
                    required: true
                }

            },

                messages: {
                title: {
                    required: "Please Enter Title"
                },
                description: {
                    required: "Please Enter Decsription"
                }
            },
             submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
             }
          });
</script>
@endsection
