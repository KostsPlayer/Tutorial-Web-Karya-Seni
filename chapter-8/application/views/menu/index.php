<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenuModal" onclick="disable_error()">Add New Menu +</a>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="bg-primary text-white align-middle text-center">
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col" style="width : 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($menu as $m) : ?>
                            <tr class="align-middle text-center">
                                <th scope="row"><?= ++$start; ?></th>
                                <td class="text-left"><?= $m['menu']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>menu/updatemenu/<?= $m['id']; ?>" class="badge text-bg-warning rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#updateMenuModal<?= $m['id']; ?>">
                                        <i class="fas fa-fw fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url(); ?>menu/deletemenu/<?= $m['id']; ?>" class="badge rounded-pill text-bg-danger general-delete text-white"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->




<!-- Add Menu Modal -->
<div class="modal fade" id="newMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMenuForm" class="needs-validation" action="<?= base_url('menu'); ?>" method="post" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control menu-input" id="menu" name="menu" placeholder="Menu name" data-error-message="The menu is required" required>
                        <div class="menu-error text-danger pl-1"></div>
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

<!-- Update Menu Modal -->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="updateMenuModal<?= $m['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="updateMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMenuModalLabel">Update Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateMenuForm<?= $m['id'] ?>" action="<?= base_url('menu/updatemenu/' . $m['id']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control menu-input" id="updateMenu" name="updateMenu" placeholder="Menu name" value="<?= $m['menu']; ?>" data-error-message="The update menu is required" required>
                            <div class="menu-error"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<style>
    .form-group .menu-error {
        font-size: 12px;
        color: #dc3545;
        padding-top: 3px;
        padding-left: 7px;
    }
</style>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addForm = document.getElementById('addMenuForm');
        var updateForms = document.querySelectorAll('[id^="updateMenuForm"]');

        addForm.addEventListener('submit', function(e) {
            var submenuInputs = addForm.querySelectorAll('.menu-input');
            var isValid = true;

            submenuInputs.forEach(function(input) {
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

            addForm.classList.add('was-validated');
        });

        updateForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                var submenuInputs = form.querySelectorAll('.menu-input');
                var isValid = true;

                submenuInputs.forEach(function(input) {
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

        var submenuInputs = document.querySelectorAll('.menu-input');

        submenuInputs.forEach(function(input) {
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

            var errorElement = input.parentNode.querySelector('.menu-error');
            if (errorElement) {
                errorElement.textContent = isValid ? '' : input.dataset.errorMessage;
                errorElement.style.display = isValid ? 'none' : 'block';
            }
        }

        function showErrorMessage(input, message) {
            input.classList.add('is-invalid');
            var errorElement = input.parentNode.querySelector('.menu-error');

            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        function hideErrorMessage(input) {
            input.classList.remove('is-invalid');
            var errorElement = input.parentNode.querySelector('.menu-error');

            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }
    });

    function disable_error() {
        var addForm = document.getElementById('addMenuForm');
        addForm.classList.remove('was-validated');

        var submenuInputs = addForm.querySelectorAll('.menu-input');
        submenuInputs.forEach(function(input) {
            input.classList.remove('is-invalid');
            var errorElement = input.parentNode.querySelector('.menu-error');
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        });
    }
</script>