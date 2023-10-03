<?php
require_once "include/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
	<link rel="icon" type="image/png" sizes="30x30" href="favicon-32x32.png">

	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
	<script>
		// On page load or when changing themes, best to add inline in `head` to avoid FOUC
		if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
			document.documentElement.classList.add('dark');
		} else {
			document.documentElement.classList.remove('dark')
		}
	</script>
</head>

<body class="bg-gray-50 dark:bg-gray-900">


	<!-- sign up -->
	<section class="bg-gray-50 dark:bg-gray-900">
		<!-- <section> -->
		<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
			<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-800" style="box-shadow: 0 15px 20px 0; border-radius: 20px;">
				<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						Create Account
					</h1>
					<form class="space-y-4 md:space-y-6" method="POST" action="signup.php" enctype="multipart/form-data">
						<div>
							<label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
								Name</label>
							<input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Gadisa Ahmed" required="">
						</div>
						<div>
							<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
								email</label>
							<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="gadisa@connect.nl" required="">
						</div>
						<div>
							<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
							<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
						</div>

						<div>
							<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="profile_picture">Upload Profile</label>
							<input class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="profile_picture" id="profile_picture" required="">
						</div>

						<div class="flex items-start">
							<div class="flex items-center h-5">
								<input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
							</div>
							<div class="ml-3 text-sm">
								<label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="terms_conditions.php">Terms and Conditions</a></label>
							</div>
						</div>
						<button type="submit" class="w-full text-white bg-[#4B5563] hover:bg-[#014737]/80  hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create
							an account</button>
						<p class="text-sm font-light text-gray-500 dark:text-gray-400">
							Already have an account? <a href="index.php" class="font-medium text-red-600  hover:text-green-700 dark:text-primary-500">Login</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</section>


	<?php
	// Check if the form is submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		// Get form data
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		// Validate form data
		$errors = [];
		if (empty($name)) {
			$errors[] = "Name is required";
		}
		if (empty($email)) {
			$errors[] = "Email is required";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email format";
		}
		if (empty($password)) {
			$errors[] = "Password is required";
		}
		// Check if file is uploaded
		if (empty($_FILES['profile_picture']['name'])) {
			$errors[] = "Profile picture is required";
		}
		// If there are no errors, check if the email already exists in the database
		if (empty($errors)) {
			// Connect to the database
			$db_host = "localhost";
			$db_user = "root";
			$db_pass = "";
			$db_name = "backend";
			$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			// Check if the email already exists in the database
			$email_query = "SELECT * FROM users WHERE email='$email'";
			$email_result = mysqli_query($conn, $email_query);

			if (mysqli_num_rows($email_result) > 0) {
				// Use JavaScript to display error message
				echo "<script>
                    setTimeout(function() {
                        alert(`Account already exists! \nGo to login page!`);
                        window.location.href = 'index.php';
                    }, 200);
                 </script>";
			} else {
				// Hash the password
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				// Upload profile picture to server
				$profile_picture_name = $_FILES['profile_picture']['name'];
				$profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
				$profile_picture_type = $_FILES['profile_picture']['type'];
				$profile_picture_size = $_FILES['profile_picture']['size'];

				$upload_dir = 'profile_pictures/';

				if (empty($errors)) {
					// Check if file type is valid
					$allowed_types = array('jpg', 'jpeg', 'png');
					$profile_picture_extension = pathinfo($profile_picture_name, PATHINFO_EXTENSION);
					if (!in_array($profile_picture_extension, $allowed_types)) {
						$errors[] = "Invalid file type. Allowed types: jpg, jpeg, png";
					}

					// Check if file size is valid
					$max_size = 500000; // 500kb
					if ($profile_picture_size > $max_size) {
						$errors[] = "File size exceeds maximum size. Maximum size: 500kb";
					}

					// Generate unique file name to prevent overwriting
					$new_file_name = uniqid('profile_', true) . "." . $profile_picture_extension;

					// Upload file to server
					if (move_uploaded_file($profile_picture_tmp_name, $upload_dir . $new_file_name)) {

						// Insert user data into the database
						$insert_user_query = "INSERT INTO users (name, email, password, profile_picture) VALUES ('$name', '$email', '$hashed_password', '$new_file_name')";

						if (mysqli_query($conn, $insert_user_query)) {
							// Use JavaScript to display success message and redirect to index.php after 200ms
							echo "<script>
                                setTimeout(function() {
                                    alert('Account created successfully');
                                    window.location.href = 'index.php';
                                }, 200);
                             </script>";
						} else {
							$errors[] = "Error: " . $insert_user_query . "<br>" . mysqli_error($conn);
						}
					} else {
						$errors[] = "Error uploading file";
					}
				}

				mysqli_close($conn);
			}

			// Display errors
			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo $error . "<br>";
				}
			}
		}
	}
	?>

</body>

</html>