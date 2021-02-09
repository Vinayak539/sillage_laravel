@extends('layouts.admin-master')
@section('title', 'Update Page')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Page</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.all') }}"> All Pages</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Update Page</h4>
        </div>
        <div class="card-body">
            <form method="post" id="formEditSize" action="{{route('admin.pages.update', $page->id)}}" class="needs-validation">
                @csrf
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="heading">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="heading" required id="heading" class="form-control"
                            placeholder="Enter Sub Title" value="{{ $page->heading }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">Page Type <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">---select---</option>
                            <option value="about" {{$page->type == 'about' ? 'selected' : ''}}>About</option>
                            <option value="privacy_policy" {{$page->type == 'privacy_policy' ? 'selected' : ''}}>Privacy Policy</option>
                            <option value="terms_of_service" {{$page->type == 'terms_of_service' ? 'selected' : ''}}>Terms Of Service</option>
                            <option value="cancellation_refund" {{$page->type == 'cancellation_refund' ? 'selected' : ''}}>Cancellation And Refund</option>
                            <option value="shipping_information" {{$page->type == 'shipping_information' ? 'selected' : ''}}>Shipping Information</option>
                            <option value="others" {{$page->type == 'others' ? 'selected' : ''}}>Others</option>
                        </select>
                    </div>
                </div>
                            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sort_index">Sort Index <span class="text-danger">*</span></label>
                        <input type="number" name="sort_index" id="sort_index" required value="{{ $page->sort_index }}" class="form-control" placeholder="Enter Sort Index...!">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span> </label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">--Select--</option>
                            <option value="1" {{ $page->status == true ? 'selected': '' }}>Active</option>
                            <option value="0" {{ $page->status == false ? 'selected': '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" required class="form-control summernote"
                                placeholder="Write Something here..." >{!! $page->description !!} </textarea>
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
</script>
@endsection
