<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('main/index') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-fw fa-palette fa-lg"></i>
        </div>
        <div class="sidebar-brand-text mx-2">ARTS</div>
    </a>

 

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Query Menu -->
    <?php
    $role_id = $this->session->userdata('role_id');

    if ($role_id) {
        $queryMenu = "SELECT `menu`.`id`, `menu`
                    FROM `menu` JOIN `access_menu` 
                    ON `menu`.`id` = `access_menu`.`menu_id`
                    WHERE `access_menu`.`role_id` = $role_id
                    ORDER BY `access_menu`.`menu_id` ASC
       ";
    } else {
        $this->session->set_flashdata('warning', "You need to log in first to access this service!");
        redirect('auth');
    };

    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- Looping Menu -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- Sub-Menu sesuai Menu -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * FROM `sub_menu` JOIN `menu`
                            ON `sub_menu`.`menu_id` = `menu`.`id`
                            WHERE `sub_menu`.`menu_id` = $menuId
                            AND `sub_menu`.`is_active` = 1
        ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>

            <!-- Nav Item - Dashboard -->
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']) ?>">
                    <i class="<?= ($sm['icon']) ?>"></i>
                    <span><?= ($sm['title']) ?></span></a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

        <?php endforeach; ?>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a href="<?= base_url('auth/logout'); ?>" class="nav-link pt-0 logout">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>

<!-- End of Sidebar -->

<script>
    $(document).ready(function() {
        $('.logout').on('click', function(e) {
            e.preventDefault();
            const hrefall = $(this).attr('href');

            Swal.fire({
                title: 'Ready to Leave?',
                text: "Select Logout below if you are ready to end your current session.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout'
            }).then((result) => {
                if (result.value) {
                    document.location.href = hrefall;
                }
            });
        });
    });
</script>