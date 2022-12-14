@extends('layouts.cms')
@section('title', 'Reviews')
@section('content')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1.2em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1.2em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1.2em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: ' ★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Reviews</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Reviews
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <button id="addReview"
                        class="btn btn-icon btn-icon rounded-circle btn-primary waves-effect waves-light">
                        <i class="feather icon-plus-circle"></i></button>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="review_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Resentator</th>
                                                <th>Ratings</th>
                                                <th>Comments</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $rating)
                                                <tr class="text-center">
                                                    <td>
                                                        <div class="avatar mr-1 avatar-lg bg-transparent">
                                                            @if ($rating->image)
                                                                <img src="{{ asset('/img/user/' . $rating->image) }}"
                                                                    alt="{{ $rating->name }}">
                                                            @else
                                                                <img src="https://avatars.dicebear.com/api/adventurer/:jhone.svg"
                                                                    alt="{{ $rating->name }}">
                                                            @endif
                                                        </div>
                                                        <br>
                                                        {{ $rating->name }}
                                                        <br>
                                                        {{ $rating->company }}
                                                    </td>
                                                    <td>
                                                        @for($i=1; $i <= $rating->star_rating; $i++)
                                                        <i class="feather icon-star text-warning"></i>
                                                        @endfor
                                                    </td>
                                                    <td>{{ Str::limit($rating->comments, 50) }}</td>
                                                    <td>
                                                        @can('ratings-edit')
                                                            <button
                                                                class="btn btn-outline-primary round mr-1 mb-1 waves-effect waves-light edit-review"
                                                                type="button" data-id="{{ $rating->id }}">Update</button>
                                                        @endcan
                                                        @can('ratings-delete')
                                                            <button type="button"
                                                                class="btn btn-outline-danger round mr-1 mb-1 waves-effect waves-light"
                                                                id="delete-review" data-id="{{ $rating->id }}"
                                                                data-name="{{ $rating->name }}">Delete</button>
                                                        @endcan
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
    {{-- modals --}}
    <div class="modal fade text-left" data-backdrop="false" id="review-modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="reviewForm" name="reviewForm" enctype="multipart/form-data">
                    <input type="hidden" name="rating_id" id="rating_id">
                    <div class="modal-body">
                        <div class="row mb-2 justify-content-center">
                            <div class="col-auto">
                                <img class="avatar-sm rounded-circle" width="100" height="100" id="modal-preview"
                                    src="https://via.placeholder.com/150"><br><br>
                                <div class="upload-btn-wrapper">
                                    <button class="btn-upload">Upload Avatar</button>
                                    <input id="image" type="file" name="image" accept="image/*"
                                        onchange="readURL(this);">
                                </div>
                                <input type="hidden" name="hidden_image" id="hidden_image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Resentator </label>
                                <input id="name" name="name" type="text" placeholder="Resentator"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company </label>
                                <input id="company" name="company" type="text" placeholder="Company"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Comments </label>
                                <textarea class="form-control" name="comments" id="comments" cols="10" rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ratings</label>
                                <br>
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="star_rating" value="5"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio"  id="star4" class="rate" name="star_rating" value="4"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="star_rating" value="3"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="star_rating" value="2">
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="star_rating" value="1"/>
                                    <label for="star1" title="text">1 star</label>
                                </div>
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
        // Service villa
        $(document).ready(function() {
            $('#addReview').click(function() {
                $('#btn-save').val("create-review");
                $('#title').html("Add Review");
                $('#reviewForm').trigger("reset");
                $('#review-modal').modal('show');
                $('#modal-preview').attr('src', 'https://via.placeholder.com/150');

            });

            $('body').on('click', '.edit-review', function() {
                var rating_id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: SITEURL + "/dashboard/reviews/edit/" + rating_id,
                    success: function(data) {
                        $('#title').html("Edit Review");
                        $('#btn-save').val("edit-review");
                        $('#review-modal').modal('show');
                        $('#rating_id').val(data.id);
                        $('#name').val(data.name);
                        $('#company').val(data.company);
                        $('#comments').val(data.comments);
                        // if($("input:radio").val(data.star_rating)) {
                        //     $("#star"+data.star_rating).prop("checked", false);
                        // }
                        $('#modal-preview').attr('alt', 'No image available');
                        if (data.image) {
                            $('#modal-preview').attr('src', '{{ URL::to('/img/user') }}' + '/' + data.image);
                            $('#hidden_image').attr('src', '{{ URL::to('/img/user') }}' + '/' + data.image);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            });

            $('body').on('click', '#delete-review', function() {
                var rating_id = $(this).data('id');
                var service_name = $(this).data('name');
                var text_data = 'Are you sure to delete review from ' + ' ' + service_name + ' ?';
                Swal.fire({
                    title: 'Delete Review',
                    text: text_data,
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
                            url: SITEURL + "/dashboard/reviews/destroy/" + rating_id,
                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == true) {
                                    $("#review_table").load(window.location.href +
                                        " #review_table");
                                    Swal.fire({
                                        type: "success",
                                        title: 'Deleted!',
                                        text: 'Review has been deleted.',
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

        $('body').on('submit', '#reviewForm', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/dashboard/reviews/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#reviewForm').trigger("reset");
                    $('#review-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $("#review_table").load(window.location.href + " #review_table");
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        });
    </script>
@endpush
