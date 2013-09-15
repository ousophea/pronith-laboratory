<ul class="nav nav-list">
    <li class="active">
        <a href="index.html">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li <?php echo (segment(1) == 'doctors') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user"></i>
            <span>Doctors</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'doctors' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('doctors/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Doctor
                </a>
            </li>

            <li <?php echo (segment(1) == 'doctors' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('doctors/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Doctor Lists
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'patients') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user"></i>
            <span>Patients</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'patients' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('patients/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Patient
                </a>
            </li>

            <li <?php echo (segment(1) == 'patients' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('patients/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Patient Lists
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-desktop"></i>
            <span>Ill Group</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_groups/add">
                    <i class="icon-double-angle-right"></i>
                    New ill group
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_groups/lists">
                    <i class="icon-double-angle-right"></i>
                    List ill group
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-folder-close-alt"></i>
            <span>Ills</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ills/add">
                    <i class="icon-double-angle-right"></i>
                    New Ill
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ills/lists">
                    <i class="icon-double-angle-right"></i>
                    List Ills
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-folder-close-alt"></i>
            <span>Ill item</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_items/add">
                    <i class="icon-double-angle-right"></i>
                    New Ill item
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_items/lists">
                    <i class="icon-double-angle-right"></i>
                    List Ill items
                </a>
            </li>
        </ul>
    </li>


    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user"></i>
            <span>Users</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>users/add">
                    <i class="icon-double-angle-right"></i>
                    New user
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>users/lists">
                    <i class="icon-double-angle-right"></i>
                    List users
                </a>
            </li>
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>users/index">
                    <i class="icon-double-angle-right"></i>
                    Profile
                </a>
            </li>
        </ul>
    </li>
</li>

<li>
    <a href="<?php echo base_url(); ?>users/calendar">
        <i class="icon-calendar"></i>
        <span>Calendar</span>
    </a>
</li>
</ul><!--/.nav-list-->