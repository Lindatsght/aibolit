<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// REVIZORRO v2.01 Jan-10-2013
// Greg Zemskov
// audit@revisium.com
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

define('PREPARE_AKNOWN', 0);

define('CRC32_LIMIT', pow(2, 31) - 1);
define('CRC32_DIFF', CRC32_LIMIT * 2 -2);

header('Content-Type: text/plain');

if (!PREPARE_AKNOWN) {
  $global_ignore_dir = array('/cache/', '/backup/', '/awstats/', '/webstats/', '/log/', '/logs/');
  $global_ignore_file = array('.jpg', '.flv', '.zip', '.rar', '.tar', '.gz', '.mp3', '.avi', '.mpg');
}

if ($argc == 1) {
// ------------------------------------------------------------
   $mem_before = memory_get_usage();

   $global_list = array();

   $all_files = scan_directory_recursively('.');

   if ($f = fopen('report_revizorro_' . date('d-m-Y-H-i', time()) .  '.txt', 'w')) {
      fputs($f, serialize($global_list));
      fclose($f);
   } else {
     die('Cannot create report file.');
   }

   echo 'total: ' . count($global_list) . " files and directories\n";

   $mem_after = memory_get_usage();

   echo 'Mem before: ' . $mem_before . ' After: ' . $mem_after . "\n";

   if (!PREPARE_AKNOWN) {
     exit;
   }

   if ($f = fopen('.aknown', 'w')) {
      foreach ($global_list as $item) {
          if ($item['acrc'] != '') {
             fputs($f, $item['acrc'] . "\n");
          }
      }

      fclose($f);
   } else {
     die('Cannot create .aknown file.');
   }


} else {
// ------------------------------------------------------------
  $input1 = $argv[1]; 
  $input2 = $argv[2]; 
  $type = $argv[3];

  if (($type != 'f' && $type != 's')) {
     die('Invalid type argument'); 
  }

  echo "Comparing $input1 vs $input2\n";


  $fs1 = unserialize(implode('', file($input1)));
  $fs2 = unserialize(implode('', file($input2)));

  if ((count($fs1) < 1) || (count($fs2) < 1)) {
     die('Error in reading files.'); 
  }

  $changed = array();

  // remove unchanged or find changed
  $file_list1 = array_keys($fs1);
  for ($i = 0; $i < count($file_list1); $i++) {
    if (isset( $fs2[$file_list1[$i]] )) {
       $modified = false;

       if ($type == 'f') {
          if ( $fs1[$file_list1[$i]]['chk'] != $fs2[$file_list1[$i]]['chk'] ) {
             $modified = true;
          }
       } else
       if ($type == 's') {
          if( 
            ( $fs1[$file_list1[$i]]['sze'] != $fs2[$file_list1[$i]]['sze'] ) 
             ||
            ( $fs1[$file_list1[$i]]['crc'] != $fs2[$file_list1[$i]]['crc'] ) 
            )
          {
             $modified = true;
          }
       }

       if ($modified) {
          $changed[] = $file_list1[$i];
          $changed_details[$file_list1[$i]] = get_diff($fs1[$file_list1[$i]], $fs2[$file_list1[$i]]);
       }
 
       unset($fs1[$file_list1[$i]]);
       unset($fs2[$file_list1[$i]]);
     }
  }

  $removed = array_keys($fs1);
  $added = array_keys($fs2);

  // print changed
  echo 'Changed files ' . count($changed) . "\n\n";
  for ($i = 0; $i < count($changed); $i++) {
     $k = $changed[$i];
     echo $k . "\n";
     echo $changed_details[$k] . "\n";

     print "\n";
  }
  echo "\n\n";

  // print removed
  echo 'Removed files ' . count($removed) . "\n\n";
  for ($i = 0; $i < count($removed); $i++) {
     echo $removed[$i] . "\n";
  }
  echo "\n\n";

  // print added
  echo 'Added files ' . count($added) . "\n\n";
  for ($i = 0; $i < count($added); $i++) {
     $c = date('d/m/Y H:i:s', $fs1[$added[$i]]['c']);
     $m = date('d/m/Y H:i:s', $fs2[$added[$i]]['m']);

     echo $added[$i] . " [$c]  [$m]\n";
  }
  echo "\n\n";

}

exit;

// ------------------------------------------------------------
function print_diff(&$fs1, &$fs2, $v) {
  if ($fs1[$v] != $fs2[$v]) {
     if ($v == 'c' || $v == 'm') {
        $fs1[$v] = date('d/m/Y H:i:s', $fs1[$v]);
        $fs2[$v] = date('d/m/Y H:i:s', $fs2[$v]);
     }

     if ($v == 'perm') {
        $fs1[$v] = decoct($fs1[$v]);
        $fs2[$v] = decoct($fs2[$v]);
     }

     return ' - ' . $v . "\t" . $fs1[$v] . ' <> ' . $fs2[$v]  . "\n";
  }

  return '';
}

