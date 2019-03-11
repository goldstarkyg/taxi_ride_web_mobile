<?php
 //.............Required Functions..............
	//json web service to get data from one live server to another live server n store in array
function get_json_data($api_url, $api_req_method='GET', $req_data_string = "")
{
	$json_result = remote_get_contents(urldecode($api_url), $api_req_method, $req_data_string);	
	return $json_result ;
}
function convert_json_to_array($data){

	$data_decode = stripslashes(urldecode($data));	
	$data_decode_escaped = escapeData($data_decode);
	return json_decode($data_decode_escaped,true);
}
function escapeData($data) 
{
	if(is_array($data)) {
		$parsed = array();
		foreach ($data as $key=>$value)
			array_push($parsed, escapeString($key).':'.escapeData($value));
		return '{'.implode(',', $parsed).'}';
	} else
		return escapeString($data);
}
function escapeString($string) 
{	
	//$string = str_replace("\\", "\\\\", $string);
	//$string = str_replace('/', "\\/", $string);
	//$string = str_replace('"', "\\".'"', $string);
	$string = str_replace("\b", "\\b", $string);
	$string = str_replace("\t", "\\t", $string);
	$string = str_replace("\n", "\\n", $string);
	$string = str_replace("\f", "\\f", $string);
	$string = str_replace("\r", "\\r", $string);
	$string = str_replace("\u", "\\u", $string);
	//return '"'.$string.'"';
	return $string;
}

function replace_escapeData($data) 
{
	if(is_array($data)) {
		$parsed = array();
		foreach ($data as $key=>$value)
			array_push($parsed, replace_escapeString($key).':'.replace_escapeData($value));
		return '{'.implode(',', $parsed).'}';
	} else
		return replace_escapeString($data);
}

function replace_escapeString($string) 
{	
	$string = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $string);
	$string = str_replace("\n", "<br />", $string);	
	$string = str_replace("\r\n", "<br />", $string);
	return $string;
}

// Get remote file contents, preferring faster cURL if available
function remote_get_contents($url, $api_req_mtd, $req_data_str)
{
	if (function_exists('curl_get_contents') AND function_exists('curl_init'))
	{
		return curl_get_contents($url, $api_req_mtd, $req_data_str);
	}
	else
	{
		// A litte slower, but (usually) gets the job done
		return file_get_contents($url);
	}
}

