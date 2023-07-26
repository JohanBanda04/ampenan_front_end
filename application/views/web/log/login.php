<section dir="ltr" id="home">
<div class="limiter" >
	<div class="bg-img1"></div>

	<div class="container-login100">
		<div class="wrap-login100">
			<div class="col-lg-8">
				<div class="login100-pic">
					<center>
						<img src="img/img-login.png" alt="IMG">
						<small>
							<a class="img-attribute" href="https://www.freepik.com/vectors/background">Background vector created by jcomp - www.freepik.com</a>
						</small>
					</center>
				</div>
			</div>
			<div class="col-lg-4">
				<center>
					<img src="assets/login/images/logo_ampenan.png" alt="IMG" style="width: 40%;">

					<form class="login100-form validate-form" action="" method="post">

						<span class="login100-form-title" style="padding:7px 13px 40px;font-size:15px;">
							APLIKASI MANAJEMEN PROGRAM KEGIATAN DAN ANGGARAN
						</span>
						<?php
							echo $this->session->flashdata('msg');
						?>
						<div class="wrap-input100 validate-input" data-validate = "Username is required">
							<input class="input100" type="text" placeholder="Username" name="username" autofocus>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
						</div>
		
						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" placeholder="Password" name="password">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
		
						<div class="container-login100-form-btn">
							<button type="submit" name="btnlogin" class="login100-form-btn">
								Login
							</button>
						</div>
					</form>
				</center>
			</div>
			
		</div>
	</div>
</div>
</section >
