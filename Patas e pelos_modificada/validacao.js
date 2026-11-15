
function validarFormulario(event) {

    let nome = document.getElementById("nome_completo").value;
    let cpf = document.getElementById("CPF").value;
    let senha = document.getElementById("senha_desejada").value;
    let confirmarSenha = document.getElementById("senha_criada").value;
    let email = document.getElementById("email").value;
    let telefone = document.getElementById("telefone").value;

    if (nome == "") {
        alert("Preencha o nome!");
        event.preventDefault();
    }

    else if (cpf.length != 11) {
        alert("O CPF deve ter 11 números!");
        event.preventDefault();
    }

    else if (senha.length < 8) {
        alert("A senha deve ter pelo menos 8 caracteres!");
        event.preventDefault();
    }

    else if (senha != confirmarSenha) {
        alert("As senhas não coincidem!");
        event.preventDefault();
    }

    else if (email == "" || email.indexOf("@") == -1) {
        alert("Digite um e-mail válido!");
        event.preventDefault();
    }

    else if (telefone.length < 10) {
        alert("Digite um telefone válido!");
        event.preventDefault();
    }

}
