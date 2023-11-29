<div class="modal-body">
    <table id="dtShop" class="table no-footer">
        <thead>
            <tr class="fs-5 fw-bold text-center">
                <th class="text-center">Id de su producto</th>
                <th class="text-center">Producto</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($buyProducts as $buyProduct) {
            ?>
                <tr class="text-center text-black-50">
                    <td><?php echo $buyProduct->productID; ?></td>
                    <td><?php echo $buyProduct->name; ?></td>
                    <td><?php if (!empty($buyProduct->description)) echo $buyProduct->description;
                        else echo "Sin descripción" ?></td>
                    <td>$<?php echo $buyProduct->shopPrice; ?></td>
                    <td><?php echo $buyProduct->quantity; ?></td>
                    <td><button type="button" class="btn btn-sm btn-secondary btn-shopModal-deleteProduct rounded" data-product-id="<?php echo $buyProduct->productId; ?>" title="Retirar Producto de la Compra"><i class="bi bi-trash-fill fs-5 hover-scale text-danger"></i></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p class="text-end">Total a pagar : $<? //php echo $totalPrice 
                                            ?></p>
</div>

<script>
    var dtShop = $('#dtShop').DataTable({ // DATA TABLE
        dom: 'RfrtlpiB',
        destroy: true,
        processing: true,
        language: {
            search: "",
            searchPlaceholder: 'Search'
        },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        buttons: []
    });

    $('.btn-shopModal-deleteProduct').on('click', function() {
        Swal.fire({
            title: 'Está seguro?',
            text: "Esta acción no se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro!',
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Client/removeProductToShop'); ?>",
                    data: {
                        'productID': $(this).attr("data-product-id"),
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response) {
                            case true:
                                Swal.fire({
                                    title: 'Exito',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    getDtShop()
                                }, 2000);

                                break;
                        }
                    }
                });
            }
        });
    });
</script>