function curl_get_contents($url, $req_method, $req_data)
{
	// Initiate the curl session
	$ch = curl_init();
	
	// Set the URL
	curl_setopt($ch, CURLOPT_URL, $url);
	
	// Removes the headers from the output
	curl_setopt($ch, CURLOPT_HEADER, 0);
	
	// Return the output instead of displaying it directly
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// timeout/connecion-timeout
	//curl_setopt($ch, CURLOPT_TIMEOUT, 240); 
	//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);	

	// get method
	if($req_method == "GET" || $req_method == "GET_JSON")
	{	
		curl_setopt($ch, CURLOPT_HTTPGET, 1);		
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");		
	}
	// post method
	// post method with json data to be sent
	else if($req_method == "POST" || $req_method == "POST_JSON")
	{
		curl_setopt($ch, CURLOPT_POST, 1);		
	}		
	// put method		
	// put method with json data to be sent
	else if($req_method == "PUT" || $req_method == "PUT_JSON")
	{
		//echo "put";exit;
		//curl_setopt($ch, CURLOPT_PUT, 1);				
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		/*
		$httpheader_arr = array(
							'X-HTTP-Method-Override: PUT', 														
							'Content-Length: '.strlen($req_data)
						  	);
							
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader_arr);
		*/
	}
	// delete method
	// delete method with json data to be sent
	else if($req_method == "DELETE" || $req_method == "DELETE_JSON")
	{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	}

	//header for json data
	if($req_method == "GET_JSON" || $req_method == "POST_JSON" 
		|| $req_method == "PUT_JSON" || $req_method == "DELETE_JSON")
	{
		
		
		$httpheader_arr = array(
							//'X-HTTP-Method-Override: PUT', 														
							'Accept: application/json',
							'Content-Type: application/json',
							'Content-Length: '.strlen($req_data)
							);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader_arr);
		

	}

	// send data for put, delete, post
	if($req_data != "")
	{
		//echo "data";exit;
		curl_setopt($ch, CURLOPT_POSTFIELDS,  $req_data);	
		//curl_setopt($ch, CURLOPT_POSTFIELDSIZE, strlen($req_data));		
	}	
	

	try {
	// Execute the curl session
	$output = curl_exec($ch);
	}	
	catch (Exception $e) {
		
		//custom error handler 
		$output_arr = array(
							"result" => array(
												"status" => "error",
												"data" => array(
																	"msg" => $e->getMessage()
																)
											  )
							);
		$output = json_encode($output_arr);

		// Close the curl session
		curl_close($ch);
		
		// Return the output as a variable
		return $output;

	}
	
	// Close the curl session
	curl_close($ch);
	
	// Return the output as a variable
	return $output;

}

	//..................Admin Login Check..................
	function check_admin_login($login_arr)
	{		
		$login_arr = add_slashes($login_arr);
		$username = $login_arr['username']; 
	    $password = sha1(SALT_VAR.$login_arr['password']);
		$roleid=$login_arr['roleid'];		
		$row=single_row(ADMIN,"*","roleid='".$roleid."' and`username`='".$username."' and `password`='".$password."'","id","desc","",false);
		if($row!=false)
		{
			/*session_register($_SESSION['Adm_UserId']);
			session_register($_SESSION['Adm_RoleId']);
			session_register($_SESSION['Adm_Email']);
			session_register($_SESSION['Adm_UserNm']);
			session_register($_SESSION['Adm_Fname']);
			session_register($_SESSION['Adm_Lname']);*/			
			$_SESSION['Adm_UserId']=$row['id'];
			$_SESSION['Adm_RoleId']=$row['roleid'];
			$_SESSION['Adm_Email']=$row['email'];
			$_SESSION['Adm_UserNm']=$row['username'];
			$_SESSION['Adm_Fname']=$row['fname'];
			$_SESSION['Adm_Lname']=$row['lname'];
			return true;
		}
		else
		{
			return false;			
		}
	}
  function user_statistics()
	{
		$sel_chart = sel_rec (ADMIN_CHART,"*","ip_address = '".$_SERVER['REMOTE_ADDR']."' and ses_id = '".session_id()."'","1","desc","");
		if($sel_chart != false)
		{
			$count_rows = mysql_fetch_array($sel_chart);
			if($count_rows[ses_id] != session_id())
			{
				$chart_arr[ip_address] 	= $_SERVER['REMOTE_ADDR'];
				$chart_arr[ses_id] 		= session_id(); 
				$chart_arr[count_timer] = $count_rows[count_timer] + "1";
				$chart_arr[dateupdated] = date("Y-m-d h:m:s");
				$inc_chart = upd_rec(ADMIN_CHART,$chart_arr,"ip_address = '".$_SERVER['REMOTE_ADDR']."' and ses_id = '".session_id()."'");
			}
		}
		else
		{
			$chart_arr[ip_address] 	= $_SERVER['REMOTE_ADDR'];
			$chart_arr[ses_id] 		= session_id(); 
			$chart_arr[count_timer] = "1";
			$inc_chart = ins_rec(ADMIN_CHART,$chart_arr);
		}
	}
	function logout()
	{
		unset($_SESSION['Adm_UserId']);
		//session_unregister($_SESSION[Adm_UserId]);
		
		unset($_SESSION['Adm_RoleId']);
		//session_unregister($_SESSION[Adm_RoleId]);
		
		unset($_SESSION['Adm_Email']);
		//session_unregister($_SESSION[Adm_Email]);
		
		unset($_SESSION['Adm_UserNm']);
		//session_unregister($_SESSION[Adm_UserNm]);

		unset($_SESSION['Adm_Fname']);
		//session_unregister($_SESSION[Adm_Fname]);

		unset($_SESSION['Adm_Lname']);
		//session_unregister($_SESSION[Adm_Lname]);
	}
	function admin_login_check() // check in login page......
	{
		if($_SESSION['Adm_UserId']=='')
		{
			print '<script language="javascript">window.location.href="dashboard.php"</script>';
			exit;
		}
	}	
	function is_admin_login()
	{		
		if($_SESSION and $_SESSION['Adm_UserId']=='')
		{
			print '<script language="javascript">window.location.href="index.php"</script>';
			exit;
		}
	}
	function is_user_login($page,$flag=true)
	{
		if (!isset ($_SESSION[USERID]))
		{
			print '<script language="javascript">window.location.href="'.$page.'"</script>';
			exit;
		}
	}
	function is_siteuser_login_check()
	{
		if (!isset ($_SESSION[userid]))
		{
			print '<script language="javascript">window.location.href="index.php"</script>';
		}
	}
	
	function highlightWords($string, $words)
	{
		$words1 = explode(" ",$words);
		foreach ( $words1 as $word )
		{
			$string = str_ireplace($word, '<span class="highlight_word">'.$word.'</span>', $string);
		}
		/*** return the highlighted string ***/
		return $string;
	}
	
	function sub_string($str='',$max)
	{
		if (strlen($str) > $max)
			return substr($str,0,$max)."...";
		else
			return $str;
	}
	
	function get_pagetitle($str)
	{
		return str_replace("_"," ",strtoupper(substr($str,0,1)).substr($str,1));
	}
	
	function get_pagename()
	{
		$arr=split("/",$_SERVER['PHP_SELF']);
		return $arr[count($arr)-1];
	}
	
	//................ get random password start...........
	function generate_password($len)
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		for($i=0; $i<$len; $i++) $r_str .= substr($chars,rand(0,strlen($chars)),1);
		return $r_str;
	}
	//................ get random password end...........
	
	
	//................ get random password start...........
	function generate_string($len)
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		for($i=0; $i<$len; $i++) $r_str .= substr($chars,rand(0,strlen($chars)),1);
		return $r_str;
	}
	//................ get random password end...........
	
	
	//................ get random password start...........
	function generate_randomnumber($len)
	{
		$chars = "0123456789";
		for($i=0; $i<$len; $i++) 
			$r_str .= substr($chars,rand(0,strlen($chars)),1);
		return $r_str;
	}
	//................ get random password end...........

	function upload_image($files, $dir, $oldfile ,$prefix)
	{
		if($files[tmp_name]!='')
		{
			if (!is_dir ($dir))
			{
				mkdir($dir,0777);
				chmod($dir,0777);	
			}
		
			if ($oldfile != "" && is_file($dir.$oldfile))
			{
				//echo "test". $dir.$oldfile;exit;
				unlink($dir.$oldfile);
			}
			
			if($files[name]!='')
			{
				//$imgname = explode(".",$files[name]);
				//$imagename = $imgname[0].'.png';
				//echo $dir.$oldfile;exit;
				//unlink('images/logoImages/'.'images.jpeg');
				$imagename = $files[name];

			}
			//$filename = $prefix."".rand(0,999999999999)."-".$imagename;
			$filename =$imagename;

			if (is_file($dir.$filename))
				//$filename = $prefix."".rand(0,999999999999)."-".rand(0,999999999999)."-".$imagename;
				$filename = $imagename;

				
			if(@move_uploaded_file($files[tmp_name],$dir.$filename))
			{
				return $filename;
			}
			else
			{
				return false;
			}
		}
	}
	function upload_video($files, $dir, $oldfile ,$prefix)
	{
		if($files[tmp_name]!='')
		{
			if (!is_dir ($dir))
			{
				mkdir($dir,0777);
				chmod($dir,0777);	
			}
		
			if ($oldfile != "" && is_file($dir.$oldfile))
			{
				unlink($dir.$oldfile);
			}
			
			if($files[name]!='')
			{
				$imgname = explode(".",$files[name]);
				$imagename = $imgname[0].'.mov'; 	
			}
			$filename = $prefix."".rand(0,999999999999)."-".$imagename;
			
			if (is_file($dir.$filename))
				$filename = $prefix."".rand(0,999999999999)."-".rand(0,999999999999)."-".$imagename;
			
			echo "fNM:".$filename;
			echo "\n \n";
			echo "tNM:".$files[tmp_name];
			echo "\n\n";
			echo "dir:".$dir.$filename;
			if(@move_uploaded_file($files[tmp_name],$dir.$filename))
			{
				echo "yes";
				return $filename;
			}
			else
			{
				echo "no";
				return false;
			}
		}
	}

	function getModifiedUrlNamechange($catnm)
	{
		$catnm1=ereg_replace("[^A-Za-z0-9]","-",$catnm);
		return $catnm1;
	}
	
	function getVideoName($catnm)
	{
		$catnm1=ereg_replace("[^A-Za-z0-9.]","-",$catnm);
		return $catnm1;
	}

	function getmetadate($table,$where,$disp=false)
	{
		$metaarray = array();
		$sel = "select title,meta_title,meta_keyword,meta_description,seo_detail from $table where ".$where;
		if ($disp==true)
			echo $sel;
		$sel_qur = mysql_query($sel);
		$totrows = mysql_num_rows($sel_qur);
		if($totrows > 0)
		{
			$sel_obj = mysql_fetch_array($sel_qur);
			array_push($metaarray,$sel_obj['title']); 
			array_push($metaarray,$sel_obj['meta_title']); 		
			array_push($metaarray,$sel_obj['meta_keyword']); 
			array_push($metaarray,$sel_obj['meta_description']); 		
			array_push($metaarray,$sel_obj['seo_detail']); 		
		}
		return $metaarray;
	}
	function getglobalmetadata($table,$where='1=1')
	{
		$metaarray = array();
		$sel = "select title,meta_title,meta_keyword,meta_description,seo_detail from global_meta_tag where ".$where;
		$sel_qur = mysql_query($sel);
		$totrows = mysql_num_rows($sel_qur);
		if($totrows > 0)
		{
			$sel_obj = mysql_fetch_array($sel_qur);
			array_push($metaarray,$sel_obj['title']); 
			array_push($metaarray,$sel_obj['meta_title']); 		
			array_push($metaarray,$sel_obj['meta_keyword']); 
			array_push($metaarray,$sel_obj['meta_description']); 		
			array_push($metaarray,$sel_obj['seo_detail']); 		
		}
		return $metaarray;
	}


	function getCreditCard($card="")
	{
		$card_arr = array(	"AmEx"	=>	"American Express",
							"MasterCard"=>	"MasterCard",
							"Visa" 	=> 	"Visa",
							"Dino" 	=> 	"Discover",						
							);
		$cardopt="";					
		foreach($card_arr as $key1=>$valu){
			if($key1==$card)
				$cardopt .= "<option value=".$key1." selected>$valu</option>";
			else
				$cardopt .= "<option value=".$key1.">$valu</option>";
		}
		return $cardopt;
	}

	function getMonth($id="")
	{	
			
		$cur_mn = date("m");
	
		$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		
		$tMonth=$mon;
		$actMonth=$tMonth;
		$motmOption="";
		for($m=1; $m < count($actMonth); $m++)
		{
			if($m == $id)
				$motmOption .="<option value='$m' selected=selected>$actMonth[$m]</option>";
			else
				$motmOption .="<option value='$m'>$actMonth[$m]</option>";						
		}
		
		return $motmOption;
	}
	
	function exporttocsv($tab,$fields='*',$where='1=1',$orderby='1',$order='desc',$filename='export.csv')
	{
		$csv_terminated = "\n";
		$csv_separator = ",";
		$csv_enclosed = '"';
		$csv_escaped = "\\";
		$sql_query = "select $fields from $tab where $where order by $orderby $order";
	 
		// Gets the data from the database
		$result = mysql_query($sql_query);
		$fields_cnt = mysql_num_fields($result);
	 
		$schema_insert = '';
		for ($i = 0; $i < $fields_cnt; $i++)
		{
			$l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
				stripslashes(mysql_field_name($result, $i))) . $csv_enclosed;
			$schema_insert .= $l;
			$schema_insert .= $csv_separator;
		} // end for
	 
		$out = trim(substr($schema_insert, 0, -1));
		$out .= $csv_terminated;

		// Format the data
		while ($row = mysql_fetch_array($result))
		{
			$schema_insert = '';
			for ($j = 0; $j < $fields_cnt; $j++)
			{
				if ($row[$j] == '0' || $row[$j] != '')
				{
					if ($csv_enclosed == '')
					{
						$schema_insert .= $row[$j];
					} else
					{
						$schema_insert .= $csv_enclosed .
						str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
					}
				} else
				{
					$schema_insert .= '';
				}
	 
				if ($j < $fields_cnt - 1)
				{
					$schema_insert .= $csv_separator;
				}
			} // end for
	 
			$out .= $schema_insert;
			$out .= $csv_terminated;
		} // end while
	 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Length: " . strlen($out));
		// Output to browser with appropriate mime type, you choose ;)
		header("Content-type: text/x-csv");
		//header("Content-type: text/csv");
		//header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=$filename");
		echo $out;
		exit;
	}
	
	function add_slashes($var)
	{
		if (is_array($var))
		{
			if (count($var) > 0)
			{
				foreach ($var as $k=>$v)	
				{
					$var[$k] = addslashes($v);
				}
			}
			return $var;
		}
		else
			return addslashes($var);
	}
	
	function strip_slashes($var)
	{
		if (is_array($var))
		{
			if (count($var) > 0)
			{
				foreach ($var as $k=>$v)	
				{
					$var[$k] = stripslashes($v);
				}
			}
			return $var;
		}
		else
			return stripslashes($var);
	}
	
	
	

