function mostrar(){
    let new_dado = document.querySelectorAll('.new_dado')

    new_dado.forEach(function(new_dado) {
        if (new_dado.style.display === "none") {
            new_dado.style.display = 'block'
        }   
    });

    let salvar = document.getElementById('salvar')
    salvar.style.display = 'block'
    
}

function salvar(){
    let new_dado = document.querySelectorAll('.new_dado')

    new_dado.forEach(function(new_dado) {
        if (new_dado.style.display === "block") {
            new_dado.style.display = 'none'
        } else {
            new_dado.style.display = 'none'
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