<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newpaymentModal">Add New Payment Method +</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payment as $p) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $p['payment']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>item/updatepayment/<?= $p['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updatepaymentModal<?= $p['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>item/deletepayment/<?= $p['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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




<!-- Modal Add Payment -->
<div class="modal fade" id="newpaymentModal" tabindex="-1" role="dialog" aria-labelledby="newpaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newpaymentModalLabel">New Payment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-payment-form" action="<?= base_url('item/payment'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="payment" name="payment" placeholder="Payment method name">
                        <div id="add-payment-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-payment-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal Payment -->
<?php foreach ($payment as $p) : ?>
    <div class="modal fade" id="updatepaymentModal<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updatepaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatepaymentModalLabel">Update Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-payment-form" action="<?= base_url(); ?>item/updatepayment/<?= $p['id']; ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control update-payment-input" id="update" name="update" placeholder="Payment method name" value="<?= $p['payment'] ?>">
                            <div id="update-payment-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-payment-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!-- Add Payment -->
<script>
    $(document).ready(function() {
        $('#add-payment-btn').click(function() {
            var paymentInput = $('#payment').val().trim();
            if (paymentInput === '') {
                // Tampilkan pesan error jika payment kosong
                $('#payment').addClass('is-invalid');
                $('#add-payment-error').text("Payment Method is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika payment tidak kosong
                $('#payment').removeClass('is-invalid');
                // Kirim form
                $('#add-payment-form').submit();
            }
        });
    });
</script>

<!-- Update Payment -->
<script>
    $(document).ready(function() {
        $('.update-payment-btn').click(function() {
            var updatePaymentInput = $(this).closest('form').find('.update-payment-input').val().trim();
            if (updatePaymentInput === '') {
                // Tampilkan pesan error jika payment kosong
                $(this).closest('form').find('.update-payment-input').addClass('is-invalid');
                $(this).closest('form').find('#update-payment-error').text("Payment Method is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika payment tidak kosong
                $(this).closest('form').find('.update-payment-input').removeClass('is-invalid');
                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });
</script>