function getdayofweek($no)
{
	switch ($no)
	{
		
		case 0:
			$day="Monday"; break;
		case 1:
			$day="Tuesday"; break;
		case 2:
			$day="Wednesday"; break;
		case 3:
			$day="Thursday"; break;
		case 4:
			$day="Friday"; break;
		case 5:
			$day="Saturday"; break;	
		case 6:
			$day="Sunday"; break;					
	}
	return $day;
}

function sub_words($bsdesc,$length=100)
{
	$bphrase = $bsdesc; 
	$babody = str_word_count($bphrase,2);
	if(count($babody) > $bthreshold_length)
	{ 
		$btbody = array_keys($babody);
		$bpro_sdesc= substr($bphrase,0,$btbody[$bthreshold_length]) . "...";	 		  
	} 
	else
	{ 
		$bpro_sdesc=$bsdesc;
	}	
	return $bpro_sdesc;
}

function smartCopy($source, $dest, $folderPermission=0755,$filePermission=0644){
# source=file & dest=dir => copy file from source-dir to dest-dir
# source=file & dest=file / not there yet => copy file from source-dir to dest and overwrite a file there, if present

# source=dir & dest=dir => copy all content from source to dir
# source=dir & dest not there yet => copy all content from source to a, yet to be created, dest-dir
    $result=false;
   
    if (is_file($source)) { # $source is file
        if(is_dir($dest)) { # $dest is folder
            if ($dest[strlen($dest)-1]!='/') # add '/' if necessary
                $__dest=$dest."/";
            $__dest .= basename($source);
            }
        else { # $dest is (new) filename
            $__dest=$dest;
            }
        $result=copy($source, $__dest);
        chmod($__dest,$filePermission);
        }
    elseif(is_dir($source)) { # $source is dir
        if(!is_dir($dest)) { # dest-dir not there yet, create it
            @mkdir($dest,$folderPermission);
            chmod($dest,$folderPermission);
            }
        if ($source[strlen($source)-1]!='/') # add '/' if necessary
            $source=$source."/";
        if ($dest[strlen($dest)-1]!='/') # add '/' if necessary
            $dest=$dest."/";

        # find all elements in $source
        $result = true; # in case this dir is empty it would otherwise return false
        $dirHandle=opendir($source);
        while($file=readdir($dirHandle)) { # note that $file can also be a folder
            if($file!="." && $file!="..") { # filter starting elements and pass the rest to this function again
#                echo "$source$file ||| $dest$file<br />\n";
                $result=smartCopy($source.$file, $dest.$file, $folderPermission, $filePermission);
                }
            }
        closedir($dirHandle);
        }
    else {
        $result=false;
        }
    return $result;
    }
