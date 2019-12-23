@extends('layouts.admin-master')
@section('title', 'Assigned Products')
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
            <h4>Assigned Product of {{ $section->SectionName }}</h4>
        </div>
        <div class="card-body">
            <form method="post" role="form" class="needs-validation" id="formRemoveProduct">
                @csrf
                <div class="card-body">
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
                                @forelse($assignedProducts as $assign)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                class="custom-control-input customCheck checkBoxClass" name="assign[]"
                                                value="{{$assign->id}}" id="customCheck{{ $assign->id }}" required>
                                            <label class="custom-control-label mb-3"
                                                for="customCheck{{ $assign->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ '/storage/images/products/'. $assign->product->image_url }}"
                                            target="_blank"><img
                                                src="{{ '/storage/images/products/'. $assign->product->image_url }}"
                                                alt="{{ $assign->product->title }}" width="50">
                                        </a>
                                    </td>
                                    <td>{{ $assign->product->title }}</td>
                                </tr>

                                @empty
                                <tr class="text-center">
                                    <td class="text-danger" colspan="3">
                                        <h4>No Product Assign <a
                                                href="{{ route('admin.sections.assign', $section->id) }}"
                                                title="Assign Product"> <span class="text-info">click here </span></a>
                                            to Assign
                                        </h4>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            @if(count($assignedProducts))
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <button type="submit" class="btn btn-primary btnSubmit pull-right">
                                            <i class="fa fa-tasks"></i> Remove Assign
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
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

        var old_categories = {!!json_encode($assignedProducts) !!};

        if (old_categories && typeof old_categories == "object") {
            for (x of old_categories) {
                $(".customCheck[value=" + x.id + "]").attr("checked", "checked");
            }
        }
        
        $("#formRemoveProduct").validate({
             rules: {
    
                "assign[]": {
                   required: true
                },
             },
             messages: {
                "assign[]": {
                   required: "Please Select Product to Remove"
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