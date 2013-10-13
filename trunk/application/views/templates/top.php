<div class="navbar navbar-inverse hidden-print">

    <div class="navbar-inner">
        <div class="container-fluid">
            <a href="#" class="brand">
                <small>
                    <i class="icon-unlock-alt"></i>
                    	ប្រព័ន្ធគ្រប់​គ្រង មន្ទីរ​ពិសោធន៍
                    </small>
                    <b>ប្រណីត</b>
            </a><!--/.brand-->
            <ul class="nav ace-nav pull-right">
                <li class="light-blue user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                        <img class="nav-user-photo" src="images/user.png" alt="Jason's Photo" />
                        <span id="user_info">
                            <small><?php echo $this->session->userdata(USE_USERNAME); ?></small>
                        </span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer" id="user_menu">
                        <li>
                            <a href="#">
                                <i class="icon-cog"></i>
                                កំណត់
                            </a>
                        </li>

                        <li>
                            <a class="ajax" href="<?php echo base_url(); ?>users/profile">
                                <i class="icon-user"></i>
                                ជីវប្រវត្តិសង្ខេប
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo base_url().'users/loginout' ?>">
                                <i class="icon-off"></i>
                                ចាកចេញ់
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!--/.w8-nav-->
        </div><!--/.container-fluid-->
    </div><!--/.navbar-inner-->

</div>