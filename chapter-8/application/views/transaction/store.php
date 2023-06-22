<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

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
                        <th class="text-center" scope="col" style="width: 130px;">Date</th>
                        <th class="text-center" scope="col" style="width: 110px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getDataStore as $gds) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td class="for-table" style="max-width: 120px;"><?= $gds['name_item']; ?></td>
                            <td class="for-table" style="max-width: 120px;"><?= $gds['name']; ?></td>
                            <td class="for-table" style="max-width: 130px;"><?= $gds['address']; ?></td>
                            <td class="for-table text-center" style="max-width: 50px;"><?= $gds['quantity']; ?></td>
                            <td class="for-table" style="max-width: 120px;"><?= $gds['number']; ?></td>
                            <td class="for-table" style="max-width: 110px;"><?= $gds['payment']; ?></td>
                            <td class="for-table" style="max-width: 110px;"><?= $gds['delivery']; ?></td>
                            <td class="for-table" style="max-width: 130px;"><?= date('d F Y', $gds['date_create']); ?></td>
                            <td class="text-center for-table" style="max-width: 110px;">
                                <a href="" class="badge badge-info"><i class="fas fa-fw fa-clipboard-list"></i></a>
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