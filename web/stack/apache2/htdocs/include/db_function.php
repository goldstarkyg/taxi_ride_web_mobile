<?php
	//...................Database functions start.................

	//................insert new record to database [start].................................
	function ins_rec($tab,$array,$disp=false)	
	{	
		$array = add_slashes($array);
				
		$qry = "insert into $tab set ";
		if (count($array) > 0)
		{
			foreach ($array as $k=>$v)
			{
				if($v != "")
				{
					$qry .= "`$k`='".$v."',";
				}
			}
		}
		
		$qry=trim($qry,",");
		
		if ($disp)
			echo $qry;
		
		$err = mysql_query($qry);
		
		if (!$err)
		{
			echo mysql_error()." - <b>".$qry."</b>";
			return false;
		}
		else
		{
			return mysql_insert_id();
		}
	}
	//................insert new record to database [end].................................
	
	//................update record from database [start].................................
	function upd_rec($tab,$array,$where="1=1",$disp=false)	
	{	
		$array = add_slashes($array);
		$qry = "update $tab set ";
		if (count($array) > 0)
		{
			foreach ($array as $k=>$v)
			{				
					$qry .= "$k='".$v."',";
			
			}
		}
			
		$qry=trim($qry,",")." where ".$where;
		if ($disp)
			echo $qry;
		
		$err = mysql_query($qry);		
		
		if (!$err)
		{
			echo mysql_error()." - <b>".$qry."</b>";
			return false;
		}
		else
			return true;
	}
	//................update record from database [end].................................
	
	//................delete record from database [start].................................
	function del_rec($tab,$where="1=1",$disp=false)
	{
		$qry = "delete from $tab where $where";
		if ($disp)
			echo $qry;
			
		$err = mysql_query($qry);
		if (!$err)
		{
			echo mysql_error()." - <b>".$qry."</b>";
			return false;
		}
		else
			return true;
	}
	//................delete record from database [end].................................
	
	//...............................select rows from a table [start]................
	function sel_rec ($tab,$fields="*",$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false) 
	{
		/*if($fields=="*")
			$fields="*";
		else
			$fields="$fields";*/
		
	$qry = "select $fields from $tab where $where order by $orderby $order $limit"; 
		
		if ($disp)
			echo $qry;
		
		$res = mysql_query($qry);
		
		if (!$res)	
			echo mysql_error()."-<b>".$qry."</b>";
		
		if (mysql_num_rows($res) > 0)
			return $res;
		else
			return false;
		
	}
	function sel_rec1 ($tab,$fields="*",$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false) 
	{
		/*if($fields=="*")
			$fields="*";
		else
			$fields="$fields";*/
		
	$qry = "select $fields from $tab where $where group by $orderby $order $limit"; 
		
		if ($disp)
			echo $qry;
		
		$res = mysql_query($qry);
		
		if (!$res)	
			echo mysql_error()."-<b>".$qry."</b>";
		
		if (mysql_num_rows($res) > 0)
			return $res;
		else
			return false;
		
	}
	function sel_total_rec ($tab,$fields="*",$where="1=1") 
	{
		/*if($fields=="*")
			$fields="*";
		else
			$fields="$fields";*/
		
		$qry = "select $fields from $tab where $where";
		
		if ($disp)
			echo $qry;
		
		$res = mysql_query($qry);
		echo mysql_error();
		
		if (!$res)	
			echo mysql_error()." - <b>".$qry."</b>";
		
		if (mysql_num_rows($res) > 0)
			return mysql_num_rows($res);
		else
			return 0;
		
	}
	//...............................select rows from a table [end]................
	
	//...............................select  single row from a table [start]................
	function single_row($tab,$fields="*",$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false)
	{
		$res_single = sel_rec($tab,$fields,$where,$orderby,$order,$limit,$disp);
        //print_r($res_single);

		//echo mysql_num_rows($res_single); exit;
		if ($res_single != false && mysql_num_rows($res_single) > 0)
		{
            //print_r($res_single);
			return strip_slashes(mysql_fetch_array($res_single));
		}
		else
			return false;
	}

function single_row_assoc($tab,$fields="*",$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false)
{
    $res_single = sel_rec($tab,$fields,$where,$orderby,$order,$limit,$disp);
    //print_r($res_single);

    //echo mysql_num_rows($res_single); exit;
    if ($res_single != false && mysql_num_rows($res_single) > 0)
    {
        //print_r($res_single);
        return strip_slashes(mysql_fetch_assoc($res_single));
    }
    else
        return false;
}

