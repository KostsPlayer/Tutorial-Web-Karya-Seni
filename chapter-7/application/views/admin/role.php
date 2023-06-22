<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-7">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flasdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role +</a>

            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center align-middle" scope="col">#</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Role</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>
                        <tr>
                            <th class="align-middle text-center" scope="row"><?= $i; ?></th>
                            <td class="for-table" style="max-width: 130px;"><?= $r['role']; ?></td>
                            <td class="for-table text-center" style="max-width: 130px;">
                                <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-success"><i class="fab fa-fw fa-accessible-icon"></i></a>
                                <a href="<?= base_url(); ?>admin/update_role/<?= $r['id']; ?>" class="badge badge-warning" data-toggle="modal" data-target="#updateRoleModal<?= $r['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>admin/delete_role/<?= $r['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-role-form" action="<?= base_url('admin/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                        <div id="add-role-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-role-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Role Modal -->
<?php foreach ($role as $r) : ?>
    <div class="modal fade" id="updateRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update-role-form" action="<?= base_url(); ?>admin/update_role/<?= $r['id']; ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control update-role-input" id="role" name="role" placeholder="Role name" value="<?= $r['role'] ?>">
                            <div id="update-role-error" class="text-danger pl-1 mt-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update-role-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        $('#add-role-btn').click(function() {
            var roleInput = $('#role').val().trim();
            if (roleInput === '') {
                // Tampilkan pesan error jika role kosong
                $('#role').addClass('is-invalid');
                $('#add-role-error').text('Role is required.');
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika role tidak kosong
                $('#role').removeClass('is-invalid');
                // Kirim form
                $('#add-role-form').submit();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.update-role-btn').click(function() {
            var updateMenuInput = $(this).closest('form').find('.update-role-input').val().trim();
            if (updateMenuInput === '') {
                // Tampilkan pesan error jika role kosong
                $(this).closest('form').find('.update-role-input').addClass('is-invalid');
                $(this).closest('form').find('#update-role-error').text('Role is required.');
                return false; // Mencegah pengiriman form
            } else {
                // Hapus kelas is-invalid jika role tidak kosong
                $(this).closest('form').find('.update-role-input').removeClass('is-invalid');
                // Kirim form
                $(this).closest('form').submit();
            }
        });
    });
</script>