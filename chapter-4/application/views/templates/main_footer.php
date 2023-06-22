<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <?php foreach ($contact as $c) : ?>
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <p>
                            <strong>Address:</strong> <?= $c['location'] ?>
                            <br>
                            <strong>Phone:</strong> <?= $c['number']; ?><br>
                            <strong>Email:</strong> <?= $c['email']; ?><br>
                        </p>
                    </div>
                <?php endforeach; ?>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#portfolio">Gallery</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Thanks</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Our project advisor</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Our teaching faculty</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Our parents nad Family</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Our Friends</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">The people who have helped us</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Join Our Services</h4>
                    <p>We can create many things based on abstraction and ethical thinking together.</p>
                    <form action="<?= base_url('fiture/upload') ?>" method="post">
                        <input type="email" name="email"><input type="submit" value="Move Up">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>ARTS</span></strong>.
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/aos/aos.js"></script>
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url('assets') ?>/Bethany/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets') ?>/Bethany/assets/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Masonry -->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

<!-- Sweet Alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url(''); ?>assets/js/sweetalert/sweetalert2.all.min.js"></script>
<script src="<?= base_url(''); ?>assets/js/sweetalert/myscript.js"></script>
<script>
    $(document).ready(function() {
        // Filter portfolio items based on selected category
        $('.filter-category').on('click', function() {
            var category = $(this).data('category');
            if (category === '*') {
                $('.portfolio-item').show();
            } else {
                $('.portfolio-item').hide();
                $('.filter-' + category).show();
            }
        });
    });
</script>


</body>

</html>