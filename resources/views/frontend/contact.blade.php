@extends('frontend.layout.app')
@section('content')
<section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url(img/page-header/page-header-background-transparent.jpg);">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 align-self-center p-static order-2 text-center">
                <h1>İzmir <strong>Berkay Dekorasyon</strong></h1>
                <span class="d-block text-4">Berkay Dekorasyon İnşaat Taah. San ve Tic Ltd. Şti.</span>

                
            </div>
            <div class="col-md-12 align-self-center order-1">
                <ul class="breadcrumb breadcrumb-light d-block text-center">
                    <li><a href="{{ route('home')}}">Anasayfa</a></li>
                    <li class="active">İletişim</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container py-4 my-5">
    <div class="row align-items-center">
        <div class="col-lg-5 col-xl-4 offset-xl-1 mb-5 mb-lg-0">
            <div class="overflow-hidden">
                <h2 class="text-color-dark font-weight-bold line-height-3 text-5-5 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="250">{{ config('settings.adres1')}}</h2>
            </div>
        
            <ul class="list list-unstyled text-color-dark font-weight-bold text-4 py-2 my-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="750">
                <li class="d-flex align-items-center mb-2">
                    <i class="icons icon-envelope text-color-dark me-2"></i>
                    Email: <a href="mailto:{{ config('settings.email1')}}" class="text-color-dark text-color-hover-primary text-decoration-none ms-1">{{ config('settings.email1')}}</a>
                </li>
                <li class="d-flex align-items-center mb-0">
                    <i class="icons icon-phone text-color-dark me-2"></i>
                    Telefon: <a href="tel:1234567890" class="text-color-dark text-color-hover-primary text-decoration-none ms-1">{{ config('settings.telefon1')}}</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-xl-5 offset-lg-1 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1250">
            @include('frontend.layout.form')

        </div>
    </div>
</div>

    

<section class="section bg-transparent position-relative border-0 z-index-1 m-0 p-0">

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6248.279487170746!2d27.108814!3d38.461335!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbd9c6bdeec337%3A0xf2593d50ef43a479!2zQmFocml5ZSDDnMOnb2ssIDE3NjMvMi4gU2ssIDM1NjAwIEthcsWfxLF5YWthL8Swem1pciwgVMO8cmtpeWU!5e0!3m2!1str!2sus!4v1735268967433!5m2!1str!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection
