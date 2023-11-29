<?php echo view('admin/nav/navbar'); ?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/products.html">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Imagen</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <style>
                            .image-input-placeholder {
                                background-image: url('');
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url('');
                            }
                        </style>
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                            <div id="file" class="image-input-wrapper w-150px h-150px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="ki-duotone ki-pencil fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <div class="text-muted fs-7">Seleccione la imagen de su producto. Solo *.png, *.jpg and *.jpeg image files are accepted</div>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Estado</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <select id="sel-status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Seleccione una opción">
                            <option value="<?php echo @$product['status']; ?>" hidden><?php echo @$product['status']; ?></option>
                            <option value="En Venta">En Venta</option>
                            <option value="Pronto en Venta">Pronto en Venta</option>
                        </select>
                        <div class="text-muted fs-7">Seleccione un estado para el producto.</div>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Detalles del Producto</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <label class="form-label">Categoría</label>
                        <select id="sel-category" class="form-select mb-2" data-control="select2" data-placeholder="Seleccione una opción">
                            <option value="<?php echo @$product['categoryID']; ?>" hidden><?php echo @$product['categoryName']; ?></option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="text-muted fs-7 mb-7">Añada su producto a una categoría.</div>
                        <a href="#" id="btn-createCategory" class="btn btn-light-primary btn-sm mb-10">
                            <i class="ki-duotone ki-plus fs-2"></i>Crear nueva categoría</a>
                        <label class="form-label">SubCategoría</label>
                        <select id="sel-subCategory" class="form-select mb-2" data-control="select2" data-placeholder="Seleccione una opción">
                            <option value="<?php echo @$product['subCategoryID']; ?>" hidden><?php echo @$product['subCategoryName']; ?></option>
                            <?php foreach ($subCategories as $subCategory) : ?>
                                <option value="<?php echo $subCategory->id ?>"><?php echo $subCategory->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="text-muted fs-7 mb-7">Añada su producto a una subCategoría.</div>
                        <a href="#" id="btn-createSubCategory" class="btn btn-light-primary btn-sm mb-10">
                            <i class="ki-duotone ki-plus fs-2"></i>Crear nueva subCategoría</a>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="form-label">Nombre del Producto</label>
                                        <input type="text" id="productName" class="form-control mb-2 required focus" placeholder="Nombre del Producto" value="<?php echo @$product['name']; ?>" />
                                        <div class="text-muted fs-7">Se recomienda de que el nombre del producto sea único.</div>
                                    </div>
                                    <div>
                                        <label class="form-label">Descripción <span class="text-muted fst-italic">(Opcional)</span></label>
                                        <textarea id="productDescription" class="form-control mb-2"><?php echo @$product['description']; ?></textarea>
                                        <div class="text-muted fs-7">Realice una descripción de su producto para mejor visibilidad.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Cantidad</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="form-label">Cantidad del Producto</label>
                                        <input type="text" id="productQuantity" class="form-control mb-2 required focus number" placeholder="Cantidad del Producto" value="<?php echo @$product['quantity']; ?>" />
                                        <div class="text-muted fs-7">Escriba la cantidad de su producto.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Precio</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 row">
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Precio del Producto</label>
                                            <input type="text" id="productPrice" class="form-control mb-2 required focus number" placeholder="Precio del Producto" value="<?php echo @$product['price']; ?>" />
                                            <div class="text-muted fs-7">Escriba el precio de su producto.</div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Precio De Descuento del Producto</label>
                                            <input type="text" id="productDiscountPrice" class="form-control mb-2 focus number" placeholder="Nuevo Precio" value="<?php echo @$product['discountPrice']; ?>" />
                                            <div class="text-muted fs-7">Escriba el nuevo precio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center justify-content-around row">
                                <?php if (@$edit) : ?>
                                    <a href="<?php echo base_url('Admin/showViewProducts'); ?>" class="btn btn-dark-50  shadow rounded col-12 col-lg-3 m-3">Descartar</a>
                                    <button type="button" id="btn-update" data-id="<?php echo @$product['id']; ?>" class="btn btn-primary shadow rounded col-12 col-lg-3 m-3">Actualizar Cambios</button>
                                <?php else : ?>
                                    <a href="<?php echo base_url('Admin/showViewProducts'); ?>" class="btn btn-dark-50 shadow rounded col-12 col-lg-3 m-3">Descartar</a>
                                    <button type="button" id="btn-save" class="btn btn-primary shadow rounded col-12 col-lg-3 m-3">Guardar</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    Inputmask("999.99", {
        "numericInput": true
    }).mask("#productPrice");

    Inputmask("999.99", {
        "numericInput": true
    }).mask("#productDiscountPrice");

    $('#btn-createCategory').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/showViewModalCreateCategory'); ?>",
            dataType: "html",
            success: function(response) {
                $('#modal').html(response);
            }
        });
    });

    $('#btn-createSubCategory').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/showViewModalCreateSubCategory'); ?>",
            dataType: "html",
            success: function(response) {
                $('#modal').html(response);
            }
        });
    });

    $('#btn-update').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/productActions'); ?>",
                data: {
                    'id': $(this).attr('data-id'),
                    'action': 'update',
                    'name': $('#productName').val(),
                    'description': $('#productDescription').val(),
                    'price': $('#productPrice').val(),
                    'discountPrice': $('#productDiscountPrice').val(),
                    'status': $('#sel-status').val(),
                    'category': $('#sel-category').val(),
                    'subCategory': $('#sel-subCategory').val(),
                    'quantity': $('#productQuantity').val(),
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            Swal.fire({
                                title: 'Exito',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                window.location.href = "<?php echo base_url('Admin/showViewProducts'); ?>";
                            }, 2000);
                            break;
                        case 'INVALID_PRICE':
                            $('#productPrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-update').removeAttr('disabled');
                            break;
                        case 'INVALID_DISCOUNT_PRICE':
                            $('#productDiscountPrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-update').removeAttr('disabled');
                            break;
                    }
                },
                error: function(error) {
                    $('#btn-update').removeAttr('disabled');
                    Swal.fire({
                        title: 'Ha ocurrido un error',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        } else {
            $('#btn-update').removeAttr('disabled');
            Swal.fire({
                title: 'Complete la Información',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });

    $('#btn-save').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/createProduct'); ?>",
                data: {
                    'name': $('#productName').val(),
                    'description': $('#productDescription').val(),
                    'price': $('#productPrice').val(),
                    'discountPrice': $('#productDiscountPrice').val(),
                    'status': $('#sel-status').val(),
                    'category': $('#sel-category').val(),
                    'subCategory': $('#sel-subCategory').val(),
                    'quantity': $('#productQuantity').val(),
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            Swal.fire({
                                title: 'Exito',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('input').val('');
                            $('select').val('');
                            $('textarea').val('');
                            $('.selection').val('');
                            $('#btn-save').removeAttr('disabled');
                            break;
                        case 'INVALID_PRICE':
                            $('#productPrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-save').removeAttr('disabled');
                            break;
                        case 'INVALID_DISCOUNT_PRICE':
                            $('#productDiscountPrice').addClass('required is-invalid');
                            Swal.fire({
                                title: 'Introduzca correctamente el precio',
                                icon: 'warning',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#btn-save').removeAttr('disabled');
                            break;
                    }
                },
                error: function(error) {
                    $('#btn-save').removeAttr('disabled');
                    Swal.fire({
                        title: 'Ha ocurrido un error',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        } else {
            $('#btn-save').removeAttr('disabled');
            Swal.fire({
                title: 'Complete la Información',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });


    $('.number').on('input', function() { // Input Only Number
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
</script>