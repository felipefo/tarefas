controleTarefa = new ControleTarefa();

function ControleTarefa() {

    this.get = function () {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.status === 200)
            {
                var listaTarefas = JSON.parse(this.responseText);
                carregaListaTarefas(listaTarefas);
            } else {
                alert(this.responseText);
            }
           
        };
        xmlhttp.open("GET", "/api/tarefas.php");
        xmlhttp.send();
    };

    this.delete = function (id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.status === 200)
            {
                controleTarefa.get();
                alert("Tarefa removida com sucesso");
            } else {
                alert("Erro ao remover a Tarefa");
            }
        };
        xmlhttp.open("DELETE", "/api/tarefas.php?id=" + id);
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
                    document.getElementById("adicionar").style = 'none';
                } else {
                    alert("Erro ao criar a tarefa");
                }
            }
        };
        xmlhttp.open("POST", "/api/tarefas.php");
        xmlhttp.send(tarefaForm);
    };

    this.put = function (event) {
        event.preventDefault();//previne que o browser faça a submissao, premitindo que seja feita com javascript.
        var formElement = document.getElementById("atualizartarefa");
        //https://developer.mozilla.org/en-US/docs/Web/API/FormData/Using_FormData_Objects
        var tarefaForm = new FormData(formElement);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            if (xmlhttp.readyState === xmlhttp.DONE) {
                if (xmlhttp.status === 200)
                {
                    controleTarefa.get();
                    alert("Tarefa atualizada com sucesso");
                    document.getElementById("atualizar").style = 'none';
                } else {
                    alert("Erro ao atualizar a tarefa");
                }
            }
        };
        xmlhttp.open("POST", "/api/tarefas.php?id=" + formElement['atualizarid'].value);
        xmlhttp.send(tarefaForm);
    };
}
