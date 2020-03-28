@extends('layouts.admin-master')
@section('title', 'Update Faq')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.faqs.all') }}"><i class="fas fa-list"></i> Manage Faqs</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <form method="post" class="needs-validation" id="formEditFaq">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="question">Question <span class="text-danger">*</span></label>
                            <textarea name="question" id="question" rows="10" class="form-control"
                                placeholder="Enter Question here..." required>{{ $faq->question }}</textarea>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="answer">Answer <span class="text-danger">*</span></label>
                            <textarea name="answer" id="answer" rows="10" class="form-control"
                                placeholder="Enter Answer here..." required>{{ $faq->answer }}</textarea>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="1" {{ $faq->status == true ? 'selected': '' }}>Active</option>
                                <option value="0" {{ $faq->status == false ? 'selected': '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-12 mt-4">
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
    $(document).ready(function () {


        $("#formEditFaq").validate({
            rules: {

                question: {
                    required: true
                },

                answer: {
                    required: true
                },

                status: {
                    required: true
                },
            },
            messages: {

                question: {
                    required: "Please Enter Question"
                },

                answer: {
                    required: "Please Enter Answer"
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

        $(".delete-object").click(function () {
            if (window.confirm(
                    "Are you sure, You want to Delete ? ")) {
                $("#txtFaqID").val($(this).attr("data-obj-id"));
                $("#formDelete").submit();
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            }
        });
    });

</script>
@endsection
