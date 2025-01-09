const menu_navbar = document.querySelector("#menu_navbar");
        const img_menu = document.querySelector("#img_menu");
        const ModelProjet  = document.querySelector("#ModelProjet ");
        const buttonAddProjet  = document.querySelector("#buttonAddProjet");
        const closeModelProjet  = document.querySelector("#closeModelProjet");


        img_menu.addEventListener('click', function() {
            menu_navbar.classList.toggle("hidden");
        });
        closeModelProjet.addEventListener('click', function() {
            ModelProjet.classList.toggle("hidden");
        });
        buttonAddProjet.addEventListener('click', function() {
            ModelProjet.classList.toggle("hidden");
        });



        window.onload = function() {
        const alertMessage = document.getElementById('alert-message');
        
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.classList.add('opacity-0'); 
                alertMessage.classList.add('transition-opacity');
                setTimeout(function() {
                    alertMessage.remove();
                }, 300);
            }, 2000);
        }
    }