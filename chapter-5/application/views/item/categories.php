<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newCategoriesModal">Add New Categories +</a>

            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center" style="width: 140px;">Categories</th>
                        <th scope="col" class="text-center">icon</th>
                        <th scope="col" class="text-center">About</th>
                        <th scope="col" class="text-center" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $ctg) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $ctg['categories']; ?></td>
                            <td><?= $ctg['icon']; ?></td>
                            <td><?= $ctg['about']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>item/updatecategories/<?= $ctg['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updateCategoriesModal<?= $ctg['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>item/deletecategories/<?= $ctg['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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
<div class="modal fade" id="newCategoriesModal" tabindex="-1" role="dialog" aria-labelledby="newCategoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCategoriesModalLabel">New Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="categoryForm" action="<?= base_url('item/categories'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="categories" name="categories" placeholder="Categories name">
                        <div id="categoryError" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon here">
                        <div id="iconError" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="about" name="about" placeholder="Something about this" rows="5"></textarea>
                        <div id="aboutError" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="category-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Role Modal -->
<?php foreach ($categories as $ctg) : ?>
    <div class="modal fade" id="updateCategoriesModal<?= $ctg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateCategoriesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoriesModalLabel">Update Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-category-form" action="<?= base_url(); ?>item/updatecategories/<?= $ctg['id']; ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $ctg['id'] ?>">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control update-category-input" id="update" name="update" placeholder="Categories name" value="<?= $ctg['categories'] ?>">
                            <div id="update-category-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control update-icon-input" id="updateIcon" name="updateIcon" placeholder="Icon here" value="<?= $ctg['icon'] ?>">
                            <div id="update-icon-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control update-about-input" id="updateAbout" name="updateAbout" placeholder="Something about this" rows="5"><?= $ctg['about'] ?></textarea>
                            <div id="update-about-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-category-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<script>
    $(document).ready(function() {
        $('#category-btn').click(function() {
            var categoryInput = $('#categories').val().trim();
            var iconInput = $('#icon').val().trim();
            var aboutInput = $('#about').val().trim();
            if (categoryInput === '') {
                // Tampilkan pesan error jika categories kosong
                $('#categories').addClass('is-invalid');
                $('#categoryError').text("Category is required.");
                return false; // Mencegah pengiriman form
            }
            if (iconInput === '') {
                // Tampilkan pesan error jika icon kosong
                $('#icon').addClass('is-invalid');
                $('#iconError').text("Icon is required.");
                return false; // Mencegah pengiriman form
            }
            if (aboutInput === '') {
                // Tampilkan pesan error jika about kosong
                $('#about').addClass('is-invalid');
                $('#aboutError').text("Description is required.");
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika categories tidak kosong
                $('#categories').removeClass('is-invalid');
                $('#icon').removeClass('is-invalid');
                $('#about').removeClass('is-invalid');
                // Kirim form
                $('#categoryForm').submit();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.update-category-btn').click(function() {
            var updateCategoryInput = $(this).closest('form').find('.update-category-input').val().trim();
            var updateIconInput = $(this).closest('form').find('.update-icon-input').val().trim();
            var updateAboutInput = $(this).closest('form').find('.update-about-input').val().trim();
            if (updateCategoryInput === '') {
                // Tampilkan pesan error jika category kosong
                $(this).closest('form').find('.update-category-input').addClass('is-invalid');
                $(this).closest('form').find('#update-category-error').text('Category is required.');
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
                // Hapus kelas is-invalid jika category tidak kosong
                $(this).closest('form').find('.update-category-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-icon-input').removeClass('is-invalid');
                $(this).closest('form').find('.update-about-input').removeClass('is-invalid');
                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });
</script>