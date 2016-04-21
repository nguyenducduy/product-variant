<span class="text-primary"><?php echo $title; ?>: </span>
<?php if (!(empty($tag))) { ?>
    <<?php echo $tag; ?> class="code"><?php echo $value; ?></<?php echo $tag; ?>>
<?php } elseif ($noCode == true) { ?>
    <?php echo $value; ?><br/>
<?php } else { ?>
    <span class="text-danger"><?php echo $value; ?></span>
    <br/>
<?php } ?>
