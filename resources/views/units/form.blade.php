@extends('layouts.app')
@section('page-title', isset($unit) ? 'Edit Satuan' : 'Tambah Satuan')
@section('page-subtitle', isset($unit) ? 'Edit data satuan' : 'Buat satuan baru')

@section('content')
    <form action="{{ isset($unit) ? route('units.update', $unit) : route('units.store') }}" method="POST">
        @csrf
        @if (isset($unit))
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form {{ isset($unit) ? 'Edit' : 'Tambah' }} Satuan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Nama Satuan</label>
                    </div>
                    <div class="col-md-9 form-group">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ?? ($unit->name ?? '') }}" name="fname" placeholder="Nama Satuan" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Keterangan</label>
                    </div>
                    <div class="col-md-9 form-group">
                        <textarea name="info" id="info" name="info" class="form-control @error('info') is-invalid @enderror"
                            style="resize: none; min-height: 100px;" placeholder="Keterangan">{{ old('info') ?? ($unit->info ?? '') }}</textarea>
                        @error('info')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
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
