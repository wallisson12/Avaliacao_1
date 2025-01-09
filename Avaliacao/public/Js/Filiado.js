$(function (){
	$("#dataNascimento").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		onSelect: ()=>{
			testeAq()
		}
	})
})

const inputIdade = $("#idade");
const inputDate = $("#dataNascimento");
/**
 * Responsável por calcular a idade e exibir no input de idade
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function testeAq(){
	const dataAtual = new Date();
	const dataNascimento = new Date(inputDate.val());
	if (!isNaN(dataNascimento.getTime())) {
		const mesAtual = dataAtual.getMonth();
		const diaAtual = dataAtual.getDate();
		const mesNascimento = dataNascimento.getMonth();
		const diaNascimento = dataNascimento.getDate();

		let idade = dataAtual.getFullYear() - dataNascimento.getFullYear();

		if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
			idade--;
		}

		inputIdade.val(idade >= 0 ? idade : 0);
	}
}
