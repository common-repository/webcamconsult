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

$locale = explode('_', get_locale());


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Webcamconsult widgets</h2>
	<p>
	<a href="https://app.webcamconsult.com" target="__blank" class="button"><?=__('Naar dashboard', 'webcamconsult')?><span class="dashicons dashicons-external"></span></a>
	&nbsp;
	<a href="https://app.webcamconsult.com/spreekkamer" target="__blank" class="button"><?=__('Naar spreekkamer', 'webcamconsult');?> <span class="dashicons dashicons-external"></span></a>
	</p>
    <iframe id="webcamconsult-admin-iframe" src="https://login.webcamconsult.com/extwidgets?locale=<?=$locale[0];?>" scrolling="yes"></iframe>
</div>
<script>
	var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
	var eventer = window[eventMethod];
	var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

	// Listen to message from child window
	eventer(messageEvent, function (e) {
		if (e.data.client_id !== undefined) {
			var set_data = {
				'action': 'set_client_id',
				'client_id': e.data.client_id
			};
			jQuery.post(ajaxurl, set_data, function (response) {
				// new client id is set
			});
		}
	}, false);
</script>