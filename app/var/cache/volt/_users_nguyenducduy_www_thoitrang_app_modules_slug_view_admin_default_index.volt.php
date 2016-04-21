<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>
    <?php echo $this->lang->query('page-title-index'); ?> | <?php echo $this->config->global->title; ?>
</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->url->getStatic('favicon.ico'); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo $this->url->getStatic('favicon.ico'); ?>">
        <!-- BEGIN Pages CSS-->
        <link href="<?php echo $this->url->getStatic('plugins/boostrapv3/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->url->getStatic('min/index.php?g=cssDefaultCoreAdmin&rev=' . $this->config->global->version->css); ?>" rel="stylesheet" type="text/css">
        
        <!--[if lte IE 9]>
            <link href="<?php echo $this->url->getStatic('plugins/admin-fix/ie9.css'); ?>" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script type="text/javascript" src="<?php echo $this->url->getStatic('plugins/jquery/jquery-1.11.1.min.js'); ?>"></script>
        
        <script type="text/javascript">
            var root_url = "<?php echo $this->url->getBaseUri(); ?>admin";
            var static_url = "<?php echo $this->url->getStaticBaseUri(); ?>";
            window.onload = function() {
                // fix for windows 8
                if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                    document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="<?php echo $this->url->getStatic('plugins/admin-fix/windows.chrome.fix.css'); ?>" />'
            }
        </script>
    </head>
    <body class="fixed-header menu-pin">
        

