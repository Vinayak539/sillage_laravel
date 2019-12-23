@extends('layouts.admin-master')
@section('title', 'Update Newsletter')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Send Newsletter</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.subscribers.send') }}" role="form" class="needs-validation"
                id="formSendNewsletter">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            @foreach($sendEmails as $email)
                            <div class="col-md-3">
                                <input type="hidden" name="emails[]" value="{{$email}}">
                            </div>
                            @endforeach
                            <label for="comment">Write Something here<span class="text-danger">*</span></label>
                            <textarea name="message" id="message" rows="5" class="form-control summernote"
                                placeholder="Write Something here..." required>{{ old('message') }}</textarea>
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
    $(document).ready(function () {

            $("#formSendNewsletter").validate({
             rules: {

                message: {
                   required: true
                },
             },
             messages: {
                message: {
                   required: "Please Write Message"
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