function makedir($dirpath,$permission="0777")
{
	if(!is_dir($dirpath))
	{
		mkdir($dirpath);
		chmod($dirpath,$permission);		
	}	
}
function unzip($zipfile,$foldernm)
{
    $zip = zip_open($zipfile);
    while ($zip_entry = zip_read($zip))    {
        zip_entry_open($zip, $zip_entry);
        if (substr(zip_entry_name($zip_entry), -1) == '/') {
            $zdir = substr(zip_entry_name($zip_entry), 0, -1);
            if (file_exists($foldernm."/".$zdir)) {
               // trigger_error('Directory "<b>' . $zdir . '</b>" exists', E_USER_ERROR);
                return false;
            }
            mkdir($foldernm."/".$zdir);
        }
        else {
            $name = zip_entry_name($zip_entry);
            if (file_exists($name)) {
               // trigger_error('File "<b>' . $name . '</b>" exists', E_USER_ERROR);
               // return false;
            }
            $fopen = fopen($foldernm."/".$name, "w");
            fwrite($fopen, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)), zip_entry_filesize($zip_entry));
        }
        zip_entry_close($zip_entry);
    }
    zip_close($zip);
    return true;
}

function delTree($dir) {
    $files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( is_dir( $file ) )
            delTree( $file );
        else
            unlink( $file );
    }
  
    if (is_dir($dir)) rmdir( $dir );
  
}

