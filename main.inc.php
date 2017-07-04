<?php
if (!class_exists('hpl_version')) {
	include (strtr(dirname(__FILE__), '\\', '/') . '/system/path/main.inc.php');
	/**
	 * @about - version control directory.
	 * @param - integer $labelTime (mandatory labeling directory edited time) : Default 0
	 * @return - object
	 * @usage - Object var name=new hpl_version($labelTime);
	 */
	class hpl_version {
		private $touchTime;
		private $labelTime;
		function __construct($labelTime = 0) {
			$this->labelTime = 0;
			$this->touchTime = time();
			if (!hpl_func_arg :: delimit2error() && !hpl_func_arg :: int2error(0)) {
				if ($labelTime < 0) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): The parameter 1 number should be >= 0', E_USER_WARNING, 1);
				} else {
					$this->labelTime = $labelTime;
				}
			}
		}
		/** Get version label unix timestamp.
		 * @access - public function
		 * @return - integer|boolean
		 * @usage - Object->label();
		 */
		public function label() {
			if (!hpl_func_arg :: delimit2error()) {
				return $this->labelTime;
			}
			return false;
		}
		/** Specify search directory to obtain version directory name based on the current script and document root.
		 * @access - public function
		 * @param - string $dir (home directory path)
		 * @param - string $limitMaxVersion (limit maximum version) : Default void
		 * @return - string|boolean
		 * @usage - Object->get($dir,$limitMaxVersion);
		 */
		public function get($dir = null, $limitMaxVersion = '') {
			$result = false;
			if (!hpl_func_arg :: delimit2error() && !hpl_func_arg :: string2error(0) && !hpl_func_arg :: string2error(1)) {
				if (hpl_path :: is_absolute($dir) || (!hpl_path :: is_root_model($dir) && !hpl_path :: is_relative($dir))) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid argument by parameter 1', E_USER_WARNING, 1);
				}
				elseif ($limitMaxVersion != '' && !preg_match('/^([0-9]{1}|[1-9]{1}[0-9]*)*\.([0-9]{1}|[1-9]{1}[0-9]*)\.([0-9]{1}|[1-9]{1}[0-9]*)$/', $limitMaxVersion)) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid highest version number ' . $limitMaxVersion, E_USER_WARNING, 1);
				} else {
					clearstatcache();
					$dir = hpl_path :: relative(hpl_path :: script($dir));
					$dir = (substr($dir, -1, 1) !== '/' ? $dir . '/' : $dir);
					if (is_dir($dir)) {
						if ($dh = opendir($dir)) {
							$version = false;
							$maxVersion = false;
							while (($file = readdir($dh)) !== false) {
								if (is_dir($dir . $file) && preg_match('/^([0-9]{1}|[1-9]{1}[0-9]*)*\.([0-9]{1}|[1-9]{1}[0-9]*)\.([0-9]{1}|[1-9]{1}[0-9]*)$/', $file)) {
									$filemtime = filemtime($dir . $file);
									if (!$maxVersion && ($this->labelTime == 0 || $filemtime <= $this->labelTime)) {
										$version = (version_compare($file, $version) > 0 ? $file : $version);
									}
									if ($limitMaxVersion) {
										if (!$maxVersion && version_compare($version, $limitMaxVersion) > 0) {
											$maxVersion = true;
											$version = (is_dir($dir . $limitMaxVersion) ? $limitMaxVersion : false);
										}
										if (version_compare($file, $limitMaxVersion) > 0 && $this->labelTime > 0 && $filemtime <= $this->labelTime) {
											touch($dir . $file, $this->touchTime); //reset file mtime
										}
									}
								}
							}
							closedir($dh);
							$result = $version;
						}
					}
				}
			}
			return $result;
		}
		/** Check the version of the directory exists specified search directory based on the current script and document root.
		 * @access - public function
		 * @param - string $dir (home directory path)
		 * @param - string $version (check version)
		 * @return - boolean
		 * @usage - Object->is_exists($dir,$version);
		 */
		public function is_exists($dir = null, $version = null) {
			$result = false;
			if (!hpl_func_arg :: delimit2error() && !hpl_func_arg :: string2error(0) && !hpl_func_arg :: string2error(1)) {
				if (hpl_path :: is_absolute($dir) || (!hpl_path :: is_root_model($dir) && !hpl_path :: is_relative($dir))) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid argument by parameter 1', E_USER_WARNING, 1);
				}
				elseif (!preg_match('/^([0-9]{1}|[1-9]{1}[0-9]*)*\.([0-9]{1}|[1-9]{1}[0-9]*)\.([0-9]{1}|[1-9]{1}[0-9]*)$/', $version)) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid version number ' . $version, E_USER_WARNING, 1);
				} else {
					clearstatcache();
					$dir = hpl_path :: relative(hpl_path :: script($dir));
					$dir = (substr($dir, -1, 1) !== '/' ? $dir . '/' : $dir);
					$result = is_dir($dir . $version);
				}
			}
			return $result;
		}
	}
}
?>