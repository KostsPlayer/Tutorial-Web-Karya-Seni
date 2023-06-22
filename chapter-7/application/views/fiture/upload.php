<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <div class="row">
        <div class="col-lg">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <?php echo form_open_multipart('fiture/upload', ['id' => 'form', 'class' => 'validation', 'novalidate' => 'novalidate']); ?>

            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group mb-2 mt-3 ml-3">
                                <img id="preview-image" src="<?= base_url('assets') ?>/img/profile/default.jpg" class="card-img-top img-thumbnail">
                            </li>
                            <li class="list-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="content" name="content" value="<?= set_value('content'); ?>" required onchange="previewImage(event)">
                                    <label class="custom-file-label ml-3" for="content" id="filename-label">Upload</label>
                                    <div class="invalid-feedback ml-4" style="font-size: 12px;">The file is required</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group mb-2">
                                    <input type="text" class="form-control" id="item" name="item" placeholder="Art's name" value="<?= set_value('item'); ?>" required>
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">The art's name is required</div>
                                </li>
                                <li class="list-group mb-2">
                                    <textarea class="form-control" id="about" name="about" rows="7" placeholder="Description of Arts" required><?= set_value('about'); ?></textarea>
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">The description is required</div>
                                </li>
                                <li class="list-group mb-2">
                                    <select name="categories" id="categories" class="form-control custom-select" value="<?= set_value('categories'); ?>" required>
                                        <option disabled selected value="">Select Categories</option>
                                        <?php foreach ($categories as $c) : ?>
                                            <option value="<?= $c['id'] ?>" <?= set_select('categories', $c['id']); ?>><?= $c['categories'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">The category is required</div>
                                </li>
                                <li class="list-group mb-2">
                                    <select name="format" id="format" class="form-control custom-select" value="<?= set_value('format'); ?>" required>
                                        <option disabled selected value="">Select Format</option>
                                        <?php foreach ($format as $f) : ?>
                                            <option value="<?= $f['id'] ?>" <?= set_select('format', $f['id']); ?>><?= $f['format'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">The format is required</div>
                                </li>
                                <li class="list-group">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Price ($)" value="<?= set_value('price'); ?>" pattern="\d*" title="Price must be a number">
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">Price must be a number</div>
                                </li>
                            </ul>
                        </div>
                        <div class="float-end" style="margin-right: 14px; margin-bottom: 14px;">
                            <button type="submit" class="btn btn-primary px-5 py-1 fw-bold">UPLOAD</button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

        // Tampilkan nama file pada label input
        var fileName = event.target.files[0].name;
        var fileNameLabel = document.getElementById('filename-label');
        fileNameLabel.innerHTML = fileName;
    }

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>