function del_file($path)
{
	if (is_file($path))
	{
		unlink($path);
		return true;
	}
	else
		return false;
}

function dateDiff($date1, $date2) {
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);
     $secs = $date1 - $date2;
     if ($secs < 60) 
	 {
	 	$second=$secs." seconds";
	 }
     $minutes = round($secs / 60);
   	 if ($minutes < 60) 
	 {
	 	$minute=$minutes." min.";		
	 }
     $hours = round($minutes / 60);
     if ($hours < 60) 
	 {
	 	if($hours==1)
			$hour=$hours." hour";
		else
			$hour=$hours." hours";
	 }
    	$days = round($hours / 24);
    if ($days > 0) 
	{
	 	if($days==1)
			$cont=$days." day";
		else
			$cont=$days." days";		  
	}
	elseif($hours > 0)
		$cont=$hour;
	elseif($minutes > 0)
		$cont=$minute;
	//elseif($secs > 0)
		//$cont=$second;
	else
		$cont="closed";
	return $cont;
		
	 
}

function create_combo($name,$id,$table,$where="1=1",$value="",$dispval="",$default="",$class="",$multi=false,$orderby='',$order='')
{
	if($orderby!='')
		$orderby=" order by ".$orderby." ";
	if($order!='')
		$orderby.=$order;
	if($multi==true)
		$multiple="multiple='multiple'";
	$combo = '<select '.$multiple.' name="'.$name.'" id="'.$id.'" class="'.$class.'">
				<option value="">Select </option>';
	
	$sel="select $value,$dispval from $table where $where $orderby";
	$res=mysql_query($sel);	
	if (mysql_num_rows($res))
	{
		while ($val = mysql_fetch_array($res))
		{
			$combo .= '<option value="'.$val[$value].'"';
			//if ($default==$val[$value])
			if(in_array($val[$value],$default))
				$combo .= ' selected="selected" ';
			$combo .='>'.stripslashes(utf8_decode($val[$dispval])).'</option>';					
		}
	}
	
	
	$combo .='</select>';
	return $combo; 
}
function word_wrap($desc,$length="30")
{
	$phrase = $desc; 
	$abody = str_word_count($phrase,2);
	if(count($abody) > $length)
	{ 
		$tbody = array_keys($abody);
		$short_desc1= substr($phrase,0,$tbody[$length]) . "...";	 		
	}
	else
	{ 
		$short_desc1=$desc;
	}		
	return $short_desc1; 
}	

