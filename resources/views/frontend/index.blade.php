@extends('frontend.layout.app')
@section('content')
@include('frontend.layout.slider')
<div class="custom-page-wrapper">
    <section class="section bg-transparent border-0 position-relative py-0 m-0">
        <div class="container container-xl-custom custom-container-style custom-margin-top">
            <div class="row mb-5">
                <div class="col">
                    <div class="overflow-hidden">
                        <div class="owl-carousel-wrapper position-relative z-index-1 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="1000" style="height: 373px;">
                            <div class="owl-carousel owl-theme dots-horizontal-center custom-dots-style-1 mb-0" data-plugin-options="{'responsive': {'576': {'items': 1}, '768': {'items': 1}, '992': {'items': 2}, '1200': {'items': 3}}, 'margin': 25, 'loop': true, 'nav': false, 'dots': true, 'autoplay': true, 'autoplayTimeout': 7000}">
                                @foreach ($Service as $item)
                                <div>
                                    <a href="{{route('servicedetail',$item->slug)}}" title="{{ $item->title}}" class="text-decoration-none">
                                        <div class="card custom-card-style-1 border-radius-0">
                                            <div class="card-body text-center p-5 mb-4">
                                                <img width="75" height="75" src="/frontend/architecture-2/icons/house-plant.svg" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary mt-3 mb-4 pb-3'}" />
                                                <h2 class="text-color-dark font-weight-bold line-height-1 text-5 mb-3">{{ $item->title}}</h2>
                                                <p class="mb-0">{{ $item->short}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="start" class="row align-items-center pb-xl-5 mb-xl-5">
                <div class="col-9 col-lg-4 col-xl-5 pb-5 pb-lg-0 mb-5 mb-lg-0">
                    <div class="position-relative">
                        <img src="/frontend/architecture-2/backgrounds/arch-plan-2.jpg" class="img-fluid position-absolute left-0 z-index-0 appear-animation" alt="" data-appear-animation="fadeIn" data-appear-animation-delay="850" style="bottom: -168px;" />
                        <div class="overflow-hidden position-relative z-index-1">
                            <img src="/frontend/hakkimizda-1.jpg" class="img-fluid appear-animation" alt="" data-appear-animation="maskLeft" data-appear-animation-delay="250" />
                        </div>
                        <div class="overflow-hidden position-absolute z-index-2" style="bottom: -75px; right: -17%;">
                            <img src="/frontend/hakkimizda-2.jpg" style="width:300px" class="img-fluid appear-animation" alt="" data-appear-animation="maskRight" data-appear-animation-delay="550" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-5 offset-lg-1 position-relative pt-5 pt-lg-0">
                    <div class="position-absolute z-index-0 left-0 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="2000" style="top: 190px;">
                        <h2 class="text-color-dark custom-stroke-text-effect-1 custom-big-font-size-1 font-weight-black opacity-1 mb-0">BERKAY</h2>
                    </div>
                    <div class="pt-lg-5 ps-lg-5 mt-lg-5">
                        <div class="overflow-hidden mb-2">
                            <h2 class="text-color-default positive-ls-3 line-height-3 text-4 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="800">{{ config('settings.siteTitle')}}</h2>
                        </div>
                        <div class="overflow-hidden mb-3">
                            <h3 class="text-transform-none text-color-dark font-weight-black text-10 line-height-2 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="1000"> Hayallerinizi Gerçekleştirir </h3>
                        </div>
                        <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1200">
                            <img src="/frontend/architecture-2/divider.jpg" class="img-fluid opacity-5 mb-4" alt="" />
                        </div>
                        <p class="custom-font-tertiary text-5 line-height-4 mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1400">
                        Berkay Dekorasyon, 2000 yılından bu yana İzmir Karşıyaka’da faaliyet gösteren ve {{ date('Y') - 2000 }} yıllık tecrübesiyle sektörde öncü konumda bulunan bir firmadır.     
                        </p>
                        <p class="text-3-5 pb-3 mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">
                            Profesyonel e, müşteri memnuniyetini ön planda tutarak, kalite ve ekonomik çözümler sunmaktayız.
                        </p>
                        <a href="{{ route('contactus')}}" class="btn btn-primary custom-btn-style-1 font-weight-bold text-3 px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1800">İletişime Geç</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container container-xl-custom pb-3">
            <div class="row align-items-center text-center py-5 my-3">
                @for ($i=1; $i <= 10; $i++)
                <div class="col-sm-3 mb-5">
                    <img src="/frontend/logolar/{{$i}}.jpg" alt class="img-fluid" style="max-width: 250px;" />
                </div>
                @endfor
            </div>
        </div>
    </section>
    <section class="section section-height-3 border-0 m-0">
        <div class="container py-2">
            <div class="row counters counters-sm">
                <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="counter">
                        <strong class="text-color-dark font-weight-bold line-height-1 text-12 mb-2" data-to="25" data-append="+">0</strong>
                        <label class="text-color-default positive-ls-3 font-weight-normal text-3-5 mb-0">YILLIK DENEYİM</label>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-5 mb-sm-0">
                    <div class="counter">
                        <strong class="text-color-dark font-weight-bold line-height-1 text-12 mb-2" data-to="10" data-append="+">0</strong>
                        <label class="text-color-default positive-ls-3 font-weight-normal text-3-5 mb-0">UZMAN EKİP</label>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="counter">
                        <strong class="text-color-dark font-weight-bold line-height-1 text-12 mb-2" data-to="350" data-append="+">0</strong>
                        <label class="text-color-default positive-ls-3 font-weight-normal text-3-5 mb-0">MÜŞTERİ</label>
                    </div>
                </div>
                
                <div class="col-sm-6 col-lg-3">
                    <div class="counter">
                        <strong class="text-color-dark font-weight-bold line-height-1 text-12 mb-2" data-to="1000" data-append="+">0</strong>
                        <label class="text-color-default positive-ls-3 font-weight-normal text-3-5 mb-0">BİTEN PROJE</label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section my-0 py-5 border-0 bg-transparent">
        <div class="container container-xl-custom">
            <div class="row justify-content-between align-items-center py-5">
                <div class="col-lg-3">
                    <h4 class="text-primary text-3 font-weight-bold mb-2">{{config('settings.siteTitle')}}</h4>
                    <h3 class="mb-3 font-weight-bold text-6">Tamamlanan Projelerimiz</h3>
                    <p class="mb-5 mb-lg-0">Berkay Dekorasyon olarak başarıyla tamamladığımız bazı referans projelerimiz</p>
                </div>
                <div class="col-lg-8">
                    <div class="carousel-half-full-width-wrapper carousel-half-full-width-right">
                        <div class="owl-carousel owl-theme carousel-half-full-width-right nav-style-1 nav-dark nav-font-size-lg mb-0 owl-loaded owl-drag owl-carousel-init" data-plugin-options="{'responsive': {'0': {'items': 1}, '768': {'items': 3}, '992': {'items': 3}, '1200': {'items': 3}}, 'loop': true, 'nav': true, 'dots': false, 'margin': 20}" style="height: auto;">
                            
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(-0px, 0px, 0px); transition: all">
                                    @foreach ($Project->random(10) as $item)
                                        
                                
                                    <div class="owl-item cloned" style="width: 404.333px; margin-right: 20px;">
                                        <div class="p-relative">
                                            <span class="thumb-info thumb-info-swap-content anim-hover-inner-wrapper rounded">
                                                <span class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content">
                                                    <img src="{{  $item->getFirstMediaUrl('page', 'thumb') }}" class="img-fluid" alt="">
                                                </span>
                                            </span>
                                            <h4 class="font-weight-bold mt-4">{{ $item->title}}</h4>
                                            {{-- <ul class="list list-icons list-primary font-weight-medium mt-3">
                                                <li><i class="fas fa-check text-color-primary"></i> Fusce sit amet orci quis arcu vestibulum.</li>
                                                <li><i class="fas fa-check text-color-primary"></i> Amet orci quis arcu vestibulum.</li>
                                                <li><i class="fas fa-check text-color-primary"></i> Orci quis arcu vestibulum.</li>
                                            </ul> --}}
                                            <a href="{{ route('projedetail', $item->slug)}}" class="btn btn-arrow-effect-1 ws-nowrap text-primary text-2 bg-transparent border-0 px-0 text-uppercase stretched-link">
                                                Proje Detaylarına Bak <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"></button>
                                <button type="button" role="presentation" class="owl-next"></button>
                            </div>
                            <div class="owl-dots disabled">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-height-3 bg-primary border-0 m-0">
        <div class="container container-xl-custom">
            <div class="row align-items-center justify-content-center text-center text-xl-start">
                <div class="col-md-8 col-xl-9 mb-4 mb-xl-0 appear-animation" data-appear-animation="fadeInRightShorterPlus" data-appear-animation-delay="250">
                    <h2 class="text-color-default font-weight-semibold positive-ls-3 text-4 mb-0">{{config('settings.siteTitle')}}</h2>
                    <h3 class="text-transform-none text-color-light font-weight-black line-height-2 text-9 mb-0">Berkay Dekorasyon Hayallerinizi Gerçekleştirir.
                    </h3>
                </div>
                <div class="col-xl-3 text-xl-end appear-animation" data-appear-animation="fadeInRightShorterPlus" data-appear-animation-delay="500">
                    <a href="{{route('contactus')}}" class="btn btn-light custom-btn-style-1 font-weight-bold text-color-dark text-3 px-5 py-3">İletişime Geç</a>
                </div>
            </div>
        </div>
    </section>



</div>



@endsection
