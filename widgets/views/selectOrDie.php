<?php
/**
 * Used by GmfuStatisticsWidget to display statistics in the sidebar.
 *
 * @package humhub.modules.gmfu.views
 * @since 0.5
 */
?>

<div class="panel panel-default members" id="course-panel">
    <?php $this->widget('application.widgets.PanelMenuWidget', array('id' => 'course-panel')); ?>
    <div class="panel-heading"><?php echo '<strong>Admin</strong> Stats'; ?></div>
    <div class="panel-body">
        <?php foreach ($newUsers as $user) : ?>
            <a href="<?php echo $user->getProfileUrl(); ?>">
                <img src="<?php echo $user->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                     height="40" width="40" alt="40x40" data-src="holder.js/40x40" style="width: 40px; height: 40px;"
                     data-toggle="tooltip" data-placement="top" title=""
                     data-original-title="<strong><?php echo $user->displayName; ?></strong><br><?php echo $user->profile->title; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="panel panel-default members" id="badge-panel">
    <?php $this->widget('application.widgets.PanelMenuWidget', array('id' => 'badge-panel')); ?>
    <div class="panel-heading"><?php echo '<strong>My</strong> Badges'; ?></div>
    <div class="panel-body">
        <?php foreach ($newUsers as $user) : ?>
            <a href="<?php echo $user->getProfileUrl(); ?>">
                <img src="<?php echo $user->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                height="40" width="40" alt="40x40" data-src="holder.js/40x40" style="width: 40px; height: 40px;"
                data-toggle="tooltip" data-placement="top" title=""
                data-original-title="<strong><?php echo $user->displayName; ?></strong><br><?php echo $user->profile->title; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>
<div class="panel panel-default" id="user-statistics-panel">
    <?php $this->widget('application.widgets.PanelMenuWidget', array('id' => 'user-statistics-panel')); ?>

    <div class="panel-heading"><?php echo '<strong>Course</strong> stats'; ?></div>
    <div class="panel-body">
        <div class="knob-container" style="text-align: center; opacity: 0;">
            <strong>Total Available Courses</strong><br><br>
            <input id="user-total" class="knob" data-width="120" data-displayprevious="true" data-readOnly="true"
                   data-fgcolor="#7191a8" data-skin="tron"
                   data-thickness=".2" value="<?php echo $statsTotalUsers; ?>"
                   data-max="<?php echo $statsTotalUsers; ?>"
                   style="font-size: 25px !important; margin-top: 44px !important;">
        </div><hr>
        <div class="knob-container" style="text-align: center; opacity: 0;">
            <strong>?????</strong><br><br>

            <input id="user-online" class="knob" data-width="120" data-displayprevious="true" data-readOnly="true"
                   data-fgcolor="#4cd9c0"
                   data-skin="tron"
                   data-thickness=".2" value="<?php echo $statsUserOnline; ?>"
                   data-max="<?php echo $statsTotalUsers; ?>"
                   style="font-size: 25px !important; margin-top: 44px !important;">
        </div>
    </div>
</div>

<script>
    $(function () {
        $(".knob").knob();
        $(".knob-container").css( "opacity", 1 );
    });

</script>
