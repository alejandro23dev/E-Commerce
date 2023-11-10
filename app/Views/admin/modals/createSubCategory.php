<div class="modal fade" id="createSubCategoryModal" tabindex="-1" aria-labelledby="createSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSubCategoryModalLabel">Crear SubCategoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                    <label class="form-label">Sub Categoría</label>
                        <input type="text" id="subCategoryName" class="form-control requiredModal focus" placeholder="Nombre de la Sub Categoría">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Categoría</label>
                        <select id="sel-category" class="form-select mb-2" data-control="select2" data-placeholder="Seleccione una opción">
                            <option value="" hidden></option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Descartar</button>
                <button type="button" id="btn-saveModal" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    $('#createSubCategoryModal').modal('show');

    $('#btn-saveModal').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('requiredModal');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/createSubCategory'); ?>",
                data: {
                    'name': $('#subCategoryName').val(),
                    'categoryID': $('#sel-category').val(),
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
                                window.location.reload();
                            }, 2000);

                            break;
                        case 1:
                            if (response.msg == 'DUPLICATE_USER_NAME') {
                                $('#btn-saveModal').removeAttr('disabled');
                                $('#subCategoryName').addClass('is-invalid');
                                Swal.fire({
                                    title: 'Ya existe esa categoría',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                $('#btn-saveModal').removeAttr('disabled');
                                Swal.fire({
                                    title: 'Ha ocurrido un error',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            break;
                    }
                },
                error: function(error) {
                    $('#btn-saveModal').removeAttr('disabled');
                    Swal.fire({
                        title: 'Ha ocurrido un error',
                        icon: 'error',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        } else {
            $('#btn-saveModal').removeAttr('disabled');
            Swal.fire({
                title: 'Complete la Información',
                icon: 'warning',
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });
</script>