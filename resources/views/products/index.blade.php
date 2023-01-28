@extends('layouts.app')
@section('page-title', 'Produk')
@section('page-subtitle', 'List data produk produk')

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
    <script src="{{ asset('assets/js/pages/products.js') }}"></script>
    <!-- Initialize DataTable -->
    {!! $table->scripts() !!}
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title">List Produk</h4>
            <div class="card-header-form">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Produk</a>
                <!-- Example single danger button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle ps-2" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Stock Opname</a></li>
                        <li><a class="dropdown-item" href="#">Setting Keuntungan</a></li>
                        <li><a class="dropdown-item" href="#">Setting Discount</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTable -->
            {!! $table->table(['class' => 'table table-striped w-100']) !!}
        </div>
    </div>
@endsection
