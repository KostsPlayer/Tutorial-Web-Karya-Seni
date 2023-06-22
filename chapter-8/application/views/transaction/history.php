<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="<?= base_url('transaction/deleteallhistory') ?>" class="btn btn-danger mb-3 float-right delete-all-history"><i class="fas fa-fw fa-trash-alt mr-2"></i>History</a>

            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col">#</th>
                        <th class="text-center" scope="col" style="width: 120px;">Item</th>
                        <th class="text-center" scope="col" style="width: 120px;">Name</th>
                        <th class="text-center" scope="col" style="width: 130px;">Address</th>
                        <th class="text-center" scope="col" style="width: 50px;">Quantity</th>
                        <th class="text-center" scope="col" style="width: 120px;">Number</th>
                        <th class="text-center" scope="col" style="width: 115px;">Payment</th>
                        <th class="text-center" scope="col" style="width: 115px;">Delivery</th>
                        <th class="text-center" scope="col" style="width: 150px;">Date</th>
                        <th class="text-center" scope="col" style="width: 110px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getPurchaseMe as $gpm) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td style="max-width: 120px;"><?= $gpm['name_item']; ?></td>
                            <td style="max-width: 120px;"><?= $gpm['name']; ?></td>
                            <td style="max-width: 130px;"><?= $gpm['address']; ?></td>
                            <td class="for-table text-center" style="max-width: 50px;"><?= $gpm['quantity']; ?></td>
                            <td style="max-width: 120px;"><?= $gpm['number']; ?></td>
                            <td style="max-width: 115px;"><?= $gpm['payment']; ?></td>
                            <td style="max-width: 115px;"><?= $gpm['delivery']; ?></td>
                            <td style="max-width: 150px;"><?= date('d F Y', $gpm['date_create']); ?></td>
                            <td class="text-center for-table" style="max-width: 110px;">
                                <a href="<?= base_url('transaction/editinfo') ?>/<?= $gpm['id'] ?>" class="badge badge-warning" data-toggle="modal" data-target="#updateInfo<?= $gpm['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url('transaction/deletehistory') ?>/<?= $gpm['id'] ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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




<!-- Modal Update Info -->
<?php foreach ($getPurchaseMe as $gpm) : ?>
    <div class="modal fade" id="updateInfo<?= $gpm['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="updateContactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateContactModalLabel">Update Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-info-form" action="<?= base_url('transaction/editinfo') ?>/<?= $gpm['id'] ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $gpm['id'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-name-input" id="updateName" name="updateName" placeholder="Full Name" value="<?= $gpm['name'] ?>">
                            <div id="update-name-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-address-input" id="updateAddress" name="updateAddress" placeholder="Address" value="<?= $gpm['address'] ?>">
                            <div id="update-address-warning" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-quantity-input" id="updateQuantity" name="updateQuantity" placeholder="Quantity" value="<?= $gpm['quantity'] ?>">
                            <div id="update-quantity-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-number-input" id="updateNumber" name="updateNumber" placeholder="Number" value="<?= $gpm['number'] ?>">
                            <div id="update-number-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <select name="updatePaymentId" id="updatePaymentId" class="form-control custom-select update-paymentid-input">
                                <?php foreach ($payment as $p) : ?>
                                    <?php if ($p['id'] == $gpm['payment_id']) : ?>
                                        <option value="<?= $p['id']; ?>" selected><?= $p['payment']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['payment']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="update-paymentid-error text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <select name="updateDeliveryId" id="updateDeliveryId" class="form-control custom-select update-deliveryid-input">
                                <?php foreach ($delivery as $d) : ?>
                                    <?php if ($d['id'] == $gpm['delivery_id']) : ?>
                                        <option value="<?= $d['id']; ?>" selected><?= $d['delivery']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $d['id']; ?>"><?= $d['delivery']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="update-deliveryid-warning text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-info-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<script>
    $(document).ready(function() {
        $('.update-info-btn').click(function(e) {

            e.preventDefault();

            var updateNameInput = $(this).closest('form').find('.update-name-input').val().trim();
            var updateAddressInput = $(this).closest('form').find('.update-address-input').val().trim();
            var updateQuantityInput = $(this).closest('form').find('.update-quantity-input').val().trim();
            var updateNumberInput = $(this).closest('form').find('.update-number-input').val().trim();
            var updatePaymentIdInput = $(this).closest('form').find('.update-paymentid-input').val().trim();
            var updateDeliveryIdInput = $(this).closest('form').find('.update-deliveryid-input').val().trim();

            if (updateNameInput === '') {
                // Tampilkan pesan error jika name kosong
                $(this).closest('form').find('.update-name-input').addClass('is-invalid');
                $(this).closest('form').find('#update-name-error').text('Your name is required.');
                return false; // Mencegah pengiriman form
            }

            if (updateAddressInput === '') {
                // Tampilkan pesan error jika address kosong
                $(this).closest('form').find('.update-address-input').addClass('is-invalid');
                $(this).closest('form').find('#update-address-warning').text("Are you sure, you didn't fill in the address?");
            }

            if (updateQuantityInput === '') {
                // Tampilkan pesan error jika quantity kosong
                $(this).closest('form').find('.update-quantity-input').addClass('is-invalid');
                $(this).closest('form').find('#update-quantity-error').text('Quantity is required.');
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
            }

            if (updatePaymentIdInput === '') {
                // Tampilkan pesan error jika payment kosong
                $(this).closest('form').find('.update-paymentid-input').addClass('is-invalid');
                $(this).closest('form').find('#update-paymentid-error').text('Payment is required.');
                return false; // Mencegah pengiriman form
            }

            if (updateDeliveryIdInput === '') {
                // Tampilkan pesan error jika delivery kosong
                $(this).closest('form').find('.update-deliveryid-input').addClass('is-invalid');
                $(this).closest('form').find('#update-deliveryid-warning').text("Are you sure, you didn't fill in the delivery?");
            }

            // Hapus kelas is-invalid jika inputan tidak kosong
            $(this).closest('form').find('.update-name-input').removeClass('is-invalid');
            $(this).closest('form').find('.update-address-input').removeClass('is-invalid');
            $(this).closest('form').find('.update-quantity-input').removeClass('is-invalid');
            $(this).closest('form').find('.update-number-input').removeClass('is-invalid');
            $(this).closest('form').find('.update-paymentid-input').removeClass('is-invalid');
            $(this).closest('form').find('.update-deliveryid-input').removeClass('is-invalid');

            Swal.fire({
                title: 'Are you sure?',
                text: "Please double-check your inputs to ensure there are no mistakes.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sure'
            }).then((result) => {
                if (result.value) {
                    $(this).closest('form').submit();
                }
            });
        });
    });
</script>