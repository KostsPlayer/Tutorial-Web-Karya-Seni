<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="flash-data-login" data-flashdata="<?= $this->session->flashdata('login'); ?>"></div>
            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <div class="card">
                <div class="row g-0">

                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group mb-3 ml-4" style="padding-top: 30px;">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <span class="fw-bold">User Information</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa-solid fa-fw fa-envelope-open"></i>
                                        </div>
                                        <div class="col-md-11">
                                            <?= $user['email']; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </div>
                                        <div class="col-md-11">
                                            <?= $user['name']; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa-solid fa-fw fa-map-location-dot"></i>
                                        </div>
                                        <div class="col-md-11">
                                            <?php if ($user['address'] == '') : ?>
                                                Please fill in your address on the <a href="<?= base_url('user/edit_profile') ?>">edit profile</a> page!
                                            <?php else : ?>
                                                <?= $user['address'] ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fa-solid fa-fw fa-phone-volume"></i>
                                        </div>
                                        <div class="col-md-11">
                                            <?php if ($user['phone_number'] == '') : ?>
                                                Please fill in your phone number on the <a href="<?= base_url('user/edit_profile') ?>">edit profile</a> page!
                                            <?php else : ?>
                                                <?= $user['phone_number'] ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text text-start"><small class="text-muted">Member since</small></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text text-end"><small class="text-muted"><?= date('d F Y', $user['date_create']); ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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