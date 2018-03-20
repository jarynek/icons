<?php

namespace Manager\files;


class Files {

	/**
	 * set Multiple Files
	 *
	 * @param $files
	 *
	 * @return array|bool
	 */
	private function setMultipleFiles( $files ) {
		if ( is_array( $files ) && ! empty( $files ) ) {
			$data = [];

			for ( $i = 0; $i < count( $files['name'] ); $i ++ ) {
				foreach ( array_keys( $files ) as $key ) {
					$data[ $i ][ $key ] = $files[ $key ][ $i ];
				}
			}

			return $data;
		}

		return false;
	}

	/**
	 * zip upload
	 * @param $files
	 */
	public function zipUpload( $files ) {
		if ( isset($files) &&  !empty($files)) {
			foreach ( $this->setMultipleFiles( $files['file'] ) as $key => $file ) {
				$target = FILE_UPLOAD . basename( $file['name'] );
				if ( move_uploaded_file( $file['tmp_name'], $target ) ) {
					echo 'byl nahrán soubor ' . $file['name'];
				} else {
					echo 'nic';
				}
			}
		}
	}

	/**
	 * unpack zip
	 */
	public function unpackZip() {

		foreach ( glob(FILE_UPLOAD . '*.zip') as $file ) {
			$zip = new \ZipArchive();
			if ( $zip->open( $file ) === true ) {
				$zip->extractTo( FILE_UPLOAD );
				$zip->close();
				unlink($file);
				echo 'ok';
			} else {
				echo 'failed';
			}
		}
	}

	/**
	 * @param string $file
	 */
	public function copyFile( $file ) {
		copy( $file, wp_upload_dir()['path'] . '/' . basename( $file ) );
	}

	/**
	 * clear dir
	 */
	public function clearDir()
	{
		$dirs = new \RecursiveDirectoryIterator(FILE_UPLOAD, \FilesystemIterator::SKIP_DOTS);
		$dirs = new \RecursiveIteratorIterator($dirs, \RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($dirs as $file => $info) {
			if(is_dir($info->getPathname())){
				rmdir($info->getPathname());
			}elseif (is_file($info->getPathname())){
				unlink($info->getPathname());
			}
		}
	}
}