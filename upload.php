<?php
// Define the directory to store uploaded images
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Initialize a flag to indicate if upload is successful
$uploadOk = 1;

// Check if the file is an actual image
$check = getimagesize($_FILES["photo"]["tmp_name"]);
if ($check === false) {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check if the file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size (limit to 2MB)
if ($_FILES["photo"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow only certain file formats
if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// If all checks pass, try to upload the file
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        // Redirect back to the index.php page
        header("Location: index.php");
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Sorry, your file was not uploaded.";
}
?>
