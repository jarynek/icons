<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 17.03.18
 * Time: 12:00
 */

namespace Manager\category;


class Category {


	/**
	 * insert category
 	 * @param string $name
	 *
	 * @return mixed
	 */
	public function insert($name) {

		if(term_exists( $name, 'category', 0 )){
			return term_exists( $name, 'category', 0 )['term_id'];
		}

		$cat = array(
			'cat_ID'               => 0,
			'cat_name'             => $name,
			'category_description' => $name,
			'category_nicename'    => $name,
			'category_parent'      => '',
			'taxonomy'             => 'category'
		);

		return wp_insert_category( $cat, $wp_error = false );
	}
}