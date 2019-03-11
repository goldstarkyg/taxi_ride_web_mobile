<?php
class get_pageing_cms
{
	var $record_per_page=10;
	var	$pages=5;
	var $tbl,$file_names,$order,$query;

///////// GET THE VALUE OF START VARIABLE////////////////

	function start()
	{
		if($_GET["start"])
			return	$start=$_GET["start"];
		else
			return	$start=0;
	}

//////////////  END OF START FUNCTION///////////////////

//////////////  GET THE CURRENT FILE NAME ///////////////////

	function file_names()
	{
		$pt=explode("/",$_SERVER['SCRIPT_FILENAME']);
		//$pt=explode("/",$_SERVER['REQUEST_URI']);
		$totpt=count($pt);
		return $this->file_names=$pt[$totpt-1];
	}

//////////////  END OF FILE_NAME FUNCTION///////////////////

//////////////  DISPLAY THE NUMERIC PAGING WITHOUT RECORD DETAIL///////////////////

	function number_pageing_nodetail($query,$record_per_page='',$pages='')
	{
		return $this->number_pageing($query,$record_per_page,$pages,"N");
	}

	function number_pageing_bottom_nodetail($query,$record_per_page='',$pages='')
	{
		return $this->number_pageing($query,$record_per_page,$pages,"N","Y");
	}

	function number_pageing_bottom($query,$record_per_page='',$pages='')
	{
		return $this->number_pageing($query,$record_per_page,$pages,"","Y");
	}

//////////////  END OF NUMERIC PAGING FUNCTION ///////////////////

	function runquery($query)
	{
		return	mysql_query($query);
	}

	function table($result,$titles,$fields,$passfield="",$edit,$delete,$parent="")
	{

		if($parent=="")
			$parent="Y";

		if($passfield=="")
			$passfield="id";

		$cont="<table width='100%' cellspacing='0' cellpadding='3' border='0' class='borders'><tr>";
		foreach($titles as $K=>$V)
		{
			$cont1.="<td";
			$cont1.=(is_numeric($V))?" width='$V%' align='center'><strong>$K</strong></td>":" align='center'><strong>$V</strong></td>";
		}
		$cont.=$cont1."</tr>";
		$cont.="<tr><td colspan='".count($titles)."'><script language=javascript>
					msg=\"<table border=0 cellpadding=3 cellspacing=1 class='bg1' width='100%'><TR>$cont1</TR></table>\";

					</script>
			<script src='topmsg.js'></script>
			</td></tr>";
		$j=0;
		while($gets=mysql_fetch_object($result))
		{
			$j=1;
			$cont.="<tr onMouseOver=\"this.className='yellowdark3bdr'\" onmouseout=\"this.className=''\">";
			foreach($fields as $K=>$V)
			{
				$cont.="<td align='center'>";
				$tmps=explode(",",$V);
				$newval="";
				foreach($tmps as $val)
				{
					$newval.=$gets->$val." ";
				}
				$cont.=(is_numeric($K))?$newval:"<a href='$K?$passfield=".$gets->$passfield."' onMouseOver=\"smsg('View Detail of ".addslashes($newval)."');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$newval."</a>";
				$cont.="&nbsp;</td>";
			}
			$cont.="<td><INPUT name='button' type='button' onClick=\"";
			$cont.=($parent=="N")?"window":"parent.body";
			$cont.=".location.href='$edit?$passfield=".$gets->$passfield."'\" value='Edit' onMouseOver=\"smsg('Edit This Record -> $newval');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&nbsp;&nbsp;<INPUT onClick=\"deleteconfirm('Are you sure you want to delete this Record?.','$delete?$passfield=".$gets->$passfield."');\" type='button' value='Delete' onMouseOver=\"smsg('Delete This Record -> $newval');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&nbsp;</td>";
			$cont.="</tr>";
		}

		if($j==0)
		{
			$cont.="<tr><td colspan='".(count($fields)+1)."' align='center'><font color='red'><strong>No Record To Display</strong></font></td></tr>";
		}
		echo	$cont.="</table>";
	}
///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////

	function number_pageing_req($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='',$cur_page="",$query_string="",$cat_id="")
	{

		$this->file_names();
		$this->query=$query;

		if($record_per_page>0)
			$this->record_per_page=$record_per_page;

		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();

		$start=$this->start();

		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();

		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if ($current_page > 2)
			$start_loop = $current_page-2 ;

		if ($total_pages >= $current_page + 3)
		{
			$end_loop = $current_page + 3;
		}

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}

