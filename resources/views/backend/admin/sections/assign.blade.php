@extends('layouts.admin-master')
@section('title', 'Assign Customer')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i>Edit Section</li>
            <li class="breadcrumb-item"><a href="{{ route('admin.sections.all') }}"> All Sections</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Assign Product in {{ $section->SectionName }}</h4>
        </div>
        <div class="card-body">
            <form method="post" role="form" class="needs-validation" id="formAssign"> 
                @csrf
                <div class="col-md-12 mx-auto table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    <input type="checkbox" id="ckbCheckAll">
                                    <label for="ckbCheckAll">Select All</label>
                                </th>
                                <th>Image</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkBoxClass"
                                            name="assign[]" value="{{ $product->id }}" id="customCheck{{ $product->id }}" required>
                                        <label class="custom-control-label mb-3"
                                            for="customCheck{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ '/storage/images/products/'. $product->image_url }}"
                                        target="_blank"><img
                                            data-original="{{ '/storage/images/products/'. $product->image_url }}"
                                            alt="{{ $product->title }}" class="lazy" width="50">
                                    </a>
                                </td>
                                <td>{{ $product->title }}</td>
                            </tr>

                            @empty
                            <tr class="text-center">
                                <td class="text-danger" colspan="3">
                                    <h4>No Data Found..</h4>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if(count($products))
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-primary btnSubmit pull-right">
                                        <i class="fa fa-tasks"></i> Assign
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('extracss')
<style>
    .custom-control-label::after {
        border: 1px solid #1183e1 !important;
        border-radius: 3px;
    }

    .custom-control {
        padding-left: 2.5rem !important;
    }

    .modal-lg {
        max-width: 70% !important;
    }
</style>
@endsection
@section('extrajs')
<script>
    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

        $(".checkBoxClass").change(function () {
            if (!$(this).prop("checked")) {
                $("#ckbCheckAll").prop("checked", false);
            }
        });

        $("#formAssign").validate({
             rules: {
    
                "assign[]": {
                   required: true
                },
             },

             messages: {
                "assign[]": {
                   required: "Please Select Atleast One Product"
                },
             },

             submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
             }
          });

        var old_categories = {!!json_encode($assignedProducts) !!};

        if (old_categories && typeof old_categories == "object") {
            for (x of old_categories) {
                $(".checkBoxClass[value=" + x.product_id + "]").attr("checked", "checked");
            }
        }

    });

</script>
@endsection