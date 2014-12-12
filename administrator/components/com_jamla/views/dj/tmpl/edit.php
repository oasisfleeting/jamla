<?php
/**
 * @version     1.2.0
 * @package     com_speakers
 * @copyright   Jose Cuenca - 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jose Cuenca <jose@aviationmedia.aero> - http://www.aviationmedia.aero
 */
// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_speakers/assets/css/speakers.css');
//$mainframe = JFactory::getApplication();
//$
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function() {

	});
	Joomla.submitbutton = function(task)
	{
		if (task == 'speaker.cancel') {
			Joomla.submitform(task, document.getElementById('speaker-form'));
		}
		else {

			if (task != 'speaker.cancel' && document.formvalidator.isValid(document.id('speaker-form'))) {

				Joomla.submitform(task, document.getElementById('speaker-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jamla&task=dj.save&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="speaker-form" class="form-validate">

	<div class="form-horizontal">

		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('userid'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('userid'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('username'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('username'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('host'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('host'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('port'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('port'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('dbuser'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('dbuser'); ?></div>
					</div>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('dbpass'); ?></div>
						<div class="controls">
							<input type="password" name="jform[dbpass]" id="jform_dbpass" value="************" class="inputbox" maxlength="99" />
						</div>
					</div>

				</fieldset>
			</div>
		</div>
	</div>
	<?php
	echo $this->form->getInput('state');
	echo $this->form->getInput('checked_out');
	echo $this->form->getInput('checked_out_time');
	echo $this->form->getInput('params');
	?>
	<input type="hidden" name="task" value="dj.save" />
	<input type="hidden" name="id" value="<?php echo intval($this->item->id); ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>
