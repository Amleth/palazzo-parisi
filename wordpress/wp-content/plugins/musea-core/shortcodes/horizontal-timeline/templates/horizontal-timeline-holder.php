<div class="eltdf-horizontal-timeline" data-distance="<?php echo esc_attr( $distance ); ?>">
	<div class="eltdf-ht-nav">
		<div class="eltdf-ht-nav-wrapper">
			<div class="eltdf-ht-nav-inner">
				<ol>
					<?php foreach ( $dates as $date ) { ?>
						<li>
							<a href="#" data-date="<?php echo esc_attr( $date['formatted'] ); ?>"><?php echo esc_html( $date['date_label'] ); ?></a>
						</li>
					<?php } ?>
				</ol>
				<span class="eltdf-ht-nav-filling-line" aria-hidden="true"></span>
			</div>
		</div>
		<ul class="eltdf-ht-nav-navigation">
			<li><a href="#" class="eltdf-prev eltdf-inactive"></a></li>
			<li><a href="#" class="eltdf-next"></a></li>
		</ul>
	</div>
	<div class="eltdf-ht-content">
		<ol>
			<?php echo do_shortcode( $content ); ?>
		</ol>
	</div>
</div>