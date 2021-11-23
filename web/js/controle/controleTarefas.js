var controleTarefa = new ControleTarefa();

function ControleTarefa() {

    this.get = function () {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            var listaTarefas = JSON.parse(this.responseText);
            carregaListaTarefas(listaTarefas);
        };
        xmlhttp.open("GET", "/www/api/tarefas.php");
        xmlhttp.send();
    };
    this.post = function (event) {
        event.preventDefault();//previne que o browser faça a submissao, premitindo que seja feita com javascript.
        var formElement = document.getElementById("adicionartarefa");
        //https://developer.mozilla.org/en-US/docs/Web/API/FormData/Using_FormData_Objects
        var tarefaForm = new FormData(formElement);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.readyState === xmlhttp.DONE) {
                if (xmlhttp.status === 201)
                {
                    controleTarefa.get();
                    alert("Tarefa criada com sucesso");
                    document.getElementById("adicionar").style='none';
                } else {
                    alert("Erro ao criar a terafa");
                }
            }
            //var listaTarefas = JSON.parse(this.responseText);
            //carregaListaTarefas(listaTarefas);
        };
        xmlhttp.open("POST", "/www/api/tarefas.php");
        xmlhttp.send(tarefaForm);
    };
}
