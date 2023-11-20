<?php if (empty($products)) { ?>
    <div class="text-center" style="height: 50vh;margin-top: 10vh;">
        <img src="<?php echo base_url('public/assets/noResult.jpg'); ?>" class="w-25 rounded-circle text-center" alt="Imagen">
        <h1 class="mt-5 text-muted">No hay Productos disponibles de esta categoría</h1>
    </div>
<?php } ?>
<div class="row mt-6">
    <?php foreach ($products as $product) : ?>
        <div class="overlay overflow-hidden rounded col-12 col-lg-3 m-3 hover-elevate-up ">
            <img src="<?php echo base_url('public/assets/media/avatars/300-1.jpg'); ?>" class="rounded w-100" alt="Imagen">
            <div class="overlay-layer bg-dark bg-opacity-50 align-items-end justify-content-center">
                <?php if ($product->status == 'En Venta') : ?>
                    <div class="row">
                        <div class="text-center" style="margin-bottom: 20%">
                            <h1 class="text-white"><?php echo $product->name; ?></h1>
                            <?php if (empty($product->description)) : ?>
                                <h6 class="text-white">Sin descripción</h6>
                            <?php else : ?>
                                <h6 class="text-white"><?php echo $product->description; ?></h6>
                            <?php endif; ?>
                            <p class="text-white fw-bold fs-1">$<?php echo $product->price; ?></p>
                        </div>
                        <div class="d-flex flex-grow-1 flex-center mb-2">
                            <button type="button" class="btn btn-primary btn-showMore btn-shadow m-2 fw-bold">Ver más</button>
                            <button type="button" class="btn btn-primary shadow btn-buy fw-bold buyID-<?php echo $product->id; ?>" data-product-id="<?php echo $product->id; ?>" data-product-price="<?php echo $product->price; ?>">Añadir al carrito <i class="fa fa-shopping-basket"></i></button>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="text-center" style="margin-bottom:20%">
                            <h1 class="text-white"><?php echo $product->name; ?></h1>
                            <?php if (empty($product->description)) : ?>
                                <h6 class="text-white">Sin descripción</h6>
                            <?php else : ?>
                                <h6 class="text-white"><?php echo $product->description; ?></h6>
                            <?php endif; ?>
                            <p class="text-white fw-bold fs-1">$<?php echo $product->price; ?></p>
                        </div>
                        <div class="d-flex flex-grow-1 flex-center mb-2">
                          <p class="p-2 bg-warning fst-italic fs-2 text-white fw-bold rounded shadow">Pronto A la Venta</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<script>
    var user = '<?php echo @$user[0]->role; ?>';
    //NOT LOGIN
    if (user == '') {
        $('.btn-buy').html('Inicia Sesion');
        $('.btn-buy').removeAttr('data-product-id');
        $('.btn-buy').addClass('btn-login');
        $('.btn-buy').removeClass('btn-primary');
        $('.btn-buy').addClass('btn-secondary');
        $('.btn-buy').removeClass('btn-buy');
        $('.btn-showMore').attr('hidden', true);
        $('.btn-showMore').removeClass('btn-showMore');
    }

    <?php if (@$buyProducts) foreach ($buyProducts as $buyProduct) : ?>

        var buyProducts = <?php echo $buyProduct->productId; ?>;

        if ($('.btn-buy').hasClass('buyID-' + buyProducts)) {
            $('.buyID-' + buyProducts).html('Descartar Producto');
            $('.buyID-' + buyProducts).addClass('btn-removeShop');
            $('.buyID-' + buyProducts).removeClass('btn-buy');
            console.log(buyProducts);
        }
    <?php endforeach; ?>

    $('.btn-login').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/showModalSignIn'); ?>",
            dataType: "html",
            success: function(response) {
                $('#modal').html(response);
            }
        });
    });

    var action = 'shop';

    $('.btn-buy').on('click', function() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/addProductToShop'); ?>",
            data: {
                'productID': $(this).attr('data-product-id'),
                'productPrice': $(this).attr('data-product-price'),
            },
            dataType: "json",
            success: function(response) {
                switch (response.error) {
                    case 0:
                        getProducts('', $(this).attr('data-product-id'));
                        break;
                    case 1:

                        break;
                    case 3:
                        break;
                }
            }
        });
    });

    $('.btn-removeShop').on('click', function() {
        var productRemoveID = $(this).attr('data-product-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/removeProductToShop'); ?>",
            data: {
                'productID': productRemoveID
            },
            dataType: "json",
            success: function(response) {
                switch (response) {
                    case true:
                        getProducts();
                        break;
                    case false:

                        break;
                    case 3:
                        break;
                }
            }
        });
    });
</script>