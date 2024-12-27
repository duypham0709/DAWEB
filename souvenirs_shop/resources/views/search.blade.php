@extends('main')

@section('content')
    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1" style="background-image: url(/template/images/slide_1.jpg);">
                </div>

                <div class="item-slick1" style="background-image: url(/template/images/slide_2.jpg);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url(/template/images/slide_1.jpg);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    {{ $title }}
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                {{-- <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <div class="stext-107 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        <p>{{ $totalProducts }} sản phẩm được tìm thấy</p>
                    </div>
                </div> --}}
                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Bộ lọc
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Tìm kiếm
                    </div>
                </div>

                <!-- Search product -->

                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form action="{{ route('products.search') }}" method="GET">
                        <div class="bor8 dis-flex p-l-15">

                            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>

                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                                placeholder="Tìm kiếm...">

                        </div>
                        @csrf
                    </form>
                </div>


                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Lọc theo
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}"
                                        class="filter-link stext-106 trans-04 {{ !request('price') ? 'active' : '' }}">
                                        Mặc định
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}"
                                        class="filter-link stext-106 trans-04 {{ request('price') === 'asc' ? 'active' : '' }}">
                                        Giá: Thấp - Cao
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}"
                                        class="filter-link stext-106 trans-04 {{ request('price') === 'desc' ? 'active' : '' }}">
                                        Giá: Cao - Thấp
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Giá
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        Tất cả
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Dưới $50.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $50.00 - $100.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $100.00 - $150.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $150.00 - $200.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $200.00 trở lên
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="loadProduct">
                @include('products.list')
            </div>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
