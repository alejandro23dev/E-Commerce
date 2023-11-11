<?php echo view('admin/nav/navbar'); ?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card mb-5 mb-xl-10 shadow">
            <div class=" col-2">
                <a href="<?php echo base_url('Admin/showViewCreateProduct'); ?>" class="btn btn-primary">Añadir Producto</a>
            </div>
            <div class="card-body border-top p-9">
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="table-responsive">
                        <table id="dtProducts" class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">ID del Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Rating</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <p id="productName" class="text-gray-800 text-hover-primary fs-5 fw-bold" style="cursor: pointer;"><?php echo $product->name; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo $product->productID; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo $product->quantity; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo $product->price; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p></p>
                                        </td>
                                        <td class="text-center">
                                            <p><?php echo $product->status; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn bg-transparent btn-edit action" data-id="<?php echo $product->id; ?>"><i class="fa fa-edit text-warning" title="Editar Producto"></i></button> <button type="button" class="btn bg-transparent btn-delete action" data-id="<?php echo $product->id; ?>"><i class="fa fa-trash text-danger" title="Eliminar Producto"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var dtProducts = $('#dtProducts').DataTable({ // DATA TABLE
        dom: 'RfrtlpiB',
        processing: true,
        language: {
            search: "",
            searchPlaceholder: 'Search'
        },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
    });

    $('#productName').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/showViewEditProduct'); ?>",
            data: {
                'id': ''
            },
            dataType: "html",
            success: function(response) {

            }
        });
    });

    dtProducts.on('click', '.action', function() {
        if ($(this).hasClass('btn-edit')) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/productActions'); ?>",
                data: {
                    'id': $(this).attr("data-id"),
                    'action': 'edit'
                },
                dataType: "html",
                success: function(response) {
                    $('#view').html(response);
                }
            });
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove!',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Admin/productActions'); ?>",
                        data: {
                            'id': $(this).attr("data-id"),
                            'action': 'delete'
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
                                        window.location.reload();
                                    }, 2000);

                                    break;
                            }
                        }
                    });
                } else if (!result.isConfirmed) {

                }
            });

        }

    });
</script>