<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- KNOB JS -->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
<!-- Chart JS -->
<script src="assets/libs/chart-js/Chart.bundle.min.js"></script>

<!-- validation toast -->
<script src="assets/toast/toastr.min.js"></script> 


<!-- Datatable js -->
<script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

<!-- Dashboard Init JS -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- Sweetalert Init JS -->
<script src="assets/js/sweetalert2.all.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>
<!-- Input Mask JS
    ============================================ -->
<script src="assets/js/jasny-bootstrap.min.js"></script>

<!-- Validation js (Parsleyjs) -->
<script src="assets/libs/parsleyjs/parsley.min.js"></script>

<!-- Modal-Effect -->
<script src="assets/libs/custombox/custombox.min.js"></script>

<!-- validation init -->
<script src="assets/js/pages/form-validation.init.js"></script>


 <!-- datatable js -->
 <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

<script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/buttons.html5.min.js"></script>
<script src="assets/libs/datatables/buttons.flash.min.js"></script>
<script src="assets/libs/datatables/buttons.print.min.js"></script>

<script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables/dataTables.select.min.js"></script>
<!-- Datatables init -->
<script src="assets/js/pages/datatables.init.js"></script>

<!-- select2 js -->
<script src="assets/libs/select2/select2.min.js"></script>
<script src="assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="assets/libs/switchery/switchery.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<script type="text/javascript">
    Parsley.addMessages('es', {
        defaultMessage: "Este valor parece ser inválido.",
        type: {
            email:        "Este valor debe ser un correo válido.",
            url:          "Este valor debe ser una URL válida.",
            number:       "Este valor debe ser un número válido.",
            integer:      "Este valor debe ser un número válido.",
            digits:       "Este valor debe ser un dígito válido.",
            alphanum:     "Este valor debe ser alfanumérico."
        },
        notblank:       "Este valor no debe estar en blanco.",
        required:       "Este valor es requerido.",
        pattern:        "Este valor es incorrecto.",
        min:            "Este valor no debe ser menor que %s.",
        max:            "Este valor no debe ser mayor que %s.",
        range:          "Este valor debe estar entre %s y %s.",
        minlength:      "Este valor es muy corto. La longitud mínima es de %s caracteres.",
        maxlength:      "Este valor es muy largo. La longitud máxima es de %s caracteres.",
        length:         "La longitud de este valor debe estar entre %s y %s caracteres.",
        mincheck:       "Debe seleccionar al menos %s opciones.",
        maxcheck:       "Debe seleccionar %s opciones o menos.",
        check:          "Debe seleccionar entre %s y %s opciones.",
        equalto:        "Este valor debe ser idéntico."
        /*Ejemplo de uso ---> data-parsley-type="alphanum"*/
        
    });

    Parsley.setLocale('es');

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
        
</script>