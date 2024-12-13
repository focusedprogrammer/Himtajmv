<?php
   
   include "../NiceAdmin/config.php";
  // Sanitize and retrieve POST data
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $subject = $conn->real_escape_string($_POST['subject']);
  $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : ''; // Check if 'message' is set

  // Check if message is empty
  if (empty($message)) {
    die('Message cannot be empty.');
  }

  // SQL query to insert form data into the database
  $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

  // Execute the query and handle success or failure
  if ($conn->query($sql) === TRUE) {
    // Show success message
    echo "<script>alert('Message sent successfully!'); window.location.href = 'contact_form_page.html';</script>";
  } else {
    // Log the error and show a failure message
    error_log("Database err: " . $conn->error);
    echo "<script>alert('There was an issue saving your message. Please try again.'); window.location.href = 'contact_form_page.html';</script>";
  }

  // Close the database connection
  $conn->close();
?>
