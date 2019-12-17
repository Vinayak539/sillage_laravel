@extends('layouts.admin-master')
@section('title', 'Add Categories')
@section('content')

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Add Category In <span id="txtCategoryName"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('admin.categories.add') }}" method="post" class="needs-validation"
                id="formAddCategory" novalidate>
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="txtCategoryID" id="txtCategoryID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" id="category_name" class="form-control"
                                value="{{ old('category_name') }}" placeholder="Enter Category Name" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Categories</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.all') }}"> All Categories</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Add Category</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category" class="mb-0 ml-2 f-20">Select Category</label>
                        {!! $dynamicCategory !!}
                        <div class="mt-2">
                            <a href="#myModal" class="tbtn-primary f-20" data-toggle="modal" data-target="#myModal">Add
                                New Parent
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('extracss')
<style>
    .category_div {
        padding-left: 15px !important;
        list-style-type: none !important;
    }

    .category_div strong {
        background: #0b85ff;
        color: #fff;
        /* padding: 0 5px; */
        cursor: pointer;
    }

    .tbtn-primary {
        background: #0b85ff !important;
        padding: 3px 10px;
        color: #fff;
        border-radius: 25px;
    }

    .tbtn-primary:hover {
        color: #fff;
    }

    .category_div.content {
        display: none;
        background-color: #f1f1f1;
        margin-top: 5px;
    }

    .category_div.content li {
        font-size: 18px;
        margin-top: 5px;
    }

    b.collapsible {
        color: #000;
        position: absolute;
        /* background: #000; */
        left: -5px;
        padding: 2px;
        cursor: pointer;
        font-size: 24px;
        font-weight: 900;
    }

    b.collapsible:after {
        content: '\002B';
        color: #000;
        font-weight: 900;
        float: right;
        margin-left: 5px;
        font-size: 24px;
        margin-top: -5px;
    }

    b.active:after {
        content: "\2212";
    }

    .f-20 {
        font-size: 20px;
    }
</style>
@endsection

@section('extrajs')
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

</script>
<script>
    $(document).ready(function () {

        $('.addCategory').click(function () {
            var val = $(this).attr('data-parent-id');
            var name = $(this).attr('data-parent-name');
            
            if (val) {
                $('#txtCategoryID').val(val);
                $('#txtCategoryName').html(name);
                $('#myModal').modal('show');
            }
        });

        $("#formAddCategory").validate({
         rules: {

            category_name: {
               required: true
            },

         },
         messages: {
            category_name: {
               required: "Please Enter Category Name"
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