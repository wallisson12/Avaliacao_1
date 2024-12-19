const btn_add_Dependente = document.getElementById('add');
const dependente_container = document.getElementById('dependente');

var contador = 0;

/**
 * Responsável por criar os inputs necessarios para o cadastro de um dependente
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
btn_add_Dependente.addEventListener('click',function ()
{
    createInputNome();
    createInputDataNascimento();
    createSelectGrauParentesco();
    contador++;
});

/**
 * Responsável por criar o input lable e adcionar na div
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function createLable(nome)
{
    var elemeto = document.createElement('label');
    elemeto.textContent = nome;

    dependente_container.appendChild(elemeto);
}

/**
 * Responsável por criar o input nome e adcionar na div
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function createInputNome()
{
    createLable("Nome: ");

    var elemento = document.createElement('input');
    elemento.setAttribute('type','text');
    elemento.setAttribute('name', `dependentes[${contador}][nome]`);
    elemento.setAttribute('required', 'true');

    var elemento2 =document.createElement('br');

    dependente_container.appendChild(elemento);
    dependente_container.appendChild(elemento2);
}

/**
 * Responsável por criar o input date e adcionar na div
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function createInputDataNascimento()
{
    createLable("Data De Nascimento: ");

    var elemento = document.createElement('input');
    elemento.setAttribute('type','date');
    elemento.setAttribute('name',`dependentes[${contador}][data_nascimento]`);
    elemento.setAttribute('required','true');


    var elemento2 =document.createElement('br');

    dependente_container.appendChild(elemento);
    dependente_container.appendChild(elemento2);
}

/**
 * Responsável por criar o input select e adcionar na div
 *
 * @author Wallisson De Jesus Campos wallissondejesus@moobi.com.br
 *
 * @since 1.0.0 - Definição do versionamento da função
 */
function createSelectGrauParentesco()
{
    createLable("Grau De Parentesco");

    var elemento = document.createElement('select');
    elemento.setAttribute('name',`dependentes[${contador}][grau_parentesco]`);

    const opcoes = ['Conjuge','Filho','Pai','Mae'];

    opcoes.forEach(opcao=>
    {
        const option = document.createElement('option');
        option.value = opcao;
        option.textContent = opcao;
        elemento.appendChild(option);
    })

    var elemento2 =document.createElement('br');

    dependente_container.appendChild(elemento);
    dependente_container.appendChild(elemento2);

}