		//$this->tbl="<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr><td width='15%' align='left'>&nbsp;&nbsp;";

		$this->tbl="<div class='pagination'>";



		if ($cur_page == "")
			$cur_page = $this->file_names;

		if($start>0)
		{
			//$this->tbl.="<a class='paging' href='".$cur_page."?start=".($start-$this->record_per_page).$query_string."' class='boldbluelink' onMouseOver=\"smsg('Previous Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">&lt;&lt;  Previous</a>&nbsp;&nbsp;";

			$this->tbl.="
			<a href=".$cur_page."?start=".($start-$this->record_per_page).$query_string.$cat_id."><< Previous</a> ";
		}
		else
		{
			$this->tbl.="<< Previous ";
		}

		//$this->tbl.="&nbsp;</td><td width='70%' align='center' class='bluenormaltahoma'>&nbsp;";
		if($detail!="N" and $simple !="N")
			$this->tbl.="Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records<BR>";
		if($simple!='N')
		{

			for($i=$start_loop;$i<$end_loop;$i++)
			{
				if($current_page==$i)
				{
					//$this->tbl.="<span class='currnet_page'>[".$i."]</span>&nbsp;&nbsp;";
					$this->tbl.="<a class='number current' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string.$cat_id."'>".$i."</a> ";
				}
				else
				{
					//$this->tbl.="<a class='paging' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."' class='boldbluelink' onMouseOver=\"smsg('View Page Number $i');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$i."</a>&nbsp;&nbsp;";

					$this->tbl.="<a class='number' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string.$cat_id."'>".$i."</a> ";

				}
			}
		}

		//$this->tbl.="&nbsp;</td><td width='15%' align='right'>";
		if($start+$this->record_per_page<$totalrows)
		{
			//$this->tbl.="<a class='paging' href='".$cur_page."?start=".($start+$this->record_per_page).$query_string."' class='boldbluelink' onMouseOver=\"smsg('Next Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Next  &gt;&gt;</a>";

			$this->tbl.="<a href='".$cur_page."?start=".($start+$this->record_per_page).$query_string.$cat_id."'>Next</a> ";

		}
		else
		{
			$this->tbl.=">> Next";
		}

		$this->tbl.="
                  </div>";

		if($bottom=="Y")
		{
			return $result=array($result,$this->tbl);
		}
		else
		{
			echo $this->tbl;
			return $result;
		}
	}


	function number_pageing($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='',$cur_page="",$query_string="")
	{
		$this->file_names();
		$this->query=$query;

		if($record_per_page>0)
			$this->record_per_page=$record_per_page;

		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();

		$start=$this->start();

		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();

		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if ($current_page > 2)
			$start_loop = $current_page-2 ;

		if ($total_pages >= $current_page + 3)
		{
			$end_loop = $current_page + 3;
		}

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		$this->tbl="<ul class='pagination pull-right' style='width: auto; float: right;'>";
		if ($cur_page == "")
			$cur_page = $this->file_names;

		if($total_pages >1)
		{
			//"perpage".$_REQUEST[perpage];
			$firstpage = floor(($total_pages/$limit)+1);
			$this->tbl.="<li><a class='number' href='".$cur_page."?start=".($firstpage-1)*$this->record_per_page.$query_string."'>".First."</a> </li>";

			if($_REQUEST[perpage]!="")
			{
				$_REQUEST[perpage]=$qs[2];
			}
			if($start>0)
			{
				$this->tbl.="
							<li><a href=".$cur_page."?start=".($start-$this->record_per_page).$query_string."><i class='fa fa-chevron-left'></i></a></li>";
			}
			else
			{
				//$this->tbl.="<li><a href='javascript:void(0);'><i class='fa fa-chevron-left'></i></a></li>";
			}

			/*$firstpage = floor(($total_pages/$limit)+1);
            $this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($firstpage-1)*$this->record_per_page.$query_string."'>".$firstpage."</a> </li>";*/

			if($detail!="N" and $simple !="N")
				$this->tbl.="Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records<BR>";
			if($simple!='N')
			{

				for($i=$start_loop;$i<$end_loop;$i++)
				{
					//$pages=5;
					//if($pages>5)
					if($current_page==$i)
					{
						$this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."'>".$i."</a> </li>";
					}
					else
					{
						$this->tbl.="<li><a class='number' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."'>".$i."</a></li> ";

					}
				}
			}

			/*$lastpage=$end_loop-1;
            $this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($total_pages-1)*$this->record_per_page.$query_string."'>".$total_pages."</a> </li>";*/

			if($start+$this->record_per_page<$totalrows)
			{
				$this->tbl.="<li><a href='".$cur_page."?start=".($start+$this->record_per_page).$query_string."'><i class='fa fa-chevron-right'></i></a> </li>";

			}
			else
			{
				//$this->tbl.="<li><a href='javascript:void(0);'><i class='fa fa-chevron-right'></i></a></li>";
			}

			$lastpage=$end_loop-1;
			$this->tbl.="<li><a class='number' href='".$cur_page."?start=".($total_pages-1)*$this->record_per_page.$query_string."'>".Last."</a> </li>";

		}
		else
		{
			if($detail!="N" and $simple !="N")
				$this->tbl.="Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records<BR>";
			if($simple!='N')
			{
				for($i=$start_loop;$i<$end_loop;$i++)
				{
					if($current_page==$i)
					{
						$this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."'>".$i."</a> </li>";
					}
					else
					{
						$this->tbl.="<li><a class='number' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."'>".$i."</a></li> ";

					}
				}
			}
		}

		$this->tbl.="</ul>";

		if($bottom=="Y")
		{
			return $result=array($result,$this->tbl);
		}
		else
		{
			echo $this->tbl;
			return $result;
		}
	}


