<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php single_post_title(); ?></title>
  </head>
  <body>
	<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			echo get_post_meta( get_the_ID(), '_wsuwp_embed_code', true );

		}
	}
	?>
  </body>
</html>
