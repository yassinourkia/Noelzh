<?php
require_once('header.php');
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Register</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Register<span> Form</span></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit curabitur </p>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Already have an Account ?<a href="signin.php">  Sign In »</a> </h4>
			</div>
			<div class="login-body">
				<form class="wow fadeInUp animated" data-wow-delay=".7s">
					<input type="text" placeholder="First Name" required="">
					<input type="text" placeholder="Last Name" required="">
					<input type="text" class="email" placeholder="Email Address" required="">
					<input type="password" name="password" class="lock" placeholder="Password">
					<input type="submit" name="Register" value="Register">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
<?php
require_once('footer.php');
?>