<div class="container mobile-header">
	{{-- MOBILE HEADER --}}
	<div class="contact">
		<div class="contact__auth contact__auth--info is-flex">
			<div class="contact__item"><a class="contact__link" href="#"><i class="fas fa-user"></i><span>Ingresar</span></a></div>
			<div class="contact__item"><a class="contact__link" href="#"><i class="fas fa-sign-in-alt"></i><span>Registrarse</span></a></div>
		</div>
	</div>
	<div class="actions">
		<div class="actions--mobile">
			<div class="actions__item">
				<img class="actions__brand" src="{{asset('img/brand_black.png')}}" alt="Logo Equibra">
			</div>
			<div class="actions__item actions__controls">
				<div class="actions__menu">
					<button class="actions__link" id="m-open-nav"><i class="fas fa-bars"></i></button>
				</div>
				<div class="actions__search">
					<button class="actions__link" id="m-open-search"><i class="fas fa-search"></i></button>
					<div class="actions__search-input" id="m-input-search">
						<div class="field has-addons actions__search-input-component">
							<div class="control is-expanded">
								<input class="input" class="" type="text" placeholder="Busca productos...">
							</div>
							<div class="control">
								<a class="button is-primary">
									<span class="icon is-small">
										<i class="fas fa-search"></i>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="actions__cart">
					<a href="#" class="actions__link" id="m-open-cart"><i class="fas fa-shopping-cart"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- HEADER DESKTOP.. --}}
<div class="desktop-header">
	<div class="container">
		<div class="desktop-header__contact">
			<span class="desktop-header__contact-item">
				<a href="" class="desktop-header__contact-link">
					<i class="far fa-envelope"></i>	
					hola@equibra.com
				</a>
			</span>
			<span class="desktop-header__contact-item">
				<a href="" class="desktop-header__contact-link">
					<i class="fab fa-facebook-messenger"></i>
					@aguaequibra
				</a>
			</span>
			<span class="desktop-header__contact-item">
				<a href="" class="desktop-header__contact-link">
					<i class="fas fa-phone"></i>	
					55 1212 1212
				</a>
			</span>
			<span class="desktop-header__contact-item">
				<a href="" class="desktop-header__contact-link">
					<i class="fab fa-whatsapp"></i>
					55 1313 1313
				</a>
			</span>
		</div>
	</div>

	<div class="desktop-main-header">
		<div class="container desktop-main-header__container">
			<div class="columns is-gapless desktop-main-header__container">
				<div class="desktop-main-header__brand column is-1">
					<img src="{{asset('img/brand_black.png')}}" alt="Logo Equibra">
				</div>
				<div class="desktop-main-header__search column is-6">
					<div class="field has-addons">
						<div class="control is-expanded">
							<input class="input" type="text" placeholder="Busca productos...">
						</div>
						<div class="control">
							<a class="button is-primary">
								<span class="icon is-small">
									<i class="fas fa-search"></i>
								</span>
							</a>
						</div>
					</div>
				</div>
				<div class="desktop-main-header__account column is-2">
					<a href="" class="desktop-main-header__item">
						<div class="desktop-main-header__account-icons">
							<i class="fas fa-sign-in-alt"></i>	
						</div>
						<span>Registrarse</span>
					</a>
					<a href="" class="desktop-main-header__item">
						<div class="desktop-main-header__account-icons">
							<i class="fas fa-user-alt"></i>
						</div>
						<span>Ingresar</span>
					</a>
						
				</div>
				<div class="desktop-main-header__cart column is-3">
					<a href="http://www" class="">
						<span>1 ítem(s) - $500</span>
						<div class="desktop-main-header__link-cart">
							<i class="fas fa-shopping-cart"></i>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="desktop-navbar">
		<div class="container desktop-navbar__container">
			<ul class="desktop-navbar__items">
				{{-- <li class="desktop-navbar__item"><a href="">INICIO</a></li> --}}
				<li class="desktop-navbar__item"><a href="">TIENDA</a></li>
				<li class="desktop-navbar__item"><a href="">FRANQUICIAS</a></li>
				<li class="desktop-navbar__item"><a href="">CONTACTO</a></li>
				<li class="desktop-navbar__item"><a href="">NOSOTROS</a></li>
			</ul>
		</div>
	</div>
</div>
