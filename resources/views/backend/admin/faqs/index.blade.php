@extends('layouts.admin-master')
@section('title', 'Manage Faqs')
@section('content')

{{-- Model --}}

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white-all">
                <h5 class="modal-title" id="formModal">Add Faq</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" class="needs-validation" id="formAddFaq">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="question">Question <span class="text-danger">*</span></label>
                                    <textarea name="question" id="question" rows="10" class="form-control"
                                        placeholder="Enter Question here..." required>{{ old('question') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="answer">Answer <span class="text-danger">*</span></label>
                                    <textarea name="answer" id="answer" rows="10" class="form-control"
                                        placeholder="Enter Answer here..." required>{{ old('answer') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-danger">
                                Note : All * Mark Fields are Compulsory !
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fa fa-plus"></i> Add
                        </button>
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
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Manage Faqs </li>
            <li class="breadcrumb-item"><a href="#addModal" data-toggle="modal" data-target="#addModal"><i
                        class="fas fa-plus"></i> Add Faqs </a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Faqs</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Status</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->id }}</td>
                            <td>{{ Str::limit($faq->question, 25) }}</td>
                            <td>{{ Str::limit($faq->answer, 25) }}</td>
                            <td>
                                {{ $faq->status == true ? 'Active' : 'Inactive' }}
                            </td>
                            <td>{{ date('d-M-Y h:i A', strtotime($faq->created_at)) }}</td>
                            <td>
                                <div class="dropdown d-inline">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                            class="dropdown-item has-icon" title="Edit Detail">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <button type="button" data-role="delete-obj" data-obj-id="{{ $faq->id }}"
                                            class="dropdown-item delete-object" title="Delete Faq">
                                            <i class="fa fa-trash text-danger"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        @empty
                        <tr class="text-center">
                            <td class="text-danger" colspan="6">
                                <h4>No Record Found..</h4>
                            </td>
                        </tr>
                        @endforelse
                        @if($faqs->total() > 50)
                        <tr class="text-center">
                            <td colspan="6">
                                {{ $faqs->links() }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Answer</th>
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

<form id="formDelete" method="POST" action="{{ route('admin.faqs.delete') }}">
    @csrf

    <input type="hidden" name="faq_id" id="txtFaqID">
</form>
@endsection

@section('extrajs')
<script>
    $(document).ready(function () {


        $("#formAddFaq").validate({
            rules: {

                question: {
                    required: true
                },

                answer: {
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
