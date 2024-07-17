@extends('layout.home')

{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

@section('title', 'Home')

@section('content')
    <!-- Hero Slider -->
    <section class="hero-wrap text-center relative">
        <div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated" style="height: 650px;">
            @foreach ($sliders as $slider)           
            <div class="hero-slide overlay" style="background-image:url(/uploads/{{$slider->gambar}})">
                <div class="container">
                    <div class="hero-holder">
                        <div class="hero-message">
                            <h1 class="hero-title nocaps">{{$slider->nama_slider}}</h1>
                            <h2 class="hero-subtitle lines">{{$slider->deskripsi}}</h2>                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section> <!-- end hero slider -->
    
        {{-- <div id="react-app" class="mb-5 react-app-container"></div>
        <script src="{{ mix('js/app.js') }}"></script> --}}
        <br>
        <h2>Search Your Package</h2>
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
        
                                                           
    <!-- Promo Banners -->
    <section class="section-wrap promo-banners pb-30">
        <div class="container">
            <div class="row">
                @foreach ($cities as $city)
                    <div class="col-xs-4 col-xxs-12 mb-30 promo-banner">
                        <a href="/packages/{city}">
                            <img src="/uploads/{{$city->gambar}}" alt="">
                            <div class="overlay"></div>
                            <div class="promo-inner valign">
                                <h2>{{$city->nama_kategori}}</h2>
                                <span>{{$city->deskripsi}}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section> <!-- end promo banners -->

    <!-- Trendy packages -->
    <section class="section-wrap-sm new-arrivals pb-50">
        <div class="container">
            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <span class="subheading">Hot items of this year</span>
                    <h2 class="heading bottom-line">trendy packages</h2>
                </div>
            </div>
            <div class="row items-grid">
                @foreach($packages as $package)
                    <div class="col-md-3 col-xs-6">
                        <div class="package-item hover-trigger">
                            <div class="package-img">
                                <a href="/frontend/shop-single.html">
                                    <img src="/uploads/{{$package->gambar}}" alt="">
                                </a>
                                <div class="hover-overlay">
                                    <div class="package-actions">
                                        <a href="/frontend/#" class="package-add-to-wishlist">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </div>
                                    <div class="package-details valign">
                                        {{-- <span class="category">
                                            <a href="/packages/{{$package->id_subkategori}}">{{$package->subcategory->nama_subkategori}}</a>
                                        </span>
                                        <h3 class="package-title">
                                            <a href="/package/{{$package->id}}">{{$package->nama_package}}</a>
                                        </h3> --}}
                                        <span class="price">
                                            <ins>
                                                <span class="amount">{{'Rp' . number_format($package->harga)}}</span>
                                            </ins>
                                        </span>
                                        <div class="btn-quickview">
                                            <a href="/package/{{$package->id}}" class="btn btn-md btn-color">
                                                <span>More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> <!-- end row -->
        </div>
    </section> <!-- end trendy packages -->

    <!-- Testimonials -->
    <section class="section-wrap relative testimonials bg-parallax overlay" style="background-image:url(img/testimonials/testimonial_bg.jpg);">
        <div class="container relative">
            <div class="row heading-row mb-20">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2 class="heading white bottom-line">Happy Clients</h2>
                </div>
            </div>
            <div id="owl-testimonials" class="owl-carousel owl-theme text-center">
                {{-- @foreach ($testimonies as $testimony)
                    <div class="item">
                        <div class="testimonial">
                            <p class="testimonial-text">{{$testimony->deskripsi}}</p>
                            <span>{{$testimony->nama_testimoni}}</span>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </section> <!-- end testimonials -->
@endsection
