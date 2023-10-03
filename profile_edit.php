<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// Include the database configuration file
require_once "include/connect.php";

// Retrieve the user id from the session
$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated user information from the form
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $email = $_POST['email'];

    // Update the user's information in the database
    $stmt = $conn->prepare("UPDATE users SET name=?, bio=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $bio, $email, $user_id);
    $stmt->execute();

    // Upload the user's new profile picture if one was selected
    if ($_FILES['profile_picture']['name']) {
        $profile_picture = basename($_FILES['profile_picture']['name']);
        $target_dir = "profile_pictures/";
        $target_file = $target_dir . $profile_picture;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $extensions_arr)) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_dir . $profile_picture)) {
                $stmt = $conn->prepare("UPDATE users SET profile_picture=? WHERE id=?");
                $stmt->bind_param("si", $profile_picture, $user_id);
                $stmt->execute();
            } else {
                // Error uploading file
                echo "Invalid file type. Please upload a JPG, JPEG, or PNG file.";
            }
        } else {
            // Invalid file type
            echo "Invalid file type. Please upload a JPG, JPEG, or PNG file.";
        }
    }

    // Redirect the user to their profile page
    header("Location: profile.php");
    exit();
}

// Retrieve the user's name, bio, email, and password from the database
$stmt = $conn->prepare("SELECT name, password, bio, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output the edit profile form
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $bio = $row["bio"];
    $password = $row['password'];
    $email = $row["email"];
} else {
    // Output an error message if the user is not found in the database
    echo 'Error: User not found.';
}
?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
    <!-- darkmode toggle -->
    <div class="text-center">
        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" style="box-shadow: 0 10px 15px 0; border-radius: 20px; margin: 3% auto;">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>


    <main class="bg-white dark:bg-gray-900">
        <div class="flex justify-center px-4 py-8 mx-auto max-w-screen-md">
            <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2">
                <form class="space-y-6" method="post" enctype="multipart/form-data">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white" for="name">Name</label>
                        <input class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-primary-600 dark:focus:ring-primary-800" type="text" name="name" id="name" value="<?php echo $name ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white" for="bio">Bio [max 400 chars]</label>
                        <textarea class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-primary-600 dark:focus:ring-primary-800" rows="4" maxlength="400" name="bio" id="bio"><?php echo $bio ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white" for="email">Email</label>
                        <input class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-primary-600 dark:focus:ring-primary-800" type="email" name="email" id="email" value="<?php echo $email ?>">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="profile_picture">Upload Profile</label>
                        <input class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="profile_picture" id="profile_picture">
                    </div>
                    <div class="text-center">
                        <button type="submit" value="Save Changes" class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 mr-2 mb-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- go back button -->
    <div class="text-center">
        <a href="profile.php" class="font-medium hover:text-red-500 dark:text-white ">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="width: 35px; margin:3% 0% 4% 49%; box-shadow: 0 5px 10px 0; border-radius: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953l7.108-4.062A1.125 1.125 0 0121 8.688v8.123zM11.25 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953L9.567 7.71a1.125 1.125 0 011.683.977v8.123z"></path>
            </svg>
        </a>
    </div>


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
