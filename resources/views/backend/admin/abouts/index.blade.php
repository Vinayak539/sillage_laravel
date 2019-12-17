@extends('layouts.admin-master')
@section('title', 'Manage About Us')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage About Us</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-block">
        @if($about)
        <form method="post" action="/adrana951/manage-abouts/edit/{{ $about->id }}" class="needs-validation"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_description">Short Description <span class="text-danger">*</span> </label>
                        <textarea name="short_description" id="short_description" class="form-control summernote"
                            placeholder="Write Short About here..." required>{{ $about->short_description }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control summernote"
                            placeholder="Write Something About here..." required>{{ $about->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            @if($about->image_url1)
                            <div class="col-md-4 text-center">
                                <!-- <img src="/storage/images/abouts/{{ $about->image_url1 }}" alt="Image" width="100px"
                                    class="img img-responsive mb-3"> -->
                                    <img src="{!! asset('storage/images/abouts/') !!}{{ $about->image_url1 }}" alt="Image" width="100px"
                                    class="img img-responsive mb-3">
                            </div>
                            @endif
                            <div class="col-md-8">
                                <label for="image_url1">Change Image (Optional)</label>
                                <input type="file" name="image_url1" id="image_url1" class="form-control">
                            </div>
                            @if($about->image_url1)
                            <div class="col-md-12">
                                <button type="button" class="btn btn-outline-danger ml-5 object-delete"
                                    data-obj-text="image_url1">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            @if($about->image_url2)
                            <div class="col-md-4 text-center">
                                <!-- <img src="/storage/images/abouts/{{ $about->image_url2 }}" alt="Image" width="100px"
                                    class="img img-responsive mb-3"> -->
                                    <img src="{!! asset('storage/images/abouts/') !!}{{ $about->image_url2 }}" alt="Image" width="100px"
                                    class="img img-responsive mb-3">
                            </div>
                            @endif
                            <div class="col-md-8">
                                <label for="image_url2">Change Image (Optional)</label>
                                <input type="file" name="image_url2" id="image_url2" class="form-control">
                            </div>
                            @if($about->image_url2)
                            <div class="col-md-12">
                                <button type="button" class="btn btn-outline-danger ml-5 object-delete"
                                    data-obj-text="image_url2">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fas fa-pencil-alt"></i> Update
                    </button>
                </div>
            </div>
        </form>
        @else
        <form method="post" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_description">Short Description <span class="text-danger">*</span></label>
                        <textarea name="short_description" id="short_description" class="form-control summernote"
                            placeholder="Write Something About here..."
                            required>{{ old('short_description') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control summernote"
                            placeholder="Write Something About here..." required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image_url1">Image (Optional)</label>
                        <input type="file" name="image_url1" id="image_url1" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image_url2">Image (Optional)</label>
                        <input type="file" name="image_url2" id="image_url2" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
<form action="/adrana951/manage-abouts/delete/" method="post" id="formDelete">
    @csrf
</form>

@section('extrajs')
<script>
    $(document).ready(function () {
        $('.object-delete').click(function () {
            if (window.confirm('Are you sure, you want to delete ?')) {
                var action = $('#formDelete').attr('action') + $(this).attr('data-obj-text');
                $('#formDelete').attr('action', action);
                $('#formDelete').submit();
                $(this).html('Please Wait...');
            }
        });
    });

</script>
@endsection