<?php
require_once "include/connect.php";
session_start();
// Start the session
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="30x30" href="favicon-32x32.png">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> <!--download html2canvas  -->

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

    <header class="sticky top-0 z-50">
        <nav class="bg-white border-gray-200 px-4 sm:px-6 py-2.5 dark:bg-gray-900 ml-6 mr-6">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex justify-start items-center">

                    <!-- logo -->
                    <a href="home.php" class="flex mr-4">
                        <img src="logo2.png" class="mr-1 h-10" alt="Logo" />
                    </a>

                    <!-- search form -->
                    <form action="search.php" method="GET" class="hidden lg:block lg:pl-2 ">
                        <label for="topbar-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-96">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search Post">
                        </div>
                    </form>
                </div>


                <div class="flex items-center lg:order-2">
                    <div>
                        <!-- dark mode button -->
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" style="margin-right: 25px;">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- add new post in navbar -->
                        <a href="create_post.php">
                            <button type="button" class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" style="background-color: #a1a1aa;">
                                <svg aria-hidden="true" class="mr-1 ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg> New Post
                            </button>
                        </a>

                        <!-- Apps -->
                        <button type="button" data-dropdown-toggle="apps-dropdown" class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                            <span class="sr-only">View Apps</span>
                            <!-- Icon -->
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="apps-dropdown">
                        <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            Apps
                        </div>
                        <div class="grid grid-cols-1 gap-4 p-4">
                            <a href="home.php" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mx-auto mb-1 w-7 h-7 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400">
                                    <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h9A1.5 1.5 0 0114 3.5v11.75A2.75 2.75 0 0016.75 18h-12A2.75 2.75 0 012 15.25V3.5zm3.75 7a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zm0 3a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zM5 5.75A.75.75 0 015.75 5h4.5a.75.75 0 01.75.75v2.5a.75.75 0 01-.75.75h-4.5A.75.75 0 015 8.25v-2.5z" clip-rule="evenodd" />
                                    <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 102.5 0V8a1.5 1.5 0 00-1.5-1.5z" />
                                </svg>

                                <div class="text-sm text-gray-900 dark:text-white">Feed</div>
                            </a>
                            <a href="users.php" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <svg aria-hidden="true" class="mx-auto mb-1 w-7 h-7 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                                <div class="text-sm text-gray-900 dark:text-white">Users</div>
                            </a>
                            <a href="profile.php" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <svg aria-hidden="true" class="mx-auto mb-1 w-7 h-7 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-sm text-gray-900 dark:text-white">Profile</div>
                            </a>
                            <a href="logout.php" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                                <svg aria-hidden="true" class="mx-auto mb-1 w-7 h-7 text-gray-400 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <div class="text-sm text-gray-900 dark:text-white">Logout</div>
                            </a>
                        </div>
                    </div>


                    <!-- profile pictue -->
                    <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <div class="relative">
                            <?php
                            // Retrieve the user id from the session
                            $user_id = $_SESSION['id'];

                            // Retrieve the user's data from the database
                            $sql = "SELECT profile_picture FROM users WHERE id = $user_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output the user's data
                                $row = $result->fetch_assoc();
                                $profile_picture = $row["profile_picture"];

                                // Build the HTML code with the user's data
                                $html = '<img src="profile_pictures/';

                                if (!empty($profile_picture)) {
                                    $html .= $profile_picture;
                                } else {
                                    $html .= 'https://www.citypng.com/public/uploads/preview/profile-user-round-red-icon-symbol-download-png-11639594337tco5j3n0ix.png';
                                }

                                $html .= '" class="w-10 h-10 rounded-full" alt="Profile Picture">';

                                // Display the HTML code
                                echo $html;
                            } else {
                                echo "User not found.";
                            }
                            ?>
                            <span class="top-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                        </div>
                    </button>


                    <!-- Dropdown menu -->
                    <div class="hidden z-50 my-4 w-50 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                        <div class="py-3 px-4">
                            <div class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">


                                <?php
                                // Retrieve the user id from the session
                                $user_id = $_SESSION['id'];

                                // Retrieve the user's name and email from the database
                                $sql = "SELECT name, email FROM users WHERE id = $user_id";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output the user's name and email
                                    $row = $result->fetch_assoc();
                                    $name = $row["name"];
                                    $email = $row["email"];

                                    // Update the HTML code with the user's name and email
                                    $html = '<span class="block text-sm font-semibold text-gray-900 dark:text-white">' . $name . '</span>';
                                    $html .= '<span class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">' . $email . '</span>';

                                    // Display the updated HTML code
                                    echo $html;
                                } else {
                                    echo "User not found.";
                                }
                                ?>
                            </div>

                            <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                                <li>
                                    <a href="profile.php" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My profile</a>
                                </li>
                            </ul>

                            <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                                <li>
                                    <a href="logout.php" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </nav>
    </header>


    <!-- Add post/ view profile / logout button "+" -->
    <div data-dial-init class="fixed right-6 bottom-6 group">
        <div id="speed-dial-menu-vertical" class="flex flex-col items-center hidden mb-4 space-y-2">
            <a href="create_post.php">
                <button type="button" data-tooltip-target="tooltip-print" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="sr-only">Post</span>
                </button>
            </a>
            <div id="tooltip-print" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Post
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>


            <a href="profile.php">
                <button type="button" data-tooltip-target="tooltip-profile" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sr-only">Profile</span>
                </button>
            </a>
            <div id="tooltip-profile" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Profile
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <!-- download -->
            <button onclick="download()" type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Download</span>
            </button>
            <div id="tooltip-download" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Download
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>


            <a href="logout.php">
                <button type="button" data-tooltip-target="tooltip-share" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="sr-only">Logout</span>
                </button>
            </a>
            <div id="tooltip-share" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Logout
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

        </div>
        <button type="button" data-dial-toggle="speed-dial-menu-vertical" aria-controls="speed-dial-menu-vertical" aria-expanded="false" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg aria-hidden="true" class="w-8 h-8 transition-transform group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>


    <!-- diplayed posts -->
    <div class="flex justify-between px-10 mx-auto max-w-screen-lg mt-4 " style=" box-shadow: 0px 13px 6px 0px; border-radius: 5px 5px 0px 0px;">
        <div class=" mx-auto max-w-screen-lg w-full grid grid-cols-1 ">
            <?php
            // Get all stories from the stories table with user name and created time
            $sql = "SELECT s.*, u.name, u.email, u.joined_day, u.profile_picture, s.story_created_at 
                  FROM stories s 
                  JOIN users u ON s.user_id = u.id 
                  ORDER BY s.story_created_at DESC";

            $result = $conn->query($sql);

            // Loop through the results and display the posts
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // <!-- Post content -->

                    echo '<div id="download"  class="w-full hover:text-red-700" style=" box-shadow: 0px 14px 12px 0px; border-radius: 5px 5px 25px 25px;">';
                    // <!-- Post author -->
                    echo '<div class="flex items-center mt-8 mb-2 mx-auto max-w-screen-lg">';
                    echo '<div  class="ml-4" style="box-shadow: 4px 0px 4px 0px; border-radius:22px">';

                    $profile_picture = $row["profile_picture"];
                    // Build the HTML code with the user's data
                    $html = '<img src="profile_pictures/';
                    if (!empty($profile_picture)) {
                        $html .= $profile_picture;
                    } else {
                        $html .= 'https://www.citypng.com/public/uploads/preview/profile-user-round-red-icon-symbol-download-png-11639594337tco5j3n0ix.png';
                    }
                    $html .= '" class="w-12 h-12 rounded-full p-0.5  ring-2 ring-gray-600 dark:ring-gray-700" alt="Profile Picture">';
                    // Display the profile picture
                    echo $html;
                    echo '</div>';

                    echo '<div  class="text-gray-300 font-medium ml-2">';
                    echo "<h2 class='text-gray-900 dark:text-gray-300 font-medium '>Posted by " . $row['name'] . "</h2>";
                    echo "<p class='text-gray-600 dark:text-gray-400 font-small'>" . $row['story_created_at'] . "</p>";
                    echo '</div>';
                    echo '</div>';

                    echo "<hr class='border-t-4 border-gray-700 my-3'>"; // hr line 

                    echo '<div  class="m-4 ml-10 mt-4 hover:text-yellow-600 text-gray-800 dark:text-gray-300">';
                    // <!-- Post title -->
                    echo "<h5 class='text-sm font-bold'>" . $row['story_title'] . "</h5>";
                    // <!-- Post content -->
                    echo "<p class='leading-relaxed';>" . $row['story_content'] . "</p>";
                    echo '</div>';

                    // <!-- Post image -->
                    if ($row['story_image']) {
                        echo "<img  src='" . $row['story_image'] . "' alt='Post Image' class='mx-auto rounded max-w-200 mb-4'>";
                    }





                    // comment
                    echo '<div>';
                    // Run SQL query to fetch data
                    $storyId = $row['id'];
                    $sqlComments = "SELECT u.name, c.created_at, c.comment 
                    FROM comments c 
                    INNER JOIN users u 
                    ON c.user_id = u.id
                    WHERE c.story_id = :story_id 
                    ORDER BY c.created_at DESC";
                    // $result = mysqli_query($conn, $sql);
                    $stmt = $pdo->prepare($sqlComments);
                    $stmt->execute([
                        'story_id' => $storyId,
                    ]);

                    echo "<hr class='border-t-2 border-yellow-900 my-3'>"; // hr line 
                    // Display comments
                    if ($stmt->rowCount() > 0) {
                        foreach ($stmt as $row) {
                            $name = $row["name"];
                            $created_at = $row["created_at"];
                            $comment = $row["comment"];

                            echo <<<HTML
                            <div class="ml-2">
                                <div class=" ml-6 mt-2 shadow-xl rounded-tl-md rounded-bl-md ">
                                    <h1 class="ml-2 text-gray-800 dark:text-gray-600"> <strong>{$name}</strong>- {$created_at}</h1>
                                </div>
                                <div class="ml-20 mb-4 pl-2 hover:text-yellow-600 " style="box-shadow: -2px 0px 0px 0px; border-radius: 0px 35px 3px 18px;" >
                                    <h5 class="text-gray-800 dark:text-gray-600 mr-4">{$comment} </h5>

                                </div>
                            </div>
                            HTML;
                        }
                    } else {
                        echo "No comments yet.";
                    }
                    echo '</div>';

                    // $storyId = $row['id'];
                    echo <<<HTML
                    <form method="POST" action="comments.php">
                    <label for="comment" class="sr-only">Your comment</label>
                    <input type="hidden"  name="storyID" value="$storyId">
                    <div class="flex items-center px-3 py-2 rounded-lg dark:bg-gray-900 " style="border-radius:2px 5px 20px 25px;">
                        <textarea id="comment" name="comment_content" rows="1" class="caret-green-600 block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment..."></textarea>
                        <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                        <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                        <span class="sr-only">comment</span>
                        </button>
                    </div>
                    </form>
                    HTML;
                    echo '</div>';
                }
            } else {
                echo "No posts yet.";
            }
            ?>
        </div>
    </div>


    <!-- footer -->
    <footer class="bg-white-50 dark:bg-gray-900">
        <div class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <!-- <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 md:my-8"> -->
            <div class="text-center">
                <span class="block text-sm text-center text-gray-500 dark:text-gray-400">© 2023-2024 <a href="#" class="hover:underline">Connect™</a>. All Rights Reserved.
                </span>
                <ul class="flex justify-center mt-5 space-x-5">
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>


    <!-- download canvas-->
    <script type="text/javascript">
        function download() {
            var download = document.getElementById("download");
            html2canvas(download).then(function(canvas) {
                var link = document.createElement('a');
                link.download = 'connect.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }
    </script>

    <!-- handles like/unlike system -->
    <script>
        function likeStory(storyId) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the like count
                    document.getElementById("like-count-" + storyId).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "reaction.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("story_id=" + storyId + "&reaction_type=like");
        }

        function dislikeStory(storyId) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the dislike count
                    document.getElementById("dislike-count-" + storyId).innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "reaction.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("story_id=" + storyId + "&reaction_type=dislike");
        }
    </script>

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