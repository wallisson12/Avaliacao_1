const btn_add_Dependente = document.getElementById('add');
const dependente_container = document.getElementById('dependente');

var contador = 0;

btn_add_Dependente.addEventListener('click',function ()
{
    createInputNome();
    createInputDataNascimento();
    createSelectGrauParentesco();
    contador++;
});

function createLable(nome)
{
    var elemeto = document.createElement('label');
    elemeto.textContent = nome;

    dependente_container.appendChild(elemeto);
}

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