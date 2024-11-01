<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.webswing.nl
 * @since      1.0.0
 *
 * @package    Webcamconsult
 * @subpackage Webcamconsult/admin/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
// If this file is called directly, abort.
if (!defined('WPINC'))
{
	die;
}


/**
 * Get and save current options
 */
if (isset($_POST['save']))
{
	if (isset($_POST['activate-inline-widget']))
	{
		update_option('webcamconsult-inline-widget', 1);
	}
	else
	{
		update_option('webcamconsult-inline-widget', 0);
	}
	if (isset($_POST['widget-id']))
	{
		update_option('webcamconsult-inline-widget-id', $_POST['widget-id']);
	}
}


$activate_checked = (get_option('webcamconsult-inline-widget')) ? 'checked' : '';
$widget_id = (get_option('webcamconsult-inline-widget-id')) ? get_option('webcamconsult-inline-widget-id') : '0';
?>
<div class="wrap">
    <h2>Webcamconsult inline widget</h2>
	<form method="post">
		<input type="hidden" name="save" value="1" />
		<table class="form-table">
			<tbody><tr>
					<th scope="row"><label for="actvate-inline-widget"><?=__('Activeer inline widget', 'webcamconsult');?></label></th>
					<td><input name="activate-inline-widget" type="checkbox" id="actvate-inline-widget" value="1" class="regular-checkbox" <?= $activate_checked ?>></td>
				</tr>

				<tr>
					<th scope="row"><label for="widget-id">Widget</label></th>
					<td>
						<select name="widget-id" id="widget-id">
							<option value="0">---</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Wijzigingen opslaan"></p></form>
</div>
<script>
	var data = {
		'action': 'get_widgets'
	};
	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function (response) {
		if (response !== '0') {
			// fill the widget selector
			var obj = jQuery.parseJSON(response);
			jQuery(obj).each(function (index, widgetObj) {
				// fill the selectors
				jQuery('#widget-id').append(jQuery('<option />').val(widgetObj._id).text(widgetObj.name));

			});
			jQuery('#widget-id').val('<?= $widget_id ?>').data('current');
		} else {
			//there are no widgets, or user id is undefined
		}
	});
</script>