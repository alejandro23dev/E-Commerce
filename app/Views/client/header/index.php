<html>

<head>
    <title><?php echo COMPANY_NAME; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/media/logos/favicon.ico'); ?>" />
    <!-- css --->
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/plugins/custom/datatables/datatables.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- js --->
    <script>
        var hostUrl = "<?php echo base_url('public/assets/'); ?>";
    </script>
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/scripts.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/fslightbox/fslightbox.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/typedjs/typedjs.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/custom/datatables/datatables.bundle.js'); ?>"></script>

    <script>
        function simpleAlert(icon, title) {
            Swal.fire({
                position: "top-end",
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 2500
            });
        }

        function globalError() {
            Swal.fire({
                title: 'Error',
                text: 'An error has ocurred',
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    </script>

</head>
<style>
    .active {
        border-bottom: 2px solid #3e97ff;
    }
</style>

<body>
    <div id="page" class="container">
        <?php echo view($page); ?>
    </div>
</body>