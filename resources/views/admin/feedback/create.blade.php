@extends('admin.layouts.layout')

@section('content')
    <!-- Main Content -->
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('admin.feedback.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Feedback Category Section</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add new Feedback</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.feedback.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="name" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Position</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="position" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Comments</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea name="comment" class="summernote"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7 text-right">
                                          <button class="btn btn-primary">Create Category</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
