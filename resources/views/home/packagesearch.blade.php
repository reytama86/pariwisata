<!-- resources/views/packages/show.blade.php -->

@extends('layout.app') <!-- Sesuaikan dengan layout aplikasi Anda -->

@section('content')
    <h2>Packages in {{ $city }}</h2>

    @if(count($packages) > 0)
        <div class="row">
            @foreach($packages as $package)
                <div class="col-md-4 col-xs-6 package package-grid">
                    <div class="package-item clearfix">
                        <div class="package-img hover-trigger">
                            <a href="/package/{{ $package->id }}">
                                <img src="/uploads/{{ $package->gambar }}" alt="{{ $package->nama_package }}">
                            </a>
                            <!-- ... tambahkan elemen HTML lainnya sesuai kebutuhan ... -->
                        </div>
                        <div class="package-details">
                            <h3 class="package-title">
                                <a href="/package/{{ $package->id }}">{{ $package->nama_package }}</a>
                            </h3>
                            <span class="amount">Rp {{ number_format($package->harga) }}</span>
                            <!-- ... tambahkan elemen HTML lainnya sesuai kebutuhan ... -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No packages found in {{ $city }}.</p>
    @endif
@endsection
