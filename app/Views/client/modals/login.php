<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-11">
                    <h1 class="text-dark fw-bolder mb-3">Bienvenido</h1>
                </div>
                <div class="fv-row mb-8">
                    <input id="user-login-modal" type="text" placeholder="Usuario" class="form-control bg-transparent required focus" />
                </div>
                <div class="fv-row mb-3">
                    <input id="password-login-modal" type="password" placeholder="Contraseña" name="password" autocomplete="off" class="form-control bg-transparent required focus" />
                </div>
                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                    <div></div> <a href="" class="link-primary">Olvidé mi contraseña?</a>
                </div>
                <div class="d-grid mb-10"> <button type="button" id="btn-login-modal" class="btn btn-primary"> <span class="indicator-label">Unirme</span> <span class="indicator-progress">Espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> </button> </div>
                <div class="text-gray-500 text-center fw-semibold fs-6"> No tienes cuenta? <a href="<?php echo base_url('Client/showSignUp'); ?>" class="link-primary">Crear una cuenta</a> </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    $('#loginModal').modal('show');

    $('#btn-login-modal').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Authentication/signInProcessClient'); ?>",
                data: {
                    'user': $('#user-login-modal').val(),
                    'password': $('#password-login-modal').val(),
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            window.location.reload();
                            break;
                        case 1:
                            if (response.msg == 'USER_NOT_FOUND') {
                                $('#btn-login-modal').removeAttr('disabled');
                                $('#user-login-modal').addClass('is-invalid');
                                Swal.fire({
                                    title: 'Usuario no encontrado',
                                    icon: 'error',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            if (response.msg == 'STATUS') {
                                $('#btn-login-modal').removeAttr('disabled');
                                Swal.fire({
                                    title: 'Primero debe de activar su cuenta',
                                    icon: 'warning',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            if (response.msg == 'INVALID_PASSWORD') {
                                $('#btn-login-modal').removeAttr('disabled');
                                $('#password-login-modal').addClass('is-invalid');
                                Swal.fire({
                                    title: 'Contraseña incorrecta',
                                    icon: 'error',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            break;
                    }
                },
                error: function(error) {
                    $('#btn-login-modal').removeAttr('disabled');
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
            $('#btn-login-modal').removeAttr('disabled');
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