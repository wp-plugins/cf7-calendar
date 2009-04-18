<?php
/*
Plugin Name: Calendar for Contact Form 7
Plugin URI: http://webwoke.com/wp-plugins/calendar-for-contact-form-7.html
Description: Calendar for Contact Form 7
Author: Harry Sudana, I Nym
Version: 1.0.3
Author URI: http://webwoke.com/
*/

add_action('wp_head', 'FEloadjs', 1000);
add_filter('the_content', 'page_text_filter', 1001 );

	function FEloadjs(){
		$plugins_url = get_option('siteurl') . '/wp-content/plugins/'.plugin_basename(dirname(__FILE__));
		?>
		<style type="text/css">@import url(<?php echo $plugins_url; ?>/calendar-win2k-1.css);</style>
		<script type="text/javascript" src="<?php echo $plugins_url; ?>/calendar.js"></script>
		<script type="text/javascript" src="<?php echo $plugins_url; ?>/lang/calendar-en.js"></script>
		<script type="text/javascript" src="<?php echo $plugins_url; ?>/calendar-setup.js"></script>
		<?php
	}

	function page_text_filter($content) {
		$regex = '/\[datetimepicker\s(.*?)\]/';
		return preg_replace_callback($regex, 'page_text_filter_callback', $content);
	}

	function page_text_filter_callback($matches) {
		$string = "<input type=\"text\" name=\"".$matches[1]."\" id=\"".$matches[1]."\" /><button type=\"reset\" id=\"f_".$matches[1]."\">...</button>
		<script type=\"text/javascript\"> 
			Calendar.setup({
				inputField     :    \"".$matches[1]."\",      // id of the input field
				ifFormat       :    \"%A, %B %e, %Y\",       // format of the input field
				button         :    \"f_".$matches[1]."\",   // trigger for the calendar (button ID)
				singleClick    :    false,           // double-click mode
				step           :    1                // show all years in drop-down boxes (instead of every other year as default)
			});
		</script> 
		";
		return($string);
    }
?>