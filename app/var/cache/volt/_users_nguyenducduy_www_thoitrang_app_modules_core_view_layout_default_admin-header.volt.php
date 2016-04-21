<!-- START PAGE HEADER WRAPPER -->
<!-- START HEADER -->
<div class="header ">
    <!-- START MOBILE CONTROLS -->
    <!-- LEFT SIDE -->
    <div class="pull-left full-height visible-sm visible-xs">
        <!-- START ACTION BAR -->
        <div class="sm-action-bar">
            <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
                <span class="icon-set menu-hambuger"></span>
            </a>
        </div>
        <!-- END ACTION BAR -->
    </div>

    <!-- END MOBILE CONTROLS -->
    <div class=" pull-left sm-table">
        <div class="header-inner">
            <div class="brand inline">
                <img src="<?php echo $this->url->getStatic('assets/default/images/logo-cec-web.png'); ?>" alt="logo" width="30" height="30">
            </div>
        </div>
    </div>
    <div class=" pull-right">
        <!-- START User Info-->
        <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                <span class="semi-bold"><?php echo $this->session->get('me')->name; ?></span>
            </div>
            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                     <img src="<?php echo $this->url->getStatic($this->session->get('me')->avatar); ?>" alt="<?php echo $this->session->get('me')->name; ?>" data-src="<?php echo $this->url->getStatic($this->session->get('me')->avatar); ?>" data-src-retina="<?php echo $this->url->getStatic($this->session->get('me')->avatar); ?>" width="32" height="32">
                </span>
                </button>
                <ul class="dropdown-menu profile-dropdown" role="menu">
                    <li><a href="<?php echo $this->url->get('admin/user/changepassword'); ?>"><i class="pg-settings_small"></i> <?php echo $this->lang->query('default.change-password'); ?></a>
                </li>
            </li>
        </li>
        <li class="bg-master-lighter">
            <a href="<?php echo $this->url->get('admin/user/logout'); ?>" class="clearfix">
                <span class="pull-left"><?php echo $this->lang->query('default.logout'); ?></span>
                <span class="pull-right"><i class="pg-power"></i></span>
            </a>
        </li>
    </ul>
</div>
</div>
<!-- END User Info-->
</div>
</div>
<!-- END HEADER -->
<!-- END PAGE HEADER WRAPPER -->