function generate_rand_num($len)
	{
		//$chars = "23456";
		for($i=2; $i<6; $i++) $r_str=(rand($i));
		return $r_str;
	}
	
//................................database backup function......................
function backup_tables($host,$user,$pass,$name,$tables = '*') 
{ 
  	$link = mysql_connect ($host,$user,$pass) or die ("Couldn't connect with database!");
	mysql_select_db($name,$link) or die ("Database not found!");
  	//get all of the tables 
  	if($tables == '*') 
  	{ 
    	$tables = array();
    	$result = mysql_query('SHOW TABLES');
    	while($row = mysql_fetch_row($result)) 
    	{ 
      		$tables[] = $row[0];
    	} 
  	} 
  	else 
  	{ 
    	$tables = is_array($tables) ? $tables : explode(',',$tables);
  	} 
  	foreach($tables as $table) 
  	{ 
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		for ($i = 0; $i < $num_fields; $i++) 
    	{ 
      		while($row = mysql_fetch_row($result)) 
      		{ 
        		$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{ 
				  $row[$j] = addslashes($row[$j]);
				  $row[$j] = ereg_replace("\n","\\n",$row[$j]);
				  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; } 
				  if ($j<($num_fields-1)) { $return.= ','; } 
				} 
        		$return.= ");\n";
      		} 
    	} 
    $return.="\n\n\n";
  	} 
  	//save file 
	$filename = 'whataflix-'.date("d-M-Y").'.sql';
  	$handle = fopen($filename,'w+');
	fwrite($handle,$return);
	fclose($handle);
	return $filename;
}

function verify_iphone_sign($sign="",$salt="")
{
	if($sign!='' and $salt!='')
	{
		$key=SALT_VAR;	
		$md5_salt=md5($key.$salt);
		if($sign==$md5_salt)
		{
			return true;
		}
	}
	return false;
}

function checkemail($email,$tablename)
{	
	$chk_email=sel_rec($tablename,"uid","email='$email'","1","desc","",false);
	if($chk_email)
	{
		if(mysql_num_rows($chk_email)>0)
		{
			return false;
		}
	}
	return true;
}

