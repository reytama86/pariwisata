<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        /* Tambahkan CSS styling sesuai kebutuhan Anda */
        .package {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>

    <h2>Search Results</h2>
    <p>Search Term: {{ $searchTerm }}</p>
    <p>Search Date: {{ $searchDate }}</p>

    @if(count($packages) > 0)
        <div class="row">
            @foreach($packages as $package)
                <div class="col-md-4 col-xs-6 package package-grid">
                    <div class="package-item clearfix">
                        <div class="package-img hover-trigger">
                            <a href="/package/{{ $package->id }}">
                                <img src="/uploads/{{ $package->gambar }}" alt="">
                                <img src="/uploads/{{ $package->gambar }}" alt="" class="back-img">
                            </a>
                            <div class="hover-2">
                                <div class="package-actions">
                                    <a href="#" class="package-add-to-wishlist">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="/package/{{ $package->id }}" class="package-quickview">More</a>
                        </div>
                        <div class="package-details">
                            <h3 class="package-title">
                                <a href="/package/{{ $package->id }}">{{ $package->nama_package }}</a>
                            </h3>
                            <span class="category"></span>
                        </div>
                        <span class="amount">Rp {{ number_format($package->harga) }}</span>
                        <span class="price">
                            <ins></ins>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No packages found.</p>
    @endif

</body>
</html>
