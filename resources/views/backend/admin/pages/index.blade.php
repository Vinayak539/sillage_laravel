@extends('layouts.admin-master')
@section('title', 'All Pages')
@section('content')

{{-- Model --}}

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data"
                    id="formAddPage">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="heading">Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="heading" required id="heading" class="form-control"
                                        placeholder="Enter Heading" value="{{ old('heading') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type">Page Type <span class="text-danger">*</span></label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">---select---</option>
                                        <option value="about" {{old('type') == 'about' ? 'selected' : ''}}>About</option>
                                        <option value="privacy_policy" {{old('type') == 'privacy_policy' ? 'selected' : ''}}>Privacy Policy</option>
                                        <option value="terms_of_service" {{old('type') == 'terms_of_service' ? 'selected' : ''}}>Terms Of Service</option>
                                        <option value="cancellation_refund" {{old('type') == 'cancellation_refund' ? 'selected' : ''}}>Cancellation And Refund</option>
                                        <option value="shipping_information" {{old('type') == 'shipping_information' ? 'selected' : ''}}>Shipping Information</option>
                                        <option value="others" {{old('type') == 'others' ? 'selected' : ''}}>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sort_index">Sort Index <span class="text-danger">*</span></label>
                                    <input type="number" name="sort_index" id="sort_index" required value="{{ old('sort_index') }}" class="form-control" placeholder="Enter Sort Index...!">
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
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Page</li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Page</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Pages</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <!-- <th>Description</th> -->
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $key=>$page)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $page->heading }}</td>
                            <td>{{ $page->type ? $page->type : 'N/A' }}</td>
                            <!-- <td>{!! $page->description ? Str::limit($page->description, 20) : 'N/A' !!}</td> -->
                            <td>
                                {{ $page->status == true ? 'Activated' : 'Deactivated' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($page->created_at)) }}</td>
                            <td>

                                <div class="dropdown d-inline">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.pages.edit', $page->id) }}"
                                            class="dropdown-item has-icon" title="Edit Detail">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)" data-role="delete-obj"
                                            data-obj-id="{{ $page->id }}" class="dropdown-item has-icon delete-object"
                                            title="Delete Page">
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
                        @if($pages->total() > 50)
                        <tr class="text-center">
                            <td colspan="8">
                                {{ $pages->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <!-- <th>Description</th> -->
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

<form id="formDelete" method="POST" action="{{ route('admin.pages.delete') }}">
    @csrf
    <input type="hidden" name="page_id" id="txtPageID">
</form>

@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                $("#txtPageID").val($(this).attr("data-obj-id"));
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                $("#formDelete").submit();
            }
        });

        $("#formAddPage").validate({
            rules: {

                heading: {
                    required: true
                },

                description: {
                    required: true
                },

                type: {
                    required: true
                }

            },

            messages: {
                heading: {
                    required: "Please Enter Page Heading"
                },
                description: {
                    required: "Please Enter Decsription"
                },
                type: {
                    required: "Please Choose Page Type"
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
