import { Navbar } from './navbar.js';

//navbar

let array = ["nav_responsive"];
let count = 1;
let count2 = 1;

function recursive() {
    if (window.innerWidth >= 720) {
        document.getElementsByClassName("navbar-toggler")[0], count, array, document.getElementsByClassName("navbar-collapse")[0].style.display = "flex";
    }

    if (window.innerWidth >= 720) {
        document.getElementsByClassName("navbar-toggler")[0], count, array, document.getElementsByClassName("navbar-collapse")[0].style.display = "flex";
    } else {
        let nav = new Navbar(document.getElementsByClassName("navbar-toggler")[0], count, array, document.getElementsByClassName("navbar-collapse")[0]);

        nav.optionsFunction();

        console.log("test ok");

    }

    if (document.getElementsByClassName("navbar-toggler")[0].style.display == "none") {
        document.getElementsByClassName("navbar-toggler")[0], count, array, document.getElementsByClassName("navbar-collapse")[0].style.display = "flex";
    }

    setTimeout(recursive, 2000);
}

let nav = new Navbar(document.getElementsByClassName("dropdown-toggle")[0], count2, array, document.getElementsByClassName("dropdown-menu")[0]);

nav.optionsFunction();

recursive();

// modal 

let modal = document.getElementsByClassName("modal")[0];

let modal_comtent = document.getElementsByClassName("modal-content")[0];

let modal_button = document.getElementById("modal");

let modal_dialog = document.getElementsByClassName("modal-dialog")[0];

modal_button.addEventListener("click", () => {
    modal.style.display = "block";
    onkeyup = function (event) {
        if (event.key === "Escape") {
            modal.style.display = "none";
        }
    }

    document.getElementById("close").addEventListener("click",()=>{
        modal.style.display = "none";
    })

    modal_comtent.addEventListener("mouseover", (event) => {
        document.getElementsByClassName("btn-close")[0].addEventListener("click", () => {
            modal.style.display = "none";
        })


        console.log("test_over")
    });
});


// function hide() {
//     modal.style.display = "none";
// }


// modal.style.display = "block";

        // document.getElementsByClassName("modal-content")[0].addEventListener("click", () => {
        //     modal.style.display = "block";
        // });

        // modal_comtent.addEventListener("mouseleave", (e) => {
        //     console.log("test_leave")
        //     modal.addEventListener("click", hide);
        // });



