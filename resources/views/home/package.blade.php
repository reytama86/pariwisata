@extends('layout.home')

@section('title', 'package')

@section('content')

    <!-- Single package -->
    <section class="section-wrap pb-40 single-package">
        <div class="container-fluid semi-fluid">
            <div class="row">

                <div class="col-md-6 col-xs-12 package-slider mb-60">

                    <div class="flickity flickity-slider-wrap mfp-hover" id="gallery-main">

                        <div class="gallery-cell">
                            <a href="/uploads/{{ $package->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $package->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $package->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $package->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $package->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $package->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $package->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $package->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                        <div class="gallery-cell">
                            <a href="/uploads/{{ $package->gambar }}" class="lightbox-img">
                                <img src="/uploads/{{ $package->gambar }}" alt="" />
                                <i class="ui-zoom zoom-icon"></i>
                            </a>
                        </div>
                    </div> <!-- end gallery main -->

                    <div class="gallery-thumbs">
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $package->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $package->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $package->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $package->gambar }}" alt="" />
                        </div>
                        <div class="gallery-cell">
                            <img src="/uploads/{{ $package->gambar }}" alt="" />
                        </div>
                    </div> <!-- end gallery thumbs -->

                </div> <!-- end col img slider -->

                <div class="col-md-6 col-xs-12 package-description-wrap">
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            Catalog
                        </li>
                    </ol>
                    <h1 class="package-title">{{ $package->nama_package }}</h1>
                    <span class="price">
                        <ins>
                            <span class="amount">Rp . {{ number_format($package->harga) }}</span>
                        </ins>
                    </span>
                    <p class="short-description">{{ $package->deskripsi }}</p>

                    <div class="color-swatches clearfix">
                        <span>Color:</span>
                        @php
                            $colours = explode(',', $package->warna);
                        @endphp

                        @foreach ($colours as $colour)
                            <input type="radio" name="color" id="{{ $colour }}" value="{{ $colour }}"
                                class="color">
                            <label for="{{ $colour }}" style="margin-right: 20px">{{ $colour }}</label>
                        @endforeach
                    </div>

                    <div class="size-options clearfix">
                        <span>Size:</span>
                        @php
                            $sizes = explode(',', $package->ukuran);
                        @endphp

                        @foreach ($sizes as $size)
                            <input type="radio" name="sizes" id="{{ $size }}" value="{{ $size }}"
                                class="size">
                            <label for="{{ $size }}" style="margin-right: 20px">{{ $size }}</label>
                        @endforeach
                    </div>

                    <div class="package-actions">
                        <span>Qty:</span>

                        <div class="quantity buttons_added">
                            <input type="number" step="1" min="0" value="1" title="Qty"
                                class="input-text jumlah qty text" />
                            <div class="quantity-adjust">
                                <a href="#" class="plus">
                                    <i class="fa fa-angle-up"></i>
                                </a>
                                <a href="#" class="minus">
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </div>
                        </div>

                        <a href="#" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></a>

                        <a href="#" class="package-add-to-wishlist"><i class="fa fa-heart"></i></a>
                    </div>


                    <div class="package_meta">
                        <span class="sku">SKU: <a href="#">{{ $package->sku }}</a></span>
                        <span class="brand_as">Category: <a href="#">{{ $package->city->name }}</a></span>
                        <span class="posted_in">Tags: <a href="#">{{ $package->tags }}</a></span>
                    </div>

                    <!-- Accordion -->
                    <div class="panel-group accordion mb-50" id="accordion">
                        <div class="panel">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                    class="minus">Description<span>&nbsp;</span>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    {{ $package->deskripsi }}
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                        class="plus">Information<span>&nbsp;</span>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table shop_attributes">
                                            <tbody>
                                                <tr>
                                                    <th>Size:</th>
                                                    <td>{{ $package->ukuran }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Colors:</th>
                                                    <td>{{ $package->warna }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fabric:</th>
                                                    <td>{{ $package->bahan }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="socials-share clearfix">
                            <span>Share:</span>
                            <div class="social-icons nobase">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div> <!-- end col package description -->
                </div> <!-- end row -->

            </div> <!-- end container -->
    </section> <!-- end single package -->


    <!-- Related packages -->
    <section class="section-wrap pt-0 shop-items-slider">
        <div class="container">
            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <h2 class="heading bottom-line">
                        Latest packages
                    </h2>
                </div>
            </div>

            <div class="row">

                <div id="owl-related-items" class="owl-carousel owl-theme">
                    @foreach ($latest_package as $produk)
                        <div class="package">
                            <div class="package-item hover-trigger">
                                <div class="package-img">
                                    <a href="/package/{{ $produk->id }}">
                                        <img src="/uploads/{{ $produk->gambar }}" alt="">
                                        <img src="/uploads/{{ $produk->gambar }}" alt="" class="back-img">
                                    </a>
                                    <div class="package-label">
                                        <span class="sale">sale</span>
                                    </div>
                                    <div class="hover-2">
                                        <div class="package-actions">
                                            <a href="#" class="package-add-to-wishlist">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="/package/{{ $produk->id }}" class="package-quickview">More</a>
                                </div>
                                <div class="package-details">
                                    <h3 class="package-title">
                                        <a href="/package/{{ $produk->id }}">{{ $produk->nama_produk }}</a>
                                    </h3>
                                </div>
                                <span class="price">
                                    <ins>
                                        <span class="amount">{{ 'Rp' . number_format($produk->harga) }}</span>
                                    </ins>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- end slider -->
            </div>
        </div>
    </section> <!-- end related packages -->

@endsection

@push('js')
    <script>
        $(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();

                var id_member = {{ Auth::guard('webmember')->user()->id }};
                var id_package = {{ $package->id }};
                var jumlah = $('.jumlah').val();
                var total = {{ $package->harga }} * jumlah;
                var is_checkout = 0;

                $.ajax({
                    url: '/add_to_cart',
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    data: {
                        id_member: id_member,
                        id_package: id_package,
                        jumlah: jumlah,
                        total: total,
                        is_checkout: is_checkout,
                    },
                    success: function(data) {
                        window.location.href = '/cart';
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.message);
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
