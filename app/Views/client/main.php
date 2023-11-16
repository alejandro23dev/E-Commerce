<?php echo view('client/nav/navbar'); ?>

<div id="modal"></div>
<!-- SECTION CATEGORIES -->
<div class="row mt-6 p-0  text-center">
    <?php foreach ($categories as $category) : ?>
        <div class="col-12 col-lg-1 hover-scale m-1 categoryNav categoryID-<?php echo $category->id; ?>" data-id="<?php echo $category->id; ?>" style="cursor: pointer;">
            <p><?php echo $category->name; ?></p>
        </div>
    <?php endforeach; ?>
</div>
<!-- SECTION PRODUCTS CARDS -->
<div id="main-products"></div>
<!-- SECTION FOOTER -->
<?php echo view('footer/footer'); ?>

<script>
    $('.categoryID-1').addClass('active');

    getProductsByCategory('');

    var notLogin = "<?php echo @$notLogin; ?>";

    if (notLogin == 'yes') {
        $('.loginRequired').attr('hidden', true);
        $('.btn-buy').removeAttr('data-id');
        $('.btn-buy').html('Iniciar Sesion');
        $('.btn-buy').addClass('btn-login');
        $('.btn-buy').removeClass('btn-buy');
    }

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


    function getProductsByCategory(id = '') {
        var id = id;
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/showProductsByCategory'); ?>",
            data: {
                'id': id
            },
            dataType: "html",
            success: function(response) {
                $('#main-products').html(response);
            }
        });
    }

    $('.categoryNav').on('click', function() {
        $('.categoryNav').removeClass('active');
        $(this).addClass('active');

        var id = $(this).attr('data-id');
        getProductsByCategory(id);
    });

    $('.btn-buy').on('click', function() {
        id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "<? ?>",
            data: "data",
            dataType: "dataType",
            success: function(response) {

            }
        });
        console.log('añadir producto ' + id);
    });
</script>