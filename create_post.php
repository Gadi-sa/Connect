<?php
// Start session
session_start();
include 'include/connect.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the session
    $user_id = $_SESSION['id'];

    // Get the form data
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Check if an image has been uploaded
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $image = $_FILES['image'];
        $image_path = 'story_image/' . $image['name'];
        move_uploaded_file($image['tmp_name'], $image_path);
    } else {
        $image_path = null;
    }

    // Connect to the database
    require_once "include/connect.php";


    // Insert the post into the database
    $stmt = $conn->prepare("INSERT INTO stories (user_id, story_title, story_content, story_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $content, $image_path);
    $stmt->execute();
    $stmt->close();



    // Query the stories table for the user's posts
    $sql = "SELECT * FROM stories WHERE user_id = $user_id ORDER BY story_created_at DESC";
    $result = $conn->query($sql);

    // Loop through the results and display the posts
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h2>" . $row['story_title'] . "</h2>";
            echo "<p>" . $row['story_content'] . "</p>";
            if ($row['story_image']) {
                echo "<img src='" . $row['story_image'] . "' alt='Post Image'>";
            }
            echo "</div>";
        }
    } else {
        echo "No posts found.";
    }

    // Redirect to the homepage
    header("Location: home.php");
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
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


                <form method="POST" enctype="multipart/form-data">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white" for="title">Title:</label>
                        <input class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-primary-600 dark:focus:ring-primary-800" type="text" name="title" id="title" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white" for="content">Content:</label>
                        <textarea class="block w-full px-3 py-2 mt-1 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-primary-600 dark:focus:ring-primary-800" rows="8" type="text" name="content" id="content" required></textarea>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
                        <input class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="image" id="image" required>
                    </div>

                    <div class="text-center">
                        <button class="" type="submit">
                            <svg  aria-hidden="true" class="w-8 h-8 rotate-90 text-center w-8 mt-6 text-red-700 font-medium hover:text-green-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>



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