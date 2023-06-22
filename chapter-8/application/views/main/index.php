<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
  <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
    <h1>Relax Our Soul With Art</h1>
    <h2>Art is a representation of the soul, beautify our soul with art</h2>
    <a href="#about" class="btn-get-started scrollto">Get Started</a>
  </div>
</section><!-- End Hero -->




<main id="main">




  <!-- ======= Services Section ======= -->
  <section id="services" class="services section-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-title" data-aos="fade-right">
            <h2>Services</h2>
            <p>The more mature a person becomes, the more they think ethically and abstractly about many things in the world</p>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">

            <?php foreach ($getFormat as $gf) : ?>
              <div class="col-md-6 d-flex align-items-stretch">
                <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon"><i class="<?= $gf['icon'] ?>"></i>
                  </div>
                  <h4><a href="<?= base_url('fiture/upload') ?>"><?= $gf['format'] ?></a></h4>
                  <p><?= $gf['about'] ?></p>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>
  </section><!-- End Services Section -->




  <!-- ======= Why Us Section ======= -->
  <section id="why-us" class="why-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">

              <?php foreach ($getCategories as $gc) : ?>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box mt-4">
                    <i class="<?= ($gc['icon']) ?>"></i>
                    <h4><?= $gc['categories'] ?></h4>
                    <p><?= $gc['about'] ?></p>
                  </div>
                </div>
              <?php endforeach; ?>

            </div>
          </div><!-- End .content-->
        </div>
      </div>
    </div>
  </section><!-- End Why Us Section -->




  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container">
      <div class="text-center" data-aos="zoom-in">
        <h3>Call To Action</h3>
        <p>Take action now for something you desire, or you will be moved by something you don't desire. Take a step. There's no need to overthink. The journey begins with one small step.</p>
        <a class="cta-btn" href="<?= base_url('fiture/upload') ?>">Make Waves</a>
      </div>
    </div>
  </section><!-- End Cta Section -->




  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">
      <div class="section-title" data-aos="fade-left">
        <h2>Gallery</h2>
      </div>


      <div class="section-title" data-aos="fade-left">
        <h3 class="for-h3">Photo</h3>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <?php foreach ($getCategories as $gc) : ?>
              <li data-filter=".filter-photo-<?= $gc['id'] ?>"><?= $gc['categories'] ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <?php foreach ($take_content as $tc) : ?>
          <?php
          // Ambil kategori berdasarkan id
          $category = $this->db->get_where('categories', ['id' => $tc['categories_id']])->row_array();
          ?>
          <?php if ($tc['format_id'] == 1) : ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-photo-<?= $category['id'] ?>">
              <div class="portfolio-wrap" style="width: 100%; position:relative;">
                <div class="portfolio-image" style="position: relative; overflow: hidden; padding-bottom: 100%;">
                  <img src="<?php echo base_url('upload/client/' . $tc['file']); ?>" class="img-fluid" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="portfolio-info">
                  <h4><?= $tc['name_item'] ?></h4>
                  <div class="portfolio-links">
                    <a href="<?php echo base_url('upload/client/' . $tc['file']); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $tc['name_item'] ?>"><i class="fa-solid fa-fw fa-maximize fa-xs"></i></a>
                    <a href="<?= base_url('main/itemdetail') ?>/<?= $tc['id'] ?>" title="More Details"><i class="fas fa-fw fa-info-circle fa-xs"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <div class="section-title" data-aos="fade-left" style="margin-top: 50px;">
        <h3 class="for-h3">Video</h3>
      </div>
      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <?php foreach ($getCategories as $gc) : ?>
              <li data-filter=".filter-video-<?= $gc['id'] ?>"><?= $gc['categories'] ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <?php foreach ($take_content as $tc) : ?>
          <?php
          // Ambil kategori berdasarkan id
          $category = $this->db->get_where('categories', ['id' => $tc['categories_id']])->row_array();
          ?>
          <?php if ($tc['format_id'] == 2) : ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-video-<?= $category['id'] ?>">
              <div class="portfolio-wrap" style="width: 100%; position:relative;">
                <div style="position: relative; overflow: hidden; padding-bottom: 56.25%;">
                  <video src="<?php echo base_url('upload/client/' . $tc['file']); ?>" class="img-fluid" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" muted controls></video>
                </div>
                <div class="portfolio-info">
                  <h4><?= $tc['name_item'] ?></h4>
                  <div class="portfolio-links">
                    <a href="<?php echo base_url('upload/client/' . $tc['file']); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?= $tc['name_item'] ?>"><i class="fas fa-fw fa-info-circle fa-xs"></i></a>
                    <a href="<?= base_url('main/itemdetail') ?>/<?= $tc['id'] ?>" title="More Details"><i class="fa-brands fa-fw fa-shopify fa-xs"></i></a>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

    </div>
  </section><!-- End Portfolio Section -->





  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
          <div class="section-title">
            <h2>Contact</h2>
            <p>Seek spaces of many things. You never know when and where you will return home. Rest. Engage in light conversation. Look ahead with anticipation. Discuss art and other abstract matters.</p>
          </div>
        </div>

        <?php foreach ($contact as $c) : ?>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div id="map-container">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.1404866736502!2d107.57311187384848!3d-6.873765593124971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7d1b68bb875%3A0xd8fcf5a9e43bd6e4!2sUniversitas%20Logistik%20dan%20Bisnis%20Internasional%20(ULBI)!5e0!3m2!1sid!2sid!4v1685775568820!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="info mt-4">
              <a href=""><i class="bi bi-geo-alt"></i></a>
              <h4>Location:</h4>
              <p><?= $c['location'] ?></p>
            </div>
            <div class="row">
              <div class="col-lg-6 mt-4">
                <div class="info">
                  <a href=""><i class="bi bi-envelope"></i></a>
                  <h4>Email:</h4>
                  <p><?= $c['email'] ?></p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="info w-100 mt-4">
                  <a href=""><i class="bi bi-phone"></i></a>
                  <h4>Call:</h4>
                  <p><?= $c['number'] ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          </div>
      </div>
    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<style>
  .for-h3 {
    left: 50%;
    font-size: 28px;
    font-weight: bold;
    text-transform: uppercase;
    padding-bottom: 10px;
    position: relative;
    display: inline-block;
  }

  .for-h3::after {
    content: "";
    position: absolute;
    display: block;
    width: 50px;
    height: 3px;
    background: #009970;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
  }
</style>
