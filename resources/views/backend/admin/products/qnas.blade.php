@extends('layouts.admin-master')
@section('title', 'Product Question and Answer')
@section('content')

<section class="section">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark text-white-all">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.all') }}"><i class="fas fa-list"></i> All
                    Products</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header bg-dark text-white-all">
            <h4>Product Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 bg-white pt-20 table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Product ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>

                            <tr>
                                <th>Product Name</th>
                                <td>{{ $product->title }}</td>
                            </tr>

                            <tr>
                                <th>Image</th>
                                <td>
                                    <a href="/storage/images/products/{{ $product->image_url }}" target="_blank">
                                        <img src="/storage/images/products/{{ $product->image_url }}"
                                            alt="{{ $product->name }}" width="50">
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="col-md-12 bg-white pt-20 table-responsive">
                    <div class="card-header bg-dark text-white-all">
                        <h4>Question & Answer Information</h4>
                    </div>
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Answered By</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Asked On</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($product->qnas as $qna)
                            <tr>
                                <td>{{ $qna->id }}</td>
                                <td>{{ $qna->replied_by }}</td>
                                <td>{{ str_limit($qna->question, 30) }}</td>
                                <td>{{ str_limit($qna->answer, 30) }}</td>
                                <td>{{ $qna->status == true ? 'Active' : 'Blocked' }}</td>
                                <td>{{ date('d-M-Y', strtotime($qna->created_at)) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('admin.product-faqs.edit', $qna->id) }}"
                                                class="dropdown-item" title="Edit Detail">
                                                <i class="fa fa-edit text-primary"></i> Edit
                                            </a>
                                            <button type="button" data-role="delete-obj" data-obj-id="{{$qna->id}}"
                                                class="dropdown-item delete-object" title="Delete qna">
                                                <i class="fa fa-trash text-danger"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td class="text-danger" colspan="7">
                                    <h4>No Record Found..</h4>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Answered By</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Asked On</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<form id="formDelete" method="POST" action="/adrana951/manage-products/delete/question/">
    @csrf
</form>
@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
        $(".delete-object").click(function () {
            if (window.confirm("Are you sure, You want to Delete ? ")) {
                var action = $("#formDelete").attr("action") + $(this).attr("data-obj-id");
                $("#formDelete").attr("action", action);
                $("#formDelete").submit();
                $(this).html('wait...');
            }
        });
    });

</script>
@endsection
