function alterar_dados(){
    let new_dado = document.querySelectorAll('.new_dado')
    let dado = document.querySelectorAll('.dado')
    let inputm = document.getElementById('mostrar')
    let inputs = document.getElementById('salvar')

    inputm.style.display = "none";
    inputs.style.display = "block";

    dado.forEach(function(dado) {
        if (dado.style.display === "block") {
            dado.style.display = 'none'
        }   
    });

    new_dado.forEach(function(new_dado) {
        if (new_dado.style.display === "none") {
            new_dado.style.display = 'block'
        }   
    });

    let salvar = document.getElementById('salvar')
    salvar.style.display = 'block'
    
}

function salvar_dados(){
    let new_dado = document.querySelectorAll('.new_dado')
    let dado = document.querySelectorAll('.dado')
    let inputm = document.querySelector('#mostrar')
    let inputs = document.querySelector('#salvar')

    inputm.style.display = "block";
    inputs.style.display = "none";

    new_dado.forEach(function(new_dado) {
        if (new_dado.style.display === "block") {
            new_dado.style.display = 'none'
        } else {
            new_dado.style.display = 'none'
        }    
    });

    dado.forEach(function(dado) {
        if (dado.style.display === "none") {
            dado.style.display = 'block'
        }   
    });

    let salvar = document.getElementById('salvar')
    salvar.style.display = 'none'
}
function home() {
    let home = document.getElementById('home')
    document.getElementById('main').src = 'homologacao/dados.php'
    
}
function usuarios() {
    let uuarios = document.getElementById('usuarios')
    document.getElementById('main').src = 'homologacao/table_usuarios.php'
    
}
function cadastro() {
    let uuarios = document.getElementById('usuarios')
    document.getElementById('main').src = 'homologacao/cadastro.html'
    
}