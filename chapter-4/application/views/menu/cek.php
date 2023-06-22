<!-- JavaScript -->
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
            input.parentNode.querySelector('.submenu-error').textContent = isValid ? '' : input.dataset.errorMessage;
            input.parentNode.querySelector('.submenu-error').style.display = isValid ? 'none' : 'block';
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
            input.parentNode.querySelector('.submenu-error').textContent = '';
            input.parentNode.querySelector('.submenu-error').style.display = 'none';
        });
    }
</script>
