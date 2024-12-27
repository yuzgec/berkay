<footer id="footer" class="bg-primary border-0">
	<div class="container  pt-5 pb-1">
		<div class="row py-5">
			<div class="col-md-3 mb-4 mb-lg-0">
				<h4 class="font-weight-extra-bold text-5 ls-0">Adres</h4>
				<ul class="list list-unstyled">
					<li class="mb-1">
						{{ config('settings.adres1')}}
					</li>
					
				</ul>
			</div>
			<div class="col-md-3 mb-4 mb-lg-0">
				<h4 class="font-weight-extra-bold text-5 ls-0">İletişim</h4>
				<ul class="list-unstyled">
					<li>
						<span class="d-block line-height-2 mb-1">Telefon</span>
						<a href="tel:{{ config('settings.telefon1')}}" class="text-color-light text-6 text-lg-4 text-xl-6 font-weight-bold">
							{{ config('settings.telefon1')}}
						</a>
					</li>
					<li>
						<span class="d-block line-height-2 mb-1">Telefon</span>
						<a href="tel:{{ config('settings.telefon2')}}" class="text-color-light text-6 text-lg-4 text-xl-6 font-weight-bold">
							{{ config('settings.telefon2')}}
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-3 mb-4 mb-lg-0">
				<h4 class="font-weight-extra-bold text-5 ls-0">Sayfalar</h4>
				<ul class="list-unstyled">
					@foreach ($Pages as $item)
					<li class="mb-1">
						<a href="{{ route('corporatedetail', $item->slug)}}" title="{{ $item->title}}">
							{{ $item->title}}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-3 mb-4 mb-md-0">
				<h4 class="font-weight-extra-bold text-5 ls-0">Hizmetlerimiz</h4>
				<ul class="list-unstyled">
					@foreach ($Service as $item)
					<li class="mb-1">
						<a href="{{ route('servicedetail', $item->slug)}}" title="{{ $item->title}}">
							{{ $item->title}}
						</a>
					</li>
					@endforeach	
				</ul>
			</div>
			
			
		</div>
	</div>
	<div class="footer-copyright bg-primary">
		<div class="container container-xl-custom pb-4">
			<div class="row">
				<div class="col opacity-3">
					<hr class="my-0 bg-color-light opacity-1">
				</div>
			</div>
			<div class="row py-5 my-3">
				<div class="col text-center">
					<a href="demo-architecture-2.html" class="d-inline-block mb-3">
						<img alt="Porto" width="250"  src="/berkay-logo-beyaz.png">
					</a>
					<p class="text-3 mb-0">Porto Architecture 2. © 2024. All Rights Reserved</p>
				</div>
			</div>
		</div>
	</div>
</footer>