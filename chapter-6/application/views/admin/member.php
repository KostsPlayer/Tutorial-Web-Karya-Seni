<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flasdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <table class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="align-middle" scope="col">#</th>
                        <th class="text-center align-middle" scope="col" style="width: 140px;">Role</th>
                        <th class="text-center align-middle" scope="col" style="width: 140px;">Name</th>
                        <th class="text-center align-middle" scope="col" style="width: 220px;">Email</th>
                        <th class="text-center align-middle" scope="col" style="width: 140px;">Image</th>
                        <th class="text-center align-middle" scope="col" style="width: 160px;">Date Create</th>
                        <th class="text-center align-middle" scope="col" style="width: 70px;">Active</th>
                        <th class="text-center align-middle" scope="col" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($getUser as $gu) : ?>
                        <tr>
                            <th class="align-middle" scope="row"><?= $i++; ?></th>
                            <td class="for-table" style="max-width: 140px;"><?= $gu['role']; ?></td>
                            <td class="for-table" style="max-width: 140px;"><?= $gu['name']; ?></td>
                            <td class="for-table" style="max-width: 220px;"><?= $gu['email']; ?></td>
                            <td class="for-table" style="max-width: 140px;"><?= $gu['image']; ?></td>
                            <td class="for-table" style="max-width: 160px;"><?= date('d F Y', $gu['date_create']); ?></td>
                            <td class="for-table text-center" style="max-width: 70px;"><?= $gu['is_active']; ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/memberaccess/') . $gu['id']; ?>" class="badge badge-success"><i class="fab fa-fw fa-accessible-icon"></i></a>
                                <a href="<?= base_url(); ?>admin/deletemember/<?= $gu['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->