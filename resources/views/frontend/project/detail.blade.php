@extends('frontend.layout.app')
@section('content')

<section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url({{ $Detail->getFirstMediaUrl('page', 'img') }});">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1><strong>{{ $Detail->title }}</strong></h1>
                <span class="d-block text-4">{{ config('settings.siteTitle')}}</span>
            </div>
            <div class="col-md-12 align-self-center order-1">
                <ul class="breadcrumb breadcrumb-light d-block text-center">
                <li><a href="{{ route('home')}}">Anasayfa</a></li>
                <li><a href="{{ route('service')}}">{{ $Detail->getCategory->title }}</a></li>
                <li class="active">{{ $Detail->title }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container py-2">
    <ul class="nav nav-pills sort-source sort-source-style-3 justify-content-center" data-sort-id="portfolio" data-option-key="filter" data-plugin-options="{'layoutMode': 'masonry', 'filter': '*'}">
        
    </ul>

    <div class="sort-destination-loader mt-4 pt-2 sort-destination-loader-loaded">
        <div class="row portfolio-list sort-destination lightbox" data-sort-id="portfolio" data-filter="*" style="position: relative;" data-plugin-options="{'delegate': 'a.lightbox-portfolio', 'type': 'image', 'gallery': {'enabled': true}}" data-filter="*" style="position: relative;">
            @foreach ($Detail->getMedia('gallery') as $item )
            <div class="col-md-6 col-lg-4 isotope-item brands" style="position: absolute; left: 0px; top: 0px;">
                <div class="portfolio-item">
                    <a href="{{ $item->getUrl('img')}}" class="lightbox-portfolio">
                        <span class="thumb-info thumb-info-centered-info thumb-info-no-borders border-radius-0">
                            <span class="thumb-info-wrapper border-radius-0">
                                <img src="{{ $item->getUrl('thumb')}}" class="img-fluid border-radius-0" alt="{{ $Detail->title }}">
                                <span class="thumb-info-title">
                                    <span class="thumb-info-inner">{{ $Detail->title }}</span>
                                    <span class="thumb-info-type">Berkay Dekorasyon</span>
                                </span>
                               
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
            
        </div>
    <div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>

</div>
@if($Detail->desc)
<div class="container">
    <div class="row pb-4">
        <div class="col-lg-8 mb-5 mb-lg-0 appear-animation animated fadeInUpShorterPlus appear-animation-visible" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="200" style="animation-delay: 200ms;">
            <div class="card box-shadow-1 custom-border-radius-1 mb-5" id="form">
                <div class="card-body z-index-1 py-4 my-3">
                    {!!  $Detail->desc !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 position-relative">
            <aside class="sidebar">


                <div class="card box-shadow-1 custom-border-radius-1 mb-5">
                    <div class="card-body z-index-1 py-4 my-3">
                        <h2 class="text-color-dark font-weight-bold text-6 mb-4">Hizmetlerimiz</h2>
                        <ul class="custom-nav-list-effect-1 list list-unstyled mb-0">
                            @foreach($Service->where('category', $Detail->getCategory->id) as $item)
                            <li>
                                <a class="text-decoration-none text-color-dark text-color-hover-primary text-3-5" href="{{ route('servicedetail' , $item->slug)}}" title="{{ $item->title }}">
                                    <i class="icon-arrow-right icons"></i> {{ $item->title }}
                                </a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
               
                
            </aside>
        </div>
    </div>
</div>
@endif
@endsection
