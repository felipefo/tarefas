controleUsuario = new ControleUsuarios();

function ControleUsuarios() {

    this.login = function (event) {
        event.preventDefault();//previne que o browser faça a submissao, premitindo que seja feita com javascript.
        var formElement = document.getElementById("login_usuario");
        //https://developer.mozilla.org/en-US/docs/Web/API/FormData/Using_FormData_Objects
        var tarefaForm = new FormData(formElement);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.readyState === xmlhttp.DONE) {
                if (xmlhttp.status === 200)
                {
                     controleTarefa.get();
                    alert("Usuario logado com sucesso");
                    addLogout();
                    document.getElementById("login_modal").style = 'none';
                } else {
                    alert("Usuario ou senha incorretos");
                }
            }
        };
        xmlhttp.open("POST", "/www/api/usuarios.php/login");
        xmlhttp.send(tarefaForm);
    };
    
    
     this.logout = function (event) {
        event.preventDefault();//previne que o browser faça a submissao, premitindo que seja feita com javascript.
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.readyState === xmlhttp.DONE) {
                if (xmlhttp.status === 200)
                {
                      carregaListaTarefas([]);
                    alert("Deslogado com sucesso");
                    addLogin();
                } else {
                    alert("Nao foi possivel deslogar");
                }
            }
        };
        xmlhttp.open("POST", "/www/api/usuarios.php/logout");
        xmlhttp.send();
    };
   
}
