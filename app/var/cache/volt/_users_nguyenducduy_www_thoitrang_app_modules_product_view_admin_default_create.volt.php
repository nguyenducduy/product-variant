<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>
    <?php echo $this->lang->query('page-title-create'); ?> | <?php echo $this->config->global->title; ?>
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

                
<form
    role="form"
    method="post"
    action=""
    enctype="multipart/form-data">
    <input
        type="hidden"
        name="<?php echo $this->security->getTokenKey(); ?>"
        value="<?php echo $this->security->getToken(); ?>" />
    <div class="container-fluid container-fixed-lg bg-white">
        <div class="panel panel-transparent">
            <div class="panel-body">
                <?php echo $this->getContent(); ?>
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-group form-group-default required">
                            <label><?php echo $this->lang->query('form.name'); ?></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="name"
                                value="<?php if (isset($formData['name'])) { ?><?php echo $formData['name']; ?><?php } ?>"
                                required />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default">
                            <label><?php echo $this->lang->query('form.category'); ?></label>
                            <select
                                class="cs-select cs-skin-slide"
                                data-init-plugin="cs-select"
                                name="pcid">
                                <option value="1">----</option>
                                <?php foreach ($categories as $n => $cat) { ?>
                                    <option
                                        value="<?php echo $cat->id; ?>"
                                        <?php if (isset($formData['pcid']) && $formData['pcid'] == $cat->id) { ?>
                                        selected="selected"
                                        <?php } ?>>
                                        <?php echo str_repeat('-', $cat->level); ?> <?php echo $cat->name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default">
                            <label><?php echo $this->lang->query('form.status'); ?></label>
                            <select
                                class="cs-select cs-skin-slide"
                                data-init-plugin="cs-select"
                                name="status">
                                <?php foreach ($statusList as $status) { ?>
                                <option
                                    value="<?php echo $status['value']; ?>"
                                    <?php if (isset($formData['status']) && $formData['status'] == $status['value']) { ?>
                                        selected="selected"
                                    <?php } ?>>
                                    <?php echo $this->lang->query($status['name']); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group form-group-default input-group">
                            <label><?php echo $this->lang->query('form.vendorprice'); ?></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="vendorprice"
                                value="<?php if (isset($formData['vendorprice'])) { ?><?php echo $formData['vendorprice']; ?><?php } ?>"
                                 />
                            <span class="input-group-addon">&#8363;</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default input-group">
                            <label><?php echo $this->lang->query('form.sellprice'); ?></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="sellprice"
                                value="<?php if (isset($formData['sellprice'])) { ?><?php echo $formData['sellprice']; ?><?php } ?>"
                                 />
                            <span class="input-group-addon">&#8363;</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default input-group">
                            <label><?php echo $this->lang->query('form.discountpercent'); ?></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="discountpercent"
                                value="<?php if (isset($formData['discountpercent'])) { ?><?php echo $formData['discountpercent']; ?><?php } ?>"
                                 />
                            <span class="input-group-addon">&#37;</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default">
                            <label><?php echo $this->lang->query('form.barcode'); ?></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="barcode"
                                value="<?php if (isset($formData['barcode'])) { ?><?php echo $formData['barcode']; ?><?php } ?>"
                                 />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group form-group-default">
                            <label><?php echo $this->lang->query('form.seodescription'); ?></label>
                            <textarea
                                class="form-control"
                                placeholder=""
                                name="seodescription"
                                style="height:104px"><?php if (isset($formData['seodescription'])) { ?><?php echo $formData['seodescription']; ?><?php } ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->query('form.seokeyword'); ?></label>
                            <textarea
                                class="form-control tagsinput"
                                placeholder=""
                                name="seokeyword"><?php if (isset($formData['seokeyword'])) { ?><?php echo $formData['seokeyword']; ?><?php } ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->query('form.content'); ?></label>
                            <textarea
                                class="form-control"
                                placeholder=""
                                name="content"
                                id="summernote"><?php if (isset($formData['content'])) { ?><?php echo $formData['content']; ?><?php } ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><?php echo $this->lang->query('form.cover'); ?></label>
                            <div id="uploadCover" class="dropzone" style="min-height: 240px"></div>
                            <input
                                type="hidden"
                                name="image"
                                value="<?php if (isset($formData['image'])) { ?><?php echo $formData['image']; ?><?php } ?>"
                                id="uploadCoverInput"/>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->query('form.gallery'); ?></label>
                            <div id="uploadImages" class="dropzone" style="min-height: 240px"></div>
                            <div class="multipleFiles"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="javascript:;" class="btn btn-primary" id="addScnt"><i class="fa fa-plus"></i>&nbsp; <?php echo $this->lang->query('form.variant'); ?></a>
                        <div id="p_scents" class="m-t-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-lg">
        <div class="panel panel-transparent">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-3">
                            <span class="required">*</span>: <?php echo $this->lang->query('default.required'); ?>
                            </div>
                            <div class="col-sm-9">
                                <button class="btn btn-success" type="submit" name="fsubmit"><?php echo $this->lang->query('form.button-submit'); ?></button>
                                <button class="btn btn-default" type="reset"><i class="pg-close"></i> <?php echo $this->lang->query('form.button-clear'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div style="display:none" class="product-option-group">
    <select class="cs-select select-variant" name="optiongroup">
    <?php foreach ($productOptionGroup as $item) { ?>
        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
    <?php } ?>
    </select>
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
        
    <script type="text/javascript" src="<?php echo $this->url->getStatic('min/index.php?g=jsDefaultProductAdmin&rev=' . $this->config->global->version->js); ?>"></script>

    </body>
</html>

<?php if ($this->config->global->profiler === true) { ?>
<?php echo \Engine\Helper::getInstance('profiler', 'core')->render(); ?>
<?php } ?>