function niceTime($time) 
{
  $time1=strtotime(date("Y-m-d H:i:s"));
  $delta=$time1-$time;
  if ($delta < 60) 
    return 'few sec ago.';
  else if ($delta < 120) 
    return 'min ago.';
  else if ($delta < (59 * 60)) 	//59 mins
    return floor($delta / 60) . ' min ago.';
  else if ($delta < (60 * 60)) 	//90 mins
    return floor($delta / 3600).' hour ago.';
  else if ($delta < (12 * 60 * 60)) //24 hr,60min,60sec
    return floor($delta / 3600) . ' hours ago.';
  else if ($delta < (48 * 60 * 60))   
	return date("D g:i a",$time);  
  else 
  {	//return floor($delta / 86400) . ' days ago.';
	  return date("M j",$time); }
}
function array_encode($arr)
{
	  $en_arr=array();
		if(count($arr)>0)
		{		  
		  foreach($arr as $key=>$val)
		  { 		
			if(is_array($val))
			   $en_arr[$key]=array_encode($val);
		    else		
			   $en_arr[$key]=urlencode($val);
		  }
		}
		return $en_arr;
}
function array_decode($arr)
{
		if(count($arr)>0)
		{
		 foreach ($arr as $key=>$val)
		  {
			if(is_array($val))
			   $de_arr[$key]=array_decode($val);  
			else   
			   $de_arr[$key]=urldecode($val);
		  }
		}
		  return $de_arr;
}
function csv_to_array($csv)
{
	$arry=array();
	if($csv!='')
		$arry=explode(",",$csv);
	return $arry;	
}
function unserial_data($format)
{
	if($format!='')
	{
	  	$videourl = unserialize($format); 
	}
	return $videourl;
}
function create_cat_img_zip()
	{
		$iphonezips="../";
		del_file($iphonezips."cat_img.jpg");
		if(!is_dir($iphonezips))
		{
			mkdir($iphonezips,0777);
		}
		$source_arr=array("../cat_img/");
		$destination=$iphonezips."cat_img.jpg";
		multidir_to_zip($source_arr,$destination);
 }
