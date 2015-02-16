jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;

	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);

	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;

	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('#content')
      .append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
			.append('<div class="clr"></div>')
			// .append('<p id="articleLoad"><a href="#">Load More Posts</a></p>');

		// Remove the traditional navigation.
		// $('.navigation').remove();
	}


	/**
	 * Load new posts when the link is clicked.
	 */
	$('#articleLoad a').click(function() {

		// Are there more posts to load?
		if(pageNum <= max) {

			// Show that we're working.
			// $(this).text('Loading posts...');

			$('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .post',
				function() {
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);

					// Add a new placeholder, for when user clicks again.
					$('#articleLoad')
						.before('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')

					// Update the button message.
					if(pageNum <= max) {
						$('#articleLoad a').text('');
					} else {
            $('#articleLoad').append('<p class="center-align">No More Posts</p>');
						$('#articleLoad a span').removeClass('red');
					}
				}
			);
		} else {
			$('#articleLoad a').append('');
		}

		return false;
	});
});
