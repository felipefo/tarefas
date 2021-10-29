

function adicionaMenu() {
    document.getElementById("menu").innerHTML =
            '<a href="index.html">Tarefas | </a>' +
            '<a href="categoria.html">Categoria | </a>' +
            '<a href="meusdados.html">Meus dados | </a>' +
            '<a href="logout.html">Logout</a>';
}
document.addEventListener("DOMContentLoaded", adicionaMenu);



function openNav() {
    document.getElementById("menu").style.width = "200px";
}
function closeNav() {
    document.getElementById("menu").style.width = "0";
}


