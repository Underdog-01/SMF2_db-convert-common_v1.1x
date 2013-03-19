<?php
/*
    <id>underdog:db-convert-common</id>
	<name>DB Common Collation & Engine</name>
	<version>1.1</version>
	<type>modification</type>
*/	

/* This file simply deletes the package from your packages list */

/* START - Package remover  */
SMF_remove_db_package();

/* Remove the package */
function SMF_remove_db_package()
{
	global $boarddir;

	if (@file_exists($boarddir. '/Packages/db-convert-common_v1.0x.zip'))
		@unlink($boarddir. '/Packages/db-convert-common_v1.0x.zip');
}	
/* END - Package remover */
?>