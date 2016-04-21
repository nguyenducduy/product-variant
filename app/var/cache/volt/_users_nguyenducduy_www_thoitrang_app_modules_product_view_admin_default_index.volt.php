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
        
    <link href="<?php echo $this->url->getStatic('min/index.php?g=cssDefaultProductAdmin&rev=' . $this->config->global->version->css); ?>" rel="stylesheet" type="text/css">

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
<div class="container-fluid container-fixed-lg bg-white" rel="user-admin">
    <!-- BEGIN PlACE PAGE CONTENT HERE -->
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="btn-group pull-right m-b-10">
                  <a href="<?php echo $this->url->get('admin/product/create'); ?>" class="btn btn-complete"><i class="fa fa-plus"></i>&nbsp; <?php echo $this->lang->query('default.button-create'); ?></a>
                </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php echo $this->getContent(); ?>
            <div class="table-responsive">
                <form method="post" action="">
                <input type="hidden" name="<?php echo $this->security->getTokenKey(); ?>" value="<?php echo $this->security->getToken(); ?>" />
                <table class="table table-hover table-condensed" id="basicTable">
                    <thead>
                        <tr>
                            <th style="width:7%">
                                <div class="checkbox check-danger">
                                  <input type="checkbox" value="checkall" id="checkall" class="check-all">
                                  <label for="checkall"></label>
                                </div>
                            </th>
                            <th style="width:50%"><?php echo $this->lang->query('th.name'); ?></th>
                            <th style="width:14%">
                                <?php echo $this->lang->query('th.vendorprice'); ?>
                            </th>
                            <th style="width:14%">
                                <?php echo $this->lang->query('th.sellprice'); ?>
                            </th>
                            <th style="width:10%">
                                <a href="<?php echo $this->url->getBaseUri(); ?>admin/product?orderby=status&ordertype=<?php if (Phalcon\Text::lower($formData['orderType']) == 'desc') { ?>asc<?php } else { ?>desc<?php } ?><?php if ($formData['conditions']['keyword'] != '') { ?>&keyword=<?php echo $formData['conditions']['keyword']; ?><?php } ?>">
                                    <?php echo $this->lang->query('th.status'); ?>
                                </a>
                            </th>
                            <th style="width:15%"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="bulk-actions">
                                    <select
                                        class="cs-select cs-skin-slide"
                                        data-init-plugin="cs-select"
                                        name="fbulkaction">
                                        <option value=""><?php echo $this->lang->query('default.select-action'); ?></option>
                                        <option value="delete"><?php echo $this->lang->query('default.select-delete'); ?></option>
                                    </select>
                                    <input type="submit" name="fsubmitbulk" class="btn btn-primary" value="<?php echo $this->lang->query('default.button-submit-bulk'); ?>" />
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($myProducts->items as $item) { ?>
                        <tr>
                            <td class="v-align-middle">
                                <input type="checkbox" name="fbulkid[]" value="<?php echo $item->id; ?>" <?php if (isset($formData['fbulkid'])) { ?><?php foreach ($formData['fbulkid'] as $key => $value) { if ($value == $item->id) { ?>checked="checked"<?php } ?><?php } ?><?php } ?> id="checkbox<?php echo $item->id; ?>"/>
                            </td>
                            <td class="v-align-middle">
                                <small class="pull-right">
                                    <i class="fa fa-fire"></i>&nbsp;<a href="#" class="ishot" data-name="ishot" data-type="select" data-pk="<?php echo $item->id; ?>" data-value="<?php echo $item->ishot; ?>"></a> &nbsp;
                                    <i class="fa fa-star"></i>&nbsp;<a href="#" class="isnew" data-name="isnew" data-type="select" data-pk="<?php echo $item->id; ?>" data-value="<?php echo $item->isnew; ?>"></a> &nbsp; | &nbsp;
                                    <a href="javascript:;" class="showVariant" id="<?php echo $item->id; ?>">Xem/Sửa biến thể</a>
                                </small>
                                <img src="<?php echo $this->url->getStatic($item->getThumbnailImage()); ?>" class="img-rounded" alt="<?php echo $item->getThumbnailImage(); ?>" width="60" height="60">
                                <small class="img-left-blk">
                                    <span class="label label-success"><?php echo $item->barcode; ?></span> <br/>
                                    <strong><?php echo $item->name; ?></strong> <br/>
                                    Số lượng còn: <span class="badge badge-default" id="quantity_<?php echo $item->id; ?>"><?php echo $item->quantity; ?><br/>
                                </small>
                            </td>
                            <td>
                                <?php echo number_format($item->vendorprice); ?> &#8363;
                            </td>
                            <td>
                                <span class="text-danger"><?php echo number_format($item->sellprice); ?> &#8363;</span>
                            </td>
                            <td class="v-align-middle"><span class="<?php echo $item->getStatusStyle(); ?>"><?php echo $this->lang->query($item->getStatusName()); ?></span></td>
                            <td class="v-align-middle">
                                <div class="btn-group btn-group-xs pull-right">
                                    <a href="<?php echo $this->url->get('admin/product/edit/' . $item->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i>&nbsp; <?php echo $this->lang->query('td.edit'); ?></a>
                                    <a href="javascript:deleteConfirm('<?php echo $this->url->get('admin/product/delete/' . $item->id); ?>', '<?php echo $item->id; ?>');" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
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
<div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5>Sản phẩm có nhiều phiên bản</h5>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-condensed" id="condensedTable">
                <thead>
                  <tr>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>

<style media="screen">
    .optionCover {
        width: 80px;
        height: 80px;
    }
     .dropzone {
        height: 80px;
        padding: 0px !important;
    }
     .dropzone .dz-preview, .dropzone-previews .dz-preview {
        padding: 0px !important;
        margin: 0px !important;
        width: 80px !important;
        height: 80px !important;
        font-size: 11px;
    }
     .dropzone .dz-preview .dz-details img, .dropzone-previews .dz-preview .dz-details img {
        width: 80px;
        height: 80px;
    }
     .dropzone .dz-preview .dz-details .dz-size, .dropzone-previews .dz-preview .dz-details .dz-size {
        bottom: 0px;
        left: 0px;
        line-height: 0;
    }
     .dropzone .dz-preview .dz-details .dz-filename, .dropzone-previews .dz-preview .dz-details .dz-filename {
        height: 20px;
    }
     .dropzone .dz-preview .dz-success-mark, .dropzone-previews .dz-preview .dz-success-mark, .dropzone .dz-preview .dz-error-mark, .dropzone-previews .dz-preview .dz-error-mark {
        right: 0;
        top: -3px;
    }
     .dropzone a.dz-remove, .dropzone-previews a.dz-remove {
        margin-top: -22px;
        width: 78px;
        border-radius: 0px;
        font-size: 10px;
    }
    .dropzone .dz-preview .dz-progress, .dropzone-previews .dz-preview .dz-progress {
        top: 45px;
    }
    .dropzone .dz-preview .dz-details, .dropzone-previews .dz-preview .dz-details {
        height: 53px;
    }
    .dropzone .dz-default.dz-message {
        top: 22%;
        left: 42%;
        display: block;
        margin-left: -14px;
        margin-top: -8px;
    }
    .dropzone .dz-default.dz-message span {
        display: block;
        font-size: 40px;
    }

</style>

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
        
    <script type="text/javascript" src="<?php echo $this->url->getStatic('min/index.php?g=jsDefaultProductAdmin&rev=' . $this->config->global->version->js); ?>"></script>

    </body>
</html>

<?php if ($this->config->global->profiler === true) { ?>
<?php echo \Engine\Helper::getInstance('profiler', 'core')->render(); ?>
<?php } ?>
