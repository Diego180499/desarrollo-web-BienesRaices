document.addEventListener('DOMContentLoaded', function(){

    eventListeners();
    darkMode();

});

function eventListeners(){
    const menu = document.querySelector('.mobile-menu');

    menu.addEventListener('click',navegacionResponsive);

}


function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar-nav')){
        navegacion.classList.remove('mostrar-nav');
    }else{
        navegacion.classList.add('mostrar-nav');
    }

}

function darkMode(){

    //para ver las preferencias del usuario, si su sistema lo tiene en dark o claro
    const prefiereDark = window.matchMedia('(prefers-color-scheme:dark)');

    if(prefiereDark.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    prefiereDark.addEventListener('change',function(){
        if(prefiereDark.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    });

    
    const botonDark = document.querySelector('.boton-dark');

    botonDark.addEventListener('click', function(){

        document.body.classList.toggle('dark-mode');

    });
}