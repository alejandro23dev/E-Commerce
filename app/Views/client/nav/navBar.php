<div class="bg-primary shadow p-8 rounded">
    <div class="navbar align-items-center">
        <h1 class="text-white text-uppercase"><span id="text" class="fs-1 fw-bold fst-italic"></span></h1>
        <div class="app-navbar flex-shrink-0 justify-content-end loginRequired">
            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <img src="<?php echo base_url('public/assets/media/avatars/300-1.jpg'); ?>" class="rounded-3" alt="user" />
                </div>
                <?php if ($user != '') : ?>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="<?php echo base_url('public/assets/media/avatars/300-1.jpg'); ?>" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5"><?php echo @$user[0]->user; ?>
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?php echo @$user[0]->email; ?></a>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <div class="symbol menu-link">
                                <a href="#" id="btn-showModal-shop" class="menu-link symbol fw-semibold">Mis Compras</a>
                                <?php if (count($buyProducts) > 0) { ?>
                                    <span class="symbol-badge badge badge-circle bg-danger text-white start-0"><?php echo count($buyProducts); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">Modo
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                        <i class="ki-duotone ki-night-day theme-light-show fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                            <span class="path8"></span>
                                            <span class="path9"></span>
                                            <span class="path10"></span>
                                        </i>
                                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span></span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-night-day fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                                <span class="path8"></span>
                                                <span class="path9"></span>
                                                <span class="path10"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Claro</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-moon fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Oscuro</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-screen fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Sistema</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <div class="menu-item px-5 my-1">
                            <a href="<?php echo base_url('Client/account'); ?>" class="menu-link px-5">Mi cuenta</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="#" id="btn-logout" class="menu-link px-5">Cerrar Sesion</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<script>
    var companyName = "<?php echo COMPANY_NAME; ?>";
    var typed = new Typed("#text", {
        strings: [companyName],
        typeSpeed: 200
    });

    $('#btn-logout').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/logout'); ?>",
            dataType: "html",
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $('#btn-showModal-shop').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/basket'); ?>",
            dataType: "html",
            success: function(response) {
                $('#modal').html(response);
            }
        });
    });
</script>