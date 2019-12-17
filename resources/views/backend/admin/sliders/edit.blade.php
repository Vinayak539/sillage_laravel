@extends('layouts.admin-master')
@section('title', 'Update Slider')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Update Slider Detail</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.sliders.all') }}">All Sliders</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body">
        <form method="post" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Title" value="{{ $slider->title }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subtitle">Sub Title</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control"
                                    placeholder="Enter Sub Title" value="{{ $slider->subtitle }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sort_index">Sort Index <span class="text-danger">*</span></label>
                                <input type="number" name="sort_index" class="form-control" id="sort_index"
                                    value="{{ $slider->sort_index }}" placeholder="Enter Sort Index" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url">Url (Optional)</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Enter Url"
                                    value="{{ $slider->url }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="1" {{ $slider->status == true ? 'selected': '' }}>Activate</option>
                                    <option value="0" {{ $slider->status == false ? 'selected': '' }}>Deactivate
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image_url">Change Image </label>
                                <input type="file" name="image_url" id="image_url" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"
                                    placeholder="Write Something here..."
                                    rows="5">{{ $slider->description }} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div>
                            <label>Existing Image </label>
                        </div>
                        <img src="/storage/images/sliders/{{ $slider->image_url }}" alt="Slider Title"
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

@endsection