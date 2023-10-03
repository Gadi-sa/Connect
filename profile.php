<?php
require_once "include/connect.php";

// Start the session
session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" style=" margin: 3% 0% 0% 48%; box-shadow: 0 10px 15px 0; border-radius: 20px;">
        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
        </svg>
    </button>

    <!-- disply of username, profile picture, bio... -->
    <main class="bg-white dark:bg-gray-900 ">
        <div class="flex justify-between px-20 mx-auto max-w-screen-sm  dark:bg-gray-800 dark:border-gray-800" style="margin-top: 6%; box-shadow: 0 10px 15px 0; border-radius: 20px;">
            <div class="flex items-center mb-6 not-italic">
                <div class="inline-flex items-center mr-3 mt-2 text-sm text-gray-900 dark:text-white">

                    <?php
                    // Retrieve the user id from the session
                    $user_id = $_SESSION['id'];

                    // Retrieve the user's name, bio, email, password, and joined_day from the database
                    $sql = "SELECT name, bio, email, password, joined_day FROM users WHERE id = $user_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output the user's name, bio, email, password, and joined_day
                        $row = $result->fetch_assoc();
                        $name = $row["name"];
                        $bio = $row["bio"];
                        $email = $row["email"];
                        $password = $row["password"];
                        $joined_day = $row["joined_day"];

                        // Retrieve the user's profile picture filename from the database
                        $sql = "SELECT profile_picture FROM users WHERE id = $user_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output the user's profile picture
                            $row = $result->fetch_assoc();
                            $profile_picture = $row["profile_picture"];
                            if ($profile_picture != null) {
                                $profile_picture_html = '<img src="profile_pictures/' . $profile_picture . '" alt="Profile Picture">';
                            } else {
                                $profile_picture_html = '<img src="https://www.citypng.com/public/uploads/preview/profile-user-round-red-icon-symbol-download-png-11639594337tco5j3n0ix.png" alt="Profile Picture">';
                            }
                        } else {
                            $profile_picture_html = '<img src="https://www.citypng.com/public/uploads/preview/profile-user-round-red-icon-symbol-download-png-11639594337tco5j3n0ix.png" alt="Profile Picture">';
                        }


                        // Update the HTML code with the user's name, bio, email, password, joined_day, and profile picture
                        // $html .= '<div class="profile-picture mr-4 w-16 h-16 rounded-full>' . $profile_picture_html . '</div>';
                        $html = '<img class="mr-3 w-32 h-32 rounded-full ring-2 ring-red-700 dark:ring-gray-500" ' . $profile_picture_html . `>`;
                        $html .= '<div class="profile-details">';
                        $html .= '<h2 class="profile-name text-xl font-bold text-gray-900 dark:text-white">' . $name . '</h2>';
                        $html .=  '<h4 class="text-base font-light text-gray-600 dark:text-gray-100">' . $email . '</h4>';
                        $html .= '<h5 class="text-base font-light text-gray-500 dark:text-gray-400"> Joined- ' . $joined_day . '</h5>';
                        $html .= '<p class="profile-bio text-base font-light text-gray-500 dark:text-gray-400"> Bio:  <br>' . $bio . '</p>';
                        $html .= '</div>';

                        // Display the updated HTML code
                        echo $html;
                    } else {
                        echo "User not found.";
                    }
                    ?>
                </div>
                <!-- edit button -->
                <div class="text-center">
                    <a href="profile_edit.php" class="font-medium hover:text-green-500 dark:text-primary-500 dark:text-white">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="width: 36px; margin-left:1%;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- go back button -->
    <div class="text-center">
        <a href="home.php" class="font-medium hover:text-red-500 dark:text-white ">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="width: 35px; margin:6% 0% 2% 48%; box-shadow: 0 5px 10px 0; border-radius: 20px;">
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