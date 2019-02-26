<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>
   
    </div>
    <!-- ./container do topbar -->

    <script src="<?php echo base_url('assets/js/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

    <!-- datatable.net -->
    <!-- <script src="<?php echo base_url('assets/datatables/datatables.min.js'); ?>"></script> -->
 
    <!-- datatable.net -->
    <script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
 
    <!-- buttons -->
    <script src="<?php echo base_url('assets/js/datatables/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/datatables/buttons.print.min.js'); ?>"></script>


    <!-- Função que carrega os atributos da Tabela -->
    <script>
        $(document).ready( function() {

            $('#tabela').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                'print'
                ]
            } );

            $('#tabela0').DataTable( {
            } );

        } );
    </script>
    <!-- Função que carrega os atributos da Tabela -->

<!-- Formatar input de numero decimal
<script>
// retira caracteres invalidos da string
// function LimpaValor(valor, validos, tammax) {
// var result = "";
// var aux;
// for (var i=0; i < valor.length; i++) {
// aux = validos.indexOf(valor.substring(i, i+1));
// if (aux>=0) {
// if ( result.length < tammax - 1 ) {
// result += aux;
// }
// }
// }
// return result;
// }
/* chamada :onkeydown="FormataValor(this,28,event,2,'.','.');" */
// function FormataValor(campo,tammax,teclapres,decimal,ptmilhar,ptdecimal) {
// var tecla = teclapres.keyCode;
// vr = LimpaValor(campo.value,"0123456789",tammax);
// tam = vr.length;
// dec = decimal;
// if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; }
// if (tecla == 8 ) { tam = tam - 1 ; }
// if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ) {
// if ( tam <= dec ) { campo.value = vr ; }
// else if ( (tam > dec) && (tam <= dec + 3) ){
// alert(tam);
// campo.value = vr.substr( 0, tam - dec ) + ptdecimal + vr.substr( tam - dec, tam ) ;
// } else if ( (tam >= dec + 4) && (tam <= dec + 6) ){
// campo.value = vr.substr( 0, tam - 3 - dec ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else if ( (tam >= dec + 7) && (tam <= dec + 9) ){
// campo.value = vr.substr( 0, tam - 6 - dec ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else if ( (tam >= dec + 10) && (tam <= dec + 12) ){
// campo.value = vr.substr( 0, tam - 9 - dec ) + ptmilhar + vr.substr( tam - 9 - dec , 3 ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else if ( (tam >= dec + 13) && (tam <= dec + 15) ){
// campo.value = vr.substr( 0, tam - 12 - dec ) + ptmilhar + vr.substr( tam - 12 - dec , 3 ) + ptmilhar + vr.substr( tam - 9 - dec , 3 ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else if ( (tam >= dec + 16) && (tam <= dec + 18) ){
// campo.value = vr.substr( 0, tam - 15 - dec ) + ptmilhar + vr.substr( tam - 15 - dec , 3 ) + ptmilhar + vr.substr( tam - 12 - dec , 3 ) + ptmilhar + vr.substr( tam - 9 - dec , 3 ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else if ( (tam >= dec + 19) && (tam <= dec + 21) ){
// campo.value = vr.substr( 0, tam - 18 - dec ) + ptmilhar + vr.substr( tam - 18 - dec , 3 ) + ptmilhar + vr.substr( tam - 15 - dec , 3 ) + ptmilhar + vr.substr( tam - 12 - dec , 3 ) + ptmilhar + vr.substr( tam - 9 - dec , 3 ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else if ( (tam >= dec + 22) && (tam <= dec + 24) ){
// campo.value = vr.substr( 0, tam - 21 - dec ) + ptmilhar + vr.substr( tam - 21 - dec , 3 ) + ptmilhar + vr.substr( tam - 18 - dec , 3 ) + ptmilhar + vr.substr( tam - 15 - dec , 3 ) + ptmilhar + vr.substr( tam - 12 - dec , 3 ) + ptmilhar + vr.substr( tam - 9 - dec , 3 ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// } else {
// campo.value = vr.substr( 0, tam - 24 - dec ) + ptmilhar + vr.substr( tam - 24 - dec , 3 ) + ptmilhar + vr.substr( tam - 21 - dec , 3 ) + ptmilhar + vr.substr( tam - 18 - dec , 3 ) + ptmilhar + vr.substr( tam - 15 - dec , 3 ) + ptmilhar + vr.substr( tam - 12 - dec , 3 ) + ptmilhar + vr.substr( tam - 9 - dec , 3 ) + ptmilhar + vr.substr( tam - 6 - dec , 3 ) + ptmilhar + vr.substr( tam - 3 - dec , 3 ) + ptdecimal + vr.substr( tam - dec , 12 ) ;
// }
// }
// }
</script>

Formatar input de numero decimal -->


</body>
</html>