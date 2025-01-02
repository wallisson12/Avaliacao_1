const checkBoxListaFiliados = document.getElementById('todosFiliados');
const todosCheckBoxFiliados = document.querySelectorAll('.checkboxFiliado');
const inputDeletar = document.getElementById('inputFiliadosId');

let idSelecionados = [];

if (checkBoxListaFiliados) {
    checkBoxListaFiliados.addEventListener('change', () => {
        marcarFiliadosCheckBox(checkBoxListaFiliados.checked);
    })
}

if (todosCheckBoxFiliados) {
    todosCheckBoxFiliados.forEach((checkBoxs) => {
        checkBoxs.addEventListener('change', () => {
            atualizarIdsSelecionados(checkBoxs, checkBoxs.checked);
            verificarTodosSelecionados();
        })
    })
}


/**
 * Responsável por desmarcar o checkbox da lista caso a lista nao esteja toda marcada
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function verificarTodosSelecionados() {
    checkBoxListaFiliados.checked = Array.from(todosCheckBoxFiliados).every(checkbox => checkbox.checked);
}

/**
 * Responsável por marcar com checked os checkBoxs dos filiados e atualizar a lista de ids
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function marcarFiliadosCheckBox(marca) {
    for (let i = 0; i < todosCheckBoxFiliados.length; i++) {
        todosCheckBoxFiliados[i].checked = marca;
        atualizarIdsSelecionados(todosCheckBoxFiliados[i], todosCheckBoxFiliados[i].checked);
    }
}

/**
 * Responsável por atualizar a lista de ids dos filiados
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function atualizarIdsSelecionados(filiado, adcionar) {
    let id = filiado.value;
    if (adcionar) {
        if (!idSelecionados.includes(id)) {
            idSelecionados.push(id);
        }
    } else {
        idSelecionados = idSelecionados.filter(item => item !== id)
    }

    adcionarFiliadosSelecionados();
}

/**
 * Responsável por criar o atributo name e adcionar a lista de ids de filiados
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function adcionarFiliadosSelecionados() {
    inputDeletar.value = idSelecionados;
}