function single_row_withSlash($tab,$fields="*",$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false)
	{
		$res_single = sel_rec($tab,$fields,$where,$orderby,$order,$limit,$disp);
		//echo mysql_num_rows($res_single); exit;
		if ($res_single != false && mysql_num_rows($res_single) > 0)
		{
			//echo "test"; exit;
			return mysql_fetch_array($res_single);
		}
		else
			return false;
	}
	//...............................select  single row from a table [end]................
	
	//...............................select single value from a table [start]................
	function get_single_value($tab,$fields,$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false)
	{
		$res = sel_rec($tab,$fields,$where,$orderby,$order,$limit,$disp);
		if ($res)
		{
			$val = mysql_fetch_array($res);
			return strip_slashes($val[$fields]);
		}
		else
			return false;
	}

        function get_single_value_with_Slashes($tab,$fields,$where="1=1",$orderby="1",$order="desc",$limit="",$disp=false)
	{
		$res = sel_rec($tab,$fields,$where,$orderby,$order,$limit,$disp);
		if ($res)
		{
			$val = mysql_fetch_array($res);
			return $val[$fields];
		}
		else
			return false;
	}

	//...............................select single value from a table [end]................
	
	
	//...............................check for duplication row in a table while adding new row [start]................
	function is_dup_add($table,$field,$value,$disp=false)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."'"; 
		if ($disp)
			die($q);
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	//...............................check for duplication row in a table while adding new row [end]................
	
	//...............................check for duplication row in a table while updating any row [start]................
	function is_dup_edit($table,$field,$value,$tableid,$id,$disp=false)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."' and ".$tableid."!= '".$id."'"; 
		if ($disp)
			die($q);
		$r = mysql_query($q);
		if(!$r)
			echo mysql_error();
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	function is_dup_byid($table,$field,$value,$tableid,$id,$disp=false)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."' and ".$tableid."= '".$id."'"; 
		if ($disp)
			die($q);
		$r = mysql_query($q);
		if(!$r)
			echo mysql_error();
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	function is_dup_edit_byid($table,$field,$value,$tableid,$id,$disp=false)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."' and ".$tableid."!= '".$id."'"; 
		if ($disp)
			die($q);
		$r = mysql_query($q);
		if(!$r)
			echo mysql_error();
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	//...............................check for duplication row in a table while updating any row [end]................


function list_states($country1='')
{
	$list_country=sel_rec(STATE,"*","CountryId=43","Region","asc","",false);	
	if($list_country!=false)
	{
		$opt_list="<option value='0'>Select State</option>";		
		while($val_country=mysql_fetch_array($list_country))
		{
			//$list_country=mysql_fetch_array($list_country);
			$id=$val_country['RegionID'];
			$name=$val_country['Region'];
			$sel_count='';
			if($country1==$id)
			{
				$sel_count="selected='selected'";
			}
			$opt_list.="<option value='$id' $sel_count>".$name."</option>";	
		}
	}
	return $opt_list;
}
function city_selected($tab,$where="1=1",$selected)
{
	echo $search_qry="select CityId,city from ".CITY." where $where order by city asc";
	//$list_field=sel_rec($tab,"*",$where,"name","asc","",$disp=false);	
	$list_field=mysql_query($search_qry);
	if(mysql_num_rows($list_field)>0)
	{
		$opt_list="<option value='0'>Select City</option>";		
		while($val_country=mysql_fetch_array($list_field))
		{			
			$id=$val_country['CityId'];
			$name=$val_country['city'];
			$sel_count='';
			if($selected==$id)
			{
				$sel_count="selected='selected'";
			}
			$opt_list.="<option value='$id' $sel_count>".$name."</option>";	
		}
	}
	return $opt_list;
}
function state_selected($tab,$where,$selected,$field_id='',$field_name='')
{
	$list_field=sel_rec($tab,"*",$where,"Region","asc","",$disp=false);	
	if($list_field!=false)
	{
		$opt_list="<option value='0'>Select State</option>";		
		while($val_country=mysql_fetch_array($list_field))
		{			
			$id=$val_country['RegionID'];
			$name=$val_country['Region'];
			$sel_count='';
			if($selected==$id)
			{
				$sel_count="selected='selected'";
			}
			$opt_list.="<option value='".$val_country['RegionID']."' $sel_count>".$name."</option>";	
		}
	}
	return $opt_list;
}
//...................Database functions end.................
?>