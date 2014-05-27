<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage AgriFlex3
 */

// Get the search ID. Set default if not specified.

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'agriflex_do_search' );

function agriflex_do_search() {

	$search_id = get_field( 'google-search-id' );
	if ( empty( $search_id ) ) {
		$search_id = '000100048838736456753:esay0djx0qo';
	}
	ob_start();
	?>
	<div id='cse' style='width: 100%;'>Loading</div>
	<script src='//www.google.com/jsapi' type='text/javascript'></script>
	<script type='text/javascript'>
		google.load('search', '1', {language: 'en', style: google.loader.themes.V2_DEFAULT});
		google.setOnLoadCallback(function () {
			var customSearchOptions = {};
			var orderByOptions = {};
			orderByOptions['keys'] = [
				{label: 'Relevance', key: ''} ,
				{label: 'Date', key: 'date'}
			];
			customSearchOptions['enableOrderBy'] = true;
			customSearchOptions['orderByOptions'] = orderByOptions;
			var customSearchControl = new google.search.CustomSearchControl('<?php echo $search_id; ?>', customSearchOptions);
			customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
			var options = new google.search.DrawOptions();
			options.enableSearchResultsOnly();
			options.setAutoComplete(true);
			customSearchControl.draw('cse', options);
			function parseParamsFromUrl() {
				var params = {};
				var parts = window.location.search.substr(1).split('&');
				for (var i = 0; i < parts.length; i++) {
					var keyValuePair = parts[i].split('=');
					var key = decodeURIComponent(keyValuePair[0]);
					params[key] = keyValuePair[1] ?
						decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
						keyValuePair[1];
				}
				return params;
			}

			var urlParams = parseParamsFromUrl();
			var queryParamName = 's';
			if (urlParams[queryParamName]) {
				customSearchControl.execute(urlParams[queryParamName]);
			}
		}, true);
	</script>
	<?php
	$output = ob_get_clean();
	echo $output;

}

genesis();
