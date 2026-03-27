@extends('layouts.cms')
@section('title', 'FAQ')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">FAQ</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">FAQ</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button id="addFaq" class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                        <i class="feather icon-plus-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="faq_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Question</th>
                                                <th>Answer</th>
                                                <th>Sort Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $faq)
                                                <tr class="text-center">
                                                    <td>{{ Str::limit($faq->question, 50) }}</td>
                                                    <td>{{ Str::limit(strip_tags($faq->answer), 50) }}</td>
                                                    <td>{{ $faq->sort_order }}</td>
                                                    <td>
                                                        <button class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-faq" type="button" data-id="{{ $faq->id }}">Update</button>
                                                        <button type="button" class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light" id="delete-faq" data-id="{{ $faq->id }}" data-name="{{ $faq->question }}">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade text-left" data-backdrop="false" id="faq-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="faqForm" name="faqForm">
                    <input type="hidden" name="faq_id" id="faq_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label>Question</label>
                                <input id="question" name="question" type="text" placeholder="Enter question" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sort Order</label>
                                <input id="sort_order" name="sort_order" type="number" placeholder="0" class="form-control" value="0">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Answer</label>
                                <textarea class="form-control" name="answer" id="answer" cols="10" rows="4" placeholder="Enter answer"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addFaq').click(function() {
                $('#btn-save').val("create-faq");
                $('#title').html("Add FAQ");
                $('#faqForm').trigger("reset");
                $('#faq-modal').modal('show');
            });

            $('body').on('click', '.edit-faq', function() {
                var faq_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/faqs/edit/" + faq_id,
                    success: function(data) {
                        $('#title').html("Edit FAQ");
                        $('#btn-save').val("edit-faq");
                        $('#faq-modal').modal('show');
                        $('#faq_id').val(data.id);
                        $('#question').val(data.question);
                        $('#answer').val(data.answer);
                        $('#sort_order').val(data.sort_order);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '#delete-faq', function() {
                var faq_id = $(this).data('id');
                var faq_name = $(this).data('name');
                Swal.fire({
                    title: 'Delete FAQ',
                    text: 'Are you sure to delete "' + faq_name + '"?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: SITEURL + "/dashboard/faqs/destroy/" + faq_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#faq_table").load(window.location.href + " #faq_table");
                                    Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'FAQ has been deleted.',
                                        confirmButtonClass: 'btn btn-success',
                                    })
                                }
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        });

        $('body').on('submit', '#faqForm', function(e) {
            e.preventDefault();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/faqs/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#faqForm').trigger("reset");
                    $('#faq-modal').modal('hide');
                    $('#btn-save').html('Save');
                    $("#faq_table").load(window.location.href + " #faq_table");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save');
                }
            });
        });
    </script>
@endpush
