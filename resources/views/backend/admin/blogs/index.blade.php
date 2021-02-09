@extends('layouts.admin-master')
@section('title', 'All Blogs')
@section('content')

{{-- Model --}}

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data"
                    id="formAddBlog">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" required id="title" class="form-control"
                                        placeholder="Enter Title" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" required id="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" required class="form-control summernote"
                                        placeholder="Write Something here..." >{!! old('description') !!} </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-warning"> <i class="fa fa-info-circle"></i> Note * mark is compulsory
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btnSubmit"> <i class="fa fa-plus"></i>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Model End --}}
<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Blog</li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Blog</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Blogs</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $key=>$blog)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <a href="{{ asset('storage/images/blogs/' . $blog->image) }}" target="_blank"
                                    title="Blog Image">
                                    <img src="{{ asset('storage/images/blogs/' . $blog->image) }}"
                                        alt="Blog Image" width="50px">
                                </a>
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>
                                {{ $blog->status == true ? 'Activated' : 'Deactivated' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($blog->created_at)) }}</td>
                            <td>

                                <div class="dropdown d-inline">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                            class="dropdown-item has-icon" title="Edit Detail">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)" data-role="delete-obj"
                                            data-obj-id="{{ $blog->id }}" class="dropdown-item has-icon delete-object"
                                            title="Delete Blog">
                                            <i class="fa fa-trash text-danger"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="8">
                                <h4>No Record Found..</h4>
                            </td>
                        </tr>
                        @endforelse
                        @if($blogs->total() > 50)
                        <tr class="text-center">
                            <td colspan="8">
                                {{ $blogs->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
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

<form id="formDelete" method="POST" action="{{ route('admin.blogs.delete') }}">
    @csrf
    <input type="hidden" name="blog_id" id="txtBlogID">
</form>

@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                $("#txtBlogID").val($(this).attr("data-obj-id"));
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                $("#formDelete").submit();
            }
        });

        $("#formAddBlog").validate({
            rules: {

                title: {
                    required: true
                },

                description: {
                    required: true
                },

                image: {
                    required: true
                }

            },

            messages: {
                title: {
                    required: "Please Enter Title"
                },
                description: {
                    required: "Please Enter Decsription"
                },
                image: {
                    required: "Please Enter Image"
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
