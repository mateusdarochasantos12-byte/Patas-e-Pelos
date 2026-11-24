const imagens = document.querySelectorAll(".imagens img");

const botaoAnterior = document.getElementById("anterior");
const botaoProximo = document.getElementById("proximo");

let indiceAtual = 0;
let animando = false;

function mudarImagem(direcao) {

    if (animando || imagens.length <= 1) return;

    animando = true;

    const imagemAtual = imagens[indiceAtual];

    let proximoIndice;

    if (direcao === "proximo") {
        proximoIndice = (indiceAtual + 1) % imagens.length;
    } else {
        proximoIndice = (indiceAtual - 1 + imagens.length) % imagens.length;
    }

    const proximaImagem = imagens[proximoIndice];

    imagemAtual.classList.remove("ativa");
    imagemAtual.classList.add(
        direcao === "proximo"
            ? "saindo-proximo"
            : "saindo-anterior"
    );

    proximaImagem.classList.add(
        direcao === "proximo"
            ? "entrando-proximo"
            : "entrando-anterior"
    );

    proximaImagem.addEventListener("animationend", function finalizar() {

        imagemAtual.classList.remove(
            "saindo-proximo",
            "saindo-anterior"
        );

        proximaImagem.classList.remove(
            "entrando-proximo",
            "entrando-anterior"
        );

        proximaImagem.classList.add("ativa");

        indiceAtual = proximoIndice;
        animando = false;

    }, { once: true });
}

botaoProximo.addEventListener("click", () => {
    mudarImagem("proximo");
});

botaoAnterior.addEventListener("click", () => {
    mudarImagem("anterior");
});