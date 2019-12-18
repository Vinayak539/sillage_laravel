@extends('layouts.admin-master')
@section('title', 'Assign Product')
@section('content')
<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.sections.all') }}"><i class="fas fa-list"></i> Manage Sections</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Assign Product in {{ $section->SectionName }}</h4>
        </div>
        <div class="card-body">
            <form method="post" role="form" class="needs-validation">
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
                                        <th>Name</th>
                                        <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkBoxClass"
                                                name="assign[]" value="{{$product->id}}" id="customCheck{{ $product->id }}">
                                            <label class="custom-control-label mb-3"
                                                for="customCheck{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->buy_it_now_price }}</td>
                                </tr>
    
                                @empty
                                <tr class="text-center">
                                    <td class="text-danger" colspan="7">
                                        <h4>No Data Found..</h4>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            @if(count($products))
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <button type="submit" class="btn btn-primary btnSubmit pull-right">
                                            <i class="fa fa-tasks"></i> Assign
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
                $(".checkBoxClass[value=" + x.id + "]").attr("checked", "checked");
            }
        }

    });

</script>
@endsection