<?php

class KokenGooglePlus extends KokenPlugin {

   function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('before_closing_body', 'render_js');
		$this->register_hook('discussion', 'render_div');
		$this->register_hook('discussion_count', 'render_count_div');
	}

	function render_div($item)
	{
		echo '<div id="google_comments"></div>';
	}

	function render_count_div($item)
	{
		echo '<div class="g-commentcount" data-href="{{ location.site_url }}{{ location.here }}"></div>';
	}

	function render_js()
	{
		$width = $this->data->width;
		if (!isset($width)) {
			$width = '0';
		}
		if ($width === '0') {
			$width = "document.getElementById('google_comments').offsetWidth";
		}
		
		echo <<<OUT
<script src="https://apis.google.com/js/plusone.js">
</script>
<script>
$(document).ready(function() {
	var w={$width};
	gapi.comments.render('google_comments', {
	    href: window.location,
	    width: w,
	    first_party_property: 'BLOGGER',
	    view_type: 'FILTERED_POSTMOD'
	});
});
</script>			
OUT;
	}
}
