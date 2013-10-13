<div class="page-header position-relative">
    <h1>
        សូមស្វាគមន៍
        <small>
            <i class="icon-double-angle-right"></i>
            គេហទំព័ររបស់អ្នកប្រើប្រាស់
            <?php 
            $user = $this->session->userdata(USERS); 
            //var_dump($user);
            ?>
            
            <?php
            //var_dump($this->session->userdata(GROUPS));
            ?>
        </small>
    </h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="hide" style="display: block;">
            <div id="user-profile-2" class="user-profile row-fluid">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18">
                        <li class="active">
                            <a data-toggle="tab" href="#home">
                                <i class="icon-user bigger-120"></i>
                                ជីវប្រវត្តិសង្ខេប
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#password">
                                <i class="icon-key bigger-120"></i>
                                ប្ដូរកូដសម្ថាត់
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-border padding-24">
                        
                        <div id="home" class="tab-pane active">
                            <div class="row-fluid">
                                <div class="span12">
                                    <h4 class="blue">
                                        <span class="middle"><?php echo $user[USE_USERNAME]; ?></span>
                                    </h4>

                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ឈ្មោះ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[USE_LASTNAME].' '.$user[USE_FULLNAME].'&nbsp;'; ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ឋានៈ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[GRO_NAME].'&nbsp;'; ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ថ្អៃចុះឈ្មោះ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[USE_DATACREATED].'&nbsp;'; ?></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name">ថ្ងៃកែប្រែ</div>

                                            <div class="profile-info-value">
                                                <span><?php echo $user[USE_DATAMODIFIED]."&nbsp;"; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    </div>
                                </div><!--/span-->
                            </div><!--/row-fluid-->

                        
                        <div id="password" class="tab-pane active">
                            <div class="row-fluid">
                                <div class="span12">
                                    
                                    </div>
                                </div><!--/span-->
                            </div><!--/row-fluid-->

                            <div class="space-20"></div>
                            
                        </div><!--#home-->

                    </div>
                </div>
            </div>
        </div>
        <!--PAGE CONTENT ENDS-->
    </div><!--/.span-->
</div>