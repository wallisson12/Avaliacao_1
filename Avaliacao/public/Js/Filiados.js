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
function calcularIdade(){
    let dataAtual = new Date();
    let mesAtual = dataAtual.getMonth();
    let diaAtual = dataAtual.getDay();
    let dataNascimento = new Date(inputDate.value)
    let mesNascimento = dataNascimento.getMonth();
    let diaNascimento = dataNascimento.getDay();

    if(!isNaN(dataNascimento.getDate())){
        let idade = (dataAtual.getFullYear() - dataNascimento.getFullYear());

        if(mesAtual<mesNascimento || (mesAtual === mesNascimento && diaAtual<diaNascimento)){
            idade--;
        }

        inputIdade.value = idade >=0 ? idade : 0;
    }
}

inputDate.addEventListener('change',calcularIdade)
