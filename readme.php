<?php
/*
>> Information

	Title		: hpl_version function
	Revision	: 2.8.1
	Notes		: You can use chdir() change current script parent directories.

	Revision History:
	When			Create		When		Edit		Description
	---------------------------------------------------------------------------
	03-03-2016		Poen		03-03-2016	Poen		Create the program.
	08-18-2016		Poen		08-18-2016	Poen		Reforming the program.
	08-23-2016		Poen		08-23-2016	Poen		Modify path judgment.
	08-23-2016		Poen		08-23-2016	Poen		Change get_dir function name become get.
	08-23-2016		Poen		08-23-2016	Poen		Change get_label function name become label.
	09-08-2016		Poen		09-13-2016	Poen		Improve get function.
	09-08-2016		Poen		09-13-2016	Poen		Improve is_exists function.
	09-30-2016		Poen		09-30-2016	Poen		Debug clearstatcache().
	03-27-2017		Poen		03-27-2017	Poen		Fix __construct function error message.
	03-27-2017		Poen		03-27-2017	Poen		Fix get function error message.
	03-27-2017		Poen		03-27-2017	Poen		Fix is_exists function error message.
	04-06-2017		Poen		04-06-2017	Poen		Debug get function version compare.
	---------------------------------------------------------------------------

>> About

	GitHub : https://github.com/poen0121/version

	Version control directory.

	Mandatory labeling of the time control is not updated with the latest version of instant mention.

>> Usage Function

	==============================================================
	Include file
	Usage : include('version/main.inc.php');
	==============================================================

	==============================================================
	Create new Class.
	Usage : Object var name=new hpl_version($labelTime);
	Param : integer $labelTime (mandatory labeling directory edited time) : Default 0
	Note : $labelTime = 0 is unlimited.
	Return : object
	--------------------------------------------------------------
	Example :
	$hpl_version=new hpl_version();
	Example :
	$hpl_version=new hpl_version(time());
	==============================================================

	==============================================================
	Get version label unix timestamp.
	Usage : Object->label();
	Return : integer
	--------------------------------------------------------------
	Example :
	$hpl_version->label();
	==============================================================

	==============================================================
	Specify search directory to obtain version directory name based on the current script and document root.
	Usage : Object->get($dir,$limitMaxVersion);
	Param : string $dir (home directory path)
	Param : string $limitMaxVersion (limit maximum version) : Default void
	Return : string
	Return Note : Returns FALSE on failure.
	--------------------------------------------------------------
	Example :
	$hpl_version->get('./test');
	Example :
	$hpl_version->get('./test','1.0.6');
	==============================================================

	==============================================================
	Check the version of the directory exists specified search directory based on the current script and document root.
	Usage : Object->is_exists($dir,$version);
	Param : string $dir (home directory path)
	Param : string $version (check version)
	Return : boolean
	--------------------------------------------------------------
	Example :
	$hpl_version->is_exists('./test','1.0.1');
	==============================================================

>> Revision Rule

	[Main version number] . [Minor version number] . [Revision number]

	#Main version number:
	A major software updates for incremental , usually it refers to the time a major update function and interface has been a significant change.
	 
	#Minor version number:
	Software release new features , but does not significantly affect the entire software time increments.
	 
	#Revision number:
	Usually in the software have bug , bug fixes released incremented version.

	Example :
	Version : 0.0.0
	Version : 1.0.0
	Version : 1.0.1
	Version : 1.1.0
	Version : 2.0.0
	Version : 2.0.1
	Version : 2.1.0

>> Example

	$hpl_version=new hpl_version();
	$hpl_version->label();
	$hpl_version->get('./test');

*/
?>