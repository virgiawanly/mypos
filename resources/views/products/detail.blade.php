@extends('layouts.app')
@section('page-title', 'Detail Produk')
@section('page-subtitle', 'Detail data produk')

@push('scripts')
    <script src="{{ asset('assets/js/utils/ajax-modal.js') }}"></script>
    <script src="{{ asset('assets/js/pages/product-detail.js') }}"></script>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Produk</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center pb-3">
                <div class="col-lg-3 text-center">
                    <img src="{{ $product->image_url }}" loading="lazy" class="img img-thumbnail img-fluid img-avatar" alt="{{ $product->name }}"
                        style="object-fit: cover; width: 100%; height: 300px;">
                </div>
                <div class="col-lg-9">
                    <div class="table-responsive mt-4 mt-lg-0">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama Produk</th>
                                    <td class="text-center">:</td>
                                    <td colspan="4">{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Barcode</th>
                                    <td class="text-center">:</td>
                                    <td colspan="4">{{ $product->code }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td class="text-center">:</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <th>Satuan</th>
                                    <td class="text-center">:</td>
                                    <td>{{ $product->unit->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Beli</th>
                                    <td class="text-center">:</td>
                                    <td>@currency_format($product->buy_price)</td>
                                    <th>Harga Jual</th>
                                    <td class="text-center">:</td>
                                    <td>@currency_format($product->sell_price)</td>
                                </tr>
                                <tr>
                                    <th>Profit</th>
                                    <td class="text-center">:</td>
                                    <td>@currency_format($product->profit)</td>
                                    <th>Stok Tercatat</th>
                                    <td class="text-center">:</td>
                                    <td>@currency_format($product->stock)</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td class="text-center">:</td>
                                    <td colspan="5">{{ $product->info }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">
                                            <i class="bi bi-pencil-fill me-1"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="reset" class="btn btn-danger delete-btn"
                                            data-delete-url="{{ route('products.destroy', $product->id) }}"
                                            data-origin-url="{{ route('products.index') }}">
                                            <i class="bi bi-trash-fill me-1"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-light-secondary order-1" onclick="history.back()">
                    Kembali
                </button>
            </div>
        </div>
    </div>
@endsection
