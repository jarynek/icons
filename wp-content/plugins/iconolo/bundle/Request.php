<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 06.03.18
 * Time: 5:35
 */

namespace http\Request;


class Request {

	public function file($arg)
	{
		try{
			if(isset($_FILES) && !empty($_FILES)){
				if(isset($arg)){
					return $_FILES[$arg];
				}else{
					return $_FILES;
				}
			}
		}catch (\Exception $exception){
			echo $exception->getMessage();
		}finally{
			return $_FILES;
		}
	}

	public function post($arg) {

		$request = [
			'post' => $_POST,
			'file' => $_FILES
		];

		if(isset($arg)){
			return $request[$arg];
		}
		return $request;
	}
}