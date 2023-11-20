<div class="modal fade" id="shopModal" tabindex="-1" aria-labelledby="shopModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shopModalLabel">Carrito de Compras</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="dtShop" class="table no-footer">
                    <thead>
                        <tr class="fs-5 fw-bold text-center">
                            <th class="text-center">Id de su producto</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Descripcion</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buyProducts as $buyProduct) { ?>
                            <tr class="text-center">
                                <td><?php echo $buyProduct->productID; ?></td>
                                <td><?php echo $buyProduct->name; ?></td>
                                <td><?php if(!empty($buyProduct->description)) echo $buyProduct->description;else echo "Sin descripción" ?></td>
                                <td>$<?php echo $buyProduct->price; ?></td>
                                <td><?php echo $buyProduct->quantity; ?></td>
                                <td><button type="button" class="btn btn-sm btn-secondary shadow rounded" data-shop-id="<?php echo $buyProduct->shopID; ?>"><i class="bi bi-trash-fill fs-5 hover-scale text-danger"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    $('#shopModal').modal('show');

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
</script>