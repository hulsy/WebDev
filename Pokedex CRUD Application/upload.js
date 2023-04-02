/*
 * Student Name: Alex Hulford
 * Student Number: 041066068
 * Date: April 2, 2023
 * Description: Lab Assignment 2. This script is used to dynamically update the image file name in the form.
 */

// This function is called when the user selects a file from the file input.
const imageInput = document.querySelector('#img');
// When the user selects a file, the file name is displayed in the form.
imageInput.onchange = () => {
    if (imageInput.files.length > 0) {
        const imageName = document.querySelector ('#image-name');
        imageName.textContent = imageInput.files[0].name;
    }
}