function multidir_to_zip($source_arr,$destination)
 {
		//if (is_array($source)) $source_arr = array($source); // convert it to array		
		if(!extension_loaded('zip')) 
		{	return false; 		}		
		$zip = new ZipArchive();
		if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
			return false;
		}		
		foreach ($source_arr as $source)
		{
			if(!file_exists($source)) continue;
				$source=str_replace('\\', '/', realpath($source));
	
			if(is_dir($source)===true)
			{
				$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
				foreach ($files as $file)
				{
				$file = str_replace('\\', '/', realpath($file));				
				if (is_dir($file) === true)
				{
				$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
				}
				else if (is_file($file) === true)
				{
				$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
			}
			elseif(is_file($source) === true)
			{
				$zip->addFromString(basename($source), file_get_contents($source));
			}		
		}		
			/*header('Content-Type: application/zip');
			header('Content-Length: ' . filesize($destination));
			header('Content-Disposition: attachment; filename="'.$destination.'"');*/
			
			$zip->close();
			/*readfile($destination);
			unlink($destination);*/
 }
function getletestcatimg($cat_id)
{
	 $articles = "SELECT posts.ID,p1.meta_value AS thumbnail FROM wp_posts posts INNER JOIN wp_postmeta p1 ON (p1.post_id = posts.ID AND p1.meta_key = '_thumbnail_id') INNER JOIN wp_term_relationships r ON r.object_id = posts.ID INNER JOIN wp_term_taxonomy x ON x.term_taxonomy_id = r.term_taxonomy_id INNER JOIN wp_terms t ON t.term_id = x.term_id WHERE t.term_id = '".$cat_id."' and posts.post_status='publish' group by posts.ID desc LIMIT 0,1";	
	 $res_articles=mysql_query($articles) or die(mysql_error());
	 if(mysql_num_rows($res_articles)>0)
	 {
		$get_articles=mysql_fetch_array($res_articles);
		$sel = "select p2.meta_value AS thumbnail_image from wp_postmeta as p2 where p2.meta_key = '_wp_attached_file' and p2.post_id='".$get_articles['thumbnail']."'";
		$res = mysql_query($sel) or die(mysql_error());
		$row = mysql_fetch_array($res); 	
		$newimg = $row['thumbnail_image'];
	 }
	return $newimg;	
}
function remove_caption($content)
{
	$content=preg_replace('#\s*\[caption[^]]*\].*?\[/caption\]\s*#is','<br />',$content);
	$content=preg_replace('#\s*\[s2If[^]]*\].*?\[/s2If\]\s*#is','<br />',$content);
	$content=preg_replace('#\s*\[quote[^]]*\].*?\[/quote\]\s*#is','<br />',$content);
	$content=preg_replace('#\s*\[button[^]]*\].*?\[/button\]\s*#is','<br />',$content);
	$content=str_replace("[hr]","",$content);
	$content=str_replace("Sign-In","",$content);
	return $content;
}
function getquestion_id($post_id)
{
	 $getqueid = "select post_title from wp_posts where ID='".$post_id."'";	
	 $res_getqueid=mysql_query($getqueid) or die(mysql_error());
	 if(mysql_num_rows($res_getqueid)>0)
	 {
		$post_title=mysql_fetch_array($res_getqueid);
		$sel = "select ID,final_screen from wp_mtouchquiz_quiz where name='".$post_title['post_title']."'";
		$res = mysql_query($sel) or die(mysql_error());
		$row = mysql_fetch_array($res); 	
		$question_id = $row['ID'];
	 }
	return $question_id;	
}
function timeAgo($time_ago){
$cur_time 	= time();
$time_elapsed 	= $cur_time - $time_ago;
$seconds 	= $time_elapsed ;
$minutes 	= round($time_elapsed / 60 );
$hours 		= round($time_elapsed / 3600);
$days 		= round($time_elapsed / 86400 );
$weeks 		= round($time_elapsed / 604800);
$months 	= round($time_elapsed / 2600640 );
$years 		= round($time_elapsed / 31207680 );
// Seconds
if($seconds <= 60){
	$s = 's';
	$time_total =  "$seconds".$s;
}
//Minutes
else if($minutes <=60){
	$m = 'm';
	if($minutes==1){
		$time_total = "1".$m;
	}
	else{
		$time_total = "$minutes".$m;
	}
}
//Hours
else if($hours <=24){
	$h = 'h';
	if($hours==1){
		$time_total = "1".$h;
	}else{
		$time_total = "$hours".$h;
	}
}
//Days
else if($days <= 7){
	$d = 'd';
	if($days==1){
		$time_total = "1".$d;
	}else{
		$time_total = "$days".$d;
	}
}
//Weeks
else if($weeks <= 4.3){
	$w = 'w';
	if($weeks==1){
		$time_total = "$weeks".$w;
	}else{
		$time_total = "$weeks".$w;
	}
}
//Months
else if($months <=12){
	$mo = 'm';
	if($months==1){
		$time_total = "$months".$mo;
	}else{
		$time_total = "$months".$mo;
	}
}
//Years
else{
	$ye = 'y';
	if($years==1){
		$time_total = "1".$ye;
	}else{
		$time_total = "$years".$ye;
	}
}
return $time_total;
}
function join_image($id="")
{
	$query = ("SELECT * FROM ".IMAGES." INNER JOIN ".USER." ON ".IMAGES.".uid= ".USER.".id WHERE ".USER.".id=".$id." AND ".IMAGES.".status = 1 AND ".IMAGES.".block_image!=1");	
	$result= mysql_query($query);
	$image_count = mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	$image_path =$row;
	//$file = "cardview.php?user_id=".$id."&is_cms=1";
	$file = "view-posted-diaries.php?userId=".$id."&is_cms=1";
	if($image_count!=0)
	{
		$link = "<a href=".$file.">".$image_count."</a>";
	}
	else
	{
		$link = $image_count;
	}
	return $link ;
}
function image_comment($id="")
{
	$query = mysql_query("SELECT * FROM comments WHERE `image_id`='".$id."'");
	$count = mysql_num_rows($query);
	if($count!=0)
	{
		$link = $count;
	}
	else
	{
		$link = '0';
	}
	return $link;
}
function image_likes($id="")
{
	$query = mysql_query("SELECT * FROM likes WHERE `image_id`='".$id."'");
	$count = mysql_num_rows($query);
	if($count!=0)
	{
		$link = $count;
	}
	else
	{
		$link = '0';
	}
	return $link;
}
function report_image($id="")
{
	
	$query = mysql_query("SELECT * FROM ".IMAGES." WHERE `id`=".$id." ");
	$row = mysql_fetch_array($query);
	$image_array = array ('image' =>$row[image], 'status'=>$row[status]);
	return $image_array ;
}
?>