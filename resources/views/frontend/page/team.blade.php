@extends('frontend.layout.app')
@section('content')
<section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url(img/page-header/page-header-background-transparent.jpg);">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1>Ekibimiz</h1>
                <span class="d-block text-4">{{ config('settings.siteTitle')}}</span>

            </div>
            <div class="col-md-12 align-self-center order-1">
                <ul class="breadcrumb breadcrumb-light d-block text-center">
                    <li><a href="{{ route('home')}}">Anasayfa</a></li>
                    <li class="active">Ekibimiz</li>
                </ul>
            </div>
        </div>
    </div>
</section>



<div class="container py-5 my-5">
    <div class="row appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
            
        @foreach ($Team as $item)
            
        <div class="col-md-4 col-12 mb-3">
            <div class="card custom-card-style-1">
                <div class="card-body text-center bg-color-light-scale-1 py-5">
                    <div class="custom-card-style-1-image-wrapper bg-primary rounded-circle d-inline-block mb-3">
                        <a href="{{ route('teamdetail', $item->slug)}}" title="{{ $item->title }}">
                            <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/resimyok.jpg' : $item->getFirstMediaUrl('page', 'thumb') }}" class="img-fluid rounded-circle" alt="{{ $item->title }}">
                        </a>
                    </div>
                    <h4 class="text-color-secondary font-weight-bold text-5 mb-0">
                        <a href="{{ route('teamdetail', $item->slug)}}" title="{{ $item->title }}" class="text-dark text-decoration-none">{{ $item->title }}</a>
                    </h4>
                    <p>{{ $item->master}}</p>
                    <p class="text-2 mb-2">{{ $item->short }}</p>
                    <ul class="social-icons custom-social-icons social-icons-big">
                        <li class="social-icons-instagram">
                            <a href="{{ $item->seo_title }}<" target="_blank" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="social-icons-linkedin mx-2">
                            <a href="{{ $item->seo_title }}" target="_blank" title="Linkedin">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="social-icons-envelope">
                            <a href="{{ $item->seo_title }}" target="_blank" title="Mail Adresi">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @endforeach
            
    </div>
</div>

@endsection