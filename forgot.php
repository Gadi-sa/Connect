<?php
include 'include/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirm_password) {
		echo "<script>
		setTimeout(function() {
			alert(`Passwords do not match! \nTry Again!`);
		}, 200);
	 </script>";
    } else {
        // Check if the email exists in the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
			echo "<script>
			setTimeout(function() {
				alert(`Email address not found! \n`);
			}, 200);
		 </script>";
        } else {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Update the user's password in the database
            $sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
				setTimeout(function() {
					alert(`Password reset successful! \nGo to Login Page!`);
					window.location.href = 'index.php';
				}, 200);
			 </script>";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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

<body class="bg-gray-50 dark:bg-gray-700">


	<!-- sign up -->
	<section class="bg-gray-50 dark:bg-gray-700">
		<!-- <section> -->
		<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
			<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				<div class="p-6 space-y-4 md:space-y-6 sm:p-8">
					<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
						Reset Your Password
					</h1>
					<form class="space-y-4 md:space-y-6" method="POST" action="">
						<div>
							<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
								email</label>
							<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@bit.nl" required="">
						</div>
						<div>
							<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
							<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
						</div>
						<div>
							<label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
								password</label>
							<input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
						</div>
                        <!-- <input type="submit" value="Reset password"> -->
                        <!-- <input type="submit" value="Reset password"class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> -->
                        <button type="submit" value="Reset password" class="w-full text-green-600  hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset password</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
							Back to Login? <a href="index.php" class="font-medium text-red-600 hover:text-green-700 dark:text-primary-500">Login</a>
						</p>

					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
