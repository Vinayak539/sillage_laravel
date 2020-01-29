@extends('layouts.admin-master')
@section('title', 'Manage Bulk Orders')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Manage Bulk Orders</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Manage Bulk Orders</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Enquired On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enquiries as $enquiry)
                    <tr>
                        <td>{{ $enquiry->id }}</td>
                        <td>{{ $enquiry->name }}</td>
                        <td>{{ $enquiry->email }}</td>
                        <td>{{ $enquiry->mobile }}</td>
                        <td>{{ $enquiry->message }}</td>
                        <td>{{ date('d-M-Y h:i A', strtotime($enquiry->created_at)) }}</td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td class="text-danger" colspan="6">
                            <h4>No Record Found..</h4>
                        </td>
                    </tr>
                    @endforelse
                    @if($enquiries->total() > 50)
                    <tr class="text-center">
                        <td colspan="6">
                            {{ $enquiries->links() }}
                        </td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Enquired On</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</section>

@endsection

