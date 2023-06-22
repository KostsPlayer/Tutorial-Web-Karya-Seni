<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newContactModal">Add New Main Contact +</a>

            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center align-middle" scope="col">#</th>
                        <th class="text-center align-middle" scope="col" style="width: 320px;">Location</th>
                        <th class="text-center align-middle" scope="col" style="width: 145px;">Map</th>
                        <th class="text-center align-middle" scope="col" style="width: 145px;">Email</th>
                        <th class="text-center align-middle" scope="col" style="width: 145px;">Number</th>
                        <th class="text-center align-middle" scope="col" style="width: 60px;">Active</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contact as $c) : ?>
                        <tr>
                            <th class="align-middle" scope="row"><?= ++$start; ?></th>
                            <td class="for-table" style="max-width: 320px;"><?= $c['location']; ?></td>
                            <td class="for-table" style="max-width: 145px;"><?= $c['map']; ?></td>
                            <td class="for-table" style="max-width: 145px;"><?= $c['email']; ?></td>
                            <td class="for-table" style="max-width: 145px;"><?= $c['number']; ?></td>
                            <td class="text-center"><?= $c['is_active']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>main/update_contact/<?= $c['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updateContactModal<?= $c['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>main/delete_contact/<?= $c['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newContactModal" tabindex="-1" role="dialog" aria-labelledby="newContactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContactModalLabel">New Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-contact-form" action="<?= base_url('main/contact'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                        <div id="add-location-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="map" name="map" placeholder="Map">
                        <div id="add-map-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        <div id="add-email-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="number" name="number" placeholder="Number">
                        <div id="add-number-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-contact-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Contact -->
<?php foreach ($contact as $c) : ?>
    <div class="modal fade" id="updateContactModal<?= $c['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="updateContactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateContactModalLabel">Update Main Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-contact-form" action="<?= base_url(); ?>main/update_contact/<?= $c['id']; ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $c['id'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-location-input" id="updateLocation" name="updateLocation" placeholder="Location" value="<?= $c['location'] ?>">
                            <div id="update-location-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-map-input" id="updateMap" name="updateMap" placeholder="Map" value="<?= $c['map'] ?>">
                            <div id="update-map-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-email-input" id="updateEmail" name="updateEmail" placeholder="Email" value="<?= $c['email'] ?>">
                            <div id="update-email-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-number-input" id="updateNumber" name="updateNumber" placeholder="Number" value="<?= $c['number'] ?>">
                            <div id="update-number-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="update_is_active" id="update_is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-contact-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<script>
    $(document).ready(function() {
        $('#add-contact-btn').click(function() {
            var locationInput = $('#location').val().trim();
            var mapInput = $('#map').val().trim();
            var emailInput = $('#email').val().trim();
            var numberInput = $('#number').val().trim();

            if (locationInput === '') {
                // Tampilkan pesan error jika location kosong
                $('#location').addClass('is-invalid');
                $('#add-location-error').text('Location is required.');
                return false; // Mencegah pengiriman form
            }

            if (mapInput === '') {
                // Tampilkan pesan error jika map kosong
                $('#map').addClass('is-invalid');
                $('#add-map-error').text('Map is required.');
                return false; // Mencegah pengiriman form
            }

            if (emailInput === '') {
                // Tampilkan pesan error jika email kosong
                $('#email').addClass('is-invalid');
                $('#add-email-error').text('Email is required.');
                return false; // Mencegah pengiriman form
            } else if (!isValidEmail(emailInput)) {
                // Tampilkan pesan error jika email tidak valid
                $('#email').addClass('is-invalid');
                $('#add-email-error').text('Invalid email format.');
                return false; // Mencegah pengiriman form
            }

            if (numberInput === '') {
                // Tampilkan pesan error jika number kosong
                $('#number').addClass('is-invalid');
                $('#add-number-error').text('Phone number is required.');
                return false; // Mencegah pengiriman form
            } else if (isNaN(numberInput)) {
                $('#number').addClass('is-invalid');
                $('#add-number-error').text("Phone number must be a number");
                return false;
            } else if (numberInput.length < 10) {
                // Tampilkan pesan error jika number memiliki kurang dari 10 karakter
                $('#number').addClass('is-invalid');
                $('#add-number-error').text("Phone number should have at least 10 characters!");
                return false; // Mencegah pengiriman form
            } else if (numberInput.length > 15) {
                // Tampilkan pesan error jika number memiliki lebih dari 15 karakter
                $('#number').addClass('is-invalid');
                $('#add-number-error').text("Phone number should have at most 15 characters!");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika inputan tidak kosong
                $('#location').removeClass('is-invalid');
                $('#map').removeClass('is-invalid');
                $('#email').removeClass('is-invalid');
                $('#number').removeClass('is-invalid');

                // Kirim form
                $('#add-contact-form').submit();
            }
        });
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>

<script>
    $(document).ready(function() {
        $('.update-contact-btn').click(function() {
            var updateLocationInput = $(this).closest('form').find('.update-location-input').val().trim();
            var updateMapInput = $(this).closest('form').find('.update-map-input').val().trim();
            var updateEmailInput = $(this).closest('form').find('.update-email-input').val().trim();
            var updateNumberInput = $(this).closest('form').find('.update-number-input').val().trim();

            if (updateLocationInput === '') {
                // Tampilkan pesan error jika location kosong
                $(this).closest('form').find('.update-location-input').addClass('is-invalid');
                $(this).closest('form').find('#update-location-error').text('Location is required.');
                return false; // Mencegah pengiriman form
            }

            if (updateMapInput === '') {
                // Tampilkan pesan error jika map kosong
                $(this).closest('form').find('.update-map-input').addClass('is-invalid');
                $(this).closest('form').find('#update-map-error').text('Map is required.');
                return false; // Mencegah pengiriman form
            }

            if (updateEmailInput === '') {
                // Tampilkan pesan error jika email kosong
                $(this).closest('form').find('.update-email-input').addClass('is-invalid');
                $(this).closest('form').find('#update-email-error').text('Email is required.');
                return false; // Mencegah pengiriman form
            } else if (!isValidEmail(updateEmailInput)) {
                // Tampilkan pesan error jika email tidak valid
                $(this).closest('form').find('.update-email-input').addClass('is-invalid');
                $(this).closest('form').find('#update-email-error').text('Invalid email format.');
                return false; // Mencegah pengiriman form
            }

            if (updateNumberInput === '') {
                // Tampilkan pesan error jika number kosong
                $(this).closest('form').find('.update-number-input').addClass('is-invalid');
                $(this).closest('form').find('#update-number-error').text('Number is required.');
                return false; // Mencegah pengiriman form
            } else if (isNaN(updateNumberInput)) {
                $(this).closest('form').find('.update-number-input').addClass('is-invalid');
                $(this).closest('form').find('#update-number-error').text("Phone number must be a number");
                return false;
            } else if (updateNumberInput.length < 10) {
                // Tampilkan pesan error jika number memiliki kurang dari 10 karakter
                $(this).closest('form').find('.update-number-input').addClass('is-invalid');
                $(this).closest('form').find('#update-number-error').text("Phone number should have at least 10 characters!");
                return false; // Mencegah pengiriman form
            } else if (updateNumberInput.length > 15) {
                // Tampilkan pesan error jika number memiliki lebih dari 15 karakter
                $(this).closest('form').find('.update-number-input').addClass('is-invalid');
                $(this).closest('form').find('#update-number-error').text("Phone number should have at most 15 characters!");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika inputan tidak kosong
                $(this).closest('form').find('.update-location-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-map-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-email-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-number-input').removeClass('is-invalid');

                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>