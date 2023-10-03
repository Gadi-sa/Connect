<?php
include 'include/connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Check if the user is logged in
  session_start();
  if (!isset($_SESSION['id'])) {
    // Redirect to the login page or show an error message
    header('Location: index.php');
    exit;
  }

  // var_dump(($_POST));
  // Get the input values from the form
  $user_id = $_SESSION['id'];
  $storyID = $_POST['storyID'];
  $comment_content = $_POST['comment_content'];

  // Insert the comment into the database
  $stmt = $conn->prepare('INSERT INTO comments (user_id, story_id, comment) VALUES (?, ?, ?)');
  $stmt->bind_param('iis', $user_id, $storyID, $comment_content);
  $stmt->execute();

  // Redirect back to the story page
  header('Location: home.php');
  exit;
}
?>
<a href="home.php">back comment</a>
