<?php echo view('client/nav/navbar'); ?>
<!-- SECTION CATEGORIES -->
<div class="row mt-6 p-0 text-center">
    <?php foreach ($categories as $category) : ?>
        <div class="col-1 hover-scale m-1 categoryNav categoryID-<?php echo $category->id; ?>" data-id="<?php echo $category->id; ?>" style="cursor: pointer;">
            <p><?php echo $category->name; ?></p>
        </div>
    <?php endforeach; ?>
</div>
<!-- SECTION PRODUCTS CARDS -->
<?php if (empty($products)) : ?>
    <div class="text-center" style="height: 50vh;margin-top: 10vh;">
        <img src="<?php echo base_url('public/assets/noResult.jpg'); ?>" class="w-25 rounded-circle text-center" alt="Imagen">
        <h1 class="mt-5 text-muted">No hay Productos disponibles de esta categoría</h1>
    </div>
<?php endif; ?>
<div class="row mt-6 align-items-center">
    <?php foreach ($products as $product) : ?>
        <div class="card shadow rounded col-3 m-6 hover-elevate-up">
            <div class="card-body">
                <div class="text-center">
                    <img src="<?php echo base_url('public/assets/media/avatars/300-1.jpg'); ?>" class="shadow rounded-circle w-250px hover-scale" title="Ver Más Información" style="cursor: pointer;" alt="Imagen">
                </div>
                <div class="mt-5">
                    <h2 class="text-uppercase"><?php echo $product->name; ?></h2>
                    <h6 class="text-muted"><?php if (empty($product->description)) echo "<span class='fst-italic'><i class='fa fa-info-circle text-warning'></i> No se ha proporcionado una descripción de este producto</span>";
                                                            else echo $product->description; ?></h6>
                    <h1 class="text-center mt-6">$<?php echo $product->price; ?></h1>
                </div>
                <?php if ($product->status == 'active') : ?>
                    <div class="mt-5 text-center">
                        <button type="button" class="btn btn-primary shadow btn-buy" data-id="<?php echo $product->id; ?>">Comprar <i class="fa fa-shopping-basket"></i></button>
                    </div>
                    <p class="text-center mt-5 text-muted"><?php if ($product->quantity < 25) echo "Quedan menos de 25 unidades"; ?></p>
                <?php else : ?>
                    <h3 class="fst-italic text-muted text-center mt-6"><i class="fa fa-info-circle fs-2 text-warning"></i> Pronto en Venta</h3>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- SECTION FOOTER -->
<?php echo view('footer/footer'); ?>

<script>
    var categorySelected = "<?php echo @$categorySelected; ?>";

    if (categorySelected == '') {
        $('.categoryID-1').addClass('active');
    }

    if ($('.categoryNav').hasClass('categoryID-' + categorySelected)) {
        $('.categoryID-' + categorySelected).addClass('active');
    }

    $('.categoryNav').on('click', function() {
        $(this).addClass('active');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/showProductsByCategory'); ?>",
            data: {
                'id': $(this).attr('data-id')
            },
            dataType: "html",
            success: function(response) {
                $('#page').html(response);
            }
        });
    });

    $('.btn-buy').on('click', function() {
        id = $(this).attr('data-id');
        console.log('comprar producto ' + id);
    });
</script>