<?php // REMOVE THIS LINE IF YOU'LL USE INTO THEME'S FUNCTION.PHP

/*
* CUSTOM DAILY VIDEO
*/

function get_youtube_video_urls_by_day() {
	// Array com as URLs dos vídeos do YouTube
	$video_urls = array(
		0 => 'https://www.youtube.com/watch?v=MKM90u7pf3U',
		1 => 'https://www.youtube.com/watch?v=E6M-XUW4xYY',
		2 => 'http://www.youtube.com/watch?v=ZIMfB0cHBu8',
		3 => 'https://www.youtube.com/watch?v=Di310WS8zLk',
		4 => 'https://www.youtube.com/watch?v=zZdVwTjUtjg',
		5 => 'https://youtube.com/watch?v=mGgMZpGYiy8',
		6 => 'https://www.youtube.com/watch?v=YDDHHrt6l4w',
	);
	
	// Get the current date from Wordpress
	$current_time = strtotime(current_time('mysql'));

	// Get the name of the day of the week in lowercase
	$day_of_week = date('w', $current_time);

	// Checks if the name of the day of the week is in the URL array
	if (isset($video_urls[$day_of_week])) {
		return $video_urls[$day_of_week];
	} else {
	// Returns a default URL if there is no URL corresponding to the day of the week
	return 'https://www.youtube.com/watch?v=nVqaintvwFg';
    }
}

function youtube_video_by_day_shortcode() {
    // Get the current day's video URL
    $video_url = get_youtube_video_urls_by_day();

    // HTML to show the video
    $output = $video_url;
    /*$output = '<div class="youtube-video">';
    $output .= '<iframe width="560" height="315" src="' . $video_url . '" frameborder="0" allowfullscreen></iframe>';
    $output .= '</div>'; */

    return $output;
}
add_shortcode('youtube_video_by_day', 'youtube_video_by_day_shortcode');
