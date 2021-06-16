@extends('admin.layouts.app')

@section('main-content')

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('admin.layouts.header')
        @include('admin.layouts.menu')



        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">

                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome {{ Auth::user() -> name }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Tag</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">

                        @include('validate')

                        <a  class="btn btn-primary" data-toggle="modal" href="#add_tag_modal">Add New Tag</a>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Tags</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tag name</th>
                                                <th>Tag slug</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_data as $data)

                                         <tr>
                                            <td>{{ $loop -> index+1 }}</td>
                                            <td>{{ $data -> name }}</td>
                                            <td>{{ $data -> slug }}</td>
                                            <td>{{ $data -> created_at -> diffForHumans() }}</td>
                                            <td>
                                                <div class="status-toggle">
                                                    <input  type="checkbox" status_id="{{ $data -> id }}"  {{ ( $data -> status == true ? 'checked="checked"' : '' ) }} id="cat_status_{{ $loop -> index + 1 }}" class="check cat_check" >
                                                    <label for="cat_status_{{ $loop -> index + 1 }}" class="checktoggle">checkbox</label>
                                                </div>
                                            </td>


                                            <td>
                                                <a edit_id="{{ $data -> id }}" class="btn btn-sm btn-warning edit_tag" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                    <form class="d-inline" action="{{ route('tag.destroy',  $data -> id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm delete-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>

                                            </td>
                                        </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->


{{-- add tag modal --}}
    <div id="add_tag_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Add new Category</h2>
                    <hr>
                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Name"></label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- edit tag modal --}}
    <div id="edit_tag_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Edit Category</h2>
                    <hr>
                    <form action="{{ route('tag.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                            <input name="edit_id" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-sm" type="submit" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection
