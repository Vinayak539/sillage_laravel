@extends('layouts.admin-master')
@section('title', 'Manage Tickets')
@section('content')

{{-- Model --}}

<div class="modal" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Raise Ticket</h3>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" role="form" class="needs-validation" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" placeholder="Enter Customer Email ID" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subject">Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    value="{{ old('subject') }}" placeholder="Enter Subject" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Write Description</label>
                                <textarea name="description" id="description" rows="5" class="form-control"
                                    placeholder="Please Write Description here...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-danger">
                            Note : All * Mark Fields are Compulsory !
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSubmit">
                        <i class="fa fa-plus"></i> Raise Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Model End --}}

<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Manage Tickets</h5>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="/adrana951">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#addModal" data-toggle="modal" data-target="#addModal">Raise Ticket</a>
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
                        <td>{{ $ticket->closed_at ? date('d-m-Y h:i A', strtotime($ticket->closed_at)) : 'Not closed yet' }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="dropdown-item"
                                        title="Edit Detail">
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