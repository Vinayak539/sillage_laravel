@extends('layouts.admin-master') @section('title', 'Update information')
@section('content')
<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"
                    ><i class="fas fa-home"></i> Home</a
                >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-list"></i> Update Information
            </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <form
                class="needs-validation"
                method="POST"
                enctype="multipart/form-data"
                autocomplete="off"
                id="formUpdate"
            >
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        value="{{ $admin->name }}"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email </label>
                                    <input
                                        id="email"
                                        class="form-control"
                                        value="{{ $admin->email }}"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Old Password </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Password"
                                    />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Password"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_url"
                                        >Change Profile Image
                                    </label>
                                    <input
                                        type="file"
                                        name="image_url"
                                        id="image_url"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_url"
                                        >Existing Image
                                    </label>
                                    <div>
                                        @if ($admin->image_url)
                                        <img
                                        data-original="{!! asset('storage/images/admins/' . $admin->image_url ) !!}"
                                            alt="{{ $admin->name }}"
                                            class="img img-responsive img-circle lazy"
                                            width="200px !important"
                                        />
                                        @else
                                        <img
                                            src="{!! asset('admin/assets/images/admin2.png') !!}"
                                            alt="No image"
                                            class="img img-responsive rounded-circle"
                                            width="200px !important"
                                        />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary btnSubmit">
                            <i class="fas fa-pencil-alt"></i> Update
                        </button>
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

        $("#formUpdate").validate({
            rules: {

                name: {
                    required: true,
                },
               
            },
            messages: {
              
                name: {
                    required: "Please Enter Name"
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