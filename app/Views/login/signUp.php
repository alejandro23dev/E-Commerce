<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#">
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Registar una cuenta</h1>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" id="userName" placeholder="Username" class="form-control bg-transparent required focus" />
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" id="email" placeholder="Email" class="form-control bg-transparent required focus email" />
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" id="password" placeholder="Password" class="form-control bg-transparent required focus" />
                        </div>
                        <div class="d-grid mb-10">
                            <button type="button" id="btn-register" class="btn btn-primary">
                                <span class="indicator-label">Registrarme</span>
                                <span class="indicator-progress">Espere...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">Tienes una cuenta?
                            <a href="<?php echo base_url('Client/showSignIn'); ?>" class="link-primary">Inicia Sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>

<script>
    $('#btn-register').on('click', function() {
        let resultCheckRequiredValues = checkRequiredValues('required');
        if (resultCheckRequiredValues == 0) {
            resultEmail = checkEmailFormat();
            if (resultEmail == 0) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Client/registerUser'); ?>",
                    data: {
                        'userName': $('#userName').val(),
                        'email': $('#email').val(),
                        'password': $('#password').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.error) {
                            case 0:
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Le hemos enviado un correo de verificción a su dirección de correo, por favor verifique su cuenta para poder iniciar sesión',
                                    icon: 'success',
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                setTimeout(() => {
                                    window.location.href = "<?php echo base_url('Client/showSignIn'); ?>"
                                }, "3000");
                                break;
                            case 1:
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Ha ocurrido un error al enviarle un correo de verificación por favor presione en REENVIAR CORREO.',
                                    icon: 'error',
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                break;
                        }
                    },
                    error: function(error) {
                        globalError();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Atención',
                    text: 'Rectifique su email',
                    icon: 'warning',
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                $('#email').addClass('is-invalid');
            }
        } else {
            Swal.fire({
                title: 'Atención',
                text: 'Rellene los campos requeridos',
                icon: 'warning',
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    });
</script>