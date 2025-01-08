const inputIdade = document.querySelector('#idade');
const inputDate = document.querySelector('#dataNascimento');

/**
 * Responsável por calcular a idade e exibir no input de idade
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function calcularIdade() {
    const dataAtual = new Date();
    const dataNascimento = new Date(inputDate.value);

    if (!isNaN(dataNascimento.getTime())) {
        const mesAtual = dataAtual.getMonth();
        const diaAtual = dataAtual.getDate();
        const mesNascimento = dataNascimento.getMonth();
        const diaNascimento = dataNascimento.getDate();

        let idade = dataAtual.getFullYear() - dataNascimento.getFullYear();

        if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
            idade--;
        }

        inputIdade.value = idade >= 0 ? idade : 0;
    }
}