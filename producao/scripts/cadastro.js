var cad = document.getElementById('cad')



cad.addEventListener('click', function(){
    var nome = document.getElementById("nome")
    var email = document.getElementById("email")
    var usuario = document.getElementById("usuario")
    var telefone = document.getElementById("telefone")
    var senha = document.getElementById("senha")

    limpar_input(nome,email,telefone,usuario,senha)
})
//Limpa os inputs passados como parâmetro
function limpar_input() {
    arguments.innerText = ""
}

//Verifica se os campos estão vazios
