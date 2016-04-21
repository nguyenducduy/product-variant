
<link rel="stylesheet" type="text/css" href="<?php echo $this->url->getStatic('plugins/profiler/profiler.css'); ?>">
<script type="text/javascript" src="<?php echo $this->url->getStatic('plugins/profiler/profiler.js'); ?>"></script>
<?php echo $this->partial('Profiler/window', array('name' => 'config', 'title' => 'Phalcon Config', 'content' => $htmlConfig)); ?>
<?php echo $this->partial('Profiler/window', array('name' => 'router', 'title' => 'Router', 'content' => $htmlRouter)); ?>
<?php echo $this->partial('Profiler/window', array('name' => 'memory', 'title' => 'Memory', 'content' => $htmlMemory)); ?>
<?php echo $this->partial('Profiler/window', array('name' => 'time', 'title' => 'Time', 'content' => $htmlTime)); ?>
<?php echo $this->partial('Profiler/window', array('name' => 'files', 'title' => 'Files', 'content' => $htmlFiles)); ?>
<?php echo $this->partial('Profiler/window', array('name' => 'sql', 'title' => 'SQL', 'content' => $htmlSql)); ?>
<?php echo $this->partial('Profiler/window', array('name' => 'errors', 'title' => 'Errors', 'content' => $htmlErrors)); ?>

<div class="profiler">
    <div data-window="router" class="item"><?php echo $handlerValues['router']; ?></div>
    <div data-window="memory" class="item item-right item-memory <?php echo $handlerValues['memory']['class']; ?>"><?php echo $handlerValues['memory']['value']; ?>
        kb
    </div>
    <div data-window="time" class="item item-right item-time <?php echo $handlerValues['time']['class']; ?>"><?php echo $handlerValues['time']['value']; ?>
        ms
    </div>
    <div data-window="files" class="item item-right item-files"><?php echo $handlerValues['files']; ?></div>
    <div data-window="sql" class="item item-right item-sql"><?php echo $handlerValues['sql']; ?></div>
    <div data-window="errors" class="item item-right item-errors <?php echo $handlerValues['errors']['class']; ?>"><?php echo $handlerValues['errors']['value']; ?></div>
</div>
