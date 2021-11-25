
function carregaListaTarefas(tarefas) {

    var tabelaTarefas = document.getElementById("lista_de_tarefas");
    var corpo = tabelaTarefas.getElementsByTagName('tbody')[0];
    console.log("tabelaTarefas:" + tabelaTarefas.rows.length);
    var length = corpo.rows.length;
    for (var index = 1; index < length; index++) {
        corpo.deleteRow(1);
    }
    for (var tarefa in tarefas) {
        //console.log(JSON.stringify(tarefa));
        var novaLinha = corpo.insertRow(corpo.rows.length);

        novaLinha.innerHTML = '<tr>'
                + '<td>' + tarefas[tarefa]["descricao"] + '</td>'
                + '<td class="hide_420px">' + tarefas[tarefa]['categoria'] + '</td>'
                + '<td>' + tarefas[tarefa]['status'] + '</td>'
                + '<td>' + tarefas[tarefa]['data_criacao'] + '</td>'
                + '<td><input type="button" value="Editar" \n\
                onClick=\'exibeAtualizarTarefa(' + tarefas[tarefa]['id'] + ',"' + tarefas[tarefa]['descricao'] + '")\'/>'
                + '<input type="button" value="Remover" onClick="controleTarefa.delete(' + tarefas[tarefa]['id'] + ')"/></td>'
                + '</tr>';
    }

}


    function exibeAtualizarTarefa(id, descricao, categoria) {
        
        document.getElementById('atualizar').style.display = 'block';
        document.getElementById('atualizarid').value = id;
        document.getElementById('descricao').value = descricao;
        document.getElementById('categoria').value = categoria;
    }

