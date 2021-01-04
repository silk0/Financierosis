<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- KNOB JS -->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
<!-- Chart JS -->
<script src="assets/libs/chart-js/Chart.bundle.min.js"></script>

<!-- Jvector map -->
<script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/libs/jqvmap/jquery.vmap.usa.js"></script>

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
        
    });

    Parsley.setLocale('es');
    
</script>

<!-- validation init -->
<script src="assets/js/pages/form-validation.init.js"></script> 