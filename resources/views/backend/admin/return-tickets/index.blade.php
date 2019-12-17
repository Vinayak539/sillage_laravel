@extends('layouts.admin-master')
@section('title', 'Manage Return & Refund Tickets')
@section('content')

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Return & Refund Tickets</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Raise By</th>
                        <th>Status</th>
                        <th>Raise On</th>
                        <th>Closed On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ str_limit($ticket->subject, 30) }}</td>
                        <td>{{ $ticket->open_by }}</td>
                        <td>{{ $ticket->status == true ? 'Open' : 'Closed' }}</td>
                        <td>{{ date('d-M-Y h:i A', strtotime($ticket->created_at)) }}</td>
                        <td>{{ $ticket->closed_at ? date('d-m-Y h:i A', strtotime($ticket->closed_at)) : 'Not closed yet' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.return-tickets.edit', $ticket->id) }}"
                                        class="dropdown-item" title="Edit Detail">
                                        <i class="fa fa-edit text-primary"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td class="text-danger" colspan="8">
                            <h4>No Record Found..</h4>
                        </td>
                    </tr>
                    @endforelse
                    <tr class="text-center">
                        <td colspan="8">
                            {{ $tickets->links() }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Raise By</th>
                        <th>Status</th>
                        <th>Raise On</th>
                        <th>Closed On</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection