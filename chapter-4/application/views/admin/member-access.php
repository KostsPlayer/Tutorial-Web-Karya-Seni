<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-9">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flasdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <?php foreach ($UserAccess as $gu) : ?>
                <div class="card" style="width: 22rem;">
                    <img src="<?= base_url('assets/img/profile/') . $gu['image']; ?>" class="card-img">
                    <div class="card-body pt-4">
                        <h5 class="card-title mb-3 font-weight-bold"><?= $gu['role'] ?></h5>
                        <p class="card-text mb-0"><?= $gu['name'] ?></p>
                        <p class="card-text mb-3"><?= $gu['email'] ?></p>
                        <a href="" class="btn btn-outline-danger btn-sm mb-5 disable-activated" data-id="<?= $gu['id']; ?>">Disable Activated</a>
                    </div>
                    <div class="card-footer text-muted text-right">
                        <p class="card-text"><?= date('d F Y', $gu['date_create']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>

<script>
    $(document).ready(function() {
        $('.disable-activated').click(function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            var button = $(this); // Simpan referensi tombol di sini

            $.ajax({
                url: '/admin/disableActivated',
                method: 'POST',
                data: {
                    user_id: userId
                },
                success: function(response) {
                    var status = JSON.parse(response).status;
                    if (status === 'success') {
                        // Ubah teks tombol menjadi "Disabled" menggunakan referensi tombol sebelumnya
                        button.text('Disabled');
                        // Nonaktifkan tombol
                        button.addClass('disabled');
                        // Tambahkan kelas CSS untuk menunjukkan status disabled
                        button.removeClass('btn-outline-danger');
                        button.addClass('btn-secondary');
                    } else {
                        console.log('Terjadi kesalahan saat mengubah status');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>