<?php
include('database.php');
session_start();

if (isset($_POST['add_user'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $package = trim($_POST['package']);

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($package)) {
        $_SESSION['message'] = "All fields are required!";
        header('Location: addmemeber.php');
        exit(0);
    }

    if (empty($package)) {
        $_SESSION['message'] = "Please select a package.";
        header('Location: addmemeber.php');
        exit(0);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid Email Format";
        header('Location: addmemeber.php');
        exit(0);
    }

    $query = "INSERT INTO users (fname, lname, email, password, package) VALUES('$fname', '$lname', '$email', '$password', '$package')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "User Added Successfully";
        header('Location: addmemeber.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong!";
        header('Location: addmemeber.php');
        exit(0);
    }
}



if (isset($_POST['user_delete'])) {
    $user_id = $_POST['user_delete'];

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "User Deleted Successfully";
        header('Location: deletemember.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong!";
        header('Location: deletemember.php');
        exit(0);
    }
}
