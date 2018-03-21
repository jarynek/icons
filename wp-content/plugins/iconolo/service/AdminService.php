<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 05.03.18
 * Time: 6:05
 */

namespace App\Service;

use http\Request\Request;
use Manager\files\Files;
use Manager\post\Post;
use Manager\category\Category;

class AdminService {

	protected $wpdb;
	protected $post;
	protected $request;
	protected $files;
	protected $category;

	public function __construct() {
		global $wpdb;
		$this->wpdb     = $wpdb;
		$this->post     = new Post();
		$this->request  = new Request();
		$this->files    = new Files();
		$this->category = new Category();
	}

	/**
	 * set post data
	 * @return array $data
	 */
	private function setPostData() {
		$data = [];
		foreach ( scandir( FILE_UPLOAD ) as $file ) {
			if ( $file !== '__MACOSX' && $file !== '.' && $file !== '..' ) {
				foreach ( glob( FILE_UPLOAD . $file . '/*' ) as $key => $item ) {
					$data[ $file ][ $key ]['post'] = [
						'post_author'           => get_current_user_id(),
						'post_content'          => 'petra',
						'post_content_filtered' => '',
						'post_title'            => $this->post->setTitle( basename( $item ) ),
						'post_excerpt'          => '',
						'post_status'           => 'publish',
						'post_type'             => 'post',
						'comment_status'        => '',
						'ping_status'           => '',
						'post_password'         => '',
						'to_ping'               => '',
						'pinged'                => '',
						'post_parent'           => 0,
						'menu_order'            => 0,
						'guid'                  => '',
						'import_id'             => 0,
						'context'               => ''
					];
					$data[ $file ][ $key ]['file'] = $item;
				}
			}
		}

		return $data;
	}

	/**
	 * source upload
	 */
	public function sourceUpload() {
		$this->files->zipUpload( $this->request->file( 'file' ) );
		$this->files->unpackZip();
	}

	/**
	 * insert data
	 */
	public function insertData() {

		foreach ( $this->setPostData() as $key => $dir ) {

			$categoryId = $this->category->insert( $key );

			foreach ( $dir as $keyItem => $item ) {

				/** @var  $name todo make as private method */
				$name  = str_replace( '.', '-', $item['post']['post_title'] );
				$match = $this->wpdb->get_results( "SELECT ID FROM {$this->wpdb->prefix}posts WHERE post_name = '{$name}' AND post_status = 'publish' " );

				if ( $match ) {
					$this->post->update( $item['post'], $wp_error = false );
					$item['ID'] = $match[0]->ID;
				} else {
					$item['ID'] = $this->post->insert( $item['post'], $wp_error = false );
					$this->post->setCategory( $item['ID'], $categoryId, true );
				}

				$this->files->copyFile( $item['file'] );
				$this->post->attachment( $item );
			}
		}
	}

	/**
	 * delete source
	 */
	public function deleteSource() {
		$this->files->clearDir();
	}
}