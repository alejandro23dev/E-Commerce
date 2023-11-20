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
    var companyName = "<?php echo COMPANY_NAME; ?>";
    var typed = new Typed("#text", {
        strings: ["Mejores Precios", "Mejores Descuentos", "Mejores Productos", "Y la Mejor Calidad solo con " + companyName],
        typeSpeed: 200
    });

    $('.categoryID-1').addClass('active');

    getProducts();

    $('.categoryNav').on('click', function() {
        $('.categoryNav').removeClass('active');
        $(this).addClass('active');
        var categoryID = $(this).attr('data-id');
        getProducts(categoryID);
    });

    function getProducts(categoryID = null, id = null) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Client/getProducts'); ?>",
            data: {
                'id': id,
                'categoryID': categoryID,
            },
            dataType: "html",
            success: function(response) {
                $('#main-products').html(response);
            }
        });
    }
</script>