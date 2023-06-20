<?php
// Connect to the database server.
$link = mysqli_connect("localhost", "root", "", "FK_edusearch", "3307") or die(mysqli_connect_error());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the submitted data
  $email = $_POST['email'];
  $satisfaction = $_POST['satisfaction'];
  $additional = $_POST['additional'];

  // Retrieve the user ID based on the provided email
  $query = "SELECT user_id FROM user WHERE email = '$email'";
  $result = mysqli_query($link, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    // Insert the feedback data into the satisfaction table
    $insertQuery = "INSERT INTO satisfaction (user_id, satisfaction, additional) VALUES ('$user_id', '$satisfaction', '$additional')";
    $insertResult = mysqli_query($link, $insertQuery);

    if ($insertResult) {
      echo "Feedback submitted successfully!<br>";
    } else {
      echo "Error submitting feedback: " . mysqli_error($link);
    }
  } else {
    echo "User not found.";
  }

  // Close the database connection
  mysqli_close($link);

  // Print the submitted data
  echo "Thank you for your feedback, $email!<br>";
  echo "Rating: $satisfaction<br>";
  echo "Comments: $additional<br>";
}
?>
