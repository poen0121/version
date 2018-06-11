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
		 * @param - string $anchorName (anchor file name at version directory) : Default void
		 * @return - string|boolean
		 * @usage - Object->get($dir,$limitMaxVersion,$anchorName);
		 */
		public function get($dir = null, $limitMaxVersion = '', $anchorName = '') {
			$result = false;
			if (!hpl_func_arg :: delimit2error() && !hpl_func_arg :: string2error(0) && !hpl_func_arg :: string2error(1) && !hpl_func_arg :: string2error(2)) {
				if (hpl_path :: is_absolute($dir) || (!hpl_path :: is_root_model($dir) && !hpl_path :: is_relative($dir))) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid argument by parameter 1', E_USER_WARNING, 1);
				}
				elseif (preg_match('/[\\\\:\/]/i', $anchorName)) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Unknown anchor file name', E_USER_WARNING, 1);
				}
				elseif ($limitMaxVersion != '' && !preg_match('/^([0-9]{1}|[1-9]{1}[0-9]*)*\.([0-9]{1}|[1-9]{1}[0-9]*)\.([0-9]{1}|[1-9]{1}[0-9]*)$/', $limitMaxVersion)) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid highest version number ' . $limitMaxVersion, E_USER_WARNING, 1);
				} else {
					clearstatcache();
					$relativeDir = hpl_path :: relative(hpl_path :: script($dir));
					$relativeDir = (substr($relativeDir, -1, 1) !== '/' ? $relativeDir . '/' : $relativeDir);
					if (is_dir($relativeDir)) {
						if ($limitMaxVersion && $this->labelTime == 0) {
							$result = ((isset ($anchorName { 0 }) ? is_file($relativeDir . $limitMaxVersion . '/' . $anchorName) : is_dir($relativeDir . $limitMaxVersion)) ? $limitMaxVersion : false);
						} else {
							if ($dh = opendir($relativeDir)) {
								$version = false;
								while (($file = readdir($dh)) !== false) {
									if (is_dir($relativeDir . $file) && preg_match('/^([0-9]{1}|[1-9]{1}[0-9]*)*\.([0-9]{1}|[1-9]{1}[0-9]*)\.([0-9]{1}|[1-9]{1}[0-9]*)$/', $file)) {
										if ($this->labelTime == 0) {
											$version = (!isset ($anchorName { 0 }) || (isset ($anchorName { 0 }) && is_file($relativeDir . $file . '/' . $anchorName)) ? (version_compare($file, $version) > 0 ? $file : $version) : $version);
										} else {
											$filemtime = filemtime($relativeDir . $file);
											if ($filemtime <= $this->labelTime) {
												$version = (!isset ($anchorName { 0 }) || (isset ($anchorName { 0 }) && is_file($relativeDir . $file . '/' . $anchorName)) ? (version_compare($file, $version) > 0 ? $file : $version) : $version);
											}
											if ($limitMaxVersion && version_compare($file, $limitMaxVersion) > 0 && $filemtime <= $this->labelTime) {
												touch($relativeDir . $file, $this->touchTime); //reset file mtime
											}
										}
									}
								}
								closedir($dh);
								$result = ($limitMaxVersion && $version ? ((isset ($anchorName { 0 }) ? is_file($relativeDir . $limitMaxVersion . '/' . $anchorName) : is_dir($relativeDir . $limitMaxVersion)) && filemtime($relativeDir . $limitMaxVersion) <= $this->labelTime ? $limitMaxVersion : false) : $version);
							}
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
		 * @param - string $anchorName (anchor file name at version directory) : Default void
		 * @return - boolean
		 * @usage - Object->is_exists($dir,$version,$anchorName);
		 */
		public function is_exists($dir = null, $version = null, $anchorName = '') {
			$result = false;
			if (!hpl_func_arg :: delimit2error() && !hpl_func_arg :: string2error(0) && !hpl_func_arg :: string2error(1) && !hpl_func_arg :: string2error(2)) {
				if (hpl_path :: is_absolute($dir) || (!hpl_path :: is_root_model($dir) && !hpl_path :: is_relative($dir))) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid argument by parameter 1', E_USER_WARNING, 1);
				}
				elseif (preg_match('/[\\\\:\/]/i', $anchorName)) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Unknown anchor file name', E_USER_WARNING, 1);
				}
				elseif (!preg_match('/^([0-9]{1}|[1-9]{1}[0-9]*)*\.([0-9]{1}|[1-9]{1}[0-9]*)\.([0-9]{1}|[1-9]{1}[0-9]*)$/', $version)) {
					hpl_error :: cast(__CLASS__ . '::' . __FUNCTION__ . '(): Invalid version number ' . $version, E_USER_WARNING, 1);
				} else {
					clearstatcache();
					$relativeDir = hpl_path :: relative(hpl_path :: script($dir));
					$relativeDir = (substr($relativeDir, -1, 1) !== '/' ? $relativeDir . '/' : $relativeDir);
					$result = (isset ($anchorName { 0 }) ? is_file($relativeDir . $version . '/' . $anchorName) : is_dir($relativeDir . $version));
				}
			}
			return $result;
		}
	}
}
?>