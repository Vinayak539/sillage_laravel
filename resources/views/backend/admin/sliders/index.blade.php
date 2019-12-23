@extends('layouts.admin-master')
@section('title', 'All Slider')
@section('content')

{{-- Model --}}

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Title (Optional)</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Enter Title" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subtitle">Sub Title (Optional)</label>
                                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                                        placeholder="Enter Sub Title" value="{{ old('subtitle') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description (Optional)</label>
                                    <textarea name="description" id="description" class="form-control"
                                        placeholder="Write Something here..." rows="5">{{ old('description') }} </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="url">Url (Optional)</label>
                                    <input type="text" name="url" id="url" class="form-control" placeholder="Enter Url"
                                        value="{{ old('url') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sort_index">Sort Index <span class="text-danger">*</span></label>
                                    <input type="number" name="sort_index" class="form-control" id="sort_index"
                                        value="{{ old('sort_index') }}" placeholder="Enter Sort Index" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_url">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image_url" id="image_url" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 class="text-warning"> <i class="fa fa-info-circle"></i> Note * mark is compulsory</h6>
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
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Slider</li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Slider</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Slider</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider)
                        <tr>
                            <td>{{ $slider->sort_index }}</td>
                            <td>
                                <a href="/storage/images/sliders/{{ $slider->image_url }}" target="_blank"
                                    title="Slider Image">
                                    <img src="/storage/images/sliders/{{ $slider->image_url }}" alt="Slider Image"
                                        width="50px">
                                </a>
                            </td>
                            <td>{{ $slider->title ? Str::limit($slider->title, 20) : 'N/A' }}</td>
                            <td>{{ $slider->url ? Str::limit($slider->url, 50) : 'N/A' }}</td>
                            <td>
                                {{ $slider->status == true ? 'Activated' : 'Deactivated' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($slider->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="dropdown-item"
                                            title="Edit Detail">
                                            <i class="fa fa-edit text-primary"></i> Edit
                                        </a>
                                        <button type="button" data-role="delete-obj" data-obj-id="{{ $slider->id }}"
                                            class="dropdown-item delete-object" title="Delete Slider">
                                            <i class="fa fa-trash text-danger"></i> Delete
                                        </button>
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
                        @if($sliders->total() > 50)
                        <tr class="text-center">
                            <td colspan="8">
                                {{ $sliders->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>URL</th>
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


@endsection
<form id="formDelete" method="POST" action="/adhni753/manage-sliders/delete/">
    @csrf
</form>

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                var action = $("#formDelete").attr("action") + $(this).attr("data-obj-id");
                $("#formDelete").attr("action", action);
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });
    });

</script>
@endsection
