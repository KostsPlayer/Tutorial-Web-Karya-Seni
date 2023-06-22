<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <table class="table table-hover table-bordered table-responsive">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center align-middle" scope="col">#</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Order Date</th>
                        <th class="text-center align-middle" scope="col" style="width: 120px;">Item</th>
                        <th class="text-center align-middle" scope="col" style="width: 110px;">Seller</th>
                        <th class="text-center align-middle" scope="col" style="width: 110px;">Buyer</th>
                        <th class="text-center align-middle" scope="col" style="width: 140px;">Buyer Address</th>
                        <th class="text-center align-middle" scope="col" style="width: 60px;">Shipment</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Shipping Date</th>
                        <th class="text-center align-middle" scope="col" style="width: 60px;">Recipient</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Received Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getShippingData as $gsd) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td style="max-width: 130px;"><?= date('d F Y', $gsd['date_transaction']); ?></td>
                            <td style="max-width: 120px;"><?= $gsd['item']; ?></td>
                            <td style="max-width: 110px;"><?= $gsd['seller']; ?></td>
                            <td style="max-width: 110px;"><?= $gsd['buyer']; ?></td>
                            <td style="max-width: 140px;"><?= $gsd['address_buyer']; ?></td>
                            <td class="text-center">
                                <?php if ($user['email'] == $gsd['email_seller']) : ?>
                                    <div class="form-check col">
                                        <input class="shipment-checkbox" type="checkbox" data-id="<?= $gsd['id']; ?>" <?= $gsd['shipping'] ? 'checked' : ''; ?>>
                                    </div>
                                <?php else : ?>
                                    <div class="form-check col">
                                        <input class="shipment-checkbox" type="checkbox" data-id="<?= $gsd['id']; ?>" <?= $gsd['shipping'] ? 'checked' : ''; ?> disabled>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="date-shipping" style="max-width: 130px;"><?= date('d F Y', $gsd['date_shipping']); ?></td>
                            <td class="text-center">
                                <?php if ($user['email'] == $gsd['email_buyer']) : ?>
                                    <div class="form-check col">
                                        <input class="recipient-checkbox" type="checkbox" data-id="<?= $gsd['id']; ?>" <?= $gsd['recipient'] ? 'checked' : ''; ?>>
                                    </div>
                                <?php else : ?>
                                    <div class="form-check col">
                                        <input class="recipient-checkbox" type="checkbox" data-id="<?= $gsd['id']; ?>" <?= $gsd['recipient'] ? 'checked' : ''; ?> disabled>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="date-recipient" style="max-width: 130px;"><?= date('d F Y', $gsd['date_recipient']); ?></td>
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




<script>
    $(document).ready(function() {
        $('.shipment-checkbox').on('click', function() {
            const shippingId = $(this).data('id');
            const isChecked = $(this).prop('checked');

            // Tampilkan popup konfirmasi
            Swal.fire({
                title: 'Are you sure?',
                text: "Wasn't there any problem before the items were shipped?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Alright'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik "Alright", lakukan pembaruan
                    updateShippingDate(shippingId, isChecked);
                } else {
                    // Jika pengguna membatalkan, kembalikan ke nilai sebelumnya
                    $(this).prop('checked', !isChecked);
                }
            });
        });

        function updateShippingDate(shippingId, isChecked) {
            $.ajax({
                url: "<?= base_url('transaction/updateShippingDate'); ?>",
                type: 'post',
                data: {
                    shippingId: shippingId,
                    isChecked: isChecked,
                },
                dataType: 'json',
                success: function(response) {
                    // Jika berhasil, lakukan sesuatu
                    if (response.status === 'success') {
                        // Perbarui tampilan tabel setelah pembaruan berhasil
                        $('.date-shipping[data-id="' + shippingId + '"]').text(isChecked ? 'Completed' : '');

                        if (response.message) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: '',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (response.message_error) {
                            Swal.fire({
                                icon: 'error',
                                title: response.message_error,
                                text: '',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                }
            });
        }

        $('.recipient-checkbox').on('click', function() {
            const shippingId = $(this).data('id');
            const isChecked = $(this).prop('checked');

            // Tampilkan popup konfirmasi
            Swal.fire({
                title: 'Are you sure?',
                text: "Wasn't there any problem when receiving the items?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Alright'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengklik "Alright", lakukan pembaruan
                    updateRecipientDate(shippingId, isChecked);
                } else {
                    // Jika pengguna membatalkan, kembalikan ke nilai sebelumnya
                    $(this).prop('checked', !isChecked);
                }
            });
        });

        function updateRecipientDate(shippingId, isChecked) {
            $.ajax({
                url: "<?= base_url('transaction/updateRecipientDate'); ?>",
                type: 'post',
                data: {
                    shippingId: shippingId,
                    isChecked: isChecked,
                },
                dataType: 'json',
                success: function(response) {
                    // Jika berhasil, lakukan sesuatu
                    if (response.status === 'success') {
                        // Perbarui tampilan tabel setelah pembaruan berhasil
                        $('.date-recipient[data-id="' + shippingId + '"]').text(isChecked ? 'Received' : '');

                        if (response.message) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: '',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else if (response.message_error) {
                            Swal.fire({
                                icon: 'error',
                                title: response.message_error,
                                text: '',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                }
            });
        }
    });
</script>