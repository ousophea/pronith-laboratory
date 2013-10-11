<ul class="nav nav-list">
    <li class="active">
        <a href="<?php echo site_url(); ?>">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li <?php echo (segment(1) == 'hospitals') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-building"></i>
            <span>Hospitals</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'hospitals' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('hospitals/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Hospital
                </a>
            </li>

            <li <?php echo (segment(1) == 'hospitals' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('hospitals/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Hospital Lists
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'doctors') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user-md"></i>
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
            <i class="icon-plus-sign"></i>
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
            <i class="icon-plus-sign"></i>
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
                    <i class="icon-th-list"></i>
                    List Ills
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-list-alt"></i>
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
	<li <?php echo (segment(1) == 'tests') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user-md"></i>
            <span>Examing Tests</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'tests' && (segment(2) == 'add_step1' || segment(2) == 'add_step3' || segment(2) == 'add_step3')) ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('tests/add_step1'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Test
                </a>
            </li>

            <li <?php echo (segment(1) == 'tests' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('tests/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Test Lists
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'doctors_commissions') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-money"></i>
            <span>Doctor Commission</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'doctors_commissions' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('doctors_commissions/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                  	View Commission
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'reports') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-print"></i>
            <span>Reports</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'reports' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('reports/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Report
                </a>
            </li>

            <li <?php echo (segment(1) == 'reports' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('reports/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Report Lists
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