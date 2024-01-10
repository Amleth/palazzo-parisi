<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="eltdf-tags-holder">
    <div class="eltdf-tags">
        <?php the_tags('', ', ', ''); ?>
    </div>
</div>
<?php } ?>