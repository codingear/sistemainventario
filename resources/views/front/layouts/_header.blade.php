
<div class="container">
	{{-- MOBILE HEADER --}}
	<div class="mobile-header">
		<div class="contact">
			{{-- <div class="contact__info">
				<div class="contact__item">mail</div>
				<div class="contact__item">messenger</div>
				<div class="contact__item">phone</div>
				<div class="contact__item">contact</div>
			</div> --}}
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
							{{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis, quis qui. Numquam quos totam nobis!</p> --}}
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
	{{-- MOBILE DESKTOP.. --}}
</div>
