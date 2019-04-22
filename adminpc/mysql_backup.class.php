<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

class mysql_backup
{

	public $host = NULL;
	public $db = NULL;
	public $user = NULL;
	public $pass = NULL;
	public $output = NULL;
	public $structure_only = NULL;
	public $fptr = NULL;

	public function mysql_backup( $host, $db, $user, $pass, $output, $structure_only )
	{
		set_time_limit( 120 );
		$this->host = $host;
		$this->db = $db;
		$this->user = $user;
		$this->pass = $pass;
		$this->output = $output;
		$this->structure_only = $structure_only;
	}

	public function _Mysqlbackup( $host, $dbname, $uid, $pwd, $output, $structure_only )
	{
		if ( strval( $this->output ) != "" )
		{
			$this->fptr = fopen( $this->output, "w" );
		}
		else
		{
			$this->fptr = FALSE;
		}
		$con = mysql_connect( $this->host, $this->user, $this->pass );
		$db = mysql_select_db( $dbname, $con );
		$res = mysql_list_tables( $dbname );
		$nt = mysql_num_rows( $res );
		$a = 0;
		for ( ;	$a < $nt;	++$a	)
		{
			$row = mysql_fetch_row( $res );
			$tablename = $row[0];
			$sql = "create table ".$tablename."\n(\n";
			$res2 = mysql_query( "select * from ".$tablename, $con );
			$nf = mysql_num_fields( $res2 );
			$nr = mysql_num_rows( $res2 );
			$fl = "";
			$b = 0;
			for ( ;	$b < $nf;	++$b	)
			{
				$fn = mysql_field_name( $res2, $b );
				$ft = mysql_fieldtype( $res2, $b );
				$fs = mysql_field_len( $res2, $b );
				$ff = mysql_field_flags( $res2, $b );
				$sql .= "    ".$fn." ";
				$is_numeric = FALSE;
				switch ( strtolower( $ft ) )
				{
				case "int" :
					$sql .= "int";
					$is_numeric = TRUE;
					break;
				case "blob" :
					$sql .= "text";
					$is_numeric = FALSE;
					break;
				case "real" :
					$sql .= "real";
					$is_numeric = TRUE;
					break;
				case "string" :
					$sql .= "char(".$fs.")";
					$is_numeric = FALSE;
					break;
				case "unknown" :
					switch ( intval( $fs ) )
					{
					case 4 :
						$sql .= "tinyint";
						$is_numeric = TRUE;
						break;
					default :
						$sql .= "int";
						$is_numeric = TRUE;
					}
					break;
				case "timestamp" :
					$sql .= "timestamp";
					$is_numeric = TRUE;
					break;
				case "date" :
					$sql .= "date";
					$is_numeric = FALSE;
					break;
				case "datetime" :
					$sql .= "datetime";
					$is_numeric = FALSE;
					break;
				case "time" :
					$sql .= "time";
					$is_numeric = FALSE;
					break;
				default :
					$sql .= $ft;
					$is_numeric = TRUE;
				}
				if ( strpos( $ff, "unsigned" ) && $ft != "timestamp" )
				{
					$sql .= " unsigned";
				}
				if ( strpos( $ff, "zerofill" ) && $ft != "timestamp" )
				{
					$sql .= " zerofill";
				}
				if ( strpos( $ff, "auto_increment" ) )
				{
					$sql .= " auto_increment";
				}
				if ( strpos( $ff, "not_null" ) )
				{
					$sql .= " not null";
				}
				if ( strpos( $ff, "primary_key" ) )
				{
					$sql .= " primary key";
				}
				if ( $b < $nf - 1 )
				{
					$sql .= ",\n";
					$fl .= $fn.", ";
				}
				else
				{
					$sql .= "\n);\n\n";
					$fl .= $fn;
				}
				$fna[$b] = $fn;
				$ina[$b] = $is_numeric;
			}
			$this->_Out( $sql );
			if ( !$this->structure_only )
			{
				$c = 0;
				for ( ;	$c < $nr;	++$c	)
				{
					$sql = "insert into ".$tablename." ({$fl}) values (";
					$row = mysql_fetch_row( $res2 );
					$d = 0;
					for ( ;	$d < $nf;	++$d	)
					{
						$data = strval( $row[$d] );
						if ( $ina[$d] )
						{
							$sql .= intval( $data );
						}
						else
						{
							$sql .= "\"".mysql_escape_string( $data )."\"";
						}
						if ( $d < $nf - 1 )
						{
							$sql .= ", ";
						}
					}
					$sql .= ");\n";
					$this->_Out( $sql );
				}
				$this->_Out( "\n\n" );
			}
			mysql_free_result( $res2 );
		}
		if ( $this->fptr )
		{
			fclose( $this->fptr );
		}
		return 0;
	}

	public function _Open( )
	{
		$filename = $this->output;
		if ( !( $fp = fopen( $filename, "r" ) ) )
		{
			exit( "Couldn't open ".$filename );
		}
		while ( !feof( $fp ) )
		{
			$line = fgets( $fp, 1024 );
			$SQL .= "{$line}";
		}
		return $SQL;
	}

	public function Restore( )
	{
		$SQL = explode( ";", $this->_Open( $this->output ) );
		if ( !( $link = mysql_connect( $this->host, $this->user, $this->pass ) ) )
		{
			exit( mysql_error( ) );
		}
		if ( !mysql_select_db( $this->db, $link ) )
		{
			exit( mysql_error( ) );
		}
		$result = mysql_list_tables( $this->db );
		$not = mysql_num_rows( $result );
		$i = 0;
		for ( ;	$i < $not - 1;	++$i	)
		{
			$row = mysql_fetch_row( $result );
			$tables .= $row[0].",";
		}
		$row = mysql_fetch_row( $result );
		$tables .= $row[0];
		if ( $tables != "" || $tables != NULL )
		{
			if ( !mysql_query( "DROP TABLE ".$tables ) )
			{
				exit( mysql_error( ) );
			}
		}
		$i = 0;
		for ( ;	$i < count( $SQL ) - 1;	++$i	)
		{
			if ( !mysql_unbuffered_query( $SQL[$i] ) )
			{
				exit( mysql_error( ) );
			}
		}
		return 1;
	}

	public function _out( $s )
	{
		if ( !$this->fptr )
		{
			echo $s;
		}
		else
		{
			fputs( $this->fptr, $s );
		}
	}

	public function Backup( )
	{
		$this->_Mysqlbackup( $this->host, $this->db, $this->user, $this->pass, $this->output, $this->structure_only );
		return 1;
	}

}

?>
