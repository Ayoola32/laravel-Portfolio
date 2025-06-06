@extends('admin.layouts.layout')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Blog Category Section</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Category</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.blog-category.create')}}" class="btn btn-primary">Add New <i
                                    class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                                {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush