window.onload = function () {

    let blur = document.getElementsByClassName("blur");

    let register = document.getElementsByClassName("modal")[0];

    let register_content = document.getElementsByClassName("modal-content")[0];

    let register_button = document.getElementById("register");

    let register_button2 = document.getElementById("register2");

    let register_dialog = document.getElementsByClassName("modal-dialog")[0];

    register_button.addEventListener("click", () => {
        register.style.display = "block";
        blur[0].style.filter="blur(5px)";
        blur[1].style.filter="blur(5px)";
        blur[2].style.filter="blur(5px)";
        // blur[3].style.filter="blur(5px)";
        onkeyup = function (event) {
            if (event.key === "Escape") {
                register.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            }
        }

        document.getElementById("close").addEventListener("click", () => {
            register.style.display = "none";
            blur[0].style.filter="";
            blur[1].style.filter="";
            blur[2].style.filter="";
            // blur[3].style.filter="";
        })

        register_content.addEventListener("mouseover", (event) => {
            document.getElementsByClassName("btn-close")[0].addEventListener("click", () => {
                register.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            })


            console.log("test_over")
        });
    });

    register_button2.addEventListener("click", () => {
        register.style.display = "block";
        blur[0].style.filter="blur(5px)";
        blur[1].style.filter="blur(5px)";
        blur[2].style.filter="blur(5px)";
        // blur[3].style.filter="blur(5px)";
        onkeyup = function (event) {
            if (event.key === "Escape") {
                register.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            }
        }

        document.getElementById("close").addEventListener("click", () => {
            register.style.display = "none";
            blur[0].style.filter="";
            blur[1].style.filter="";
            blur[2].style.filter="";
            // blur[3].style.filter="";
        })

        register_content.addEventListener("mouseover", (event) => {
            document.getElementsByClassName("btn-close")[0].addEventListener("click", () => {
                register.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            })


            console.log("test_over")
        });
    });

    let login = document.getElementsByClassName("modal")[1];

    let login_content = document.getElementsByClassName("modal-content")[1];

    let login_button = document.getElementById("login");

    let login_button2 = document.getElementById("login2");

    let login_dialog = document.getElementsByClassName("modal-dialog")[1];

    login_button.addEventListener("click", () => {
        login.style.display = "block";
        blur[0].style.filter="blur(5px)";
        blur[1].style.filter="blur(5px)";
        blur[2].style.filter="blur(5px)";
        // blur[3].style.filter="blur(5px)";
        onkeyup = function (event) {
            if (event.key === "Escape") {
                login.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            }
        }

        document.getElementById("close").addEventListener("click", () => {
            login.style.display = "none";
            blur[0].style.filter="";
            blur[1].style.filter="";
            blur[2].style.filter="";
            // blur[3].style.filter="";
        })

        login_content.addEventListener("mouseover", (event) => {
            document.getElementsByClassName("btn-close")[1].addEventListener("click", () => {
                login.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            })


            console.log("test_over")
        });
    });

    login_button2.addEventListener("click", () => {
        login.style.display = "block";
        blur[0].style.filter="blur(5px)";
        blur[1].style.filter="blur(5px)";
        blur[2].style.filter="blur(5px)";
        // blur[3].style.filter="blur(5px)";
        onkeyup = function (event) {
            if (event.key === "Escape") {
                login.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            }
        }

        document.getElementById("close").addEventListener("click", () => {
            login.style.display = "none";
            blur[0].style.filter="";
            blur[1].style.filter="";
            blur[2].style.filter="";
            // blur[3].style.filter="";
        })

        login_content.addEventListener("mouseover", (event) => {
            document.getElementsByClassName("btn-close")[1].addEventListener("click", () => {
                login.style.display = "none";
                blur[0].style.filter="";
                blur[1].style.filter="";
                blur[2].style.filter="";
                // blur[3].style.filter="";
            })


            console.log("test_over")
        });
    });

    const themeSelect = document.getElementById('theme-select');
    const applyThemeBtn = document.getElementById('apply-theme-btn');

    // Ajouter un gestionnaire d'événements au clic sur le bouton "Appliquer"
    applyThemeBtn.addEventListener('click', function() {
      const selectedTheme = themeSelect.value;
      document.body.className = selectedTheme;
    });
    
}