@extends('admin.layouts.layout')

@section('content')
    <!-- Main Content -->
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('admin.typer-title.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>TyperTitle Section</h1>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add new Typer-title</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.typer-title.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" name="title" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7 text-right">
                                          <button class="btn btn-primary">Create Title</button>
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