///////////// START OF NUMBER PAGING FOR LIKE-FOLLOWER-FOLLOWING ///////////////////

	function number_pageing_like_follow_following($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='',$cur_page="",$query_string="")
	{
		//	echo "FunctionCall";
		$this->file_names();
		$this->query=$query;
		//echo "Query=".$query;
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;

		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();
		$start=$this->start();

		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();

		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if ($current_page > 2)
			$start_loop = $current_page-2 ;

		if ($total_pages >= $current_page + 3)
		{
			$end_loop = $current_page + 3;
		}

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		$this->tbl="<ul class='pagination pull-right' style='width: auto; float: right;'>";
		if ($cur_page == "")
			$cur_page = $this->file_names;

		if($total_pages >1)
		{
			$query_qs=explode("&",$query_string);
			parse_str($query_qs[1], $data_qs);

			//echo $this->file_names();
			$page_uri = $_SERVER['REQUEST_URI'];
			$query = explode('?',$page_uri);
			parse_str($query[1], $data);

			$data['start']=0;
			//$data['ord']=$_REQUEST['ord'];

			if(http_build_query($data) != "")
			{
				$this->file_names=$query[0].'?'.http_build_query($data);
			}
			else
			{
				$this->file_names=$query[0];
			}

			$firstpage = floor(($total_pages/$limit)+1);
			/*$this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($firstpage-1)*$this->record_per_page.$query_string."'>".First."</a> </li>";*/
			$this->tbl.="<li><a class='number' href='$this->file_names'>".First."</a> </li>";

			if($start>0)
			{
				//parse_str($qs[1], $data_qs);
				//$left_arrow_uri=($start-$this->record_per_page);
				$data['start']=($start-$this->record_per_page);
				//$data['ord']=$_REQUEST['ord'];

				if(http_build_query($data) != "")
				{
					$this->file_names=$query[0].'?'.http_build_query($data);
				}
				else
				{
					$this->file_names=$query[0];
				}
				$this->tbl.="
							<li><a href=".$this->file_names."><i class='fa fa-chevron-left'></i></a></li>";
			}
			else
			{
				//$this->tbl.="<li><a href='javascript:void(0);'><i class='fa fa-chevron-left'></i></a></li>";
			}

			/*$firstpage = floor(($total_pages/$limit)+1);
            $this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($firstpage-1)*$this->record_per_page.$query_string."'>".$firstpage."</a> </li>";*/

			if($detail!="N" and $simple !="N")
				$this->tbl.="Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records<BR>";
			if($simple!='N')
			{

				for($i=$start_loop;$i<$end_loop;$i++)
				{
					//$pages=5;
					//if($pages>5)

					if($current_page==$i)
					{

						$data['start']=($i-1)*$this->record_per_page;
						//$data['ord']=$_REQUEST['ord'];
						if(http_build_query($data) != "")
						{
							$this->file_names=$query[0].'?'.http_build_query($data);
						}
						else
						{
							$this->file_names=$query[0];
						}

						$this->tbl.="<li><a class='number current' href='".$this->file_names."'>".$i."</a> </li>";
					}
					else
					{
						$data['start']=($i-1)*$this->record_per_page;
						//$data['ord']=$_REQUEST['ord'];
						if(http_build_query($data) != "")
						{
							$this->file_names=$query[0].'?'.http_build_query($data);
						}
						else
						{
							$this->file_names=$query[0];
						}

						$this->tbl.="<li><a class='number' href='".$this->file_names."'>".$i."</a></li> ";

					}
				}
			}

			/*$lastpage=$end_loop-1;
            $this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($total_pages-1)*$this->record_per_page.$query_string."'>".$total_pages."</a> </li>";*/

			if($start+$this->record_per_page<$totalrows)
			{
				$data['start']=($start+$this->record_per_page);
				//$data['ord']=$_REQUEST['ord'];
				if(http_build_query($data) != "")
				{
					$this->file_names=$query[0].'?'.http_build_query($data);
				}
				else
				{
					$this->file_names=$query[0];
				}
				$this->tbl.="<li><a href='".$this->file_names."'><i class='fa fa-chevron-right'></i></a> </li>";

			}
			else
			{
				//$this->tbl.="<li><a href='javascript:void(0);'><i class='fa fa-chevron-right'></i></a></li>";
			}
			$data['start']=($total_pages-1)*$this->record_per_page;
			//$data['ord']=$_REQUEST['ord'];
			if(http_build_query($data) != "")
			{
				$this->file_names=$query[0].'?'.http_build_query($data);
			}
			else
			{
				$this->file_names=$query[0];
			}
			$lastpage=$end_loop-1;
			$this->tbl.="<li><a class='number' href='".$this->file_names."'>".Last."</a> </li>";

		}
		else
		{
			if($detail!="N" and $simple !="N")
				$this->tbl.="Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records<BR>";
			if($simple!='N')
			{
				for($i=$start_loop;$i<$end_loop;$i++)
				{
					if($current_page==$i)
					{
						$this->tbl.="<li><a class='number current' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."'>".$i."</a> </li>";
					}
					else
					{
						$this->tbl.="<li><a class='number' href='".$cur_page."?start=".($i-1)*$this->record_per_page.$query_string."'>".$i."</a></li> ";

					}
				}
			}
		}

		$this->tbl.="</ul>";

		if($bottom=="Y")
		{
			return $result=array($result,$this->tbl);
		}
		else
		{
			echo $this->tbl;
			return $result;
		}
	}

