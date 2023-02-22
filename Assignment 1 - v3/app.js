/* 
    Student Name: Alex Hulford
    Lab Professor: Alemeseged Legesse
    Lab Section: 304
    Description: Assignment 1 -  My personal landing page
    Date Modified: Feb 22nd, 2023
 */


const courseBtns = document.querySelectorAll('.course-button');
const searchInput = document.querySelector('#search-input');
const courseNames = document.querySelectorAll('.course-name');
const courseCards = document.querySelectorAll('.card');
const filter = document.querySelector('#filter');
const sortUpBtn = document.querySelector('#sortUp');
const sortDownBtn = document.querySelector('#sortDown');



for (let courseBtn of courseBtns){
    courseBtn.addEventListener("click", function(e){
        e.preventDefault();
    })
}


function searchCourseByName(){
    const lookup = this.value;
    const filter = lookup.toUpperCase();
    for (let i=0; i<courseCards.length; i++){
        if(courseNames[i].innerText.toUpperCase().indexOf(filter) == -1){
            courseCards[i].classList.add('hidden');
        }
        else {
            courseCards[i].classList.remove('hidden');
        }
    }   
}


function sortUp() {      
    let courseList, i, run, li, stop;
    courseList = document.getElementById("course-list");
    run = true;
    while (run) {
        run = false;
        li = courseList.getElementsByTagName("li");
        for (i = 0; i < (li.length - 1); i++) {
            stop = false;
            if (li[i].className > li[i + 1].className) {
                stop = true;
                break;
            }
        }
        if (stop) {
            li[i].parentNode.insertBefore(li[i + 1], li[i]);
            run = true;
        }
    }
}

function sortDown() {      
    let courseList, i, run, li, stop;
    courseList = document.getElementById("course-list");
    run = true;
    while (run) {
        run = false;
        li = courseList.getElementsByTagName("li");
        for (i = 0; i < (li.length - 1); i++) {
            stop = false;
            if (li[i].className < li[i + 1].className) {
                stop = true;
                break;
            }
        }
        if (stop) {
            li[i].parentNode.insertBefore(li[i + 1], li[i]);
            run = true;
        }
    }
}


function filterByCourseLevel(){
    for (let i=0; i<courseCards.length; i++){
        if (courseCards[i].className.indexOf(this.value) == -1){
          courseCards[i].classList.add('hidden');
        } else {
        courseCards[i].classList.remove('hidden');
        }
    }
}


searchInput.addEventListener("change", searchCourseByName);
sortUpBtn.addEventListener("click", sortUp);
sortDownBtn.addEventListener("click", sortDown);
filter.addEventListener("change", filterByCourseLevel);
