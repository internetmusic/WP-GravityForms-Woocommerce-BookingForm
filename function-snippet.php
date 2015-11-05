<?php 

/*********START GRAVITY FORMS CUSTOM CHANGES*****************/
/* WRITTEN BY MICHAEL RYAN 11/05/2015 TORICAN@GMAIL.COM     */
/************************************************************/
add_filter( 'gform_pre_render_2', 'populate_form' ); //edit numerical to match gravity forms id
add_filter( 'gform_pre_validation_2', 'populate_form' ); //edit numerical to match gravity forms id
add_filter( 'gform_pre_submission_filter_2', 'populate_form' ); //edit numerical to match gravity forms id
add_filter( 'gform_admin_pre_render_2', 'populate_form' ); //edit numerical to match gravity forms id
function populate_form( $form ) {
	foreach ( $form['fields'] as &$field ) {
		if (  $field->cssClass == 'populate_student_tours'  ) { //edit css class to match field
			$choices = array();
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => '_stock_status',
						'value' => 'instock',
						'compare' => '='
					)
				),
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy'      => 'product_cat',
						'field'		=> 'term_id',
						'terms'         => '21', //woocommerce category
						'operator'      => 'IN'
					),
					array(
						'taxonomy'      => 'product_cat',
						'field'		=> 'term_id', 
						'terms'         => '22',//woocommerce category
						'operator'      => 'IN'
					),
					array(
						'taxonomy'      => 'product_cat',
						'field'		=> 'term_id', 
						'terms'         => '23',//woocommerce category
						'operator'      => 'IN'
					)					
				)
			);
			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					$product = new WC_Product( get_the_ID() );
					$choices[] = array( 'text' => $product->get_title(), 'price' => $product->price );
				endwhile;
			}
			wp_reset_postdata();		
			$field->placeholder = '- SELECT PACKAGE -';
			$field->choices = $choices;
		}	elseif ( $field->cssClass == 'populate-private-tours'  ) { 
			$choices = array();
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => '_stock_status',
						'value' => 'instock',
						'compare' => '='
					)
				),
				'tax_query' => array(
					array(
						'taxonomy'      => 'product_cat',
						'field' 	=> 'tag_id', 
						'terms'         => '28',
						'operator'      => 'IN' 
					)
				)
			);
			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					$product = new WC_Product( get_the_ID() );
					$choices[] = array( 'text' => $product->get_title(), 'price' => $product->price );
				endwhile;
			}
			wp_reset_postdata();		
			$field->placeholder = '- SELECT PACKAGE -';
			$field->choices = $choices;
		} elseif ( $field->cssClass == 'populate_regular_tours'  ) {
			$choices = array();
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => '_stock_status',
						'value' => 'instock',
						'compare' => '='
					)
				),
				'tax_query' => array(
					array(
						'taxonomy'      => 'product_cat',
						'field'		=> 'term_id',
						'terms'         => '26',
						'operator'      => 'IN'
					)
				)
			);
			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					$product = new WC_Product( get_the_ID() );
					$choices[] = array( 'text' => $product->get_title(), 'price' => $product->price );
				endwhile;
			}
			wp_reset_postdata();		
			$field->placeholder = '- SELECT PACKAGE -';
			$field->choices = $choices;
		}	
	}		
	return $form;
}
/********END GRAVITY FORMS ***********/

?>
