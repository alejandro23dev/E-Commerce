<?php echo view('admin/nav/navbar'); ?>
<!-- CARDS SECTION -->
<div class="row mt-6">
    <a href="<?php echo base_url('Admin/showViewProducts'); ?>" class="col-4 btn bg-transparent">
        <div class="card-body border rounded p-20 shadow text-center hover-scale">
            <h4 class="text-black-50">Mis Productos <i class="fa fa-shopping-basket fs-1 text-primary"></i></h4>
        </div>
    </a>
    <a href="<?php echo base_url('Admin/showViewEmployees'); ?>" class="col-4 btn bg-transparent">
        <div class="card-body border rounded p-20 shadow text-center hover-scale">
            <h4 class="text-muted">Mis Empleados <i class="fa fa-user fs-1 text-primary"></i></h4>
        </div>
    </a>
    <a href="<?php echo base_url('Admin/showViewSales'); ?>" class="col-4 btn bg-transparent">
        <div class="card-body border rounded p-20 shadow text-center hover-scale">
            <h4 class="text-muted">Mis Ventas <i class="fa fa-money-bills fs-1 text-primary"></i></h4>
        </div>
    </a>
</div>