<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function backup_tables( $host, $user, $pass, $name, $tables = "*" )
{
	$link = mysql_connect( $host, $user, $pass );
	mysql_select_db( $name, $link );
	if ( $tables == "*" )
	{
		$tables = array( );
		$result = mysql_query( "SHOW TABLES" );
		while ( $row = mysql_fetch_row( $result ) )
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array( $tables ) ? $tables : explode( ",", $tables );
	}
	foreach ( $tables as $table )
	{
		$result = mysql_query( "SELECT * FROM ".$table );
		$num_fields = mysql_num_fields( $result );
		$return .= "DROP TABLE ".$table.";";
		$row2 = mysql_fetch_row( mysql_query( "SHOW CREATE TABLE ".$table ) );
		$return .= "\n\n".$row2[1].";\n\n";
		$i = 0;
		if ( $i < $num_fields )
		{
			do
			{
				do
				{
					do
					{
						++$i;
					} while ( 1 );
				} while ( !( $row = mysql_fetch_row( $result ) ) );
				$return .= "INSERT INTO ".$table." VALUES(";
				$j = 0;
				for ( ;	$j < $num_fields;	++$j	)
				{
					$row[$j] = addslashes( $row[$j] );
					$row[$j] = ereg_replace( "\n", "\\n", $row[$j] );
					if ( isset( $row[$j] ) )
					{
						$return .= "\"".$row[$j]."\"";
					}
					else
					{
						$return .= "\"\"";
					}
					if ( $j < $num_fields - 1 )
					{
						$return .= ",";
					}
				}
				$return .= ");\n";
			} while ( 1 );
		}
		$return .= "\n\n\n";
	}
	$handle = fopen( "db-backup-".date( "d_m_Y" ).".sql", "w+" );
	fwrite( $handle, $return );
	fclose( $handle );
	echo "ok!";
}

if ( $_GET['act'] == "backup" )
{
	backup_tables( "localhost", "nganhangsimsodep", "123456", "nganhangsimsodep", "nhapxuat" );
}
?>
