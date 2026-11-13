const imagens = document.querySelectorAll(".imagens img");

const anterior = document.querySelector("#anterior");
const proximo = document.querySelector("#proximo");

let indice = 0;



function mostrarImagem() {

    imagens.forEach(function(imagem) {
        imagem.classList.remove("ativa");
    });

    imagens[indice].classList.add("ativa");

}


proximo.addEventListener("click", function() {

    indice++;

    if (indice >= imagens.length) {
        indice = 0;
    }

    mostrarImagem();

});


anterior.addEventListener("click", function() {

    indice--;

    if (indice < 0) {
        indice = imagens.length - 1;
    }

    mostrarImagem();

});