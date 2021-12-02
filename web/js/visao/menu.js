
function adicionaMenu() {
    document.getElementById("menu").innerHTML =
            '<a href="index.html">Tarefas | </a>' +
            '<a href="categoria.html">Categoria | </a>' +
            '<a href="meusdados.html">Meus dados | </a>' +
            '<a id="acesso" onclick="openLogin()" href="">Login</a>';
}
function openLogin(){
    event.preventDefault();
    document.getElementById('login_modal').style.display = 'block';
}
function addLogout(){
    document.getElementById("acesso").innerHTML = "Logout";
    document.getElementById("acesso").onclick = controleUsuario.logout;
    
}
function addLogin(){
    document.getElementById("acesso").innerHTML = "Login";
    document.getElementById("acesso").onclick = openLogin;
    
}
document.addEventListener("DOMContentLoaded", adicionaMenu);


