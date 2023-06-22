<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <form id="change-pw-form" action="" <?= base_url('user/change_password'); ?> method="post">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <div id="current-pw-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                </div>
                <div class="form-group">
                    <label for="new_password1">New Password</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <div id="pw-1-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                </div>
                <div class="form-group">
                    <label for="new_password2">Repeat Password</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <div id="pw-2-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="change-pw-btn">Change Password</button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        $('#change-pw-btn').click(function() {
            var currentInput = $('#current_password').val().trim();
            var password1Input = $('#new_password1').val().trim();
            var password2Input = $('#new_password2').val().trim();

            if (currentInput === '') {
                // Tampilkan pesan error jika menu kosong
                $('#current_password').addClass('is-invalid');
                $('#current-pw-error').text("Current Password is required!");
                return false; // Mencegah pengiriman form
            }

            if (password1Input === '') {
                // Tampilkan pesan error jika menu kosong
                $('#new_password1').addClass('is-invalid');
                $('#pw-1-error').text("New Password is required!");
                return false; // Mencegah pengiriman form
            } else if (password1Input.length < 8) {
                // Tampilkan pesan error jika new password memiliki kurang dari 8 karakter
                $('#new_password1').addClass('is-invalid');
                $('#pw-1-error').text("New Password should have at least 8 characters!");
                return false; // Mencegah pengiriman form
            }

            if (password2Input === '') {
                // Tampilkan pesan error jika menu kosong
                $('#new_password2').addClass('is-invalid');
                $('#pw-2-error').text("Repeat New Password to Confirm Password!");
                return false; // Mencegah pengiriman form
            } else if (password2Input.length < 8) {
                // Tampilkan pesan error jika new password memiliki kurang dari 8 karakter
                $('#new_password2').addClass('is-invalid');
                $('#pw-2-error').text("New Password should have at least 8 characters!");
                return false; // Mencegah pengiriman form
            } else if (password1Input !== password2Input) {
                // Tampilkan pesan error jika menu kosong
                $('#new_password2').addClass('is-invalid');
                $('#pw-2-error').text("Passwords do not match!");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika menu tidak kosong
                $('#current_password').addClass('is-invalid');
                $('#new_password1').addClass('is-invalid');
                $('#new_password2').addClass('is-invalid');
                // Kirim form
                $('#change-pw-form').submit();
            }
        });
    });
</script>