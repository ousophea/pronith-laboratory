<ul class="nav nav-list">
    <li class="active">
        <a href="<?php echo site_url(); ?>">
            <i class="icon-dashboard"></i>
            <span>ផ្ទាំង​កិច្ចការ</span>
        </a>
    </li>
    <li <?php echo (segment(1) == 'hospitals') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-building"></i>
            <span>មន្ទីរ​ពេទ្យ</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'hospitals' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('hospitals/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​មន្ទីរ​ពេទ្យថ្មី
                </a>
            </li>

            <li <?php echo (segment(1) == 'hospitals' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('hospitals/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​បន្ទីរ​ពេទ្យ
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'doctors') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user-md"></i>
            <span>វេជ្ជ​បណ្ឌិត</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'doctors' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('doctors/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​វេជ្ជ​បណ្ឌិត​ថ្មី
                </a>
            </li>

            <li <?php echo (segment(1) == 'doctors' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('doctors/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​វេជ្ជ​បណ្ឌិត
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'patients') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user"></i>
            <span>អ្នក​ជំងឺ</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'patients' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('patients/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​អ្នក​ជំ​ងឺ​ថ្មី
                </a>
            </li>

            <li <?php echo (segment(1) == 'patients' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('patients/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​អ្នក​ជំ​ងឺ
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-plus-sign"></i>
            <span>ប្រ​ភេទ​ជំ​ងឺ</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_groups/add">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​ប្រ​ភេទ​ជំ​ងឺ
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_groups/lists">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​ប្រ​ភេទ​ជំ​ងឺ
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-plus-sign"></i>
            <span>ជំងឺ</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ills/add">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​ជំងឺ
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ills/lists">
                    <i class="icon-th-list"></i>
                    បង្ហាញ​ជំងឺ
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-list-alt"></i>
            <span>ធាតុ​ជំងឺ</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_items/add">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​ធាតុ​ជំងឺ
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>ill_items/lists">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​ធាតុ​ជំងឺ
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'tests') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-user-md"></i>
            <span>តេស្ថ​ជំងឺ</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'tests' && (segment(2) == 'add_step1' || segment(2) == 'add_step3' || segment(2) == 'add_step3')) ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('tests/add_step1'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បញ្ចូល​តេស្ថ​ជំងឺ
                </a>
            </li>

            <li <?php echo (segment(1) == 'tests' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('tests/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​តេស្ថ​ជំងឺ
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'doctors_commissions') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-money"></i>
            <span>កំរៃ​​ជើង​សារ</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'doctors_commissions' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('doctors_commissions/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    បង្ហាញ​កំរៃ​ជើងសារ​
                </a>
            </li>
        </ul>
    </li>
    <li <?php echo (segment(1) == 'reports') ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-print"></i>
            <span>របាយ​ការណ៍</span>
            <b class="arrow icon-angle-down"></b>
        </a>
        <ul class="submenu">
            <li <?php echo (segment(1) == 'reports' && segment(2) == 'add') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('reports/add'); ?>">
                    <i class="icon-double-angle-right"></i>
                    របាយ​ការណ៍​ប្រាក់​ចំណូល
                </a>
            </li>

            <li <?php echo (segment(1) == 'reports' && segment(2) == 'lists') ? 'class="active"' : '' ?>>
                <a href="<?php echo site_url('reports/lists'); ?>">
                    <i class="icon-double-angle-right"></i>
                    របាយ​ការណ៍​តេស្ថ
                </a>
            </li>
        </ul>
    </li>
    
    
    <li>
        <a href="<?php echo base_url(); ?>" class="dropdown-toggle">
            <i class="icon-plus-sign"></i>
            <span>អ្នកប្រើប្រាស់</span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a class="ajax" href="<?php echo base_url(); ?>users/add">
                    <i class="icon-double-angle-right"></i>
                    	បង្កើតអ្នកប្រើប្រាស់
                </a>
            </li>

            <li>
                <a class="ajax" href="<?php echo base_url(); ?>users/lists">
                    <i class="icon-th-list"></i>
                    	បង្ហាញ​អ្នកប្រើប្រាស់
                </a>
            </li>
        </ul>
    </li>

</li>
</ul><!--/.nav-list-->