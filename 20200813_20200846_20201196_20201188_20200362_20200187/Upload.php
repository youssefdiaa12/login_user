<?php
session_start();
if(isset($_SESSION['uploaded_file']["name"])) {
    // move_uploaded_file($_FILES['userImage']['tmp_name'], "attachment/" . $_FILES['userImage']['name']);

    $tempName = $_SESSION['uploaded_file']["tmp_name"];
    $userImage = $_SESSION['uploaded_file']["name"];
    move_uploaded_file($tempName, "attachment/" . $userImage);
    echo "File uploaded successfully";
} else {
    echo "No file uploaded";
}