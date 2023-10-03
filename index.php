<?php
include 'include/connect.php';
session_start();


$login_err = ""; // initialize login_err variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST["email"];
	$password = $_POST["password"];

	$sql = "SELECT * FROM users WHERE email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $email);

	if ($stmt->execute()) {
		$result = $stmt->get_result();

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$hashed_password = $row["password"];

			if (password_verify($password, $hashed_password)) {
				$_SESSION["loggedin"] = true;
				$_SESSION["id"] = $row["id"];
				$_SESSION["email"] = $email;

				header("location: home.php");
				exit;
			} else {
				$login_err = "Invalid password.";
			}
		} else {
			$login_err = "Invalid email.";
		}
	} else {
		echo "Oops! Something went wrong. Please try again later.";
	}

	$stmt->close();
	$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<link rel="icon" type="image/png" sizes="30x30" href="favicon-32x32.png">
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

	<!-- darkmode -->
	<script>
		// On page load or when changing themes, best to add inline in `head` to avoid FOUC
		if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
			document.documentElement.classList.add('dark');
		} else {
			document.documentElement.classList.remove('dark')
		}
	</script>
</head>

<body class="bg-white dark:bg-gray-900">

	<!-- login -->
	<section class="bg-gray-50 dark:bg-gray-900">

		<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
			<!-- darkmode toggle -->
			<div class="text-center mb-10">
				<button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" style="box-shadow: 0 10px 15px 0; border-radius: 20px; margin: 3% auto;">
					<svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
					</svg>
					<svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
					</svg>
				</button>
			</div>

			<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-800 mt-2" style="box-shadow: 0 15px 20px 0; border-radius: 20px;">
				<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						Login to Connect
					</h1>
					<!-- login form-->
					<form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

						<!-- Add this section to display the error message -->
						<?php if ($login_err != "") { ?>
							<div id="error-message" class="bg-red-300 border border-red-400 text-red-700 px-4 py-1 rounded relative" role="alert">
								<span class="block sm:inline"><?php echo $login_err; ?></span>
								<span id="close-button" class="absolute top-0 bottom-0 right-0 px-4 py-1">
									<svg class="fill-current h-6 w-6 text-red-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<title>Close</title>
										<path fill-rule="evenodd" d="M13.293 6.293a1 1 0 0 0-1.414-1.414L10 8.586 7.707 6.293a1 1 0 1 0-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 0 0 1.414 1.414L10 11.414l2.293 2.293a1 1 0 0 0 1.414-1.414L11.414 10l2.293-2.293z" />
									</svg>
								</span>
							</div>

							<script>
								// Add a click event listener to the close button
								document.getElementById("close-button").addEventListener("click", function() {
									// Hide the error message
									document.getElementById("error-message").style.display = "none";
								});
							</script>
						<?php } ?>

						<div>
							<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
								Email</label>
							<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@connect.nl" required="">
						</div>
						<div>
							<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
							<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
						</div>
						<div class="flex items-center justify-between">
							<div class="flex items-start">
							</div>
							<p class="mt-2">
								<a href="forgot.php" class="text-sm font-medium text-red-600 hover:text-green-700 ">Forgot password?</a>
							</p>

						</div>
						<button type="submit" class="w-full text-white bg-[#4B5563] hover:bg-[#014737]/80  hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Log In </button>
						<p class="text-sm font-light text-gray-500 dark:text-gray-100">
							Don't have an account yet? <a href="signup.php" class="font-medium text-red-600 hover:text-green-700  dark:text-primary-500">Sign up</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</section>

    <!-- flowbite/cdn source map -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
	<!-- dark mode -->
	<script>
		var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
		var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

		// Change the icons inside the button based on previous settings
		if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
			themeToggleLightIcon.classList.remove('hidden');
		} else {
			themeToggleDarkIcon.classList.remove('hidden');
		}

		var themeToggleBtn = document.getElementById('theme-toggle');

		themeToggleBtn.addEventListener('click', function() {

			// toggle icons inside button
			themeToggleDarkIcon.classList.toggle('hidden');
			themeToggleLightIcon.classList.toggle('hidden');

			// if set via local storage previously
			if (localStorage.getItem('color-theme')) {
				if (localStorage.getItem('color-theme') === 'light') {
					document.documentElement.classList.add('dark');
					localStorage.setItem('color-theme', 'dark');
				} else {
					document.documentElement.classList.remove('dark');
					localStorage.setItem('color-theme', 'light');
				}

				// if NOT set via local storage previously
			} else {
				if (document.documentElement.classList.contains('dark')) {
					document.documentElement.classList.remove('dark');
					localStorage.setItem('color-theme', 'light');
				} else {
					document.documentElement.classList.add('dark');
					localStorage.setItem('color-theme', 'dark');
				}
			}

		});
	</script>
</body>

</html>