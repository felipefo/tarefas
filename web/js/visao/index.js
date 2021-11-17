
function carregaListaTarefas(tarefas) {

    var tabelaTarefas = document.getElementById("lista_de_tarefas");
    for (var tarefa in tarefas) {
        console.log(JSON.stringify(tarefa));
        var corpo = tabelaTarefas.getElementsByTagName('tbody')[0];
        var novaLinha = corpo.insertRow(corpo.rows.length);
        novaLinha.innerHTML = '<tr>'
                + '<td>' + tarefas[tarefa]["descricao"] + '</td>'
                + '<td class="hide_420px">' + tarefas[tarefa]['categoria'] + '</td>'
                + '<td>' + tarefas[tarefa]['status'] + '</td>'
                + '<td>' + tarefas[tarefa]['data_criacao'] + '</td>'
                + '<td><input type="button" value="Editar"/>'
                + '<input type="button" value="Remover"/></td>'
                + '</tr>';
    }
}
