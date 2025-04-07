@extends('admin.layouts.layout')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Footer Help-Links</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Help Links</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.footer-help.create')}}" class="btn btn-primary">Add New <i
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