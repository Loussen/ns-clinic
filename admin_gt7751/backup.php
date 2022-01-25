<?php
$start		   = microtime(true);
$only_connect_db = true;
$folder		  = 'backup_sqls';
require_once "pages/__includes/config.php";

function backup_database($directory, $outname, $dbhost, $dbuser, $dbpass, $dbname, $get_tables = '*')
{
	// check mysqli extension installed
	if (!function_exists('mysqli_connect')){
		die(' This scripts need mysql extension to be running properly ! please resolve!!');
	}
	
	$mysqli = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if ($mysqli->connect_error){
		print_r($mysqli->connect_error);
		return false;
	}
	$mysqli->set_charset("utf8");
	
	$dir	= $directory;
	$result = '<p> Could not create backup directory on :' . $dir . ' Please Please make sure you have set Directory on 755 or 777 for a while.</p>';
	$res	= true;
	if (!is_dir($dir)){
		if (!@mkdir($dir, 755)){
			$res = false;
		}
	}
	
	$n = 1;
	if ($res){
		$name = $outname;
		# counts
		if (file_exists($dir . '/' . $name . '.sql.gz')){
			
			for ($i = 1; @count(file($dir . '/' . $name . '_' . $i . '.sql.gz')); $i++){
				$name = $name;
				if (!file_exists($dir . '/' . $name . '_' . $i . '.sql.gz')){
					$name = $name . '_' . $i;
					break;
				}
			}
		}
		
		$fullname = $dir . '/' . $name . '.sql.gz'; # full structures
		
		if (!$mysqli->error){
			$sql  = "SHOW TABLES";
			$show = $mysqli->query($sql);
			while ($r = $show->fetch_array()){
				if ($get_tables == '*')
					$tables[] = $r[0];
				elseif (!is_array($get_tables) && $r[0] == $get_tables)
					$tables[] = $r[0];
				elseif (is_array($get_tables) && in_array($r[0], $get_tables))
					$tables[] = $r[0];
			}
			
			if (!empty($tables)){
				
				//cycle through
				$return = '';
				foreach ($tables as $table){
					$result	 = $mysqli->query('SELECT * FROM ' . $table);
					$num_fields = $result->field_count;
					$row2	   = $mysqli->query('SHOW CREATE TABLE ' . $table);
					
					$row2 = $row2->fetch_row();
					$return .= "\n
-- ---------------------------------------------------------
--
-- Table structure for table : `{$table}`
--
-- ---------------------------------------------------------

" . $row2[1] . ";\n";
					
					for ($i = 0; $i < $num_fields; $i++){
						$n = 1;
						while ($row = $result->fetch_row()){
							if ($n++ == 1){ # set the first statements
								$return .= "
--
-- Dumping data for table `{$table}`
--

";
								/**
								 * Get structural of fields each tables
								 */
								$array_field = array(); #reset ! important to resetting when loop 
								while ($field = $result->fetch_field()) # get field
									{
									$array_field[] = '`' . $field->name . '`';
									
								}
								$array_f[$table] = $array_field;
								// $array_f = $array_f;
								# endwhile
								$array_field	 = implode(', ', $array_f[$table]); #implode arrays
								
								$return .= "INSERT INTO `{$table}` ({$array_field}) VALUES\n(";
							} else {
								$return .= '(';
							}
							for ($j = 0; $j < $num_fields; $j++){
								
								$row[$j] = str_replace('\'', '\'\'', preg_replace("/\n/", "\\n", $row[$j]));
								if (isset($row[$j])){
									$return .= is_numeric($row[$j]) ? $row[$j] : '\'' . $row[$j] . '\'';
								} else {
									$return .= '\'\'';
								}
								if ($j < ($num_fields - 1)){
									$return .= ', ';
								}
							}
							$return .= "),\n";
						}
						# check matching
						@preg_match("/\),\n/", $return, $match, false, -3); # check match
						if (isset($match[0])){
							$return = substr_replace($return, ";\n", -2);
						}
						
					}
					
					$return .= "\n";
					
				}
				
				$return = "-- ---------------------------------------------------------
--
-- SIMPLE SQL Dump
-- 
-- nawa (at) yahoo (dot) com
--
-- Host Connection Info: " . $mysqli->host_info . "
-- Generation Time: " . date('F d, Y \a\t H:i A ( e )') . "
-- Server version: " . $mysqli->server_version . "
-- PHP Version: " . PHP_VERSION . "
--
-- ---------------------------------------------------------\n\n

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET time_zone = \"+00:00\";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
" . $return . "
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";

//echo $return;
				
				# end values result
				
				@ini_set('zlib.output_compression', 'Off');
				$gzipoutput = gzencode($return, 9);
				
				if (@file_put_contents($fullname, $gzipoutput)){ # 9 as compression levels
					
					$result = $name . '.sql.gz'; # show the name
					
				} else { # if could not put file , automaticly you will get the file as downloadable
					$result = false;
					// various headers, those with # are mandatory
					header('Content-Type: application/x-gzip; charset=UTF-8'); // change it to mimetype
					header("Content-Description: File Transfer");
					header('Content-Encoding: gzip'); #
					header('Content-Length: ' . strlen($gzipoutput)); #
					header('Content-Disposition: attachment; filename="' . $name . '.sql.gz' . '"');
					header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
					header('Connection: Keep-Alive');
					header("Content-Transfer-Encoding: binary");
					header('Expires: 0');
					header('Pragma: no-cache');
					
					echo $gzipoutput;
				}
			} else {
				$result = '<p>Error when executing database query to export.</p>' . $mysqli->error;
			}
		}
	} else {
		$result = '<p>Wrong mysqli input</p>';
	}
	
	if ($mysqli && !$mysqli->error){
		@$mysqli->close();
	}
	
	return $result;
}

$name = 'backup-' . date("d-m-Y-H.i") . '-' . time();
backup_database($folder, $name, host, username, password, db_name, '*');

$open = opendir($folder);
$time = time();
while ($read = readdir($open)){
	if ($read != '.' && $read != '..'){
		$filemtime = filemtime($folder . '/' . $read);
		$diff	  = $time - $filemtime;
		if ($diff > 864000)
			unlink($folder . '/' . $read);
	}
}

echo 'Database has been backed up!<br />';
echo date("d.m.Y H:i:s") . '<br />';
echo 'Process time: ' . (microtime(true) - $start);
?>