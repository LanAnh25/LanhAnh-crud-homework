<?php
include_once './database/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $studentId = $_GET['id'];

    if (deleteStudent($studentId)) {
        header("location: index.php");
        exit;
    } else {
        exit;
    }
} else {
    header("location: index.php?error=InvalidID");
    exit;
}
?>