//////////// END OF NUMBER PAGING FOR LIKE-FOLLOWER-FOLLOWING //////////////////////

//////////////  SIMPLE NEXT-PRI PAGING ///////////////////
	function pageing($query,$record_per_page="",$pages="")
	{
		$manage_user_pg=strstr($_SERVER['REQUEST_URI'],"manage-user.php?image_id");
		if($manage_user_pg != "")
		{
			return $this->number_pageing_like_follow_following($query,$record_per_page,$pages,'','','N');
		}
		else
		{
			return $this->number_pageing($query,$record_per_page,$pages,'','','N');
		}
	}
//////////////  END OF SIMPLE PAGING FUNCTION///////////////////

//////////////  WRITE ALL,A TO Z CHARACTER WITH CURRENT PAGE LINK ///////////////////
	function order()
	{
		$this->file_names();
		$this->order.="<TR><TD><a class=la href='".$this->file_names."' onMouseOver=\"smsg('View All Records');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">All</a></TD><TD class=lg>|</TD>";
		for($i=65;$i<91;$i++)
		{
			$this->order.="<TD><a class=la href='$file_names?order=".chr($i)."' onMouseOver=\"smsg('View By ".chr($i)."');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".chr($i)."</a></TD><TD class=lg>|</TD>";
		}
		return $this->order.="</TR>";
	}

	function MakeCombo($query,$value="",$fill_value,$comboname)
	{
		if($value=="")
			$value=$fill_value;

		$run=$this->runquery($query);
		$totlist=mysql_affected_rows();
		$Combo="<select name='$comboname'>";
		$Combo.="<option value=''>----------Select-----------</option>";
		for($i=0;$i<$totlist;$i++)
		{
			$get=mysql_fetch_object($run);
			$Combo.="<option value='".$get->$value."'>".$get->$fill_value."</option>";
		}
		$Combo.="</select>";
		echo $Combo;
	}


}

?>