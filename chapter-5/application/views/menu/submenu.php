<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="flash-data" data-flasdata="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="flash-error" data-flashdata="<?= $this->session->flashdata('message_error'); ?>"></div>

            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenuModal" onclick="disable_error()">Add New Submenu +</a>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="bg-primary text-white align-middle text-center">
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Active</th>
                            <th scope="col" style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subMenu as $sm) : ?>
                            <tr class="text-center">
                                <th scope="row"><?= ++$start; ?></th>
                                <td class="text-left"><?= $sm['title']; ?></td>
                                <td class="text-left"><?= $sm['menu']; ?></td>
                                <td class="text-left"><?= $sm['url']; ?></td>
                                <td class="text-left"><?= $sm['icon']; ?></td>
                                <td><?= $sm['is_active']; ?></td>
                                <td>
                                    <a href="<?= base_url('menu/updatesubmenu'); ?>/<?= $sm['id']; ?>" class="badge text-bg-warning rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#updateSubMenuModal<?= $sm['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    <a href="<?= base_url(); ?>menu/delete_submenu/<?= $sm['id']; ?>" class="badge text-bg-danger rounded-pill text-white general-delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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




<!-- Modal Add Submenu -->
<div class="modal fade" id="newSubMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">New Submenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="addSubmenuForm" class="needs-validation" action="<?= base_url('menu/submenu'); ?>" method="post" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control submenu-input" id="title" name="title" placeholder="Submenu title" data-error-message="The title is required" required>
                        <div class="submenu-error"></div>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control custom-select submenu-input" data-error-message="The menu id is required" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="submenu-error"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control submenu-input" id="url" name="url" placeholder="Submenu url" data-error-message="The url is required" required>
                        <div class="submenu-error"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control submenu-input" id="icon" name="icon" placeholder="Submenu icon" data-error-message="The icon is required" required>
                        <div class="submenu-error"></div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Activate</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submenu-btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Modal Update Submenu -->
<?php foreach ($subMenu as $sm) : ?>
    <div class="modal fade" id="updateSubMenuModal<?= $sm['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="updateSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubMenuModalLabel">Update Submenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="updateSubmenuForm" action="<?= base_url('menu/updatesubmenu/' . $sm['id']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control submenu-input" id="update_title" name="update_title" placeholder="Submenu title" value="<?= $sm['title']; ?>" data-error-message="The title update is required" required>
                            <div class="submenu-error"></div>
                        </div>
                        <div class="form-group">
                            <select name="update_menu_id" id="update_menu_id" class="form-control custom-select submenu-input" data-error-message="The menu id update is required" required>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m['id'] == $sm['menu_id']) : ?>
                                        <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="submenu-error"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control submenu-input" id="update_url" name="update_url" placeholder="Submenu url" value="<?= $sm['url']; ?>" data-error-message="The url update is required" required>
                            <div class="submenu-error"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control submenu-input" id="update_icon" name="update_icon" placeholder="Submenu icon" value="<?= $sm['icon']; ?>" data-error-message="The icon update is required" required>
                            <div class="submenu-error"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input ml-2" type="checkbox" value="1" name="update_is_active" id="update_is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
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
    .form-group .submenu-error {
        font-size: 12px;
        color: #dc3545;
        padding-top: 3px;
        padding-left: 7px;
    }
</style>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addForm = document.getElementById('addSubmenuForm');
        var updateForms = document.querySelectorAll('[id^="updateSubmenuForm"]');

        addForm.addEventListener('submit', function(e) {
            var submenuInputs = addForm.querySelectorAll('.submenu-input');
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
                var submenuInputs = form.querySelectorAll('.submenu-input');
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

        var submenuInputs = document.querySelectorAll('.submenu-input');

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

            var errorElement = input.parentNode.querySelector('.submenu-error');
            if (errorElement) {
                errorElement.textContent = isValid ? '' : input.dataset.errorMessage;
                errorElement.style.display = isValid ? 'none' : 'block';
            }
        }

        function showErrorMessage(input, message) {
            input.classList.add('is-invalid');
            var errorElement = input.parentNode.querySelector('.submenu-error');

            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }
        }

        function hideErrorMessage(input) {
            input.classList.remove('is-invalid');
            var errorElement = input.parentNode.querySelector('.submenu-error');

            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        }
    });

    function disable_error() {
        var addForm = document.getElementById('addSubmenuForm');
        addForm.classList.remove('was-validated');

        var submenuInputs = addForm.querySelectorAll('.submenu-input');
        submenuInputs.forEach(function(input) {
            input.classList.remove('is-invalid');
            var errorElement = input.parentNode.querySelector('.submenu-error');
            if (errorElement) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }
        });
    }
</script>