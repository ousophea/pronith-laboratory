<ul class="nav nav-list">
    <li class="active">
        <a href="index.html">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
	<li <?php echo (segment(1) == 'doctors')?'class="active"':'' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user"></i>
            <span>Doctors</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'doctors' && segment(2) == 'add_new')?'class="active"':'' ?>>
                <a href="<?php echo site_url('doctors/add_new'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Doctor
                </a>
            </li>

            <li <?php echo (segment(1) == 'doctors' && segment(2) == 'lists')?'class="active"':'' ?>>
                <a href="<?php echo site_url('doctors/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Doctor Lists
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'patients')?'class="active"':'' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user"></i>
            <span>Patients</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'patients' && segment(2) == 'add_new')?'class="active"':'' ?>>
                <a href="<?php echo site_url('patients/add_new'); ?>">
                    <i class="icon-double-angle-right"></i>
                    New Patient
                </a>
            </li>

            <li <?php echo (segment(1) == 'patients' && segment(2) == 'view')?'class="active"':'' ?>>
                <a href="<?php echo site_url('doctors/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    Patient Lists
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-text-width"></i>
            <span>Quiz</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li class="active">
                <a href="<?php echo base_url(); ?>quiz/new">
                    <i class="icon-double-angle-right"></i>
                    New quiz
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>quiz/lists">
                    <i class="icon-double-angle-right"></i>
                    List quiz
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-desktop"></i>
            <span>Courses</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a href="<?php echo base_url(); ?>courses/new">
                    <i class="icon-double-angle-right"></i>
                    New course
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>courses/lists">
                    <i class="icon-double-angle-right"></i>
                    List courses
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
                <a href="<?php echo base_url(); ?>ill_groups/add">
                    <i class="icon-double-angle-right"></i>
                    New ill group
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>ill_groups/lists">
                    <i class="icon-double-angle-right"></i>
                    List ill group
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-folder-close-alt"></i>
            <span>Categories</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a href="<?php echo base_url(); ?>categories/new">
                    <i class="icon-double-angle-right"></i>
                    New category
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>categories/lists">
                    <i class="icon-double-angle-right"></i>
                    List categories
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
                <a href="<?php echo base_url(); ?>users/add">
                    <i class="icon-double-angle-right"></i>
                    New user
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>users/lists">
                    <i class="icon-double-angle-right"></i>
                    List users
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>users/profile">
                    <i class="icon-double-angle-right"></i>
                    Profile
                </a>
            </li>
        </ul>
    </li>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-group"></i>
            <span>User Groups</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a href="<?php echo base_url(); ?>users/new">
                    <i class="icon-double-angle-right"></i>
                    New user group
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>users/lists">
                    <i class="icon-double-angle-right"></i>
                    List user groups
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>users/calendar">
            <i class="icon-calendar"></i>
            <span>Calendar</span>
        </a>
    </li>
</ul><!--/.nav-list-->