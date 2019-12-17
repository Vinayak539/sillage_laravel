@extends('layouts.admin-master')
@section('title', 'Assigned Products')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Assigned Product of {{ $section->SectionName }}</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.sections.all') }}">Manage Sections</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="content">
    <div class="card">
        <form method="post" role="form" class="needs-validation">
            @csrf
            <div class="card-body">
                <div class="col-md-12 mx-auto table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignedProducts as $assign)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input customCheck" name="assign[]"
                                            value="{{$assign->id}}" id="customCheck{{ $assign->id }}">
                                        <label class="custom-control-label mb-3"
                                            for="customCheck{{ $assign->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $assign->product->title }}</td>
                                <td>{{ $assign->product->buy_it_now_price }}</td>
                            </tr>

                            @empty
                            <tr class="text-center">
                                <td class="text-danger" colspan="3">
                                    <h4>No Product Assign <a href="{{ route('admin.sections.assign', $section->id) }}"
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

        var old_categories = {!!json_encode($assignedProducts) !!};
        
        if (old_categories && typeof old_categories == "object") {
            for (x of old_categories) {
                $(".customCheck[value=" + x.id + "]").attr("checked", "checked");
            }
        }

    });

</script>
@endsection