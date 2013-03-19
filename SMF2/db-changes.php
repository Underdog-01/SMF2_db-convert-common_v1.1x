<?php
/*
	<id>underdog:db-convert-common</id>
	<name>DB Common Collation & Engine</name>
	<version>1.1</version>
	<type>modification</type>
*/	

/* This file is for converting a database to a common collation & charset */
/* Imo the root charset should be common (ie. utf8) */
/* Backup your database prior to using this modification and/or running this script */ 

/* START - Mysql changes  */
SMF_adjust_tables();

/* Adjust SMF tables to common Collation & Engine type*/
function SMF_adjust_tables()
{
	global $smcFunc, $db_name;

	/* Query all tables */
	$result = $smcFunc['db_query']('',"SHOW TABLES FROM {$db_name}");
	while ($row = $smcFunc['db_fetch_row']($result)) 
    		$tables[] = $row[0];

	$smcFunc['db_free_result']($result);	

	/* Query Engine & Collation of the SMF settings table */
	$result = $smcFunc['db_query']('', "SHOW TABLE STATUS FROM `$db_name`");
	while ($val = $smcFunc['db_fetch_assoc']($result))
	{
		$engine = $val['Engine'];
		$collation = $val['Collation'];
		$charsetx = explode('_', $val['Collation']);
		$charset = $charsetx[0];          
	}
	$smcFunc['db_free_result']($result);
	
	foreach ($tables as $table)
	{
		if (!$table)
			continue;
			
		$alterTable = $smcFunc['db_query']('', "ALTER TABLE {$db_name}.{$table} CONVERT TO CHARACTER SET {$charset} COLLATE {$collation}");
		$alterTable = $smcFunc['db_query']('', "ALTER TABLE {$db_name}.{$table} ENGINE = {$engine}");
	}		
}	
/* END - Mysql changes  */
?>