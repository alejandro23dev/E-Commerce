<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Crear Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="categoryName" class="form-control requiredModal focus" placeholder="Nombre de la categoría">
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
    $('#createCategoryModal').modal('show');

    $('#btn-saveModal').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('requiredModal');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/createCategory'); ?>",
                data: {
                    'name': $('#categoryName').val(),
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
                                $('#categoryName').addClass('is-invalid');
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