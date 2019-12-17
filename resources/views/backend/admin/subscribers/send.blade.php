@extends('layouts.admin-master')
@section('title', 'Update Review')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Update Review</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.reviews.all') }}">Manage Reviews</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.subscribers.send') }}" role="form" class="needs-validation">
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

@endsection