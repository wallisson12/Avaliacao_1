$( function() {
    $( "#dataNascimento" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        onSelect: function(){
            calcularIdade();
        }
    })
} );
