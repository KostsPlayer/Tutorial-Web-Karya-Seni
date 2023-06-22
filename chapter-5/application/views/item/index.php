<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-9">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newItemModal">Add New Item +</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Format</th>
                        <th scope="col">Time</th>
                        <th scope="col">Item ID</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($item as $it) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $it['categories']; ?></td>
                            <td><?= $it['format']; ?></td>
                            <td><?= $it['time'] ?></td>
                            <td><?= $it['new_uid']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>item/updateitem/<?= $it['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updateItemModal<?= $it['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>item/deleteitem/<?= $it['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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




<!-- Add Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItemModalLabel">New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-item-form" action="<?= base_url('item'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="time" name="time" value="<?= $time ?>" readonly>
                    </div>
                    <div class="form-group">
                        <select name="categories_id" id="categories_id" class="form-control custom-select">
                            <option value="">Select Categories</option>
                            <?php foreach ($categories as $c) : ?>
                                <option value="<?= $c['id']; ?>"><?= $c['categories']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="add-categories-item-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <select name="format_id" id="format_id" class="form-control custom-select">
                            <option value="">Select Format</option>
                            <?php foreach ($format as $f) : ?>
                                <option value="<?= $f['id']; ?>"><?= $f['format']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="add-format-item-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-item-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Role Modal -->
<?php foreach ($item as $it) : ?>
    <div class="modal fade" id="updateItemModal<?= $it['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">Update Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-item-form" action="<?= base_url(); ?>item/updateitem/<?= $it['id']; ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $it['id'] ?>">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="time" name="time" value="<?= $time ?>" readonly>
                        </div>
                        <div class="form-group">
                            <select name="categories_id" id="categories_id" class="form-control custom-select update-categories-item-input">
                                <?php foreach ($categories as $c) : ?>
                                    <?php if ($c['id'] == $i['categories_id']) : ?>
                                        <option value="<?= $c['id']; ?>" selected><?= $c['categories']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $c['id']; ?>"><?= $c['categories']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div id="update-categories-item-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <select name="format_id" id="format_id" class="form-control custom-select update-format-item-input">
                                <?php foreach ($format as $f) : ?>
                                    <?php if ($f['id'] == $i['format_id']) : ?>
                                        <option value="<?= $f['id']; ?>" selected><?= $f['format']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $f['id']; ?>"><?= $f['format']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div id="update-format-item-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-item-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!-- Add JS -->
<script>
    $(document).ready(function() {
        $('#add-item-btn').click(function() {
            var categoryInput = $('#categories_id').val().trim();
            var formatInput = $('#format_id').val().trim();
            if (categoryInput === '') {
                // Tampilkan pesan error jika categories kosong
                $('#categories_id').addClass('is-invalid');
                $('#add-categories-item-error').text("Category is required.");
                return false; // Mencegah pengiriman form
            }
            if (formatInput === '') {
                // Tampilkan pesan error jika format kosong
                $('#format_id').addClass('is-invalid');
                $('#add-format-item-error').text("Format is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika categories tidak kosong
                $('#categories_id').removeClass('is-invalid');
                $('#format_id').removeClass('is-invalid');
                // Kirim form
                $('#add-item-form').submit();
            }
        });
    });
</script>

<!-- Update JS -->
<script>
    $(document).ready(function() {
        $('.update-item-btn').click(function() {
            var updateCategoryInput = $(this).closest('form').find('.update-categories-item-input').val().trim();
            var updateFormatyInput = $(this).closest('form').find('.update-format-item-input').val().trim();
            if (updateCategoryInput === '') {
                // Tampilkan pesan error jika category kosong
                $(this).closest('form').find('.update-categories-item-input').addClass('is-invalid');
                $(this).closest('form').find('#update-categories-item-error').text('Category is required.');
                return false; // Mencegah pengiriman form
            }
            if (updateFormatInput === '') {
                // Tampilkan pesan error jika category kosong
                $(this).closest('form').find('.update-format-item-input').addClass('is-invalid');
                $(this).closest('form').find('#update-format-item-error').text('Format is required.');
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika category tidak kosong
                $(this).closest('form').find('.update-categories-item-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-format-item-input').removeClass('is-invalid');
                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });
</script>