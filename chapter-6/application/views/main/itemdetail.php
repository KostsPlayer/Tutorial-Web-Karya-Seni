<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $title ?></h2>
                <ol>
                    <li><a href="<?= base_url('main') ?>">Home</a></li>
                    <li>Portfolio Details</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <?php foreach ($getData as $gd) : ?>
                    <div class="col-lg-6">
                        <div class="container">
                            <div class="portfolio-details-slider swiper">
                                <div class="swiper-wrapper align-items-center">
                                    <div class="swiper-slide">
                                        <img src="<?php echo base_url('upload/client/' . $gd['file']); ?>" class="img-fluid">
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="border-bottom border-4 border-success mb-3 mt-1">
                                <h5 class="fw-bold">Description</h5>
                            </div>
                            <div>
                                <p><?= $gd['description'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="portfolio-info">
                            <h3>Arts Information</h3>
                            <ul>
                                <li><strong class="label-width">Arts</strong>: <?= $gd['name_item'] ?></li>
                                <li><strong class="label-width">Artist</strong>: <?= $gd['username'] ?></li>
                                <li><strong class="label-width">Price ($)</strong>:
                                    <?php if ($gd['price'] == 0) : ?>
                                        Free
                                    <?php else : ?>
                                        <?= $gd['price'] ?>
                                    <?php endif; ?>
                                </li>
                                <li><strong class="label-width">Type</strong>: <?php if ($gd['format_id'] == 1) : ?>
                                        Photo
                                    <?php elseif ($gd['format_id'] == 2) : ?>
                                        Video
                                    <?php elseif ($gd['format_id'] == 3) : ?>
                                        Audio
                                    <?php elseif ($gd['format_id'] == 4) : ?>
                                        Document
                                    <?php endif; ?>
                                </li>
                                <li><strong class="label-width">Date Create</strong>: <?= date('d F Y', $gd['date_create']) ?></li>
                            </ul>
                            <div class="form" action="" method="post">
                                <?php if ($gd['price'] == 0) : ?>
                                    <a href="<?= base_url('main/downloadImage'); ?>/<?= $gd['id'] ?>">
                                        <button type="submit" class="btn btn-outline-success fw-bold">
                                            <i class="fa-solid fa-download fa-flip"></i>
                                            Download
                                        </button>
                                    </a>
                                <?php else : ?>
                                    <a href="<?= base_url('transaction/purchase'); ?>/<?= $gd['id'] ?>">
                                        <button type="submit" class="btn btn-outline-success fw-bold">
                                            <i class="fa-solid fa-cart-plus fa-flip"></i>
                                            Add to Cart
                                        </button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="portfolio-description">
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->