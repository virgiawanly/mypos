@extends('layouts.app')
@section('page-title', 'Satuan Produk')
@section('page-subtitle', 'List data satuan produk')

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
    <script src="{{ asset('assets/js/pages/units.js') }}"></script>
    <!-- Initialize DataTable -->
    {!! $table->scripts() !!}
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title">List Satuan</h4>
            <div class="card-header-form">
                <a href="{{ route('units.create') }}" class="btn btn-primary">Tambah Satuan</a>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTable -->
            {!! $table->table(['class' => 'table table-striped w-100']) !!}
        </div>
    </div>
@endsection
