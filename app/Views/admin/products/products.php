<?php echo view('admin/nav/navbar'); ?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar Producto" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <div class="w-100 mw-150px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Estado">
                            <option></option>
                            <option value="all">Todos</option>
                            <option value="active">En venta</option>
                            <option value="comingSoon">Pronto en Venta</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <!--begin::Add product-->
                    <a href="<?php echo base_url('Admin/showViewCreateProduct'); ?>" class="btn btn-primary">Añadir Producto</a>
                    <!--end::Add product-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="dtProducts">
                    <thead>
                        <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center">Producto</th>
                            <th class="text-center">ID del Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
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
                                    <p><?php if ($product->status == 'active') echo "En Venta";
                                        elseif ($product->status == 'comingSoon') echo "Pronto a la Venta";
                                        else echo "No seleccionado" ?></p>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn bg-transparent btn-edit" data-id="<?php echo $product->id; ?>"><i class="fa fa-edit text-warning" title="Editar Producto"></i></button> <button type="button" class="btn bg-transparent btn-delete" data-id="<?php echo $product->id; ?>"><i class="fa fa-trash text-danger" title="Eliminar Producto"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-center">Mostrando <?php echo count($products); ?> productos</p>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>