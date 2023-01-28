@extends('layouts.app')
@section('page-title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('page-subtitle', isset($product) ? 'Edit data produk' : 'Buat produk baru')

@push('styles')
    <link href="{{ asset('assets/extensions/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/libs/select2.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/extensions/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/utils/select2.js') }}"></script>
    <script src="{{ asset('assets/js/pages/product-form.js') }}"></script>
@endpush

@section('content')
    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form {{ isset($product) ? 'Edit' : 'Tambah' }} Produk</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Nama Produk <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9 form-group">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ?? ($product->name ?? '') }}" placeholder="Nama Produk" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Barcode <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9 form-group">
                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror"
                            value="{{ old('code') ?? ($product->code ?? '') }}" placeholder="Barcode" />
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Harga Beli <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9 form-group">
                        <input type="text" id="buy_price" name="buy_price" class="form-control @error('buy_price') is-invalid @enderror"
                            value="{{ old('buy_price') ?? ($product->buy_price ?? '') }}" />
                        @error('buy_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Harga Jual <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9 form-group">
                        <input type="text" id="sell_price" name="sell_price" class="form-control @error('sell_price') is-invalid @enderror"
                            value="{{ old('sell_price') ?? ($product->sell_price ?? '') }}" />
                        @error('sell_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                @if (!isset($product))
                    <div class="row">
                        <div class="col-md-3">
                            <label>Stok Awal <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-9 form-group">
                            <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock') ?? ($product->stock ?? '') }}" />
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <label>Kategori</label>
                    </div>
                    <div class="col-md-9 form-group">
                        <select name="category_id" class="form-control select2 ajax-select2" id="category" style="width: 100%;"
                            data-resource-url="{{ route('categories.select2') }}">
                            @if (old('category_id') && isset($category))
                                <option value="{{ $category->id }}" selected>
                                    {{ $category->name }}
                                </option>
                            @elseif (isset($product) && $product->category_id)
                                <option value="{{ $product->category_id }}" selected>
                                    {{ $product->category->name ?? '' }}
                                </option>
                            @endif
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Satuan</label>
                    </div>
                    <div class="col-md-9 form-group">
                        <select name="unit_id" class="form-control select2 ajax-select2" id="unit" style="width: 100%;"
                            data-resource-url="{{ route('units.select2') }}">
                            @if (old('unit_id') && isset($unit))
                                <option value="{{ $unit->id }}" selected>
                                    {{ $unit->name }}
                                </option>
                            @elseif (isset($product) && $product->unit_id)
                                <option value="{{ $product->unit_id }}" selected>
                                    {{ $product->unit->name ?? '' }}
                                </option>
                            @endif
                        </select>
                        @error('unit_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Keterangan</label>
                    </div>
                    <div class="col-md-9 form-group">
                        <textarea name="info" id="info" name="info" class="form-control @error('info') is-invalid @enderror"
                            style="resize: none; min-height: 100px;" placeholder="Keterangan">{{ old('info') ?? ($product->info ?? '') }}</textarea>
                        @error('info')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Gambar Produk</label>
                    </div>
                    <div class="col-md-9 form-group">
                        <label for="product-image-uploader" class="d-block">
                            <img id="product-image-preview" src="{{ $product->image_url ?? asset('assets/images/no-product-image.svg') }}"
                                class="d-block img-thumbnail" style="width: 300px; height: 240px; object-fit: cover;">
                        </label>
                        <input type="file" class="mt-2 btn btn-light-secondary" style="width: 300px;" id="product-image-uploader" accept="image/*"
                            name="image">
                        @error('image')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-between mt-3">
                        <div class="order-2">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-light-secondary">
                                Reset
                            </button>
                        </div>
                        <button type="button" class="btn btn-light-secondary order-1" onclick="history.back()">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
