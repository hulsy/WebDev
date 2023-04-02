<!--
 Student Name: Alex Hulford
 Student Number: 041066068
 Date: April 2, 2023
 Description: Lab Assignment 2. This is the error page for the Pokedex application.
 It is displayed when an error occurs.
-->

<?php
include 'header.php';

// Display an error message and then redirect to the index page
echo "Something went wrong. Please try again later.";
header("refresh:2; url=index.php");

include 'footer.php';
