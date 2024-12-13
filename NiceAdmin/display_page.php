<?php
// Check if the 'image' query parameter exists
if (isset($_GET['image'])) {
    $imageName = htmlspecialchars($_GET['image']);
    $imagePath = "uploads/" . $imageName;

    // Check if the image file exists
    if (file_exists($imagePath)) {
        echo '<h1>Uploaded Photo:</h1>';
        echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="max-width: 300px;">';
    } else {
        echo "Image not found.";
    }
} else {
    echo "No image uploaded.";
}
?>
