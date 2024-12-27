<header id="header" class="header-transparent header-effect-shrink header-no-border-bottom" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyHeaderContainerHeight': 80, 'stickyStartAt': 50, 'stickyChangeLogo': false}" style="height: 100px;">
	<div class="header-body border-top-0 bg-primary appear-animation animated fadeInUpShorterPlus appear-animation-visible" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1000" data-plugin-options="{'forceAnimation': true}" style="animation-delay: 1000ms; top: 0px;">
		<div class="header-container container-fluid" style="height: 100px; min-height: 0px;">
			<div class="header-row">
				<div class="header-column align-items-start justify-content-center">
					<div class="header-logo z-index-2 col-lg-2 px-0">
						<a href="{{ route('home')}}" title="{{ config('settings.siteTitle')}}">
							<img alt="{{ config('settings.siteTitle')}}" width="200" src="/berkay-logo-beyaz.png">
						</a>
					</div>
				</div>
				<div class="header-column flex-row justify-content-end justify-content-lg-center">
					<div class="header-nav header-nav-line header-nav-bottom-line header-nav-bottom-line-effect-1 header-nav-dropdowns-dark header-nav-light-text justify-content-end">
						<div class="header-nav-main header-nav-main-arrows header-nav-main-mobile-dark header-nav-main-dropdown-no-borders header-nav-main-effect-3 header-nav-main-sub-effect-1">
							<nav class="collapse">
								<ul class="nav nav-pills" id="mainNav">
									<li><a href="{{ route('home')}}" class="nav-link active current-page-active">Anasayfa</a></li>
									<li class="dropdown">
										<a href="" class="nav-link dropdown-toggle">Kurumsal<i class="fas fa-chevron-down"></i></a>
										<ul class="dropdown-menu">
											@foreach ($Pages as $item)
											<li><a href="{{ route('corporatedetail', $item->slug)}}" class="dropdown-item">{{ $item->title}}</a></li>
											@endforeach
										</ul>
									</li>
									<li class="dropdown">
										<a href="" class="nav-link dropdown-toggle">Hizmetlerimiz<i class="fas fa-chevron-down"></i></a>
										<ul class="dropdown-menu">
											@foreach ($Service as $item)
											<li><a href="{{ route('servicedetail', $item->slug)}}" class="dropdown-item">{{ $item->title}}</a></li>
											@endforeach	
										</ul>
									</li>
									<li class="dropdown">
										<a href="" class="nav-link dropdown-toggle">Projeler<i class="fas fa-chevron-down"></i></a>
										<ul class="dropdown-menu">
											@foreach ($ProjectCategory as $item)
											<li><a href="{{ route('servicedetail', $item->slug)}}" class="dropdown-item">{{ $item->title}}</a></li>
											@endforeach	
										</ul>
									</li>
									<li><a href="" class="nav-link">Referanslar</a></li>
									<li><a href="" class="nav-link">Blog</a></li>
									<li><a href="{{ route('contactus')}}" class="nav-link">İletişim</a></li>
								</ul>
							</nav>
						</div>
					</div>
					
					<button class="btn header-btn-collapse-nav bg-transparent border-0 text-4 position-relative top-2 p-0 ms-4" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
						<i class="fas fa-bars"></i>
					</button>
				</div>

				<ul class="header-extra-info d-none d-xxl-block mt-2 mx-3">
					<li class="d-none d-sm-inline-flex ms-0 font-weight-semibold">
						<div class="d-flex align-items-center">
							<i class="icons icon-phone text-8 text-white me-2"></i>
							<a href="tel:0{{ config('settings.telefon1')}}" class="text-decoration-none text-3 text-white">{{ config('settings.telefon1')}}</a>
						</div>
					</li>
				</ul>
				<div class="header-column align-items-end justify-content-center d-none d-lg-flex">
					<ul class="header-social-icons social-icons social-icons-clean social-icons-icon-light social-icons-medium custom-social-icons-divider">
						<li class="social-icons-facebook">
							<a href="http://www.instagram.com/{{ config('settings.instagram')}}" target="_blank" title="Facebook"><i class="fab fa-instagram"></i></a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
</header>