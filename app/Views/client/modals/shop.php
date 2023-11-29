<div class="modal fade" id="shopModal" tabindex="-1" aria-labelledby="shopModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shopModalLabel">Carrito de Compras</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="main-shops"></div>
        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    $('#shopModal').modal('show');
    getDtShop();

    function getDtShop() {
        $.ajax({
            type: "get",
            url: "<?php echo base_url('Client/getDtShop'); ?>",
            dataType: "html",
            success: function(response) {
                $('#main-shops').html(response);
            }
        });
    }
</script>