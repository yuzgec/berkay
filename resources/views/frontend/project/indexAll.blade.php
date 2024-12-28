@extends('frontend.layout.app')
@section('content')

<section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url(img/page-header/page-header-background-transparent.jpg);">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1 class="text-white font-weight-bold">Projelerimiz</h1>
                <span class="d-block text-4">{{ config('settings.siteTitle')}}</span> 
            </div>
            <div class="col-md-12 align-self-center order-1">
                <ul class="breadcrumb breadcrumb-light d-block text-center">
                    <li><a href="{{ route('home')}}">Anasayfa</a></li>
                    <li class="active">Projelerimiz</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="container container-fluid">
    <div class="masonry-loader masonry-loader-loaded">
        <div class="masonry row" data-plugin-masonry="" data-plugin-options="{'layoutMode': 'packery', 'itemSelector': '.masonry-item', 'sortBy': 'original-order'}" style="position: relative;">
            @foreach ($Detail as $item)
            <div class="masonry-item no-default-style col-6 col-lg-6 overflow-hidden px-2 mb-2" style="position: absolute; left: 0px; top: 0px;">
                
            <span class="thumb-info thumb-info-swap-content thumb-info-centered-icons">
                <span class="thumb-info-wrapper overlay overlay-show overlay-gradient-bottom-content">
                    <img src="{{  $item->getFirstMediaUrl('page', 'thumb') }}" class="img-fluid" alt="{{ $item->title}}">
                    <span class="thumb-info-action">
                        <a href="{{ route('proje', $item->slug)}}">
                            <span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fas fa-link text-dark text-dark"></i></span>
                        </a>
                    </span>
                    <span class="thumb-info-title bottom-30 bg-transparent w-100 mw-100 p-0 text-center">
                        <span class="thumb-info-swap-content-wrapper">
                            <span class="thumb-info-inner">{{ $item->title}}</span>
                            <span class="thumb-info-type text-light m-0 float-none">Projeyi İncele</span>
                        </span>
                    </span>
                </span>
            </span>
            </div>

            @endforeach
        </div>
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>
@endsection
