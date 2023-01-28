@extends('layouts.app')
@section('page-title', 'Produk')
@section('page-subtitle', 'List data produk produk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/buttons.bootstrap5.min.css') }}">
    <link href="{{ asset('assets/extensions/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/libs/select2.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/extensions/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/utils/ajax-modal.js') }}"></script>
    <script src="{{ asset('assets/js/utils/select2.js') }}"></script>
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
            <!-- Data filter -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category_id" id="category" class="form-control select2 ajax-select2 w-full"
                            data-resource-url="{{ route('categories.select2') }}" placeholder="- semua kategori -" data-empty-option="- semua kategori -">
                            <!--Select2 -->
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="unit">Satuan</label>
                        <select name="unit_id" id="unit" class="form-control select2 ajax-select2 w-full"
                            data-resource-url="{{ route('units.select2') }}" placeholder="- semua satuan -" data-empty-option="- semua satuan -">
                            <!--Select2 -->
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 pt-4">
                    <button id="filter-btn" class="btn btn-primary px-4">
                        <i class="bi bi-filter-left me-1"></i>
                        <span>Filter</span>
                    </button>
                </div>
            </div>

            <!-- DataTable -->
            {!! $table->table(['class' => 'table table-striped w-100']) !!}
        </div>
    </div>
@endsection