// ------------------------------------------------------------
function get_diff($fs1, $fs2) {
  $result = '';
  $result .= print_diff($fs1, $fs2, 'crc');
  $result .= print_diff($fs1, $fs2, 'sze');
  $result .= print_diff($fs1, $fs2, 'c');
  $result .= print_diff($fs1, $fs2, 'm');
  $result .= print_diff($fs1, $fs2, 'ino');
  $result .= print_diff($fs1, $fs2, 'uid');
  $result .= print_diff($fs1, $fs2, 'gid');
  $result .= print_diff($fs1, $fs2, 'perm');

  return $result;
}

// ------------------------------------------------------------
// -- check symlinks
// -- фильтр сделать на основе in_array для нескольких расширений


// ------------------------------------------------------------
function realCRC($str_in, $full = false)
{
        $in = crc32( $full ? normal($str_in) : $str_in );
        return ($in > CRC32_LIMIT) ? ($in - CRC32_DIFF) : $in;
}


// ------------------------------------------------------------


function scan_directory_recursively($directory, $filter = FALSE)
{
        global $global_list, $global_ignore_dir, $global_ignore_file;

       for ($i = 0; $i < count($global_ignore_dir); $i++) 
       {
           if (stripos($directory, $global_ignore_dir[$i]) !== false) {
              return; 
           }
       } 

	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}

	// if the path is not valid or is not a directory ...
	if(!file_exists($directory) || !is_dir($directory))
	{
		// ... we return false and exit the function
		return FALSE;

	// ... else if the path is readable
	} elseif(is_readable($directory))
	{
		// initialize directory tree variable
		$directory_tree = array();

		// we open the directory
		$directory_list = opendir($directory);

		// and scan through the items inside
		while (FALSE !== ($file = readdir($directory_list)))
		{

                  $ignore_file = false;
                  for ($i = 0; $i < count($global_ignore_file); $i++) 
                  {
                      if (stripos($file, $global_ignore_file[$i]) !== false) {
                         $ignore_file = true;
			    break;
                      }
                  } 

                  if ($ignore_file) continue;

			// if the filepointer is not the current directory
			// or the parent directory
			if($file != '.' && $file != '..')
			{
				// we build the new path to scan
				$path = $directory . '/' . $file;

print $path . ' // mem=' . memory_get_usage() . "\n";

				// if the path is readable
				if(is_readable($path))
				{
					// we split the new path by directories
					$subdirectories = explode('/', $path);


                                        $inf = null;
                                        $stat = stat($path);

					// if the new path is a directory
					if(is_dir($path))
					{
						// add the directory details to the file list
						$inf = array(
							//'pth'    => $path,
							//'nme'    => end($subdirectories),
							'knd'    => 0,
							'c'      => $stat[10],
							'm'      => $stat[9],
							'ino'      => $stat['ino'],
							'uid'    => $stat['uid'],
							'gid'    => $stat['gid'],
							'perm'   => fileperms($path),

							// we scan the new path by calling this function
							'sub' => scan_directory_recursively($path, $filter));

                                                //$directory_tree[] = $inf;

					// if the new path is a file
					} else
					{
						// get the file extension by taking everything after the last dot
                                                $path_info = pathinfo($path);
						$extension = $path_info['extension'];

						// if there is no filter set or the filter is set and matches
						if($filter === FALSE || $filter == $extension)
						{
							// add the file details to the file list
                                                 $crc = 0; 
                                                 if (($stat[7] < 5 * 1024 * 1024)) {  
							$content = implode('', file($path));
							$crc = realCRC($content);
                                                 unset($content); 
                                                 }
                                                        $adv_crc = $crc + realCRC(basename($path));

							$inf = array(
								//'pth'      => $path,
								//'nme'      => end($subdirectories),
								'crc'      => $crc,
								'acrc'      => $adv_crc,
								'ext' 	=> $extension,
								'sze'      => $stat[7],
								'c'      => $stat[10],
								'm'      => $stat[9],
								'ino'      => $stat['ino'],
							        'uid'    => $stat['uid'],
							        'gid'    => $stat['gid'],
							        'perm'   => fileperms($path),
								'knd'      => 1);

                                                        //$directory_tree[] = $inf;
						}
					}

 					if ($inf != null) 
					{
                                            $sum_crc = '';
                                            foreach($inf as $field) {
                                               $sum_crc .= $field;
                                            }

                                                $inf['chk'] = realCRC($sum_crc);
 						if (isset($inf['sub'])) 
						{
							$inf['chd'] = count($inf['sub']);
							unset($inf['sub']);
						}
						$global_list[$path] = $inf;
						unset($inf);					

                                        }
				}
			}
		}

		// close the directory
		closedir($directory_list);

		// return file list
		return $directory_tree;

	// if the path is not readable ...
	} else{
		// ... we return false
		return FALSE;
	}
}
// ------------------------------------------------------------

function convert($size)
 {
    $unit = array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
 }

//echo convert(memory_get_usage(true)); // 123 kb

?>