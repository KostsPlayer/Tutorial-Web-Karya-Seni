<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">

        <div class="col-lg-7">

            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <?php foreach ($getData as $gd) : ?>
                <form id="purchase-form" action="<?= base_url('transaction/purchase/') . $gd['id']; ?>" method="post">
                    <h4><?= $gd['name_item'] ?></h4>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="name_item" name="name_item" value="<?= $getData[0]['name_item'] ?>">
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name">
                            <div id="name-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address">
                            <div id="address-warning" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="quantity" name="quantity">
                            <div id="quantity-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                            <div id="phone-number-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment" class="col-sm-2 col-form-label">Payment</label>
                        <div class="col-sm-10">
                            <select name="payment" id="payment" class="form-control custom-select">
                                <option value=""></option>
                                <?php foreach ($payment as $p) : ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['payment'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="payment-error" class="text-danger pl-1" style="font-size: 12px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="delivery" class="col-sm-2 col-form-label">Delivery</label>
                        <div class="col-sm-10">
                            <select name="delivery" id="delivery" class="form-control custom-select">
                                <option value=""></option>
                                <?php foreach ($delivery as $d) : ?>
                                    <option value="<?= $d['id'] ?>"><?= $d['delivery'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4 ml-4 text-right">
                            <button type="submit" class="btn btn-primary px-3 purchase-btn">Purchase</button>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-5 mt-5">
            <div class="form-group row">
                <div class="col-sm-11">
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="<?php echo base_url('upload/client/' . $gd['file']); ?>" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        $('.purchase-btn').click(function(e) {

            e.preventDefault();
            
            var nameInput = $('#name').val().trim();
            var addressInput = $('#address').val().trim();
            var quantityInput = $('#quantity').val().trim();
            var phoneNumberInput = $('#phone_number').val().trim();
            var paymentInput = $('#payment').val().trim();

            if (nameInput === '') {
                // Tampilkan pesan error jika name item kosong
                $('#name').addClass('is-invalid');
                $('#name-error').text("Your name is required.");
                return false; // Mencegah pengiriman form
            }

            if (addressInput === '') {
                // Tampilkan pesan error jika address kosong
                $('#address').addClass('is-invalid');
                $('#address-warning').text("Are you sure, you didn't fill in the address?");
            }

            if (quantityInput === '') {
                // Tampilkan pesan error jika quantity kosong
                $('#quantity').addClass('is-invalid');
                $('#quantity-error').text('Quantity is required.');
                return false; // Mencegah pengiriman form
            }

            if (phoneNumberInput === '') {
                // Tampilkan pesan peringatan jika phone_number kosong
                $('#phone_number').addClass('is-invalid');
                $('#phone-number-error').text("Phone number is required");
                return false; // Mencegah pengiriman form
            } else if (isNaN(phoneNumberInput)) {
                $('#phone_number').addClass('is-invalid');
                $('#phone-number-error').text("Phone number must be a phone_number");
                return false;
            } else if (phoneNumberInput.length < 10) {
                $('#phone_number').addClass('is-invalid');
                $('#phone-number-error').text("Phone number should have at least 10 characters!");
                return false;
            } else if (phoneNumberInput.length > 15) {
                $('#phone_number').addClass('is-invalid');
                $('#phone-number-error').text("Phone number should have at most 15 characters!");
                return false;
            }

            if (paymentInput === '') {
                // Tampilkan pesan error jika payment kosong
                $('#payment').addClass('is-invalid');
                $('#payment-error').text('Payment is required.');
                return false; // Mencegah pengiriman form
            }

            // Hapus kelas is-invalid jika inputan tidak kosong
            $('#name').removeClass('is-invalid');
            $('#address').removeClass('is-invalid');
            $('#quantity').removeClass('is-invalid');
            $('#phone_number').removeClass('is-invalid');
            $('#payment').removeClass('is-invalid');

            // Kirim form
            Swal.fire({
                title: 'Are you sure?',
                text: "Please double-check your inputs to ensure there are no mistakes.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Purchase'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#purchase-form').submit();
                }
            });
        });
    });
</script>