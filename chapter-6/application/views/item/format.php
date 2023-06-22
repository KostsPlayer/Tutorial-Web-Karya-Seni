<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newFormatModal">Add New Format +</a>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center" style="width: 140px;">Format</th>
                        <th scope="col" class="text-center" style="width: 180px;">icon</th>
                        <th scope="col" class="text-center">About</th>
                        <th scope="col" class="text-center" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($format as $f) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $f['format']; ?></td>
                            <td><?= $f['icon']; ?></td>
                            <td><?= $f['about']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>item/updateformat/<?= $f['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updateFormatModal<?= $f['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>item/deleteformat/<?= $f['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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
<div class="modal fade" id="newFormatModal" tabindex="-1" role="dialog" aria-labelledby="newFormatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newFormatModalLabel">New Format</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="format-form" action="<?= base_url('item/format'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="format" name="format" placeholder="Format name">
                        <div id="format-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon here">
                        <div id="icon-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="about" name="about" placeholder="Something about this" rows="5"></textarea>
                        <div id="about-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="format-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Modal -->
<?php foreach ($format as $f) : ?>
    <div class="modal fade" id="updateFormatModal<?= $f['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateFormatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFormatModalLabel">Update Format</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-format-form" action="<?= base_url(); ?>item/updateformat/<?= $f['id']; ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $f['id'] ?>">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control update-format-input" id="update" name="update" placeholder="Format name" value="<?= $f['format'] ?>">
                            <div id="update-format-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-icon-input" id="updateIcon" name="updateIcon" placeholder="Icon here" value="<?= $f['icon'] ?>">
                            <div id="update-icon-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control update-about-input" id="updateAbout" name="updateAbout" placeholder="Something about this" rows="5"><?= $f['about'] ?></textarea>
                            <div id="update-about-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-format-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!-- JS Format Add -->
<script>
    $(document).ready(function() {
        $('#format-btn').click(function() {
            var formatInput = $('#format').val().trim();
            var iconInput = $('#icon').val().trim();

            if (formatInput === '') {
                // Tampilkan pesan error jika format kosong
                $('#format').addClass('is-invalid');
                $('#format-error').text("Format is required.");
                return false; // Mencegah pengiriman form
            }

            if (iconInput === '') {
                // Tampilkan pesan error jika icon kosong
                $('#icon').addClass('is-invalid');
                $('#icon-error').text("Icon is required.");
                return false; // Mencegah pengiriman form
            }

            var aboutInput = $('#about').val().trim();
            if (aboutInput === '') {
                // Tampilkan pesan error jika about kosong
                $('#about').addClass('is-invalid');
                $('#about-error').text("Description is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika format tidak kosong
                $('#format').removeClass('is-invalid');
                $('#icon').removeClass('is-invalid');
                $('#about').removeClass('is-invalid');
                // Kirim form
                $('#format-form').submit();
            }
        });
    });
</script>

<!-- JS Format Update -->
<script>
    $(document).ready(function() {
        $('.update-format-btn').click(function() {
            var updateFormatInput = $(this).closest('form').find('.update-format-input').val().trim();
            var updateIconInput = $(this).closest('form').find('.update-icon-input').val().trim();
            var updateAboutInput = $(this).closest('form').find('.update-about-input').val().trim();
            if (updateFormatInput === '') {
                // Tampilkan pesan error jika format kosong
                $(this).closest('form').find('.update-format-input').addClass('is-invalid');
                $(this).closest('form').find('#update-format-error').text('Format is required.');
                return false; // Mencegah pengiriman form
            }
            if (updateIconInput === '') {
                // Tampilkan pesan error jika icon kosong
                $(this).closest('form').find('.update-icon-input').addClass('is-invalid');
                $(this).closest('form').find('#update-icon-error').text('Icon is required.');
                return false; // Mencegah pengiriman form
            }
            if (updateAboutInput === '') {
                // Tampilkan pesan error jika about kosong
                $(this).closest('form').find('.update-about-input').addClass('is-invalid');
                $(this).closest('form').find('#update-about-error').text('Description is required.');
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika format tidak kosong
                $(this).closest('form').find('.update-format-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-icon-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-about-input').removeClass('is-invalid');
                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });
</script>