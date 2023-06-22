

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
                        <th class="text-center align-middle" scope="col">#</th>
                        <th class="text-center align-middle" scope="col" style="width: 130px;">Art</th>
                        <th class="text-center align-middle" scope="col" style="width: 150px;">Address</th>
                        <th class="text-center align-middle" scope="col" style="width: 100px;">Price ($)</th>
                        <th class="text-center align-middle" scope="col" style="width: 200px;">File</th>
                        <th class="text-center align-middle" scope="col" style="width: 110px;">Categories</th>
                        <th class="text-center align-middle" scope="col" style="width: 100px;">Format</th>
                        <th class="text-center align-middle" scope="col" style="width: 150px;">Date Create</th>
                        <th class="text-center align-middle" scope="col" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getContent as $gc) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td style="max-width: 130px;"><?= $gc['name_item']; ?></td>
                            <td style="max-width: 150px;"><?= $gc['address']; ?></td>
                            <td style="max-width: 100px;"><?= $gc['price']; ?></td>
                            <td class="for-table" style="max-width: 200px;"><?= $gc['file']; ?></td>
                            <td style="max-width: 100px;"><?= $gc['categories']; ?></td>
                            <td style="max-width: 100px;"><?= $gc['format']; ?></td>
                            <td style="max-width: 150px;"><?= date('d F Y', $gc['date_create']); ?></td>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>fiture/updategallery/<?= $gc['id']; ?>" class="badge badge-warning"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="<?= base_url(); ?>fiture/deletegallery/<?= $gc['id']; ?>" class="badge badge-danger general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <div class="row" data-masonry='{"percentPosition": true }'>
                <?php foreach ($getContent as $gc) : ?>
                    <div class="col-lg-4 px-1 col-md-12 mb-2 mb-lg-0">
                        <div class="image-wrapper">
                            <a href="<?= base_url('upload/client/') . $gc['file']; ?>" data-lightbox="gallery">
                                <img src="<?= base_url('upload/client/') . $gc['file']; ?>" class="w-100 shadow-1-strong rounded mb-2">
                            </a>
                            <div class="hover-overlay">
                                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.4)"></div>
                                <div class="image-icons">
                                    <!-- Icon for redirecting to another page -->
                                    <a href="<?= base_url('upload/client/') . $gc['file']; ?>" class="image-icon" data-lightbox="roadtrip">
                                        <i class="fas fa-link"></i>
                                    </a>
                                    <!-- Icon for zooming the image -->
                                    <a href="<?= base_url('upload/client/') . $gc['file']; ?>" class="image-icon zoom-icon" data-lightbox="roadtrip">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Include Lightbox2 CSS and JS -->
<link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/lightbox.min.css">

<!-- Place the Lightbox2 JS script after jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets') ?>/dist/js/lightbox.min.js"></script>

<script>
    $(document).ready(function() {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });

        // Get all zoom icons
        $('.zoom-icon').on('click', function(e) {
            e.preventDefault();
            // Toggle zoomed class
            $(this).closest('.image-wrapper').toggleClass('zoomed');
        });
    });
</script>

<style>
    .image-wrapper {
        position: relative;
    }

    .hover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .image-wrapper:hover .hover-overlay {
        opacity: 1;
    }

    .mask {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .image-icons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .image-icon {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 5px;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .image-icon:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .zoomed img {
        filter: grayscale(50%);
        transform: scale(1.2);
    }
</style>


