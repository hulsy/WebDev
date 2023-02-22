/* 
    Student Name: Alex Hulford
    Lab Professor: Alemeseged Legesse
    Lab Section: 304
    Description: Assignment 1 -  My personal landing page
    Date Modified: Feb 22nd, 2023
 */

const nextPictureBtn = document.querySelector('#next-picture-btn');
const headshot = document.querySelector('#headshot');
const hockey = document.querySelector('#hockey');

nextPictureBtn.addEventListener("click", function(){
    console.log('clicked');
    headshot.classList.toggle('hidden');
    hockey.classList.toggle('hidden');
})