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
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Subscribers</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive dt-responsive">
                <form action="{{ route('admin.subscribers.show') }}" method="POST">
                    @csrf
                    <table class="table table-striped table-hover" style="width:100%;">
                        <thead>
                            <tr>
                                <td colspan="4">
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
                                <th>Status</th>
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
                                <td>{{ $subscriber->status ? 'Subscribed' : 'Unsubscribed' }}</td>
                                <td>{{ date('d-M-Y h:i A', strtotime($subscriber->created_at)) }}</td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td class="text-danger" colspan="4">
                                    <h4>No Subscriber Found..</h4>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Subscribed On</th>
                            </tr>
                            <tr>
                                <td colspan="4">
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
