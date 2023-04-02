<!--
    Student Name: Alex Hulford
    Student Number: 041066068
    Date: April 2, 2023
    Description: Lab Assignment 2. This is the upload page for the Pokedex application.
    It allows the user to upload a Pokemon's image.
-->

<?php
include 'header.php';

//if the user has submitted the form, upload the image
if (isset($_POST['submit'])) {
    //get the image name and tmp name
    $image_name = $_FILES['img']['name'];
    $image_tmp_name = $_FILES['img']['tmp_name'];
    //move the image to the image folder
    $filePath = 'image/' . $image_name;
    move_uploaded_file($image_tmp_name, $filePath);
    //redirect to the index page
    header("refresh:2; url=index.php");
    echo '<br><h6 class="has-text-centered">' . $filePath . ' uploaded succesfully</h6>';
}


include 'footer.php';
