<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 11.03.18
 * Time: 19:23
 */

namespace Manager\post;


class Post {

	/**
	 * set title
	 * @param $arg
	 *
	 * @return mixed
	 */
	public function setTitle($arg)
	{
		if(!$arg){
			return false;
		}
		return preg_replace('/\.JPG/', '', $arg);
	}

	/**
	 * set name
	 * @param $arg
	 *
	 * @return bool|null|string|string[]
	 */
	public function setName($arg)
	{
		if(!$arg){
			return false;
		}
		return preg_replace('/\.JPG/', '', $arg);
	}

	/**
	 * insert
	 * @param array $post
	 * @param bool $error
	 *
	 * @return int|\WP_Error
	 */
	public function insert($post, $error)
	{
		return wp_insert_post($post, $error);
	}

	/**
	 * update
	 * @param array $post
	 * @param bool $error
	 */
	public function update($post, $error)
	{
		wp_update_post($post, $error);
	}

	/**
	 * set category
	 * @param integer $postId
	 * @param integer $categoryId
	 * @param bool $append
	 *
	 * @return array|bool|false|\WP_Error
	 */
	public function setCategory($postId, $categoryId, $append)
	{
		if(!$postId && !$categoryId && !$append){
			return false;
		}
		return wp_set_post_categories( $postId, $categoryId, $append );
	}

	/**
	 * post attachment
	 * @param array $args
	 */
	public function attachment($args)
	{
		/**
		 * $filename should be the path to a file in the upload directory
		 */
		$fileName = wp_upload_dir()['path'] . '/' . basename( $args['file'] );

		/**
		 * Prepare an array of post data for the attachment
		 */
		$attachment = array(
			'guid'           => wp_upload_dir()['url'] . '/' . basename( $fileName ),
			'post_mime_type' => wp_check_filetype( basename( $args['file'] ), null )['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $fileName ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		/**
		 * Insert the attachment
		 */
		$attach_id = wp_insert_attachment( $attachment, $fileName, $args['ID'] );

		/**Make sure that this file is included, as wp_generate_attachment_metadata() depends on it. */
		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		/**
		 * Generate the metadata for the attachment, and update the database record
		 */
		$attach_data = wp_generate_attachment_metadata( $attach_id, $fileName );

		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_post_thumbnail( $args['ID'], $attach_id );
	}
}