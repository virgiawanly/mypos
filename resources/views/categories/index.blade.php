@extends('layouts.app')
@section('page-title', 'Kategori Produk')
@section('page-subtitle', 'List data kategori produk')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/buttons.bootstrap5.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/extensions/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/utils/ajax-modal.js') }}"></script>
    <script src="{{ asset('assets/js/pages/categories/index.js') }}"></script>
    <!-- Initialize DataTable -->
    {!! $table->scripts() !!}
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title">List Kategori</h4>
            <div class="card-header-form">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTable -->
            {!! $table->table(['class' => 'table table-striped w-100']) !!}
        </div>
    </div>
@endsection
