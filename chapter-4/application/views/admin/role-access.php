<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-7">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flasdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <h5><?= $role['role'] ?></h5>

            <table class="table table-hover table-bordered table-responsive">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="text-center align-middle" scope="col">#</th>
                        <th class="text-center" scope="col" style="width: 130px;">Menu</th>
                        <th class="text-center" scope="col" style="width: 70px;">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th class="align-middle" scope="row"><?= $i; ?></th>
                            <td class="for-table" style="max-width: 130px;"><?= $m['menu']; ?></td>
                            <td class="text-center" style="max-width: 70px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>" data-toggle="modal" data-target="#checkformModal">
                                </div>
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

<!-- Ajax -->
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        })
    });
</script>