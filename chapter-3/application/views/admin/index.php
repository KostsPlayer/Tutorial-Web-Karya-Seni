<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="flash-data-login" data-flashdata="<?= $this->session->flashdata('login'); ?>"></div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<script>
    $(document).ready(function() {
        const flashWelcome = $('.flash-data-login').data('flashdata');

        if (flashWelcome) {
            Swal.fire({
                title: flashWelcome,
                text: "We hope you enjoy our services.",
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
</script>