<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 05.03.18
 * Time: 5:58
 */

namespace App\Controller;


use App\Service\AdminService;

class AdminController {

	protected $admin_service;

	public function __construct() {
		$this->admin_service = new AdminService();
	}

	/**
	 * icons action
	 */
	public function iconsAction()
	{
		$this->admin_service->sourceUpload();
		$this->admin_service->insertData();
		$this->admin_service->deleteSource();
	}
}