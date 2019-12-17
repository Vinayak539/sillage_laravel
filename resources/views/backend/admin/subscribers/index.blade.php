@extends('layouts.admin-master')
@section('title', 'Manage Subscribers')
@section('content')


<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Manage Subscribers </li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <form class="needs-validation" autocomplete="off" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="Enter City"
                            value="{{Request::get('city')}}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="territory">State</label>
                        <input type="text" name="territory" class="form-control" id="territory"
                            value="{{Request::get('territory')}}" placeholder="Enter State">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input type="number" name="pincode" class="form-control" id="pincode"
                            value="{{Request::get('pincode')}}" placeholder="Enter Pincode" minlength="5" min="1">
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-search"></i> Search
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive dt-responsive">
                <form action="{{ route('admin.subscribers.show') }}" method="POST">
                    @csrf
                    <table class="table table-striped table-hover" style="width:100%;">
                        <thead>
                            <tr>
                                <td colspan="6">
                                    <div class="text-right">
                                        @if(count($subscribers))
                                        <button type="submit" class="btn btn-outline-info">
                                            <i class="fas fa-pencil-alt"></i> Send Newsletter
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <input type="checkbox" id="ckbCheckAll">
                                    <label for="ckbCheckAll">All</label>
                                </th>
                                <th>Email</th>
                                <th>Pincode</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Subscribed On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subscribers as $subscriber)
                            <tr>
                                <td>
                                    <input type="checkbox" name="sendEmail[]" value="{{$subscriber->email}}"
                                        class="checkBoxClass">
                                </td>
                                <td>{{ $subscriber->email }}</td>
                                <td>{{ $subscriber->pincode }}</td>
                                <td>{{ $subscriber->city }}</td>
                                <td>{{ $subscriber->territory }}</td>
                                <td>{{ date('d-M-Y h:i A', strtotime($subscriber->created_at)) }}</td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td class="text-danger" colspan="6">
                                    <h4>No Subscriber Found..</h4>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Pincode</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Subscribed On</th>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="text-right">
                                        @if(count($subscribers))
                                        <button type="submit" class="btn btn-outline-info">
                                            <i class="fas fa-pencil-alt"></i> Send Newsletter
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

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
    });

</script>
@endsection