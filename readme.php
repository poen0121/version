<?php
/*
>> Information

	Title		: hpl_version function
	Revision	: 2.9.4
	Notes		: You can use chdir() change current script parent directories.

	Revision History:
	When			Create		When		Edit		Description
	---------------------------------------------------------------------------
	03-03-2016		Poen		03-03-2016	Poen		Create the program.
	08-18-2016		Poen		08-18-2016	Poen		Reforming the program.
	08-23-2016		Poen		08-23-2016	Poen		Modify path judgment.
	08-23-2016		Poen		08-23-2016	Poen		Change get_dir function name become get.
	08-23-2016		Poen		08-23-2016	Poen		Change get_label function name become label.
	09-08-2016		Poen		12-22-2017	Poen		Improve get function.
	09-08-2016		Poen		09-13-2016	Poen		Improve is_exists function.
	09-30-2016		Poen		09-30-2016	Poen		Debug clearstatcache().
	03-27-2017		Poen		03-27-2017	Poen		Fix __construct function error message.
	03-27-2017		Poen		03-27-2017	Poen		Fix get function error message.
	03-27-2017		Poen		03-27-2017	Poen		Fix is_exists function error message.
	04-06-2017		Poen		04-06-2017	Poen		Debug get function version compare.
	12-22-2017		Poen		12-22-2017	Poen		Fix get function version compare.
	02-06-2018		Poen		02-06-2018	Poen		Fix PHP 7 content function to retain original input args.
	06-04-2018		Poen		06-04-2018	Poen		Add the anchor file judgment mechanism.
	06-11-2018		Poen		06-11-2018	Poen		Fix the anchor file judgment mechanism.
	---------------------------------------------------------------------------

>> About

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
	Usage : Object->get($dir,$limitMaxVersion,$anchorName);
	Param : string $dir (home directory path)
	Param : string $limitMaxVersion (limit maximum version) : Default void
	Param : string $anchorName (anchor file name at version directory) : Default void
	Return : string
	Return Note : Returns FALSE on failure.
	--------------------------------------------------------------
	Example :
	$hpl_version->get('./test');
	Example :
	$hpl_version->get('./test','1.0.6');
	Example :
	$hpl_version->get('./test','1.0.6','anchor.php');
	Example :
	$hpl_version->get('./test','','anchor.php');
	==============================================================

	==============================================================
	Check the version of the directory exists specified search directory based on the current script and document root.
	Usage : Object->is_exists($dir,$version,$anchorName);
	Param : string $dir (home directory path)
	Param : string $version (check version)
	Param : string $anchorName (anchor file name at version directory) : Default void
	Return : boolean
	--------------------------------------------------------------
	Example :
	$hpl_version->is_exists('./test','1.0.1');
	Example :
	$hpl_version->is_exists('./test','1.0.1','anchor.php');
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