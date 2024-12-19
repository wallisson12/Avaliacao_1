const checkBoxTodosFiliados = document.getElementById('todosFiliados');
const checkBoxArrayFiliados = document.querySelectorAll('.checkboxFiliado');

/**
 * Responsável por adcionar um evento para marcar todas as checkBoxs
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
if(checkBoxTodosFiliados){
    checkBoxTodosFiliados.addEventListener('change',()=>{
        marcarCheckBoxFiliados(checkBoxTodosFiliados.checked);
    })
}

/**
 * Responsável por marcar como checked os checkBoxs dos filiados
 *
 * @return void
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function marcarCheckBoxFiliados(marca){
   for (let i=0;i<checkBoxArrayFiliados.length;i++){
       checkBoxArrayFiliados[i].checked = marca;
   }
}

