<?php echo view('client/nav/navbar'); ?>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row">
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <label class="form-label fs-2 ">Imagen</label>
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
        </div>
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-body pt-0 row">
                                <div class="col-12 col-md-6 col-lg-6 mb-10">
                                    <label class="form-label fs-2 ">Nombre de Usuario</label>
                                    <input type="text" id="clientName" class="form-control mb-2 required focus" placeholder="Nombre de Usuario" value="<?php echo $user[0]->user; ?>" />
                                    <div class="text-muted fs-7">El nombre de usuario es único.</div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <label class="form-label fs-2 ">Email </label>
                                    <input type="text" id="clientEmail" class="form-control mb-2" value="<?php echo $user[0]->email; ?>">
                                    <div class="text-muted fs-7">El email es único.</div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <label class="form-label fs-2 ">Estado de su Cuenta <i class="<?php if ($user[0]->status == 1) echo "bi bi-check-circle-fill fs-2 text-success";
                                                                                                    elseif ($user[0]->status == 2) echo "bi bi-exclamation-triangle-fill fs-2 text-warning" ?>"></i></label>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <?php if ($user[0]->status == 1) : ?>
                                    <p class="text-muted fs-5">Su cuenta está activa y no tiene problemas</p>
                                <?php elseif ($user[0]->status == 2) : ?>
                                    <p class="text-muted fs-5">Hemos detectado problemas con su cuenta. Puede quejas o explicaciones no dude en contactarnos.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="card card-flush py-4 col-12">
        <div class="text-center">
            <p class="form-label fs-2">Compras Realizadas</p>
        </div>
        <div class="card-body">

        </div>
    </div>
</div>

<?php echo view('functionsJS/formValidation'); ?>
<?php echo view('footer/footer'); ?>