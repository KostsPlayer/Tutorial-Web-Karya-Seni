<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newdeliveryModal">Add New Delivery Method +</a>

            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Delivery Method</th>
                        <th scope="col" class="text-center" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($delivery as $d) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $d['delivery']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>item/updatedelivery/<?= $d['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updatedeliveryModal<?= $d['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>item/deletedelivery/<?= $d['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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
<div class="modal fade" id="newdeliveryModal" tabindex="-1" role="dialog" aria-labelledby="newdeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newdeliveryModalLabel">New Delivery Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-delivery-form" action="<?= base_url('item/delivery'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="delivery" name="delivery" placeholder="Delivery method name">
                        <div id="add-delivery-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-delivery-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Role Modal -->
<?php foreach ($delivery as $d) : ?>
    <div class="modal fade" id="updatedeliveryModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updatedeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatedeliveryModalLabel">Update Delivery Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-delivery-form" action="<?= base_url(); ?>item/updatedelivery/<?= $d['id']; ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control update-delivery-input" id="update" name="update" placeholder="delivery method name" value="<?= $d['method'] ?>">
                            <div id="update-delivery-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-delivery-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!-- Add delivery -->
<script>
    $(document).ready(function() {
        $('#add-delivery-btn').click(function() {
            var deliveryInput = $('#delivery').val().trim();
            if (deliveryInput === '') {
                // Tampilkan pesan error jika delivery kosong
                $('#delivery').addClass('is-invalid');
                $('#add-delivery-error').text("Delivery Method is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika delivery tidak kosong
                $('#delivery').removeClass('is-invalid');
                // Kirim form
                $('#add-delivery-form').submit();
            }
        });
    });
</script>

<!-- Update delivery -->
<script>
    $(document).ready(function() {
        $('.update-delivery-btn').click(function() {
            var updateDeliveryInput = $(this).closest('form').find('.update-delivery-input').val().trim();
            if (updateDeliveryInput === '') {
                // Tampilkan pesan error jika delivery kosong
                $(this).closest('form').find('.update-delivery-input').addClass('is-invalid');
                $(this).closest('form').find('#update-delivery-error').text("Delivery Method is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika delivery tidak kosong
                $(this).closest('form').find('.update-delivery-input').removeClass('is-invalid');
                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });
</script>