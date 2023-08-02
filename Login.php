<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login \ Sign in</title>
	<link rel="stylesheet" href="css/loginStyle.css">
	<!-- Favicon  -->
	<link rel="icon" href="img/core-img/favicon.ico">
	<!-- sweet alert -->
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
	<!-- partial:index.partial.php -->
	<!DOCTYPE html>
	<html>

	<head>
		<title>Slide Navbar</title>
		<link rel="stylesheet" type="text/css" href="css/loginStyle.css">
		<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	</head>

	<body>
		<div class="main">
			<input type="checkbox" id="chk" checked aria-hidden="true">

			<div class="signup">
				<form action="controllers/userController.php" method="POST">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="fname" placeholder="First name" required="">
					<input type="text" name="lname" placeholder="Last name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pass" placeholder="Password" required="">
					<button type="submit" name="signupBtn">Sign up</button>
				</form>
			</div>

			<div class="login" id="login">
				<form action="controllers/userController.php" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="pass" placeholder="Password" required="">
					<input type="checkbox" name="remembe_me" class="chex" value="true" id="rm">
					<label for="rm" class="label">Remembe me</label>
					<button type="submit" name="loginBtn">Login</button>
				</form>
			</div>
		</div>

		<script>
			// Call the function when the page is loaded
			window.addEventListener('DOMContentLoaded', alert_delete);

			function alert_delete() {
				const search = window.location.search;
				if (search === '?s=f') {
					const checkbox = document.getElementById('chk');
					checkbox.checked = true;

					Swal.fire({
						icon: 'error',
						title: 'Erorr',
						text: 'Erorr: Either the password or email is wrong! Please try again.',
					})
				} else if (search === '?s=l') {
					Swal.fire({
						icon: 'success',
						title: 'Sweet',
						text: 'Now log in with your new account :)',
					})
					const checkbox = document.getElementById('chk');
					checkbox.checked = true;
				}
			}
		</script>
		<!-- sweet alert -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
	</body>

	</html>
	<!-- partial -->

</body>

</html>