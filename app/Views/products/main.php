<?php if (empty($products)) { ?>
    <div class="text-center" style="height: 50vh;margin-top: 10vh;">
        <img src="<?php echo base_url('public/assets/noResult.jpg'); ?>" class="w-25 rounded-circle text-center" alt="Imagen">
        <h1 class="mt-5 text-muted">No hay Productos disponibles de esta categoría</h1>
    </div>
<?php } ?>
<div class="row mt-6 align-items-center">
    <?php foreach ($products as $product) : ?>
        <div class="card shadow rounded p-6 col-12 col-lg-3 m-6 hover-elevate-up " style="cursor: pointer;">
            <img src="<?php echo base_url('public/assets/media/avatars/300-1.jpg'); ?>" class="shadow rounded text-start" title="Ver Más Información" alt="Imagen">
            <div class="mt-5">
                <h3 class="text-uppercase"><?php echo $product->name; ?></h3>
                <h6 class="text-muted"><?php if (empty($product->description)) echo "<span class='fst-italic'><i class='fa fa-info-circle text-warning'></i> No se ha proporcionado una descripción de este producto</span>";
                                        else echo $product->description; ?></h6>
                <?php if (empty($product->discountPrice)) : ?>
                    <div>
                        <h2 class="text-center mt-6">$<?php echo $product->price; ?></h2>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <h6 class="text-center text-danger mt-6 text-decoration-line-through">$<?php echo $product->price; ?></h6>
                        </div>
                        <div class="col-12 col-lg-6">
                            <h2 class="text-start mt-6">$<?php echo $product->discountPrice; ?></h2>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <?php if ($product->status == 'En Venta') : ?>
                <div class="mt-5 text-center">
                    <button type="button" class="btn btn-primary shadow btn-buy" data-id="<?php echo $product->id; ?>">Añadir al carrito <i class="fa fa-shopping-basket"></i></button>
                </div>
                <p class="text-center mt-5 text-muted"><?php if ($product->quantity < 25) echo "Quedan menos de 25 unidades"; ?></p>
            <?php else : ?>
                <h3 class="fst-italic text-muted text-center mt-6"><i class="fa fa-info-circle fs-2 text-warning"></i> Pronto en Venta</h3>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>