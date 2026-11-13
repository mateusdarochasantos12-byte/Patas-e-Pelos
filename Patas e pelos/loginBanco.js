
const formulario = document.getElementById("formLogin");

formulario.addEventListener("submit", function(event) {

    const nome = document.getElementById("responsavel").value.trim();
    const cpf = document.getElementById("CPF").value.trim();
    const senha = document.getElementById("senha").value.trim();

    if (nome === "" || cpf === "" || senha === "") {

        event.preventDefault();

        alert("Preencha todos os campos!");

    }

});
