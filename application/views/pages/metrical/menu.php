<div class="page-sidebar">
    <div class="logo">
        <a class="logo-img" href="index.html">
        <img class="desktop-logo" src="assets/images/logo.png" alt="">
        <img class="small-logo" src="assets/images/small-logo.png" alt="">
        </a>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
    </div>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li>
                    <a href="<?php echo base_url('/event'); ?>">
                        <i data-feather="calendar"></i>
                        <span>Event</span>
                    </a>
                </li>
                <li>
                <a href="<?php echo base_url('/user'); ?>">
                        <i data-feather="user"></i>
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('/setting'); ?>">
                        <i data-feather="settings"></i>
                        <span>Setting</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('/base/logout'); ?>">
                        <i data-feather="log-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>