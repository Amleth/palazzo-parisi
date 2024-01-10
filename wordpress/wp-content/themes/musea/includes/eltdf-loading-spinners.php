<?php

if ( ! function_exists( 'musea_elated_loading_spinners' ) ) {
	function musea_elated_loading_spinners() {
		$id           = musea_elated_get_page_id();
		$spinner_type = musea_elated_get_meta_field_intersect( 'smooth_pt_spinner_type', $id );
		
		$spinner_html = '';
		if ( ! empty( $spinner_type ) ) {
			switch ( $spinner_type ) {
				case 'musea_spinner':
					$spinner_html = musea_elated_loading_spinner_musea_spinner();
					break;
				case 'rotate_circles':
					$spinner_html = musea_elated_loading_spinner_rotate_circles();
					break;
				case 'pulse':
					$spinner_html = musea_elated_loading_spinner_pulse();
					break;
				case 'double_pulse':
					$spinner_html = musea_elated_loading_spinner_double_pulse();
					break;
				case 'cube':
					$spinner_html = musea_elated_loading_spinner_cube();
					break;
				case 'rotating_cubes':
					$spinner_html = musea_elated_loading_spinner_rotating_cubes();
					break;
				case 'stripes':
					$spinner_html = musea_elated_loading_spinner_stripes();
					break;
				case 'wave':
					$spinner_html = musea_elated_loading_spinner_wave();
					break;
				case 'two_rotating_circles':
					$spinner_html = musea_elated_loading_spinner_two_rotating_circles();
					break;
				case 'five_rotating_circles':
					$spinner_html = musea_elated_loading_spinner_five_rotating_circles();
					break;
				case 'atom':
					$spinner_html = musea_elated_loading_spinner_atom();
					break;
				case 'clock':
					$spinner_html = musea_elated_loading_spinner_clock();
					break;
				case 'mitosis':
					$spinner_html = musea_elated_loading_spinner_mitosis();
					break;
				case 'lines':
					$spinner_html = musea_elated_loading_spinner_lines();
					break;
				case 'fussion':
					$spinner_html = musea_elated_loading_spinner_fussion();
					break;
				case 'wave_circles':
					$spinner_html = musea_elated_loading_spinner_wave_circles();
					break;
				case 'pulse_circles':
					$spinner_html = musea_elated_loading_spinner_pulse_circles();
					break;
				default:
					$spinner_html = musea_elated_loading_spinner_pulse();
			}
		}

		print musea_elated_get_module_part( $spinner_html );
	}
}


if (!function_exists('musea_elated_loading_spinner_musea_spinner')) {
    function musea_elated_loading_spinner_musea_spinner() {
		$html = '';

		$image_gallery_valp = get_post_meta( musea_elated_get_page_id(), 'eltdf_gallery_spinner_images_meta', true );

		$image_gallery_array = explode( ',', $image_gallery_valp );

		$images_html = '';
		
		if ( isset( $image_gallery_array ) && count( $image_gallery_array ) > 0 ) {
			foreach ( $image_gallery_array as $gimg_id ):
				$images_html .= '<div>' . wp_get_attachment_image( $gimg_id, 'full' ) . '</div>';
			endforeach;
		}

		$html = '';
		$html .= '<div class="eltdf-musea-spinner">';
		$html .= '<div class="eltdf-musea-spinner-svg-holder">';
		$html .= '<svg class="eltdf-musea-spinner-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				width="92px" height="84px" viewBox="0 0 92 84" enable-background="new 0 0 92 84" xml:space="preserve">
		<rect x="1" y="1" fill="none" stroke="#4E4E4E" stroke-width="2" stroke-miterlimit="10" width="90" height="82"/>
		<polyline fill="none" stroke="#4E4E4E" stroke-width="2" stroke-linecap="square" stroke-linejoin="round" stroke-miterlimit="10" points="
			25.583,63.25 25.583,20 46.133,63.002 66.416,20 66.416,63.25 "/>
		</svg>';
		$html .= '</div>';
		$html .= '<div class="eltdf-musea-spinner-images-holder">';
		$html .= $images_html;
		$html .= '</div>';
		$html .= '</div>';

        return $html;
    }
}

if ( ! function_exists( 'musea_elated_loading_spinner_rotate_circles' ) ) {
	function musea_elated_loading_spinner_rotate_circles() {
		$html = '';
		$html .= '<div class="eltdf-rotate-circles">';
		$html .= '<div></div>';
		$html .= '<div></div>';
		$html .= '<div></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_pulse' ) ) {
	function musea_elated_loading_spinner_pulse() {
		$html = '<div class="pulse"></div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_double_pulse' ) ) {
	function musea_elated_loading_spinner_double_pulse() {
		$html = '';
		$html .= '<div class="double_pulse">';
		$html .= '<div class="double-bounce1"></div>';
		$html .= '<div class="double-bounce2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_cube' ) ) {
	function musea_elated_loading_spinner_cube() {
		$html = '<div class="cube"></div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_rotating_cubes' ) ) {
	function musea_elated_loading_spinner_rotating_cubes() {
		$html = '';
		$html .= '<div class="rotating_cubes">';
		$html .= '<div class="cube1"></div>';
		$html .= '<div class="cube2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_stripes' ) ) {
	function musea_elated_loading_spinner_stripes() {
		$html = '';
		$html .= '<div class="stripes">';
		$html .= '<div class="rect1"></div>';
		$html .= '<div class="rect2"></div>';
		$html .= '<div class="rect3"></div>';
		$html .= '<div class="rect4"></div>';
		$html .= '<div class="rect5"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_wave' ) ) {
	function musea_elated_loading_spinner_wave() {
		$html = '';
		$html .= '<div class="wave">';
		$html .= '<div class="bounce1"></div>';
		$html .= '<div class="bounce2"></div>';
		$html .= '<div class="bounce3"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_two_rotating_circles' ) ) {
	function musea_elated_loading_spinner_two_rotating_circles() {
		$html = '';
		$html .= '<div class="two_rotating_circles">';
		$html .= '<div class="dot1"></div>';
		$html .= '<div class="dot2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_five_rotating_circles' ) ) {
	function musea_elated_loading_spinner_five_rotating_circles() {
		$html = '';
		$html .= '<div class="five_rotating_circles">';
		$html .= '<div class="spinner-container container1">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container2">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container3">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_atom' ) ) {
	function musea_elated_loading_spinner_atom() {
		$html = '';
		$html .= '<div class="atom">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_clock' ) ) {
	function musea_elated_loading_spinner_clock() {
		$html = '';
		$html .= '<div class="clock">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_mitosis' ) ) {
	function musea_elated_loading_spinner_mitosis() {
		$html = '';
		$html .= '<div class="mitosis">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_lines' ) ) {
	function musea_elated_loading_spinner_lines() {
		$html = '';
		$html .= '<div class="lines">';
		$html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_fussion' ) ) {
	function musea_elated_loading_spinner_fussion() {
		$html = '';
		$html .= '<div class="fussion">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_wave_circles' ) ) {
	function musea_elated_loading_spinner_wave_circles() {
		$html = '';
		$html .= '<div class="wave_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'musea_elated_loading_spinner_pulse_circles' ) ) {
	function musea_elated_loading_spinner_pulse_circles() {
		$html = '';
		$html .= '<div class="pulse_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}
