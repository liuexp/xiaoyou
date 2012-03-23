<?php $diff = $activity->getTimestamp()->getFuzzyDifference(); ?>
<a href="<?php echo SITE_BASE; ?>/profile/<?php echo $activity->getProfileId(); ?>">
  <?php echo $activity->getRealname(); ?>
</a> <?php echo $diff; ?><?php echo ActivityHelper::action($activity->getType()); ?>