<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#">
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Inicia Sesión</h1>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Username" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
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
                        <div class="text-gray-500 text-center fw-semibold fs-6">No tienes cuenta?
                            <a href="<?php echo base_url('Client/showSignUp');?>" class="link-primary">Crear una cuenta</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>