<!-- BEGIN SIDEBAR -->
<div class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR HEADER -->
    <div class="sidebar-header">
        <img src="<?php echo $this->url->getStatic('assets/default/images/logo-cec-web.png'); ?>" alt="logo" class="brand" width="30" height="30">
        <div class="sidebar-header-controls">
            <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline" type="button"><i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR HEADER -->
    <!-- BEGIN SIDEBAR MENU -->
    <div class="sidebar-menu">
        <ul class="menu-items">
            <li class="m-t-30 active">
                <a href="<?php echo $this->url->get('admin/dashboard'); ?>" class="detailed">
                    <span class="title">Dashboard</span>
                    <span class="details">234 notifications</span>
                </a>
                <span class="icon-thumbnail "><i class="fa fa-dashboard"></i></span>
            </li>
            <?php echo $this->elements->getSidebar(); ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->

        <!-- START PAGE-CONTAINER -->
        <div class="page-container">
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

            <!-- START PAGE CONTENT WRAPPER -->
            <div class="page-content-wrapper">
                <!-- START PAGE CONTENT -->
                <div class="content">
                <div class="jumbotron" data-pages="parallax">
    <div class="container-fluid container-fixed-lg">
        <div class="inner">
            <?php if (isset($bc)) { ?>
            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <?php foreach ($bc as $b) { ?>
                    <?php if (($b['active'])) { ?>
                        <li><a href="javascript:void(0)" class="active"><?php echo $b['text']; ?></a></li>
                    <?php } else { ?>
                        <li>
                            <p><a href="<?php echo $b['link']; ?>"><?php echo $b['text']; ?></a></p>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <!-- END BREADCRUMB -->
            <?php } ?>
            
        </div>
    </div>
</div>

                
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg bg-white">
    <!-- BEGIN PlACE PAGE CONTENT HERE -->
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <?php if ($this->length($mySlugs) > 0) { ?>
            <div class="table-responsive">
                <form method="post" action="">
                <input type="hidden" name="<?php echo $this->security->getTokenKey(); ?>" value="<?php echo $this->security->getToken(); ?>" />
                <table class="table table-hover table-condensed" id="basicTable">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->query('th.slug'); ?></th>
                            <th style="width:20%"><?php echo $this->lang->query('th.model'); ?></th>
                            <th style="width:12%">
                                <a href="<?php echo $this->url->getBaseUri(); ?>admin/user?orderby=status&ordertype=<?php if (Phalcon\Text::lower($formData['orderType']) == 'desc') { ?>asc<?php } else { ?>desc<?php } ?><?php if ($formData['conditions']['keyword'] != '') { ?>&keyword=<?php echo $formData['conditions']['keyword']; ?><?php } ?>">
                                    <?php echo $this->lang->query('th.status'); ?>
                                </a>
                            </th>
                            <th style="width:12%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($mySlugs->items as $item) { ?>
                        <tr>
                            <td class="v-align-middle">
                                <?php echo $item->getObjectName(); ?> <br/>
                                <small><a href="#" class="edit-slug" data-type="text" data-pk="<?php echo $item->id; ?>"><?php echo $item->slug; ?></a></small>
                            </td>
                            <td class="v-align-middle"><?php echo $this->lang->query($item->getModelName()); ?></td>
                            <td class="v-align-middle"><span class="<?php echo $item->getStatusStyle(); ?>"><?php echo $this->lang->query($item->getStatusName()); ?></span></td>
                            <td class="v-align-middle">
                                <div class="btn-group btn-group-xs pull-right">
                                    <a href="<?php echo $this->url->get('admin/slug/edit/' . $item->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i>&nbsp; <?php echo $this->lang->query('td.edit'); ?></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
            <?php } else { ?>
                No data found.
            <?php } ?>
        </div>
        <div class="pull-right">
        <?php if (isset($paginator->items) && $paginator->total_pages > 1) { ?>
            
    <style type="text/css">
    .pagination li {
        font-size:12px;
        padding-left: 0;
    }
    </style>
    <ul class="pagination" style="margin:0 auto;">
        <?php $mid_range = 7; ?>

        <?php if ($paginator->total_pages > 1) { ?>
            <?php if ($paginator->current != 1) { ?>
                <?php $pageString = '<li>' . $this->tag->linkto('' . $paginateUrl . '&page=' . $paginator->before, '&laquo') . '</li>'; ?>
            <?php } else { ?>
                <?php $pageString = '<li style="display:none">' . $this->tag->linkto('#', '&laquo') . '</li>'; ?>
            <?php } ?>

            <?php $start_range = $paginator->current - floor(($mid_range / 2)); ?>
            <?php $end_range = $paginator->current + floor(($mid_range / 2)); ?>

            <?php if ($start_range <= 0) { ?>
                <?php $end_range = $end_range + abs(($start_range)) + 1; ?>
                <?php $start_range = 1; ?>
            <?php } ?>

            <?php if ($end_range > $paginator->total_pages) { ?>
                <?php $start_range = $start_range - ($end_range - $paginator->total_pages); ?>
                <?php $end_range = $paginator->total_pages; ?>
            <?php } ?>

            <?php $range = range($start_range, $end_range); ?>

            <?php foreach (range(1, $paginator->total_pages) as $i) { ?>
                <?php if ($this->isIncluded($i == 1 || $i == $paginator->total_pages || $i, $range)) { ?>
                    <?php if ($i == $paginator->current) { ?>
                        <?php $pageString = $pageString . '<li class="active">' . $this->tag->linkto('' . $paginateUrl . '&page=' . $i, '' . $i) . '</li>'; ?>
                    <?php } else { ?>
                        <?php $pageString = $pageString . '<li>' . $this->tag->linkto('' . $paginateUrl . '&page=' . $i, '' . $i) . '</li>'; ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

            <?php if ($paginator->current != $paginator->total_pages) { ?>
                <?php $pageString = $pageString . '<li>' . $this->tag->linkto('' . $paginateUrl . '&page=' . $paginator->next, '&raquo') . '</li>'; ?>
            <?php } else { ?>
                <?php $pageString = $pageString . '<li style="display:none">' . $this->tag->linkto('#', '&raquo') . '</li>'; ?>
            <?php } ?>

            <?php echo $pageString; ?>
        <?php } ?>
    </ul>

        <?php } ?>
        </div>
    </div>
    <!-- END PANEL -->
    <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">&nbsp;</div>
    </div>
</div>

                </div>
                <!-- END PAGE CONTENT -->
                <!-- START FOOTER -->
<div class="container-fluid container-fixed-lg footer">
    <div class="copyright sm-text-center">
        <p class="small no-margin pull-left sm-pull-reset">
            <span class="hint-text">Copyright © 2016</span>
            <span class="font-montserrat">SAIGONCEC Co.,Ltd</span>
        </span>
    </p>
    <div class="clearfix"></div>
</div>
</div>
<!-- END FOOTER -->
</div>
<!-- END PAGE CONTENT WRAPPER -->

        </div>
        <!-- END PAGE CONTAINER -->
        <!-- BEGIN PAGE LEVEL JS -->
        <script type="text/javascript" src="<?php echo $this->url->getStatic('plugins/boostrapv3/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $this->url->getStatic('min/index.php?g=jsDefaultCoreAdmin&rev=' . $this->config->global->version->js); ?>"></script>
        
    <script type="text/javascript" src="<?php echo $this->url->getStatic('min/index.php?g=jsDefaultSlugAdmin&rev=' . $this->config->global->version->js); ?>"></script>

    </body>
</html>

<?php if ($this->config->global->profiler === true) { ?>
<?php echo \Engine\Helper::getInstance('profiler', 'core')->render(); ?>
<?php } ?>
