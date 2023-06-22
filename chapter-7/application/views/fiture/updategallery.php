<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <?php foreach ($EditContent as $ec) : ?>
                <div id="upload-form">
                    <?= form_open_multipart('fiture/updategallery/' . $ec['id']); ?>
                    <input type="hidden" name="id" value="<?= $ec['id'] ?>">
                    <div class="form-group row">
                        <label for="name_item" class="col-sm-2 col-form-label">Name Arts</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name_item" name="name_item" value="<?= $ec['name_item'] ?>">
                            <div id="name-item-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="about" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="about" name="about" rows="5" value="<?= $ec['description'] ?>"></textarea>
                            <div id="aboutWarning" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="categories" class="col-sm-2 col-form-label">Categories</label>
                        <div class="col-sm-9">
                            <select name="categories" id="categories" class="form-control custom-select">
                                <option value=""></option>
                                <?php foreach ($categories as $c) : ?>
                                    <option value="<?= $c['id'] ?>" <?= $ec['categories_id'] == $c['id'] ? 'selected' : '' ?>><?= $c['categories'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="categories-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="format" class="col-sm-2 col-form-label">Format</label>
                        <div class="col-sm-9">
                            <select name="format" id="format" class="form-control custom-select">
                                <option value=""></option>
                                <?php foreach ($format as $f) : ?>
                                    <option value="<?= $f['id'] ?>" <?= $ec['format_id'] == $f['id'] ? 'selected' : '' ?>><?= $f['format'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="format-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" value="<?= $ec['address'] ?>">
                            <div id="address-warning" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="price" name="price" value="<?= $ec['price'] ?>">
                            <div id="price-warning" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label">File</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img id="preview" src="<?php echo base_url('upload/client/' . $ec['file']); ?>" class="img-thumbnail">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="content" name="content" value="<?= $ec['file'] ?>">
                                    <label class="custom-file-label" for="content">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group justify-content-end mt-2">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary px-5" id="update-gallery-btn">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        $('#update-gallery-btn').click(function() {
            var nameItemInput = $('#name_item').val().trim();
            var categoriesInput = $('#categories').val().trim();
            var formatInput = $('#format').val().trim();
            var addressInput = $('#address').val().trim();
            var priceInput = $('#price').val().trim();

            if (nameItemInput === '') {
                // Tampilkan pesan error jika name item kosong
                $('#name_item').addClass('is-invalid');
                $('#name-item-error').text("Art's name is required.");
                return false; // Mencegah pengiriman form
            }

            if (categoriesInput === '') {
                // Tampilkan pesan error jika categories kosong
                $('#categories').addClass('is-invalid');
                $('#categories-error').text('Category is required.');
                return false; // Mencegah pengiriman form
            }

            if (formatInput === '') {
                // Tampilkan pesan error jika format kosong
                $('#format').addClass('is-invalid');
                $('#format-error').text('Format is required.');
                return false; // Mencegah pengiriman form
            }

            if (addressInput === '') {
                // Tampilkan pesan peringatan jika address kosong
                $('#address').addClass('is-invalid');
                $('#address-warning').text("Are you sure, you didn't fill in the address?");
            }

            if (isNaN(priceInput)) {
                $('#price').addClass('is-invalid');
                $('#price-warning').text("Price must be a number");
                return false;
            } else {
                // Hapus kelas is-invalid jika inputan tidak kosong
                $('#name_item').removeClass('is-invalid');
                $('#categories').removeClass('is-invalid');
                $('#format').removeClass('is-invalid');
                $('#address').removeClass('is-invalid');
                $('#price').removeClass('is-invalid');

                // Kirim form
                $('#upload-form').submit();
            }
        });
    });
</script>