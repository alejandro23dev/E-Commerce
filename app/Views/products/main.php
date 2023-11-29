<?php if (empty($products)) { ?>
    <div class="text-center" style="height: 50vh;margin-top: 10vh;">
        <img src="<?php echo base_url('public/assets/noResult.jpg'); ?>" class="w-25 rounded-circle text-center" alt="Imagen">
        <h1 class="mt-5 text-muted">No hay Productos disponibles de esta categoría</h1>
    </div>
<?php } ?>
<div class="row mt-6 ms-lg-12 justify-content-around">
    <?php foreach ($products as $product) : ?>
        <div class="card col-12 col-md-5 col-lg-3 m-2 mb-6 shadow hover-elevate-up cursor-pointer">
            <div class="card-body">
                <img src="https://via.placeholder.com/150" class="w-100 rounded shadow" alt="Producto">
                <h3 class="mt-4"><?php echo $product->name; ?></h3>
                <?php if (empty($product->description)) : ?>
                    <p>Sin descripción</p>
                <?php else : ?>
                    <p><?php echo $product->description; ?></p>
                <?php endif; ?>
                <?php if ($product->status == 'Pronto en Venta') : ?>
                    <p class="fst-italic text-muted">En estos momentos no tenemos este producto en venta.</p>
                    <div class="col-12 mt-6 text-center">
                        <button type="button" class="btn btn-primary btn-sm shadow fw-bold buyID-<?php echo $product->id; ?>" data-product-id="<?php echo $product->id; ?>" data-product-price="<?php echo $product->price; ?>">Añadir a la lista de deseos <i class="bi bi-bag-plus-fill mb-1"></i></button>
                    </div>
                <?php else : ?>
                    <?php if ($product->discountPrice == '') : ?>
                        <h4 class="fw-bold fs-1 text-center">$<?php echo $product->price; ?></h4>
                    <?php else : ?>
                        <h4 class="fw-bold fs-6 text-danger text-decoration-line-through text-center fst-italic"><?php echo $product->price; ?></h4>
                        <h4 class="fw-bold fs-1 text-center">$<?php echo $product->discountPrice; ?></h4>
                    <?php endif; ?>
                    <?php if ($product->status == 'En Venta') : ?>
                        <div class="col-12 mt-6 text-center">
                            <button type="button" class="btn btn-primary btn-sm shadow btn-buy fw-bold buyID-<?php echo $product->id; ?>" data-product-id="<?php echo $product->id; ?>" data-product-price="<?php if ($product->discountPrice != '') echo $product->discountPrice;
                                                                                                                                                                                                            else echo $product->price; ?>">Añadir al carrito <i class="bi bi-cart-plus-fill mb-1"></i></button>
                        </div>
                    <?php endif; ?>
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
            $('.buyID-' + buyProducts).addClass('btn-danger');
            $('.buyID-' + buyProducts).removeClass('btn-primary');
            $('.buyID-' + buyProducts).addClass('btn-removeShop');
            $('.buyID-' + buyProducts).removeClass('btn-buy');
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