@extends('layout.home')

@section('title', 'List package')

@section('content')


<form id="searchForm">
    @csrf
    <input type="text" id="searchInput" class="form-control" placeholder="Search by package Name...">
    <input type="date" id="searchDate" class="form-control" placeholder="Search by date">
    <button type="button" id="searchButton" class="btn btn-primary">Search</button>
</form>
<div id="result"></div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchTerm = $('#searchInput').val();
            var searchDate = $('#searchDate').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('package.search') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    search: searchTerm,
                    date: searchDate
                },
                success: function(data) {
                    var packages = data.packages;
                    var result = '<h2>Search Results</h2>';

                    if (packages.length > 0) {
                        result += '<div class="row">';
                        packages.forEach(function(package) {
                            result +=
                                '<div class="col-md-4 col-xs-6 package package-grid">';
                            result += '<div class="package-item clearfix">';
                            result += '<div class="package-img hover-trigger">';
                            result += '<a href="/package/' + package.id + '">';
                            result += '<img src="/uploads/' + package.gambar +
                                '" alt="">';
                            result += '</a>';
                            result += '<div class="hover-2">';
                            result += '<div class="package-actions">';
                            result +=
                                '<a href="#" class="package-add-to-wishlist">';
                            result += '<i class="fa fa-heart"></i>';
                            result += '</a>';
                            result += '</div>';
                            result += '</div>';
                            result += '<a href="/package/' + package.id +
                                '" class="package-quickview">More</a>';
                            result += '</div>';
                            result += '<div class="package-details">';
                            result += '<h3 class="package-title">';
                            result += '<a href="/package/' + package.id + '">' +
                                package.nama_package + '</a>';
                            result += '</h3>';
                            result += '<span class="category">';
                            result += '</span>';
                            result += '</div>';
                            result += '<span class="amount">Rp ' + new Intl.NumberFormat().format(package.harga) + '</span>';
                            result += '<span class="price">';
                            result += '<ins>';
                            result += '</ins>';
                            result += '</span>';
                            result += '</div>';
                            result += '</div>';
                            result += '</div>';
                        });
                        result += '</div>';
                    } else {
                        result += '<p>No packages found.</p>';
                    }

                    $('#result').html(result);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                var searchTerm = $('#searchInput').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('package.search') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: searchTerm
                    },
                    success: function(data) {
                        var packages = data.packages;
                        var result = '<h2>Search Results</h2>';

                        if (packages.length > 0) {
                            result += '<div class="row">';
                            packages.forEach(function(package) {
                                result +=
                                    '<div class="col-md-4 col-xs-6 package package-grid">';
                                result += '<div class="package-item clearfix">';
                                result += '<div class="package-img hover-trigger">';
                                result += '<a href="/package/' + package.id + '">';
                                result += '<img src="/uploads/' + package.gambar +
                                    '" alt="">';
                                result += '<img src="/uploads/' + package.gambar +
                                    '" alt="" class="back-img">';
                                result += '</a>';
                                result += '<div class="hover-2">';
                                result += '<div class="package-actions">';
                                result +=
                                '<a href="#" class="package-add-to-wishlist">';
                                result += '<i class="fa fa-heart"></i>';
                                result += '</a>';
                                result += '</div>';
                                result += '</div>';
                                result += '<a href="/package/' + package.id +
                                    '" class="package-quickview">More</a>';
                                result += '</div>';
                                result += '<div class="package-details">';
                                result += '<h3 class="package-title">';
                                result += '<a href="/package/' + package.id + '">' +
                                    package.nama_barang + '</a>';
                                result += '</h3>';
                                result += '<span class="category">';
                                result += '</span>';
                                result += '</div>';
                                result += '<span class="amount">Rp ' + new Intl.NumberFormat().format(package.harga) + '</span>';
                                result += '<span class="price">';
                                result += '<ins>';
                                result += '</ins>';
                                result += '</span>';
                                result += '</div>';
                                result += '</div>';
                                result += '</div>';
                            });
                            result += '</div>';
                        } else {
                            result += '<p>No packages found.</p>';
                        }

                        $('#result').html(result);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script> --}}


    <!-- Catalogue -->
    <section class="section-wrap pt-80 pb-40 catalogue">
        <div class="container relative">

            <!-- Filter -->
            <div class="shop-filter">
                <div class="view-mode hidden-xs">
                    <span>View:</span>
                    <a class="grid grid-active" id="grid"></a>
                    <a class="list" id="list"></a>
                </div>
                <div class="filter-show hidden-xs">
                    <span>Show:</span>
                    <a href="#" class="active">12</a>
                    <a href="#">24</a>
                    <a href="#">all</a>
                </div>
                <form class="ecommerce-ordering">
                    <select>
                        <option value="default-sorting">Default Sorting</option>
                        <option value="price-low-to-high">Price: high to low</option>
                        <option value="price-high-to-low">Price: low to high</option>
                        <option value="by-popularity">By Popularity</option>
                        <option value="date">By Newness</option>
                        <option value="rating">By Rating</option>
                    </select>
                </form>
            </div>

            <div class="row">
                <div class="col-md-12 catalogue-col right mb-50">
                    <div class="shop-catalogue grid-view">

                        <div class="row items-grid">

                            @foreach ($packages as $package)
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
                                                <a href="/package/{{ $package->id }}">{{ $package->nama_produk }}</a>
                                            </h3>
                                            {{-- <span class="category">
                                                <a
                                                    href="/package/{{ $package->id_subkategori }}">{{ $package->subcategory->nama_subkategori }}</a>
                                            </span> --}}
                                        </div>

                                        <span class="price">
                                            <ins>
                                                <span class="amount">{{ 'Rp' . number_format($package->harga) }}</span>
                                            </ins>
                                        </span>
                                    </div>
                                </div> <!-- end package -->
                            @endforeach
                        </div> <!-- end row -->
                    </div> <!-- end grid mode -->

                    <!-- Pagination -->
                    <div class="pagination-wrap clearfix">
                        <p class="result-count">Showing: 12 of 80 results</p>
                        <nav class="pagination right clearfix">
                            <a href="#"><i class="fa fa-angle-left"></i></a>
                            <span class="page-numbers current">1</span>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </nav>
                    </div>

                </div> <!-- end col -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section> <!-- end catalog -->
@endsection
