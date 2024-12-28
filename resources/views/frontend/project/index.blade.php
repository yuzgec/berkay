@extends('frontend.layout.app')
@section('content')

<section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url(img/page-header/page-header-background-transparent.jpg);">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1 class="text-white font-weight-bold">{{ $Detail->title}}</h1>
                <span class="d-block text-4">{{ config('settings.siteTitle')}}</span> 
            </div>
            <div class="col-md-12 align-self-center order-1">
                <ul class="breadcrumb breadcrumb-light d-block text-center">
                    <li><a href="{{ route('home')}}">Anasayfa</a></li>
                    <li class="active">{{ $Detail->title}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
    <div class="container container-fluid">
        
        <ul class="nav nav-pills sort-source sort-source-style-3 justify-content-center" data-sort-id="portfolio" data-option-key="filter" data-plugin-options="{'layoutMode': 'masonry', 'filter': '*'}">
        
        </ul>
        <div class="row" data-sort-id="portfolio" data-filter="*" style="position: relative;">


            @foreach($Project->where('category', $Detail->id) as $item)
                <div class="col-lg-4 mb-4 portfolio-item">
                    <a href="{{ route('projedetail' , $item->slug)}}" title="{{ $item->title }}">

                    <span class="thumb-info thumb-info-no-borders thumb-info-no-borders-rounded thumb-info-lighten thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom">
                        <span class="thumb-info-wrapper">
                            <img src="{{ $item->getFirstMediaUrl('page', 'thumb') }}" class="img-fluid" alt="{{ $item->title }}">
                            <span class="thumb-info-title">
                                <span class="thumb-info-inner line-height-1">{{ $item->title }}</span>
                            </span>
                        </span>
                    </span>
                    </a>
                </div>

            @endforeach
        </div>
    </div>
@endsection
