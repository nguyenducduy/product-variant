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
