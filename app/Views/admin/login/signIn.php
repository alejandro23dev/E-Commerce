<div class="d-flex flex-column flex-root" style="margin-top: 20%;">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#">
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Inicia Sesión</h1>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" id="user" placeholder="Username" class="form-control bg-transparent required focus" />
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" id="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent required focus" />
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="" class="link-primary">Olvidé mi contraseña?</a>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="button" id="btn-login" class="btn btn-primary">
                                <span class="indicator-label">Unirme</span>
                                <span class="indicator-progress">Espere...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    $('#btn-login').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        $(this).attr('disabled', true);
        if (resultCheckRequiredValues == 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Authentication/signInProcess'); ?>",
                data: {
                    'user': $('#user').val(),
                    'password': $('#password').val(),
                },
                dataType: "json",
                success: function(response) {
                    switch (response.error) {
                        case 0:
                            window.location.href = "<?php echo base_url('Admin/main'); ?>"
                            break;
                        case 1:
                            if (response.msg == 'USER_NOT_FOUND') {
                                $('#btn-login').removeAttr('disabled');
                                $('#user').addClass('is-invalid');
                                Swal.fire({
                                    title: 'Usuario no encontrado',
                                    icon: 'error',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            if (response.msg == 'STATUS') {
                                $('#btn-login').removeAttr('disabled');
                                Swal.fire({
                                    title: 'Primero debe de activar su cuenta',
                                    icon: 'warning',
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                            if (response.msg == 'INVALID_PASSWORD') {
                                $('#btn-login').removeAttr('disabled');
                                $('#password').addClass('is-invalid');
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
                    $('#btn-login').removeAttr('disabled');
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
            $('#btn-login').removeAttr('disabled');
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