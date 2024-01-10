<?php

/*
   Class: MuseaElatedClassMultipleImages
   A class that initializes Select Multiple Images
*/

class MuseaElatedClassMultipleImages implements iMuseaElatedInterfaceRender {
	private $name;
	private $label;
	private $description;
	
	function __construct( $name, $label = "", $description = "" ) {
		global $musea_elated_global_Framework;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$musea_elated_global_Framework->eltdMetaBoxes->addOption( $this->name, "" );
	}
	
	public function render( $factory ) {
		global $post;
		?>
		<div class="eltdf-page-form-section">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $this->label ); ?></h4>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<ul class="eltdf-gallery-images-holder clearfix">
								<?php
								$image_gallery_val = get_post_meta( $post->ID, $this->name, true );
								if ( $image_gallery_val != '' ) {
									$image_gallery_array = explode( ',', $image_gallery_val );
								}
								
								if ( isset( $image_gallery_array ) && count( $image_gallery_array ) != 0 ):
									foreach ( $image_gallery_array as $gimg_id ):
										$gimage_wp = wp_get_attachment_image_src( $gimg_id, 'thumbnail', true );
										echo '<li class="eltdf-gallery-image-holder"><img src="' . esc_url( $gimage_wp[0] ) . '"/></li>';
									endforeach;
								endif;
								?>
							</ul>
							<input type="hidden" value="<?php echo esc_attr( $image_gallery_val ); ?>" id="<?php echo esc_attr( $this->name ) ?>" name="<?php echo esc_attr( $this->name ) ?>">
							<div class="eltdf-gallery-uploader">
								<a class="eltdf-gallery-upload-btn btn btn-sm btn-primary" href="javascript:void(0)"><?php esc_html_e( 'Upload', 'musea' ); ?></a>
								<a class="eltdf-gallery-clear-btn btn btn-sm btn-default pull-right" href="javascript:void(0)"><?php esc_html_e( 'Remove All', 'musea' ); ?></a>
							</div>
							<?php wp_nonce_field( 'eltdf_gallery_upload_get_images_' . esc_attr( $this->name ), 'eltdf_gallery_upload_get_images_' . esc_attr( $this->name ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class MuseaElatedClassTwitterFramework implements iMuseaElatedInterfaceRender {
	public function render( $factory ) {
		$twitterApi = MuseaTwitterApi::getInstance();
		$message    = '';
		
		if ( ! empty( $_GET['oauth_token'] ) && ! empty( $_GET['oauth_verifier'] ) ) {
			if ( ! empty( $_GET['oauth_token'] ) ) {
				update_option( $twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token'] );
			}
			
			if ( ! empty( $_GET['oauth_verifier'] ) ) {
				update_option( $twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier'] );
			}
			
			$responseObj = $twitterApi->obtainAccessToken();
			if ( $responseObj->status ) {
				$message = esc_html__( 'You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.', 'musea' );
			} else {
				$message = $responseObj->message;
			}
		}
		
		$buttonText = $twitterApi->hasUserConnected() ? esc_html__( 'Re-connect with Twitter', 'musea' ) : esc_html__( 'Connect with Twitter', 'musea' );
		?>
		<?php if ( $message !== '' ) { ?>
			<div class="alert alert-success">
				<span><?php echo esc_html( $message ); ?></span>
			</div>
		<?php } ?>
		<div class="eltdf-page-form-section" id="eltdf_enable_social_share">
			<div class="eltdf-field-desc">
				<h4><?php esc_html_e( 'Connect with Twitter', 'musea' ); ?></h4>
				<p><?php esc_html_e( 'Connecting with Twitter will enable you to show your latest tweets on your site', 'musea' ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<a id="eltdf-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html( $buttonText ); ?></a>
							<input type="hidden" data-name="current-page-url" value="<?php echo esc_url( $twitterApi->buildCurrentPageURI() ); ?>"/>
							<?php wp_nonce_field( 'eltdf_twitter_connect_nonce', 'eltdf_twitter_connect_nonce' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
}

class MuseaElatedClassInstagramFramework implements iMuseaElatedInterfaceRender {
	public function render( $factory ) {
		$instagram_api = MuseaInstagramApi::getInstance();
		$message       = '';

		//check if code parameter and instagram parameter is set in URL
		if ( ! empty( $_GET['code'] ) && ! empty( $_GET['instagram'] ) ) {
			//update code option so we can use it later
			$instagram_api->setConnectionType('instagram');
			$instagram_api->instagramStoreCode();
			$instagram_api->instagramExchangeCodeForToken();
			$message = esc_html__( 'You have successfully connected with your Instagram Personal account.', 'musea' );
		}

		//check if code parameter and instagram parameter is set in URL
		if ( ! empty( $_GET['access_token'] ) && ! empty( $_GET['facebook'] ) ) {
			//update code option so we can use it later
			$instagram_api->setConnectionType('facebook');
			$instagram_api->facebookStoreToken();
			$message = esc_html__( 'You have successfully connected with your Instagram Business account.', 'musea' );
		}

		//check if code parameter and instagram parameter is set in URL
		if ( ! empty( $_GET['disconnect'] ) ) {
			//update code option so we can use it later
			$instagram_api->disconnect();
			$message = esc_html__( 'You have have been disconnected from all Instagram accounts.', 'musea' );

		}
		?>

		<?php if ( $message !== '' ) { ?>
			<div class="alert alert-success">
				<span><?php echo esc_html( $message ); ?></span>
			</div>
		<?php } ?>
		<div class="eltdf-page-form-section" id="eltdf_enable_social_share">
			<div class="eltdf-field-desc">
				<h4><?php esc_html_e( 'Connect with Instagram', 'musea' ); ?></h4>
				<p><?php esc_html_e( 'Connecting with Instagram will enable you to show your latest photos on your site', 'musea' ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<?php
					$instagram_user_id = get_option($instagram_api::INSTAGRAM_USER_ID);
					$connection_type   = get_option( $instagram_api::CONNECTION_TYPE );
					if ($instagram_user_id) { ?>
						<div class="row">
							<div class="col-lg-12">
								<p><?php echo esc_html__( 'You are currently connected to Instagram ID: ', 'musea' ); echo esc_attr($instagram_user_id) ?></p>
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<?php if ( ! empty( $_GET['disconnect'] ) ) { ?>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->reloadURL() ); ?>"><?php echo esc_html__( 'Reload Page', 'musea' ); ?></a>
							</div>
						<?php } else if ( empty( $connection_type ) ) { ?>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->instagramRequestCode() ); ?>"><?php echo esc_html__( 'Connect with Instagram Personal account', 'musea' ); ?></a>
							</div>
<!--							<div class="col-lg-4">-->
<!--								<a class="btn btn-primary" href="--><?php //echo esc_url( $instagram_api->facebookRequestCode() ); ?><!--">--><?php //echo esc_html__( 'Connect with Instagram Business account', 'musea' ); ?><!--</a>-->
<!--							</div>-->
						<?php } else { ?>
							<div class="col-lg-4">
								<a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->disconnectURL() ); ?>"><?php echo esc_html__( 'Disconnect Instagram account', 'musea' ) ?></a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
}

class MuseaElatedClassRepeater implements iMuseaElatedInterfaceRender {
	private $label;
	private $description;
	private $name;
	private $fields;
	private $num_of_rows;
	private $button_text;
	private $table_layout;
	
	function __construct( $fields, $name, $label = '', $description = '', $button_text = '', $table_layout = false ) {
		global $musea_elated_global_Framework;
		
		$this->label        = $label;
		$this->description  = $description;
		$this->fields       = $fields;
		$this->name         = $name;
		$this->num_of_rows  = 1;
		$this->button_text  = ! empty( $button_text ) ? $button_text : esc_html__( 'Add New Item', 'musea' );
		$this->table_layout = $table_layout;
		
		$counter = 0;
		foreach ( $this->fields as $field ) {
			
			if ( ! isset( $this->fields[ $counter ]['options'] ) ) {
				$this->fields[ $counter ]['options'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['args'] ) ) {
				$this->fields[ $counter ]['args'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['label'] ) ) {
				$this->fields[ $counter ]['label'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['description'] ) ) {
				$this->fields[ $counter ]['description'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['default_value'] ) ) {
				$this->fields[ $counter ]['default_value'] = '';
			}
			$counter ++;
		}
		
		$musea_elated_global_Framework->eltdMetaBoxes->addOption( $this->name, '' );
	}
	
	public function render( $factory ) {
		global $post;
		
		$clones          = array();
		$wrapper_classes = array();
		
		if ( ! empty( $post ) ) {
			$clones = get_post_meta( $post->ID, $this->name, true );
		}
		
		$sortable_class = 'sortable';
		
		foreach ( $this->fields as $field ) {
			if ( $field['type'] == 'textareahtml' ) {
				$sortable_class = '';
				break;
			}
		}
		
		if ( $this->table_layout ) {
			$wrapper_classes[] = 'eltdf-repeater-table';
		}
		?>
		<div class="eltdf-repeater-wrapper <?php echo implode( ' ', $wrapper_classes ) ?>">
			<?php if ( $this->label !== '' ) { ?>
				<h4><?php echo esc_attr( $this->label ); ?></h4>
			<?php } ?>
			<?php if ( $this->description != '' ) { ?>
				<p><?php echo esc_attr( $this->description ); ?></p>
			<?php } ?>
			<?php if ( $this->table_layout ) { ?>
				<div class="eltdf-repeater-table-heading">
					<div class="eltdf-repeater-fields-holder">
						<div class="eltdf-repeater-table-cell eltdf-repeater-sort"><?php esc_html_e( 'Order', 'musea' ) ?></div>
						<div class="eltdf-repeater-fields">
							<?php foreach ( $this->fields as $field ) {
								$col_width_class = 'col-xs-12';
								if ( ! empty( $field['col_width'] ) ) {
									$col_width_class = 'col-xs-' . $field['col_width'];
								} ?>
								<div class="eltdf-repeater-table-cell <?php echo esc_attr( $col_width_class ); ?>"><?php echo esc_html( $field['th'] ); ?></div>
							<?php } ?>
						</div>
						<div class="eltdf-repeater-table-cell eltdf-repeater-remove"><?php esc_html_e( 'Remove', 'musea' ) ?></div>
					</div>
				</div>
			<?php } ?>
			<div class="eltdf-repeater-wrapper-inner <?php echo esc_attr( $sortable_class ); ?>" data-template="<?php echo str_replace( '_', '-', $this->name ); ?>">
				<?php if ( ! empty( $clones ) && count( $clones ) > 0 ) {
					$counter = 0;
					foreach ( $clones as $clone ) {
						?>
						<div class="eltdf-repeater-fields-holder clearfix" data-index="<?php echo esc_attr( $counter ); ?>">
							<div class="eltdf-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<div class="eltdf-repeater-fields">
							<?php
								foreach ( $this->fields as $field ) {
									$col_width_class = 'col-xs-12';
									if ( ! empty( $field['col_width'] ) ) {
										$col_width_class = 'col-xs-' . $field['col_width'];
									}
									?>
									<div class="eltdf-repeater-fields-row <?php echo esc_attr( $col_width_class ); ?>">
										<div class="eltdf-repeater-fields-row-inner">
										<?php
											if ( $field['type'] == 'repeater' ) {
												
												$sortable_inner_class = 'sortable';
												foreach ( $field['fields'] as $field_inner ) {
													if ( $field_inner['type'] == 'textareahtml' ) {
														$sortable_inner_class = '';
														break;
													}
												} ?>
												<div class="eltdf-repeater-inner-wrapper">
													<div class="eltdf-repeater-inner-wrapper-inner <?php echo esc_attr( $sortable_inner_class ); ?>" data-template="<?php echo str_replace('_', '-', $field['name']); ?>">
														<h4><?php echo esc_attr($field['label']); ?></h4>
														<?php if($field['description'] != ''){ ?>
															<p><?php echo esc_attr($field['description']); ?></p>
														<?php } ?>
														<?php if (!empty($clone[$field['name']]) && count($clone[$field['name']]) > 0) {
															$counter2 = 0;

															foreach($clone[$field['name']] as $clone_inner) {
																?>
																<div class="eltdf-repeater-inner-fields-holder eltdf-second-level clearfix" data-index="<?php echo esc_attr($counter2); ?>">
																	<div class="eltdf-repeater-sort">
																		<i class="fa fa-sort"></i>
																	</div>
																	<div class="eltdf-repeater-inner-fields">
																		<?php
																		foreach ($field['fields'] as $field_inner) { 
																			$col_width_inner_class = 'col-xs-12';
																			if ( ! empty($field_inner['col_width']) ) {
																				$col_width_inner_class = 'col-xs-'.$field_inner['col_width'];
																			} ?>
																			<div class="eltdf-repeater-inner-fields-row <?php echo esc_attr( $col_width_inner_class ); ?>">
																				<div class="eltdf-repeater-inner-fields-row-inner">
																					<?php

																					if (!isset($field_inner['options'])) {
																						$field_inner['options'] = array();
																					}
																					if (!isset($field_inner['args'])) {
																						$field_inner['args'] = array();
																					}
																					if (!isset($field_inner['label'])) {
																						$field_inner['label'] =  '';
																					}
																					if (!isset($field_inner['description'])) {
																						$field_inner['description'] = '';
																					}
																					if (!isset($field_inner['default_value'])) {
																						$field_inner['default_value'] = '';
																					}

																					if($clone_inner[$field_inner['name']] == '' && $field_inner['default_value'] != ''){
																						$repeater_inner_field_value = $field_inner['default_value'];
																					} else {
																						$repeater_inner_field_value = $clone_inner[$field_inner['name']];
																					}

																					$containerClass = '';
																					$data = array();

																					if ( ! empty( $field_inner['dependency'] ) ) {
																						$dependencyValues = musea_elated_return_repeater_dependency_options_array(array(
																							'field' 	   => $field,
																							'repeaterName' => $this->name,
																							'counter' 	   => $counter,
																							'fieldInner'   => $field_inner,
																							'counter2' 	   => $counter2
																						));
																						$data 			  = $dependencyValues['data'];
																						$containerClass   = $dependencyValues['class'];
																					}
																			        ?>
																					<div class="<?php echo esc_attr($containerClass); ?>" <?php echo musea_elated_get_inline_attrs($data, true); ?>>
																						<?php
																							$factory->render($field_inner['type'], $field_inner['name'], $field_inner['label'], $field_inner['description'], $field_inner['options'], $field_inner['args'], array('name'=> $this->name . '['.$counter.']['.$field['name'].']', 'index' => $counter2, 'value' => $repeater_inner_field_value));
																						?>
																					</div>
																				</div>
																			</div>
																			<?php
																		} ?>
																	</div>
																	<div class="eltdf-repeater-remove">
																		<a class="eltdf-clone-inner-remove" href="#"><i class="fa fa-times"></i></a>
																	</div>
																</div>
																<?php $counter2++; } 
															} ?>
													</div>
													<div class="eltdf-repeater-inner-add">
														<a class="eltdf-inner-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr($this->num_of_rows) ?>" href="#"><?php echo esc_html($field['button_text']); ?></a>
													</div>
												</div>
											<?php
											} else {
												if($clone[$field['name']] == '' && $field['default_value'] != ''){
													$repeater_field_value = $field['default_value'];
												} else {
													$repeater_field_value = $clone[$field['name']];
												}

												$containerClass = '';
												$data = array();

												if ( ! empty( $field['dependency'] ) ) {
													$dependencyValues = musea_elated_return_repeater_dependency_options_array(array(
														'field' 		=> $field,
														'repeaterName' => $this->name,
														'counter' 		=> $counter
													));
													$data 			  = $dependencyValues['data'];
													$containerClass   = $dependencyValues['class'];
												}
										        ?>
												<div class="<?php echo esc_attr($containerClass); ?>" <?php echo musea_elated_get_inline_attrs($data, true); ?>>
												<?php
													$factory->render($field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], array('name'=> $this->name, 'index' => $counter, 'value' => $repeater_field_value));
													?>
												</div>
												<?php
											} ?>
										</div>
									</div>
							<?php } ?>
						</div>
						<div class="eltdf-repeater-remove">
							<a class="eltdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php $counter++; } } ?>
				<script type="text/html" id="tmpl-eltdf-repeater-template-<?php echo str_replace('_', '-', $this->name); ?>">
					<div class="eltdf-repeater-fields-holder <?php echo esc_attr( $sortable_class ); ?> clearfix"  data-index="{{{ data.rowIndex }}}">
						<div class="eltdf-repeater-sort">
							<i class="fa fa-sort"></i>
						</div>
						<div class="eltdf-repeater-fields">
							<?php
							foreach ($this->fields as $field) { 
								$col_width_class = 'col-xs-12';
								if ( ! empty($field['col_width']) ) {
									$col_width_class = 'col-xs-'.$field['col_width'];
								} ?>
								<div class="eltdf-repeater-fields-row <?php echo esc_attr($col_width_class);?>">
									<div class="eltdf-repeater-fields-row-inner">
										<?php
										if($field['type'] == 'repeater') { ?>
											<div class="eltdf-repeater-inner-wrapper">
												<div class="eltdf-repeater-inner-wrapper-inner" data-template="<?php echo str_replace('_', '-', $field['name']); ?>">
													<h4><?php echo esc_attr($field['label']); ?></h4>
													<?php if($field['description'] != ''){ ?>
														<p><?php echo esc_attr($field['description']); ?></p>
													<?php } ?>
												</div>
												<div class="eltdf-repeater-inner-add">
													<a class="eltdf-inner-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr($this->num_of_rows) ?>" href="#">
														<?php echo esc_html($field['button_text']); ?>
													</a>
												</div>
											</div>
										<?php } else {
											$containerClass = '';
											$data = array();
											
											if ( ! empty( $field['dependency'] ) ) {
												$dependencyValues = musea_elated_return_repeater_dependency_options_array( array(
													'field'             => $field,
													'repeaterName'      => $this->name,
													'counter'           => '{{{ data.rowIndex }}}',
													'newFieldDepedency' => true,
												) );
												$data             = $dependencyValues['data'];
												$containerClass   = $dependencyValues['class'];
											}
									        ?>
											<div class="<?php echo esc_attr($containerClass); ?>" <?php echo musea_elated_get_inline_attrs($data, true); ?>>
											<?php
												$repeater_template_field_value = ($field['default_value'] != '') ? $field['default_value'] : '';
												$factory->render($field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], array('name' => $this->name, 'index' => '{{{ data.rowIndex }}}', 'value' => $repeater_template_field_value));
											 ?>
									        </div> <?php
										} ?>
									</div>
								</div>
								<?php
							} ?>
						</div>
						<div class="eltdf-repeater-remove">
							<a class="eltdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
				</script>
				<?php 
				//add script if field type repeater
				foreach ($this->fields as $field) {
					if($field['type'] == 'repeater') {
					?>
					<script type="text/html" id="tmpl-eltdf-repeater-inner-template-<?php echo str_replace('_', '-', $field['name']); ?>">
						<div class="eltdf-repeater-inner-fields-holder eltdf-second-level clearfix" data-index="{{{ data.rowInnerIndex }}}">
							<div class="eltdf-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<div class="eltdf-repeater-inner-fields">
								<?php $counter2 = 0;
								foreach ($field['fields'] as $field_inner) { 
									$col_width_inner_class = 'col-xs-12';
									if ( ! empty($field_inner['col_width']) ) {
										$col_width_inner_class = 'col-xs-'.$field_inner['col_width'];
									} ?>
									<div class="eltdf-repeater-inner-fields-row <?php echo esc_attr($col_width_inner_class);?>">
										<div class="eltdf-repeater-fields-row-inner">
											<?php

											if (!isset($field_inner['options'])) {
												$field_inner['options'] = array();
											}
											if (!isset($field_inner['args'])) {
												$field_inner['args'] = array();
											}
											if (!isset($field_inner['label'])) {
												$field_inner['label'] =  '';
											}
											if (!isset($field_inner['description'])) {
												$field_inner['description'] = '';
											}
											if (!isset($field_inner['default_value'])) {
												$field_inner['default_value'] = '';
											}

											$containerClass = '';
											$data = array();
											
											if ( ! empty( $field_inner['dependency'] ) ) {
												$dependencyValues = musea_elated_return_repeater_dependency_options_array( array(
													'field'             => $field,
													'repeaterName'      => $this->name,
													'counter'           => '{{{ data.rowIndex }}}',
													'fieldInner'        => $field_inner,
													'counter2'          => '{{{ data.rowInnerIndex }}}',
													'newFieldDepedency' => true,
												) );
												$data             = $dependencyValues['data'];
												$containerClass   = $dependencyValues['class'];
											}
									        ?>
											<div class="<?php echo esc_attr($containerClass); ?>" <?php echo musea_elated_get_inline_attrs($data, true); ?>>
											<?php
												$repeater_inner_template_field_value = ($field_inner['default_value'] != '') ? $field_inner['default_value'] : '';
												$factory->render($field_inner['type'], $field_inner['name'], $field_inner['label'], $field_inner['description'], $field_inner['options'], $field_inner['args'], array('name'=> $this->name . '[{{{ data.rowIndex }}}]['.$field['name'].']', 'index' => '{{{ data.rowInnerIndex }}}', 'value' => $repeater_inner_template_field_value));
											?>
											</div>
										</div>
									</div>
									<?php
									$counter2++;	} ?>
							</div>
							<div class="eltdf-repeater-remove">
								<a class="eltdf-clone-inner-remove" href="#"><i class="fa fa-times"></i></a>
							</div>
						</div>
					</script>
					<?php }
				} ?>
			</div>
			<div class="eltdf-repeater-add">
				<a class="eltdf-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr( $this->num_of_rows ) ?>" href="#"><?php echo esc_html( $this->button_text ); ?></a>
			</div>
		</div>
		<?php
	}
}

class MuseaElatedClassFieldAddress extends MuseaElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $repeat = array() ) {
		$col_width = 12;
		if ( isset( $args["col_width"] ) ) {
			$col_width = $args["col_width"];
		}
		
		$suffix = ! empty( $args['suffix'] ) ? $args['suffix'] : false;
		
		$class = $id = $country = $lat_field = $long_field = '';
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id    = $name . '-' . $repeat['index'];
			$name  = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$value = $repeat['value'];
		} else {
			$id    = $name;
			$value = musea_elated_option_get_value( $name );
		}
		
		if ( $label === '' && $description === '' ) {
			$class .= ' eltdf-no-description';
		}
		
		if ( isset( $args['country'] ) && $args['country'] != '' ) {
			$country = $args['country'];
		}
		
		if ( isset( $args['latitude_field'] ) && $args['latitude_field'] != '' ) {
			$lat_field = $args['latitude_field'];
		}
		
		if ( isset( $args['longitude_field'] ) && $args['longitude_field'] != '' ) {
			$long_field = $args['longitude_field'];
		}
		?>
		<div class="eltdf-page-form-section eltdf-address-field <?php echo esc_attr( $class ); ?>" data-country="<?php echo esc_attr( $country ); ?>" data-lat-field="<?php echo esc_attr( $lat_field ); ?>" data-long-field="<?php echo esc_attr( $long_field ); ?>" id="eltdf_<?php echo esc_attr( $id ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
							<?php if ( $suffix ) : ?>
								<div class="input-group">
							<?php endif; ?>
								<input type="text" class="form-control eltdf-input eltdf-form-element" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( htmlspecialchars( $value ) ); ?>"/>
								<?php if ( $suffix ) : ?>
									<div class="input-group-addon"><?php echo esc_html( $args['suffix'] ); ?></div>
								<?php endif; ?>
							<?php if ( $suffix ) : ?>
								</div>
							<?php endif; ?>
							<?php
							$google_maps_api_key = musea_elated_options()->getOptionValue( 'google_maps_api_key' );
							if ( empty( $google_maps_api_key ) ) { ?>
								<p class="description"><?php esc_html_e( 'In order for the map functionality to be enabled please input the Google Map API key in the General section of the Musea Options', 'musea' ); ?></p>
							<?php } ?>
							<a class="eltdf-reset-marker eltdf-hide-field" href="#"><?php esc_html_e( 'Reset Marker', 'musea' ); ?></a>
							<div class="map_canvas"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class MuseaElatedClassFieldIcon extends MuseaElatedClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $repeat = array() ) {
		$class = '';
		
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id     = $name . '-' . $repeat['index'];
			$name   = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
			$rvalue = $repeat['value'];
		} else {
			$id     = $name;
			$rvalue = musea_elated_option_get_value( $name );
		}
		
		$select2 = '';
		if ( isset( $args['select2'] ) ) {
			$select2 = 'eltdf-select2';
		}
		$col_width = 3;
		if ( isset( $args['col_width'] ) ) {
			$col_width = $args['col_width'];
		}
		
		if ( $label === '' && $description === '' ) {
			$class .= ' eltdf-no-description';
		}
		
		$icon_packs        = musea_elated_icon_collections()->getIconCollectionsEmpty();
		$icons_collections = musea_elated_icon_collections()->getIconCollectionsKeys();
		?>
		<div class="eltdf-page-form-section <?php echo esc_attr( $class ); ?>" id="eltdf_<?php echo esc_attr( $id ); ?>">
			<div class="eltdf-field-desc">
				<h4><?php echo esc_html( $label ); ?></h4>
				<p><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="eltdf-section-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
							<select name="<?php echo esc_attr( $name ) . '[icon_pack]'; ?>" class="<?php echo esc_attr( $select2 ) ?> form-control eltdf-form-element icon-dependence">
								<?php foreach ( $icon_packs as $key => $value ) {
									if ( $key == "-1" ) {
										$key = "";
									} ?>
									<option <?php if ( ! empty( $rvalue ) && $rvalue['icon_pack'] == $key ) { echo "selected='selected'"; } ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<?php foreach ( $icons_collections as $icons_collection ) { ?>
						<?php
						$icons_param = musea_elated_icon_collections()->getIconCollectionParamNameByKey( $icons_collection );
						$field_class = ! empty( $rvalue ) && $rvalue['icon_pack'] == $icons_collection ? 'eltdf-show-field' : 'eltdf-hide-field';
						?>
						<div class="row eltdf-icon-collection-holder <?php echo esc_attr( $field_class ); ?>" data-icon-collection="<?php echo esc_attr( $icons_collection ); ?>">
							<div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
								<select name="<?php echo esc_attr( $name . '[' . $icons_param . ']' ); ?>" class="<?php echo esc_attr( $select2 ) ?> form-control eltdf-form-element">
									<?php
									$icons       = musea_elated_icon_collections()->getIconCollection( $icons_collection );
									$active_icon = $rvalue[ $icons_param ];
									foreach ( $icons->icons as $option => $key ) { ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php if ( $key == $active_icon ) { echo 'selected'; } ?>><?php echo esc_attr( $option ); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
}
