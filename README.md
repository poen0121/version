# version
PHP Library ( PHP >= 5.2 ) CLI,CGI

> About

	Version control directory.

	Mandatory labeling of the time control is not updated with the latest version of instant mention.

> Learning Documents

	Please read `readme.php` document.

> Revision Rule

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

> Example

	$hpl_version=new hpl_version();
	$hpl_version->label();
	$hpl_version->get('./test');
