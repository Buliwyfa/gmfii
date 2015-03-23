<?php
/**
 * Used by SpaceStatisticsWidget to display statistics in the sidebar.
 *
 * @package humhub.modules.gmfu.views
 * @since 0.5
 */

$form = $this->beginWidget('CActiveForm', array(
'id' => 'home-newsletter-form',
'enableAjaxValidation' => false,
'enableClientValidation' => true,
));
?>
<div class="pm-step">
    <p>What is your name?</p>

</div>
<div class="pm-step">
    <p>Could you fill in your e-mail adress please?</p>
</div>
<div class="pm-step">
    <p>Is there something you would like to say?<br /><span class="muted">Protip: <code>shift + return</code> for a new line.</span></p>
    <textarea name="body" autocomplete="off"></textarea>
</div>
<?
echo $form->textField($newsletterSubscribeForm, 'email');
echo $form->error($newsletterSubscribeForm, 'email');
echo CHtml::link("subscribe", "#", array('class'=>'btSubscribe'));
?>
<p class="progress-bar">
<span class="bar"></span>
</p>

<p class="muted"><input type="button" id="navigation" value="Next step" /> or press tab</p>
<?
$this->endWidget();
?>

<script type="text/javascript">
// Cache the form
var $form = $('#form');

// Stuff for the progress bar
var $bar = $('.progress-bar .bar');
var steps = $('.pm-step').length;

// Initialize Promin
$form.promin({
    // Want to update the bar on every change
    events: {
        change: function(i) {
            $bar.css('width', (i / steps * 100) + '%');
        }
    }
});

// Tell the button to go to the next step
$('#navigation').on('click', function() {
    $form.promin('next');
});
</script>
