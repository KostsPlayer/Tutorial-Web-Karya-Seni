<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <?php echo form_open_multipart('user/edit_profile', ['id' => 'form', 'class' => 'validation', 'novalidate' => 'novalidate']); ?>

            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush ml-3">
                            <li class="list-group mb-2" style="margin-top: 13px;">
                                <img id="preview-image" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                            </li>
                            <li class="list-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="image" name="image" value="<?= set_value('image'); ?>" onchange="previewImage(event)">
                                    <label class="custom-file-label pb-2" for="image" id="filename-label">Profile</label>
                                    <div class="invalid-feedback ml-4" style="font-size: 12px;">The file is required</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group mb-2">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user['email']; ?>" required readonly>
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">The email is required</div>
                                </li>
                                <li class="list-group mb-2">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Username" value="<?= $user['name']; ?>" required>
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">The name is required</div>
                                </li>
                                <li class="list-group mb-2">
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address"><?= $user['address']; ?></textarea>
                                    <div class="valid-feedback ml-2" style="font-size: 12px;">Consider providing address</div>
                                </li>
                                <li class="list-group">
                                    <input type="text" class="form-control" id="number" name="number" placeholder="Number" value="<?= $user['phone_number']; ?>" pattern="\d*" title="Phone Number must be a number">
                                    <div class="invalid-feedback ml-2" style="font-size: 12px;">Phone Number must be a number</div>
                                    <div class="valid-feedback ml-2" style="font-size: 12px;">Consider providing your phone number</div>
                                </li>
                            </ul>
                        </div>

                        <div class="float-end" style="margin-right: 14px; margin-bottom: 14px;">
                            <button type="submit" class="btn btn-primary py-1 fw-bold px-4">SENT</button>
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

    $('#form').submit(function(event) {
        event.preventDefault();

        // Kirim form
        Swal.fire({
            title: 'Are you sure?',
            text: "Please make sure there are no mistakes in the input data",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sure'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form').submit();
            }
        })
    })
</script>