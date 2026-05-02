@extends('layouts.mahasiswa')

@section('sections')
    {{-- DASHBOARD SECTION --}}
    @include('mahasiswa.partials.dashboard')

    {{-- PENGAJUAN SECTION --}}
    @include('mahasiswa.partials.pengajuan')

    {{-- PENGATURAN SECTION --}}
    @include('mahasiswa.partials.pengaturan')
@endsection