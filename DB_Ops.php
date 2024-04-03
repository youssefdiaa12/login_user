<?php
// Database operations
session_start();


function connectToDatabase()
{
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "profile");
//        insertUser($_POST, $conn);
//        // Select user data from the database
//        selectUser($_POST['username']);
    return $conn;
}


function insertUser($userData)
{
    // Insert user data into the database

    $fullName = $userData['fullName'];
    $userName = $userData['userName'];
    $birthdate = $userData['birthdate'];
    $email = $userData['email'];
    $phone = $userData['phone'];
    $address = $userData['address'];
    $password = $userData['password'];
    $userImage = $_FILES['userImage']['name'];
    $confirmPass = $userData['confirmPassword'];
    $conn = connectToDatabase();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $result = selectUser($email, $conn);
        if ($result->num_rows > 0) {
            echo "Email already exists";
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO register_user (full_name, user_name, birth_date, phone, address, password, confirem_password, user_image, email)
                    VALUES ('$fullName', '$userName', '$birthdate', '$phone', '$address', '$password',  '$confirmPass', '$userImage', '$email')";

            if ($conn->query($sql) === TRUE) {
                // Store file details in session
                move_uploaded_file($_FILES['userImage']['tmp_name'], "attachment/" . $_FILES['userImage']['name']);
                $_SESSION['uploaded_file']["name"] = $_FILES['userImage']['name'];
                $_SESSION['uploaded_file']["tmp_name"] = $_FILES['userImage']['tmp_name'];
                // Redirect to Upload.php
                header('Location: Upload.php');
                echo "New record created successfully at database";

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
}


insertUser($_POST);

function selectUser($email, $conn)
{   //check if the email is unique
    $sql = "SELECT * FROM register_user WHERE email = '$email'";
    return $conn->query($sql);
}




