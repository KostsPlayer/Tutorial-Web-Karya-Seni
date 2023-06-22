<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <div class="container">
                <div class="row" data-masonry='{"percentPosition": true }'>
                    <?php foreach ($getContent as $gc) : ?>
                        <div class="col-lg-4 p-1 mb-1">
                            <a href="<?= base_url('upload/client/') . $gc['file']; ?>" data-bs-toggle="modal" data-bs-target="#gallery<?= $gc['id']; ?>">
                                <img src="<?= base_url('upload/client/') . $gc['file']; ?>" class="img-fluid img-thumbnail" />
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal -->
<?php foreach ($getContent as $gc) : ?>
    <div class="modal fade" id="gallery<?= $gc['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?php echo form_open_multipart('fiture/updateGallery/' . $gc['id'], ['id' => 'galleryForm', 'class' => 'needs-validation', 'novalidate' => 'novalidate']); ?>

                <input type="hidden" name="id" value="<?= $gc['id'] ?>">

                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <ul class="list-group list-group-flush">
                                <li class="list-group mb-2">
                                    <img src="<?= base_url('upload/client/') . $gc['file']; ?>" alt="" id="preview-image" class="img-thumbnail img-fluid">
                                </li>
                                <li class="list-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control custom-file-input gallery-validate" id="content" name="content" value="<?= $gc['file'] ?>" onchange="previewImage(event)" data-error-message="The update file is required">
                                        <label class="custom-file-label" for="content" id="filename"><?= $gc['file'] ?></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-7">
                            <div class="ml-2">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group mb-2">
                                        <input type="text" class="form-control gallery-validate" id="item" name="item" value="<?= $gc['name_item'] ?>" required data-error-message="The update arts name is required">
                                        <div class="gallery-error"></div>
                                    </li>
                                    <li class="list-group mb-2">
                                        <textarea class="form-control gallery-validate" name="about" id="about" rows="7" required data-error-message="The update description is required"><?= $gc['description'] ?></textarea>
                                        <div class="gallery-error"></div>
                                    </li>
                                    <li class="list-group mb-2">
                                        <select name="categories" id="categories" class="form-control custom-select gallery-validate" required data-error-message="The update category is required">
                                            <?php foreach ($categories as $c) : ?>
                                                <?php if ($c['id'] == $gc['categories_id']) : ?>
                                                    <option value="<?= $c['id']; ?>" selected><?= $c['categories']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $c['id']; ?>"><?= $c['categories']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="gallery-error"></div>
                                    </li>
                                    <li class="list-group mb-2">
                                        <select name="format" id="format" class="form-control custom-select gallery-validate" required data-error-message="The update format is required">
                                            <?php foreach ($format as $f) : ?>
                                                <?php if ($f['id'] == $gc['format_id']) : ?>
                                                    <option value="<?= $f['id']; ?>" selected><?= $f['format']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $f['id']; ?>"><?= $f['format']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="gallery-error"></div>
                                    </li>
                                    <li class="list-group">
                                        <input type="text" class="form-control gallery-validate" id="price" name="price" value="<?= $gc['price'] ?>">
                                        <div class="gallery-error"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>




<style>
    .list-group .gallery-error {
        font-size: 12px;
        color: #dc3545;
        padding-top: 3px;
        padding-left: 7px;
    }
</style>




<script>

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

        var fileName = event.target.files[0].name;
        var fileNameLabel = document.getElementById('filename');
        fileNameLabel.innerHTML = fileName;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var galleryForms = document.querySelectorAll('[id^="galleryForm"]');

        galleryForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                var galleryValidate = form.querySelectorAll('.gallery-validate');
                var isValid = true;

                galleryValidate.forEach(function(input) {
                    if (input.value.trim() === '') {
                        isValid = false;
                        showErrorMessage(input, input.dataset.errorMessage);
                    } else {
                        hideErrorMessage(input);
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                form.classList.add('was-validated');
            });
        });

        var galleryValidate = document.querySelectorAll('.gallery-validate');

        galleryValidate.forEach(function(input) {
            input.addEventListener('input', function() {
                toggleValidity(this);
            });

            toggleValidity(input);
        });

        function toggleValidity(input) {
            var value = input.value.trim();
            var isValid = value !== '';
            input.classList.toggle('is-valid', isValid);
            input.classList.toggle('is-invalid', !isValid);

            var errorElement = input.parentNode.querySelector('.gallery-error');
            if (errorElement) {
                errorElement.textContent = isValid ? '' : input.dataset.errorMessage;
                errorElement.style.display = isValid ? 'none' : 'block';
            }
        }

        function showErrorMessage(input, message) {
            input.classList.add('is-invalid');
            var errorElement = input.parentNode.querySelector('.gallery-error');

            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        function hideErrorMessage(input) {
            input.classList.remove('is-invalid');
            var errorElement = input.parentNode.querySelector('.gallery-error');

            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }
    });

    function disable_error() {
        var galleryForm = document.getElementById('galleryForm');
        galleryForm.classList.remove('was-validated');

        var galleryValidate = galleryForm.querySelectorAll('.gallery-validate');
        galleryValidate.forEach(function(input) {
            input.classList.remove('is-invalid');
            var errorElement = input.parentNode.querySelector('.gallery-error');
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        });
    }
</script>