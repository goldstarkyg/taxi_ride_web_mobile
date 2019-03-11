 <?php
class tapnstyle
{
     public function signup($dataArr)
    {
        $request_data=array_decode($dataArr);
        $name=$request_data[name];
        //print_r($request_data);
        $email=$request_data[email];
        $phone_number=$request_data[phone_number];
        $password = $request_data[password];
        $facebook_id = $request_data[facebook_id];
        $flag = $request_data[isdevice];

        $sel="select * from user WHERE email='$email'";
        $rs=mysql_query($sel);

        //if($name !='' && $email !='' && $password !='')
        if($facebook_id !='')
        {
            $sel_face="select * from user WHERE facebook_id='$facebook_id'";
            $rs_face=mysql_query($sel_face);
        }
        if(mysql_num_rows($rs_face) > 0)
        {
            $succArr = 3;
        }
        else if(mysql_num_rows($rs) > 0)
        {
            $succArr = 2;
        }
        else
        {
            $arr['name'] = $name;
            $arr['email'] = $email;
            $arr['phone_number']=$phone_number;
            $arr['password']=md5($password);
            $arr['facebook_id']=$facebook_id;
            $arr['status']='1';
            $arr['isdevice']=$flag;
            if($facebook_id !='')
            {
                $image='graph.facebook.com/'.$facebook_id.'/picture?type=large';
                $arr['image']=$image;
            }
            else
            {
                //$image='avtar.jpg';
                $arr['image']='';
            }

            if(ins_rec(user, $arr))
            {

                $subject = 'Tap N Style Looking Great Just Got Easier';
                //$mail->Body = 'your new password is   '.$password.'';
                $body = '
			<p><b>User Register</b></p><br>
			<p><img src="http://138.68.5.43/tapNstyle/include/class/tapnstyle.png"></p><br>
			<p>Hey,'.$name.'</p><br>
			<p>Did someone call a stylist? </p>
			<p><b>Email Id:</b> '.$email.'</p>
			<p><b>Password:</b> '.$password.'</p><br>

			 <p>
            For the ladies, here’s an idea: before your next big night out get your girlfriend over to yours, buy some champers and order one of our trained professionals to Blow Dry & Style your hair or do your Make Up.  Sounds fun right, we think so too 

            Check Availability Now("https://mockingbot.in/app/6ctaxAoGx390jx076pmRgW3xOfhKs9j")
            </p>
			 <p>Follow us for latest news and hair & beauty pics from happy Tap n Style clients!</p>

			<p><b><a href="www.facebook.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/facebook.png" height="50" width="50"></a> <a href="https://twitter.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/twitter.jpeg" height="50" width="50"></a> <a href="https://instagram.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/instaragram.jpeg" height="50" width="50"></a> <b> </p><br>

		    <p><b>Tap n’ Style    |    Don’t Plan Ahead Ltd    |    Company No. 9184952</b></p>
			';



                $sql = "SELECT * FROM `user` WHERE email='$email'";
                $rs = mysql_query($sql) or die(mysql_error());
                $data=mysql_fetch_array($rs);
                $field['id']=$data['u_id'];
                $field['name']=$data['name'];
                $field['email']=$data['email'];
                $field['phone_number']=$data['phone_number'];
                $field['facebook_id']=$data['facebook_id'];

                $header = "From: info@tapnstyle.com\r\n";
                $header.= "MIME-Version: 1.0\r\n";
                $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $header.= "X-Priority: 1\r\n";
                $status = mail($email, $subject, $body, $header);

                //$succArr = 1;
            }
            if ($status)
            {
                $succArr = 1;
            }
        }
        if ($succArr == 1)
        {
            //  $fields[$i][Offset]=$i;
            //return '{"data":' . json_encode($fields) . ',"success":' . json_encode('true') . '}';
            return '{"message":"Sign Up successfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

        }
        else if($succArr == 2)
        {
            return '{"message":"Email id Already exists","success":' . json_encode('false') . '}';
        }
        else if($succArr == 3)
        {
            return '{"message":"Facebook id Already exists","success":' . json_encode('false') . '}';
        }

        //$rs = mysql_query($sql);


        //return json_encode($fields);
    }
	public function signup_08dec($dataArr)
	{
		$request_data=array_decode($dataArr);
		$name=$request_data[name];
                //print_r($request_data);
		$email=$request_data[email];
		$phone_number=$request_data[phone_number];
		$password = $request_data[password];
		$facebook_id = $request_data[facebook_id];
		$flag = $request_data[isdevice];

		$sel="select * from user WHERE email='$email'";
		$rs=mysql_query($sel);

		//if($name !='' && $email !='' && $password !='')
		if($facebook_id !='')
		{	
		$sel_face="select * from user WHERE facebook_id='$facebook_id'";
		$rs_face=mysql_query($sel_face);
		}
		if(mysql_num_rows($rs_face) > 0)
		{
			$succArr = 3;
		}
		else if(mysql_num_rows($rs) > 0)
		{
			$succArr = 2;
		}
		else
		{
			$arr['name'] = $name;
			$arr['email'] = $email;
			$arr['phone_number']=$phone_number;
			$arr['password']=md5($password);
			$arr['facebook_id']=$facebook_id;
			$arr['status']='1';
			$arr['isdevice']=$flag;
			if($facebook_id !='')
			{
				$image='graph.facebook.com/'.$facebook_id.'/picture?type=large';
				$arr['image']=$image;
			}
			else
			{
				//$image='avtar.jpg';
				$arr['image']='';
			}

			if(ins_rec(user, $arr))
            {

                 $subject = 'Welcome to Tap N Style, your account is approved!';
            //$mail->Body = 'your new password is   '.$password.'';
            $body = '<p><b>User Register</b></p><br>
			<p><img src="http://138.68.5.43/tapNstyle/include/class/tapnstyle.png"></p><br>
			<p>Hey,'.$name.'</p><br>
			<p>Did someone call a stylist? </p>
			<p><b>Email Id:</b> '.$email.'</p>
			<p><b>Password:</b> '.$password.'</p><br>

			
			 <p>Follow us for latest news and hair & beauty pics from happy Tap n Style clients!</p>

			<p><b><a href="www.facebook.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/facebook.png" height="50" width="50"></a> <a href="https://twitter.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/twitter.jpeg" height="50" width="50"></a> <a href="https://instagram.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/instaragram.jpeg" height="50" width="50"></a> <b> </p><br>

		    <p><b>Tap n’ Style    |    Don’t Plan Ahead Ltd    |    Company No. 9184952</b></p>
			';
    


            $sql = "SELECT * FROM `user` WHERE email='$email'";
            $rs = mysql_query($sql) or die(mysql_error());
            $data=mysql_fetch_array($rs);
            $field['id']=$data['u_id'];
            $field['name']=$data['name'];
            $field['email']=$data['email'];
            $field['phone_number']=$data['phone_number'];
            $field['facebook_id']=$data['facebook_id'];
      $header = "From: info@tapnstyle.com\r\n";
            $header.= "MIME-Version: 1.0\r\n";
            $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $header.= "X-Priority: 1\r\n";
            $status = mail($email,$subject,$body,$header);
          
            //$succArr = 1;
}           
 if ($status)
            {
                $succArr = 1;
            }
		}
		if ($succArr == 1)
		{
			//  $fields[$i][Offset]=$i;
			//return '{"data":' . json_encode($fields) . ',"success":' . json_encode('true') . '}';
			return '{"message":"Sign Up successfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else if($succArr == 2)
		{
			return '{"message":"Email id Already exists","success":' . json_encode('false') . '}';
		}
		else if($succArr == 3)
		{
			return '{"message":"Facebook id Already exists","success":' . json_encode('false') . '}';
		}

		//$rs = mysql_query($sql);


		//return json_encode($fields);
	}

	public function signup_old($dataArr)
	{
		$name=urldecode($dataArr[name]);
		$email=urldecode($dataArr[email]);
		$phone_number=urldecode($dataArr[phone_number]);
		$password = urldecode($dataArr[password]);
		$facebook_id = urldecode($dataArr[facebook_id]);
		$flag = urldecode($dataArr[isdevice]);

		$sel="select * from user WHERE email='.$email.'";
		$rs=mysql_query($sel);

		//if($name !='' && $email !='' && $password !='')
		if(mysql_num_rows($rs) > 0)
		{
			$succArr = -1;


		}
		else
		{
			$arr['name'] = $name;
			$arr['email'] = $email;
			$arr['phone_number']=$phone_number;
			$arr['password']=md5($password);
			$arr['facebook_id']=$facebook_id;
			$arr['isdevice']=$flag;

			ins_rec(user, $arr);
			$succArr = 1;
		}
		if ($succArr == 1)
		{
			//  $fields[$i][Offset]=$i;
			//return '{"data":' . json_encode($fields) . ',"success":' . json_encode('true') . '}';
			return '{"message":"Sign Up secessfully","success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Email id Already exists","success":' . json_encode('false') . '}';
		}

		//$rs = mysql_query($sql);


		//return json_encode($fields);
	}
	public function login($dataArr)
	{
		$email=urldecode($dataArr[email]);
		$password1 = urldecode($dataArr[password]);
		$password=md5($password1);

		 $sql = "SELECT * FROM `user` WHERE email='$email' and password='$password'";
		$rs = mysql_query($sql) or die(mysql_error());
		$data=mysql_fetch_array($rs);

		if (mysql_num_rows($rs) > 0)
		{
			$status="SELECT * FROM `user` where email='$email'";
			$statusrs=mysql_query($status);
			$datastatus=mysql_fetch_array($statusrs);
			$statuschk=$datastatus['status'];

			$arr_schedule['status']=0;
            		upd_rec(tp_schedule,$arr_schedule,"DATE(book_date)=subdate(current_date, 1)",false);

			$field['id']=$data['u_id'];
			$field['name']=$data['name'];
			$field['email']=$data['email'];
			$field['phone_number']=$data['phone_number'];
			$succArr = 1;

		}
		else {
			$succArr = -1;
		}
		if ($succArr == 1 AND $statuschk==1) 
		{
		
			return '{"user_details":' . json_encode($field) . ',"isActive":' . json_encode($statuschk) .  ',"success":' . json_encode("true") . '}';

		}
		elseif($statuschk == 0 and $succArr !=-1)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == -1)
		{
			return '{"message":"invalid login credentials","success":' . json_encode('false') . '}';
		}

	}
	public function facebook_login($dataArr)
	{
		$facebook_id=urldecode($dataArr[facebook_id]);

		$sql = "SELECT * FROM `user` WHERE facebook_id='$facebook_id'";
		$rs = mysql_query($sql) or die(mysql_error());
		$data=mysql_fetch_array($rs);
		if (mysql_num_rows($rs) > 0)
		{
			$u_id=$data['u_id'];
			$status="SELECT * FROM `user` where u_id='$u_id'";
			$statusrs=mysql_query($status);
			$datastatus=mysql_fetch_array($statusrs);
			$statuschk=$datastatus['status'];

			$fields['id']=$data['u_id'];
			$fields['name']=$data['name'];
			$fields['email']=$data['email'];
			$fields['phone_number']=$data['phone_number'];
			$fields['facebook_id']=$data['facebook_id'];
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1 AND $statuschk==1)
		{
			return '{"user_details":' . json_encode($fields) .',"isActive":' . json_encode($statuschk) . ',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0 and $succArr !=-1)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"invalid login credentials","success":' . json_encode('false') . '}';
		}
	}
	public function edit_profile($dataArr)
	{
		$uid=urldecode($dataArr[uid]);
		$name=urldecode($dataArr[name]);
		$email=urldecode($dataArr[email]);
		$phone_number=urldecode($dataArr[phone_number]);
		$status="SELECT * FROM `user` where u_id='$uid'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

		if($statuschk == 1 )
		{
			$arr['name'] = $name;
			$arr['email'] = $email;
			$arr['phone_number']=$phone_number;
			upd_rec(user,$arr,"u_id=$uid");
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1 AND $statuschk==1)
		{
			return '{"message":"Your profile details have been successfully updated.","isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"Update not a successfully","success":' . json_encode('false') . '}';
		}
	}
	public function get_profile($dataArr)
		{
			$uid=urldecode($dataArr[uid]);

			$result=sel_rec(user,"*","u_id='$uid'","u_id","desc","Limit 1",false);
			if ($result !='')
			{
				$row=mysql_fetch_array($result);
				$status="SELECT * FROM `user` where u_id='$uid'";
				$statusrs=mysql_query($status);
				$datastatus=mysql_fetch_array($statusrs);
				$statuschk=$datastatus['status'];

				$field['id']=$row['u_id'];
				$field['name']=$row['name'];
				$field['email']=$row['email'];
				$field['phone_number']=$row['phone_number'];
				$succArr = 1;

			}
			else
			{
				$succArr = -1;
			}
			if ($succArr == 1 and $statuschk==1)
			{
				return '{"user_details":' . json_encode($field) . ',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';

			}
			elseif($statuschk == 0 and $succArr = -1)
			{
				return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
			}
			else
			{
				return '{"message":"invalid login credentials","success":' . json_encode('false') . '}';
			}



		}
	public function forgot_password($dataArr)
	{
		$email=urldecode($dataArr[email]);
		$sel="select * from user WHERE email='$email'";
		$rs=mysql_query($sel);
		$row=mysql_fetch_array($rs);
        	$name=$row['name'];
		if(mysql_num_rows($rs) > 0)
		{
			$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$newPassword = '';
			for ($i = 0; $i < 8; $i++) $newPassword .= substr($str, rand(0, strlen($str)), 1);
			$password=$newPassword;

			$mdpassword=md5($password);
			//$fields['password']=$mdpassword;
			//upd_rec(user, $fields, "email="."'.$email.'", false);

			$upd="update user set password='$mdpassword' WHERE email='$email'";
			$up_rs=mysql_query($upd);

			$subject = 'Tap N Style Forgot Password';
			//$mail->Body = 'your new password is   '.$password.'';
			$body = '
			<p><b>Forgot Password</b></p><br>
			<p><img src="http://138.68.5.43/tapNstyle/include/class/tapnstyle.png"></p><br>
			<p>Hey,'.$name.'</p><br>
			<p>Your email and new password for Tap n’ Style are as below. </p>
			<p><b>Email Id:</b> '.$email.'</p>
			<p><b>Password:</b> '.$password.'</p><br>
	
			 <p>
            For the ladies, here’s an idea: before your next big night out get your girlfriend over to yours, buy some champers and order one of our trained professionals to Blow Dry & Style your hair or do your Make Up.  Sounds fun right, we think so too 

            Check Availability Now("https://mockingbot.in/app/6ctaxAoGx390jx076pmRgW3xOfhKs9j")
            </p>
			 <p>Follow us for latest news and hair & beauty pics from happy Tap n Style clients!</p>
			
			<p><b><a href="www.facebook.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/facebook.png" height="50" width="50"></a> <a href="https://twitter.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/twitter.jpeg" height="50" width="50"></a> <a href="https://instagram.com" target="_blank"><img src="http://138.68.5.43/tapNstyle/include/class/instaragram.jpeg" height="50" width="50"></a> <b> </p><br>

		    <p><b>Tap n’ Style    |    Don’t Plan Ahead Ltd    |    Company No. 9184952</b></p>
			';
                        $header = "From: info@tapnstyle.com\r\n"; 
                        $header.= "MIME-Version: 1.0\r\n"; 
                        $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
                        $header.= "X-Priority: 1\r\n";
                        $status = mail($email, $subject, $body, $header);
			if ($status)
			{
				$succArr = 1;
			}
		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1) {
			//  $fields[$i][Offset]=$i;
			//return '{"data":' . json_encode($fields) . ',"success":' . json_encode('true') . '}';
			return '{"message":"Mail send successfully","success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"invalid Email credentials","success":' . json_encode('false') . '}';
		}


	}

	public function forgot_password_old($dataArr)
	{
		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		//$mail->SMTPDebug=3;
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'sarju@techintegrity.in';
		$mail->Password = 'Welcometis1';
		$mail->SMTPSecure = 'tls';

		$mail->From = 'sarju@techintegrity.in';
		$mail->FromName = 'Test';
		$mail->addAddress('sarju@techintegrity.in', 'test');

		$mail->addReplyTo('sarju@techintegrity.in', 'test');

		$mail->WordWrap = 50;
		$mail->isHTML(true);

		$mail->Subject = 'Using PHPMailer';
		$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';

		if(!$mail->send())
		{
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		
		}
		else
		{
			echo 'Message has been sent';
		}

	}

	public  function  get_service($dataArr)
	{
		$uid=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$uid'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

		$sel="SELECT * FROM `tp_categories` where status !=0 and is_parent =0 ORDER by id DESC";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$id=$row['id'];

				$minute=$row['category_time'];
				//$minuts=date('H:i',strtotime($minute));
				$minuts1=date('H:i',strtotime($minute));
				$minuts = explode(":",$minuts1);
				$s=' ';
				if($minuts[0] !='00')
				{
					$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
					$times=$total_min/60;
					$time=$times.$s.'hrs';

				}
				else
				{
					$total_min = intval($minuts[1]);
					$time=$total_min.$s.'mins';
				}

				$field[$i]['id'] = $row['id'];
				$field[$i]['category_name'] = $row['category_name'];
				$field[$i]['category_price'] = $row['category_price'];
				$field[$i]['category_icon'] = $row['category_icon'];
				//$field[$i]['category_time'] = $row['category_time'];
				$field[$i]['category_time'] = $time;

				//$sel_sc="SELECT * FROM `tp_subcategories` WHERE parent_category_id=$id ORDER BY id DESC";
				$sel_sc="SELECT * FROM `tp_categories` WHERE is_parent=$id and status !=0 ORDER by id DESC";
				$rs_sc=mysql_query($sel_sc);
				if(mysql_num_rows($rs_sc) > 0)
				{
					$c=0;
					while($row_sub=mysql_fetch_array($rs_sc))
					{
						$minute=$row_sub['category_time'];
						//$minuts=date('H:i',strtotime($minute));
						$minuts1=date('H:i',strtotime($minute));
						$minuts = explode(":",$minuts1);
						$s=' ';
						if($minuts[0] !='00')
						{
							$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
							$times=$total_min/60;
							$time=$times.$s.'hrs';

						}
						else
						{
							$total_min = intval($minuts[1]);
							$time=$total_min.$s.'mins';
						}

						$sub_cate[$c]['subcategory_name'] = $row_sub['category_name'];
						$sub_cate[$c]['subcategory_price'] = $row_sub['category_price'];
						$sub_cate[$c]['subcategory_icon'] = $row_sub['category_icon'];
						$sub_cate[$c]['subcategory_time'] = $time;
						$sub_cate[$c]['sub_id'] = $row_sub['id'];
						$sub_cate[$c]['main_category_id']=$row_sub['is_parent'];
						$c++;
					}

					$field[$i]['subcategories']=$sub_cate;


				}
				else
				{
					$field[$i]['subcategories']=[];
				}


				$i++;
			}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
	
		if ($succArr == 1 and $statuschk==1)
		{
			return '{"choose_service":' . json_encode($field) .',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';

		}
		elseif($statuschk == 0 and $succArr !=-1)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}	

	public  function  get_service_20sep($dataArr)
	{
		//$uid=urldecode($dataArr[uid]);
		$sel="SELECT * FROM `tp_categories` ORDER by id DESC";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$id=$row['id'];
				
				$minute=$row['category_time'];
				//$minuts=date('H:i',strtotime($minute));
				$minuts1=date('H:i',strtotime($minute));
				$minuts = explode(":",$minuts1);
				$s=' ';
				if($minuts[0] !='00')
				{
					$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
					$times=$total_min/60;
					$time=$times.$s.'hrs';

				}
				else
				{
					$total_min = intval($minuts[1]);
					$time=$total_min.$s.'mins';
				}				

				$field[$i]['id'] = $row['id'];
				$field[$i]['category_name'] = $row['category_name'];
				$field[$i]['category_price'] = $row['category_price'];
				$field[$i]['category_icon'] = $row['category_icon'];
				//$field[$i]['category_time'] = $row['category_time'];
				$field[$i]['category_time'] = $time;


				//$sel_sc="SELECT * FROM `tp_subcategories` ts JOIN tp_categories tc on ts.parent_category_id=tc.id WHERE tc.id=$id";
				$sel_sc="SELECT * FROM `tp_subcategories` WHERE parent_category_id=$id ORDER BY id DESC";
				$rs_sc=mysql_query($sel_sc);
				if(mysql_num_rows($rs_sc) > 0)
				{
					$c=0;
					while($row_rc=mysql_fetch_array($rs_sc))
					{
						$minute=$row_rc['subcategory_time'];
						//$minuts=date('H:i',strtotime($minute));
						$minuts1=date('H:i',strtotime($minute));
						$minuts = explode(":",$minuts1);
						$s=' ';
						if($minuts[0] !='00')
						{
							$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
							$times=$total_min/60;
							$time=$times.$s.'hrs';

						}
						else
						{
							$total_min = intval($minuts[1]);
							$time=$total_min.$s.'mins';
						}		
						
						$sub_cate[$c]['subcategory_name'] = $row_rc['subcategory_name'];
						$sub_cate[$c]['subcategory_price'] = $row_rc['subcategory_price'];
						$sub_cate[$c]['subcategory_icon'] = $row_rc['subcategory_icon'];
						//$sub_cate[$c]['subcategory_time'] = $row_rc['subcategory_time'];
						$sub_cate[$c]['subcategory_time'] = $time;
						$sub_cate[$c]['parent_category_id'] = $row_rc['parent_category_id'];
						$sub_cate[$c]['sub_id'] = $row_rc['id'];
						$c++;
					}
					
					$field[$i]['subcategories']=$sub_cate;
				
					
				}
				else
					{
					 $field[$i]['subcategories']=[];
					}


			$i++;
			}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"choose_service":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
		
	public function stylist($dataArr)
	{
		$sel="SELECT * FROM `tp_artist` ORDER by a_id DESC";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$a_id=$row['a_id'];
				$field[$i]['a_id'] = $row['a_id'];
				$field[$i]['fullname'] = $row['fullname'];
				$field[$i]['image'] = $row['image'];
				$field[$i]['mobile_number'] = $row['mobile_no'];
				$field[$i]['country_code'] = '+'.$row['country_code'];
				$field[$i]['email'] = $row['email'];
				$field[$i]['password'] = $row['password'];
				$field[$i]['profile_detail'] = strip_tags($row['about_you']);
				$field[$i]['qualifications'] = strip_tags($row['qualifications']);
				$field[$i]['work_experience'] = strip_tags($row['work_experience']);
				$field[$i]['service_price'] = $row['service_price'];
				$field[$i]['document'] = $row['document'];
				$field[$i]['zipcode'] = $row['zipcode'];
				$field[$i]['miles'] = $row['miles'];
				$field[$i]['price'] = $row['price'];
				$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
				$rs_reting=mysql_query($sel_reting);
				$ros_reting=mysql_fetch_array($rs_reting);
				//$field[$i]['rating_point'] = $row['rating_point'];
				$field[$i]['rating_point'] = $ros_reting['totalreting'];
				$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
				$rs_review=mysql_query($sel_review);
				$ros_review=mysql_fetch_array($rs_review);
				$field[$i]['review'] = $ros_review['totalrevies'];
				$sel_cat="SELECT * FROM `tp_categories` where status !=0 ORDER by id DESC";
				$qry_cat=mysql_query($sel_cat);
				if (mysql_num_rows($qry_cat) > 0)
				{
					$a=0;
					//$row=mysql_fetch_array($result);
					while($row_cat=mysql_fetch_array($qry_cat)) {
						$id = $row_cat['id'];

						$minute = $row_cat['category_time'];
						//$minuts=date('H:i',strtotime($minute));
						$minuts1 = date('H:i', strtotime($minute));
						$minuts = explode(":", $minuts1);
						$s = ' ';
						if ($minuts[0] != '00') {
							$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
							$times = $total_min / 60;
							$time = $times . $s . 'hrs';

						} else {
							$total_min = intval($minuts[1]);
							$time = $total_min . $s . 'mins';
						}

						$field_cat[$a]['id'] = $row_cat['id'];
						$field_cat[$a]['category_name'] = $row_cat['category_name'];
						$field_cat[$a]['category_price'] = $row_cat['category_price'];
						$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
						//$field[$i]['category_time'] = $row['category_time'];
						$field_cat[$a]['category_time'] = $time;
						$sel_sc="SELECT * FROM `tp_subcategories` WHERE parent_category_id=$id and status !=0 ORDER BY id DESC";
						$rs_sc=mysql_query($sel_sc);
						if(mysql_num_rows($rs_sc) > 0)
						{
							$c=0;
								while($row_sub=mysql_fetch_array($rs_sc))
								{
									$minute=$row_sub['subcategory_time'];
									//$minuts=date('H:i',strtotime($minute));
									$minuts1=date('H:i',strtotime($minute));
									$minuts = explode(":",$minuts1);
									$s=' ';
									if($minuts[0] !='00')
									{
										$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
										$times=$total_min/60;
										$time=$times.$s.'hrs';

									}
									else
									{
										$total_min = intval($minuts[1]);
										$time=$total_min.$s.'mins';
									}

									$sub_cate[$c]['subcategory_name'] = $row_sub['subcategory_name'];
									$sub_cate[$c]['subcategory_price'] = $row_sub['subcategory_price'];
									$sub_cate[$c]['subcategory_icon'] = $row_sub['subcategory_icon'];
									//$sub_cate[$c]['subcategory_time'] = $row_rc['subcategory_time'];
									$sub_cate[$c]['subcategory_time'] = $time;
									$sub_cate[$c]['parent_category_id'] = $row_sub['parent_category_id'];
									$sub_cate[$c]['sub_id'] = $row_sub['id'];
									$c++;
								}
							$field_cat[$a]['sub_category'] = $sub_cate;
						}
						else
						{
							$field_cat[$a]['sub_category'] = [];
						}
						$a++;
					}
					$field[$i]['category'] = $field_cat;
				}
				else
				{
					$field[$i]['category'] = [];
				}



				$i++;
			}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"stylist and Artist":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	public  function  stylist_19sep($dataArr)
	{
		//$uid=urldecode($dataArr[uid]);
		$sel="SELECT * FROM `tp_artist` ORDER by a_id DESC";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$a_id=$row['a_id'];
				$field[$i]['a_id'] = $row['a_id'];
				$field[$i]['fullname'] = $row['fullname'];
				$field[$i]['image'] = $row['image'];
				$field[$i]['mobile_number'] = $row['mobile_number'];
				$field[$i]['country_code'] = '+'.$row['country_code'];
				$field[$i]['email'] = $row['email'];
				$field[$i]['password'] = $row['password'];
				$field[$i]['profile_detail'] = strip_tags($row['about_you']);
				$field[$i]['qualifications'] = strip_tags($row['qualifications']);
				$field[$i]['work_experience'] = strip_tags($row['work_experience']);
				$field[$i]['service_price'] = $row['service_price'];
				$field[$i]['document'] = $row['document'];
				$field[$i]['zipcode'] = $row['zipcode'];
				$field[$i]['miles'] = $row['miles'];
				$field[$i]['price'] = $row['price'];
				$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
				$rs_reting=mysql_query($sel_reting);
				$ros_reting=mysql_fetch_array($rs_reting);
				//$field[$i]['rating_point'] = $row['rating_point'];
				$field[$i]['rating_point'] = $ros_reting['totalreting'];
				//$field[$i]['review'] = $row['review'];
				$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
				$rs_review=mysql_query($sel_review);
				$ros_review=mysql_fetch_array($rs_review);
				$field[$i]['review'] = $ros_review['totalrevies'];

				$i++;
			}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"stylist and Artist":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	
	public  function stylist_old($dataArr)
	{
		//$uid=urldecode($dataArr[uid]);
		$sel="SELECT * FROM `tp_artist` ORDER by a_id DESC";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$field[$i]['a_id'] = $row['a_id'];
				$field[$i]['fullname'] = $row['fullname'];
				$field[$i]['image'] = $row['image'];
				$field[$i]['mobile_number'] = $row['mobile_number'];
				$field[$i]['email'] = $row['email'];
				$field[$i]['password'] = $row['password'];
				$field[$i]['profile_detail'] = strip_tags($row['about_you']);
				$field[$i]['qualifications'] = strip_tags($row['qualifications']);
				$field[$i]['work_experience'] = strip_tags($row['work_experience']);
				$field[$i]['service_price'] = $row['service_price'];
				$field[$i]['document'] = $row['document'];
				$field[$i]['zipcode'] = $row['zipcode'];
				$field[$i]['miles'] = $row['miles'];
				$field[$i]['price'] = $row['price'];
				$i++;
			}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"stylist and Artist":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}

	public  function  get_artist_profile($dataArr)
	{
		$a_id=urldecode($dataArr[a_id]);
		$sel="SELECT * FROM `tp_artist` WHERE a_id='$a_id'";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{

			$row=mysql_fetch_array($qry);
				$field['a_id'] = $row['a_id'];
				$field['fullname'] = $row['fullname'];
				$field['image'] = $row['image'];
				$field['mobile_number'] = $row['mobile_no'];
				$field['email'] = $row['email'];
				$field['password'] = $row['password'];
				$field['profile_detail'] = strip_tags($row['about_you']);
				$field['qualifications'] = strip_tags($row['qualifications']);
				$field['work_experience'] = strip_tags($row['work_experience']);
				$field['service_price'] = $row['service_price'];
				$field['document'] = $row['document'];
				$field['zipcode'] = $row['zipcode'];
				$field['miles'] = $row['miles'];
				$field['price'] = $row['price'];
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"Artist_detail":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
		}
		public function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
	{
		$earth_radius = 6371;
		$dLat = deg2rad($latitude2 - $latitude1);
		$dLon = deg2rad($longitude2 - $longitude1);

		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * asin(sqrt($a));
		$d = $earth_radius * $c;

		return $d;
	}

		public function artis_filter($dataArr)
		{
		$name=urldecode($dataArr[name]);
		$address =urldecode($dataArr[postcode]);
		$miles = urldecode($dataArr[miles]);
		$cate_id=urldecode($dataArr[category_id]);

		$uid=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$uid'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		$geo = json_decode($geo, true);

		if ($geo['status'] = 'OK')
		{
			$latitude1 = $geo['results'][0]['geometry']['location']['lat'];
			$longitude1 = $geo['results'][0]['geometry']['location']['lng'];
		}
		//$sql = "select * from tp_artist where fullname Like '%$name%' AND status !=0 AND find_in_set('$cate_id',service_price) <> 0";
		$sql="SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id and ta.fullname Like '$name%' AND ta.status !=0 and ta.holiday_status=0 ORDER by tac.artist_price DESC";
		$rslocation=mysql_query($sql);

		if (mysql_num_rows($rslocation) > 0)
		{
			$total = mysql_num_rows($rslocation);
			$i=0;
			while ($row = mysql_fetch_array($rslocation))
			{
				$latitude2 = $row['latitude'];
				$longitude2 = $row['longitude'];

				$distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
				if ($distance < $row['miles'])
				{
					$service_id=$row['service_price'];
					$a_id=$row['a_id'];
					$field[$i]['a_id'] = $row['a_id'];
					$field[$i]['fullname'] = $row['fullname'];
					$field[$i]['image'] = $row['image'];
					$field[$i]['mobile_number'] = $row['mobile_no'];
					$field[$i]['country_code'] = '+' . $row['country_code'];
					$field[$i]['email'] = $row['email'];
					$field[$i]['password'] = $row['password'];
					$field[$i]['profile_detail'] = strip_tags(utf8_encode($row['about_you']));
					$field[$i]['qualifications'] = strip_tags(utf8_encode($row['qualifications']));
					$field[$i]['work_experience'] = strip_tags(utf8_encode($row['work_experience']));
					$field[$i]['service_price'] = $row['service_price'];
					$field[$i]['document'] = $row['document'];
					$field[$i]['zipcode'] = $row['zipcode'];
					$field[$i]['miles'] = $row['miles'];
					$sel_price="SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
					$rs_price=mysql_query($sel_price);
					$data=mysql_fetch_array($rs_price);
					if($data['artist_price'] !='')
					{
						$field[$i]['price'] = $data['artist_price'];
					}
					else
					{
						$field[$i]['price'] = "0";
					}
					$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
					$rs_reting=mysql_query($sel_reting);
					$ros_reting=mysql_fetch_array($rs_reting);
					//$field[$i]['rating_point'] = $row['rating_point'];
					if($row['rating_point'] !='')
					{
						$rat=$row['rating_point'];
						$field[$i]['rating_point'] = $row['rating_point'];
					}
					else
					{
						$rat='0';
						$field[$i]['rating_point'] = '0';
					}
					$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
					$rs_review=mysql_query($sel_review);
					$ros_review=mysql_fetch_array($rs_review);
					//$field[$i]['review'] = $ros_review['totalrevies'];
					if($ros_review['totalrevies'] !='')
					{
						$review=$ros_review['totalrevies'];
						$field[$i]['review'] = $ros_review['totalrevies'];
					}
					else
					{
						$review='0';
						$field[$i]['review'] = '0';
					}
					$avreg_rate=$rat/$review;
					if($avreg_rate !='') 
					{
						$field[$i]['rate_avrege'] = $avreg_rate;
					}
					else
					{
						$field[$i]['rate_avrege'] = "0";
					}
					$sel_gallary="SELECT * FROM `tp_artist_portfolio` WHERE artist_id=$a_id";
                   			 $rs_gallary=mysql_query($sel_gallary);
                    			if(mysql_num_rows($rs_gallary) > 0)
                   			 {
                      			  $field_gallary=[];
                       			 $g=0;
                        		while($row_gallary=mysql_fetch_array($rs_gallary))
                        		{
		                            $field_gallary[$g][portfolio_image]=$row_gallary['portfolio_image'];
                		            $field_gallary[$g][image_title]=$row_gallary['image_title'];
                		            $field_gallary[$g][image_caption]=$row_gallary['image_caption'];
                		            $g++;
                		        }
                		            $field[$i]['gallary'] = $field_gallary;
                		    }
		                    else
                		    {
                		        $field[$i]['gallary'] = [];
                		    }
					$field_cat=[];
					//$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
					$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) order BY tc.id DESC";
					$qry_cat=mysql_query($sel_cat);
					if (mysql_num_rows($qry_cat) > 0)
					{
						$a=0;
						while($row_cat=mysql_fetch_array($qry_cat))
						{
							/*$minute = $row_cat['artist_time'];
							$minuts1 = date('H:i', strtotime($minute));
							$minuts = explode(":", $minuts1);
							$s = ' ';
							if ($minuts[0] != '00')
							{
								$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
								$times = $total_min / 60;
								$time = $times . $s . 'hrs';

							}
							else
							{
								$total_min = intval($minuts[1]);
								$time = $total_min . $s . 'mins';
							}*/
							$minute = $row_cat['artist_time'];
                            				$s = ' ';
                            				$total_min=$minute;
                            				$hours = floor($total_min / 60);
                            				$minutes = ($total_min % 60);
                           				// $time=sprintf($format, $hours, $minutes);
                           				$art_time=$hours.$s.'hr'.$s.$minutes.$s.'mins';

							$service_price=explode(",", $row['price']);
							$field_cat[$a]['id'] = $row_cat['artist_category'];
							$field_cat[$a]['category_name'] = $row_cat['category_name'];
							$field_cat[$a]['category_price'] =$row_cat['artist_price'];
							$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
							$field_cat[$a]['category_time'] = $art_time;
							$field_cat[$a]['main_category_id']=$row_cat['is_parent'];
							$a++;
						}
						$field[$i]['category'] = $field_cat;

					}
					else
					{
						$field[$i]['category'] = [];
					}
					$i++;
				}

			}
		
			$lim = 10;
			$off = $dataArr[off];
			if ($off == '' || $off == '0')
				$off = 0;
			$cms_pageing = new get_pageing_cms();
			$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
			$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
			$pg_query_string = '';
			$perpageTmp = urldecode($dataArr[perpage]);
			$perpage = '';
			if ($perpageTmp != '') {
				$perpage = $perpageTmp;
			} else {
				$perpage = 10;
			}

			$arra= array_slice( $field,$off,$lim);
			$num =sizeof($arra);
			//echo $num;exit;
			if($num !=0)
			{
				$fields=$arra;
				$new_off = $off + $num;
				$succArr = 1;
			}
			else
			{
				$result_array = 2;
			}

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1 and $statuschk == 1)
		{
			return '{"Artist_filter":' . json_encode($fields) . ',"isActive":' . json_encode($statuschk).',"Offset":' . $new_off .',"success":' . json_encode("true") . ',"total":'.$total.'}';

		}
		else if($succArr == 2)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
		
		public  function  artis_filter_21sep($dataArr)
		{
		$name=urldecode($dataArr[name]);
		$lim = 10;
		$off = $dataArr[off];
		if ($off == '' || $off == '0')
			$off = 0;

		$sel="SELECT * FROM `tp_artist` WHERE fullname Like '$name%' ORDER  by a_id DESC LIMIT $off,$lim";
		$qry=mysql_query($sel);
		$num=mysql_num_rows($qry);
		$new_off = $off + $num;
		if (mysql_num_rows($qry) > 0) {
			$i=0;
			while ($row = mysql_fetch_array($qry))
			{
			$field[$i]['a_id'] = $row['a_id'];
			$field[$i]['fullname'] = $row['fullname'];
			$field[$i]['image'] = $row['image'];
			$field[$i]['mobile_number'] = $row['mobile_number'];
			$field[$i]['email'] = $row['email'];
			$field[$i]['password'] = $row['password'];
			$field[$i]['profile_detail'] = strip_tags($row['about_you']);
			$field[$i]['qualifications'] = strip_tags($row['qualifications']);
			$field[$i]['work_experience'] = strip_tags($row['work_experience']);
			$field[$i]['service_price'] = $row['service_price'];
			$field[$i]['document'] = $row['document'];
			$field[$i]['zipcode'] = $row['zipcode'];
			$field[$i]['miles'] = $row['miles'];
			$field[$i]['price'] = $row['price'];
			$field[$i]['rating_point'] = $row['rating_point'];
		    $field[$i]['review'] = $row['review'];
		$i++;
		}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"Artist_filter":' . json_encode($field) . ',"Offset":' . $new_off . ',"success":' . json_encode("true") . '}';

		}
	
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	public  function  artis_filter_old($dataArr)
	{
		$name=urldecode($dataArr[name]);
		$sel="SELECT * FROM `tp_artist` WHERE fullname Like '$name%' ORDER  by a_id DESC";
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0) {
			$i=0;
			while ($row = mysql_fetch_array($qry))
			{
			$field[$i]['a_id'] = $row['a_id'];
			$field[$i]['fullname'] = $row['fullname'];
			$field[$i]['image'] = $row['image'];
			$field[$i]['mobile_number'] = $row['mobile_number'];
			$field[$i]['email'] = $row['email'];
			$field[$i]['password'] = $row['password'];
			$field[$i]['profile_detail'] = strip_tags($row['about_you']);
			$field[$i]['qualifications'] = strip_tags($row['qualifications']);
			$field[$i]['work_experience'] = strip_tags($row['work_experience']);
			$field[$i]['service_price'] = $row['service_price'];
			$field[$i]['document'] = $row['document'];
			$field[$i]['zipcode'] = $row['zipcode'];
			$field[$i]['miles'] = $row['miles'];
			$field[$i]['price'] = $row['price'];
			$field[$i]['rating_point'] = $row['rating_point'];
			$field[$i]['review'] = $row['review'];
		$i++;
		}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"Artist_detail":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}

	public  function  postcode($dataArr)
	{
		$address =urldecode($dataArr[postcode]);
		$miles = urldecode($dataArr[miles]);

		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		$geo = json_decode($geo, true);

		if ($geo['status'] = 'OK') {

			$latitude = $geo['results'][0]['geometry']['location']['lat'];
			$longitude = $geo['results'][0]['geometry']['location']['lng'];
		}
		$sql = "SELECT DISTINCT *,Round(((ACOS(SIN('$latitude' * PI() / 180) * SIN(latitude * PI() / 180) + COS('$latitude' * PI() / 180) * COS(latitude * PI() / 180) * COS(('$longitude'-longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515),(2)) AS distance FROM tp_artist Having distance <= $miles";
		$rslocation=mysql_query($sql);

		if (mysql_num_rows($rslocation) > 0)
		{
			$i=0;
			while ($row = mysql_fetch_array($rslocation))
			{
				$field[$i]['a_id'] = $row['a_id'];
				$field[$i]['fullname'] = $row['fullname'];
				$field[$i]['image'] = $row['image'];
				$field[$i]['mobile_number'] = $row['mobile_number'];
				$field[$i]['email'] = $row['email'];
				$field[$i]['password'] = $row['password'];
				$field[$i]['profile_detail'] = strip_tags($row['about_you']);
				$field[$i]['qualifications'] = strip_tags($row['qualifications']);
				$field[$i]['work_experience'] = strip_tags($row['work_experience']);
				$field[$i]['service_price'] = $row['service_price'];
				$field[$i]['document'] = $row['document'];
				$field[$i]['zipcode'] = $row['zipcode'];
				$field[$i]['miles'] = $row['miles'];
				$field[$i]['price'] = $row['price'];
				$field[$i]['rating_point'] = $row['rating_point'];
				$field[$i]['review'] = $row['review'];
				$i++;
			}
			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"Artist_filter":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
		
		public function artist_review($dataArr)
		{
		$a_id=urldecode($dataArr[a_id]);
		$review=urldecode($dataArr[review]);
		$u_id=urldecode($dataArr[u_id]);
		$book_id=urldecode($dataArr[book_id]);
		$rating_point=urldecode($dataArr[rating_point]);

		$status="SELECT * FROM `user` where u_id='$u_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

		if($a_id !='' && $u_id !='')
		{
			$date=date("Y-m-d h:i:sa");
			$arr['user_id'] = $u_id;
			$arr['artist_id']=$a_id;
			$arr['review']=$review;
			$arr['book_id']=$book_id;
			$arr['review_date']=$date;
			$arr['review_rating']=$rating_point;
			ins_rec(tp_review, $arr);

			 $sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
           		 $rs_reting=mysql_query($sel_reting);
           		 $ros_reting=mysql_fetch_array($rs_reting);
            		 $rat=$ros_reting['totalreting'];

		         $sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
    		         $rs_review=mysql_query($sel_review);
            		 $ros_review=mysql_fetch_array($rs_review);
		         $review=$ros_review['totalrevies'];
		         $avreg_rate=$rat/$review;

	                 $fields[rating_point] = $avreg_rate;
           
		        upd_rec(tp_artist,$fields,"a_id=$a_id");

			//$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC";
			$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs) > 0)
			{
				$i=0;
				while($data=mysql_fetch_array($rs))
				{
					$field[$i]['r_id']=$data['r_id'];
					$field[$i]['user_id']=$data['r_id'];
					$field[$i]['artist_id']=$data['artist_id'];
					$field[$i]['review']=$data['review'];
					$field[$i]['name']=$data['name'];
					$field[$i]['email']=$data['email'];
					$field[$i]['phone_number']=$data['phone_number'];
					$field[$i]['facebook_id']=$data['facebook_id'];
					$field[$i]['review_date']=$data['review_date'];
					$field[$i]['rating_point']=$data['review_rating'];
					$field[$i]['book_id']=$book_id;
					$i++;
				}
			}

			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1 and $statuschk == 1)
		{
			return '{"message":"Review Submit successfully","user_details":' . json_encode($field) . ',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == -1)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}

	}
	public  function get_review($dataArr)
	{
		$a_id=urldecode($dataArr[a_id]);
		$u_id=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$u_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

			$lim = 10;
			$off = $dataArr[off];
			if ($off == '' || $off == '0')
				$off = 0;
			$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC LIMIT $off,$lim";

			$cms_pageing = new get_pageing_cms();
			$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
			$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
			$pg_query_string = '';
			$perpageTmp = urldecode($dataArr[perpage]);
			$perpage = '';
			if ($perpageTmp != '') {
				$perpage = $perpageTmp;
			} else {
				$perpage = 10;
			}
			$rs=mysql_query($sql);
			$num = mysql_num_rows($rs);
			$new_off = $off + $num;
			if($num > 0)
			{
				$i = 0;
				while ($data = mysql_fetch_array($rs)) {
					$field[$i]['r_id'] = $data['r_id'];
					$field[$i]['user_id'] = $data['user_id'];
					$field[$i]['artist_id'] = $data['artist_id'];
					$field[$i]['review'] = $data['review'];
					$field[$i]['name'] = $data['name'];
					$field[$i]['email'] = $data['email'];
					$field[$i]['phone_number'] = $data['phone_number'];
					$field[$i]['facebook_id'] = $data['facebook_id'];
					$field[$i]['review_date'] = $data['review_date'];
					$field[$i]['rating_point'] = $data['review_rating'];
					$field[$i]['book_id']=$data['book_id'];
					$i++;
				}
				$succArr = 1;
			}

		else
		{
			$succArr = -1;
		}
		if ($succArr == 1 and $statuschk == 1)
		{
			return '{"message":"Review Submit successfully","user_details":' . json_encode($field) . ',"isActive":' . json_encode($statuschk).',"Offset":' . $new_off . ',"success":' . json_encode("true") . ',"total":'.$num.'}';

		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == -1)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}

	}
	public  function get_review_21sep($dataArr)
	{
		$a_id=urldecode($dataArr[a_id]);

		if($a_id !='')
		{
			//$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id JOIN tp_artist ta on tr.artist_id=ta.a_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC";
			$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs) > 0)
			{
				$i=0;
				while($data=mysql_fetch_array($rs))
				{
					$field[$i]['r_id']=$data['r_id'];
					$field[$i]['user_id']=$data['user_id'];
					$field[$i]['artist_id']=$data['artist_id'];
					$field[$i]['review']=$data['review'];
					$field[$i]['name']=$data['name'];
					$field[$i]['email']=$data['email'];
					$field[$i]['phone_number']=$data['phone_number'];
					$field[$i]['facebook_id']=$data['facebook_id'];
					$field[$i]['review_date']=$data['review_date'];
					$field[$i]['rating_point']=$data['review_rating'];
					$i++;
				}
			}

			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"message":"Review successfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}

		else if($succArr == -1)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}

	}

		public function artist_review_old($dataArr)
	{
		$a_id=urldecode($dataArr[a_id]);
		$u_id=urldecode($dataArr[u_id]);
		$review=urldecode($dataArr[review]);

		if($a_id !='' && $u_id !='')
		{
			$date=date("Y-m-d h:i:sa");
			$arr['user_id'] = $u_id;
			$arr['artist_id']=$a_id;
			$arr['review']=$review;
			$arr['review_date']=$date;
			ins_rec(tp_review, $arr);
			//$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC";
			$sql="SELECT * FROM `tp_review` tr JOIN  user u ON tr.user_id=u.u_id JOIN tp_artist ta on tr.artist_id=ta.a_id WHERE tr.artist_id=$a_id ORDER BY tr.r_id DESC";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs) > 0)
			{
				$i=0;
				while($data=mysql_fetch_array($rs))
				{
					$field[$i]['r_id']=$data['r_id'];
					$field[$i]['user_id']=$data['r_id'];
					$field[$i]['artist_id']=$data['artist_id'];
					$field[$i]['review']=$data['review'];
					$field[$i]['name']=$data['name'];
					$field[$i]['email']=$data['email'];
					$field[$i]['phone_number']=$data['phone_number'];
					$field[$i]['facebook_id']=$data['facebook_id'];
					$field[$i]['review_date']=$data['review_date'];
					$field[$i]['rating_point']=$data['rating_point'];
				$i++;
				}
			}

			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"message":"Review successfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}

		else if($succArr == -1)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}

	}
	
	public  function stylist_asc_desc_22sep($dataArr)
	{
		$price=urldecode($dataArr[price]);
		$address =urldecode($dataArr[postcode]);
		$miles = urldecode($dataArr[miles]);
		$cate_id=urldecode($dataArr[category_id]);
		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		$geo = json_decode($geo, true);

		if ($geo['status'] = 'OK')
		{
			$latitude1 = $geo['results'][0]['geometry']['location']['lat'];
			$longitude1 = $geo['results'][0]['geometry']['location']['lng'];
		}
		if($price=='high')
		{
			//$sel = "SELECT * FROM `tp_artist` ORDER by a_id DESC";
			$sel = "select * from tp_artist where status !=0 AND find_in_set('$cate_id',service_price) <> 0 ORDER by price DESC";
		}
		else if($price=='low')
		{
			//$sel = "SELECT * FROM `tp_artist` ORDER by a_id ASC";
			$sel = "select * from tp_artist where status !=0 AND find_in_set('$cate_id',service_price) <> 0 ORDER by price ASC";
		}
		elseif($price=='rate')
		{
			$sel = "select * from tp_artist where status !=0 AND find_in_set('$cate_id',service_price) <> 0 ORDER by rating_point DESC";
			//$sel="SELECT * FROM `tp_artist` ORDER by rating_point DESC";
		}
		else
		{
			$sel = "select * from tp_artist where status !=0 AND find_in_set('$cate_id',service_price) <> 0 ORDER by price DESC";
		}
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$latitude2 = $row['latitude'];
				$longitude2 = $row['longitude'];
				$distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
				if ($distance < $row['miles']) {
					$a_id = $row['a_id'];
					$field[$i]['a_id'] = $row['a_id'];
					$field[$i]['fullname'] = $row['fullname'];
					$field[$i]['image'] = $row['image'];
					$field[$i]['mobile_number'] = $row['mobile_number'];
					$field[$i]['country_code'] = '+' . $row['country_code'];
					$field[$i]['email'] = $row['email'];
					$field[$i]['password'] = $row['password'];
					$field[$i]['profile_detail'] = strip_tags($row['about_you']);
					$field[$i]['qualifications'] = strip_tags($row['qualifications']);
					$field[$i]['work_experience'] = strip_tags($row['work_experience']);
					$field[$i]['service_price'] = $row['service_price'];
					$field[$i]['document'] = $row['document'];
					$field[$i]['zipcode'] = $row['zipcode'];
					$field[$i]['miles'] = $row['miles'];
					$field[$i]['price'] = $row['price'];
					$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
					$rs_reting=mysql_query($sel_reting);
					$ros_reting=mysql_fetch_array($rs_reting);
					//$field[$i]['rating_point'] = $row['rating_point'];
					if($ros_reting['totalreting'] !='')
					{
						$rat=$ros_reting['totalreting'];
						$field[$i]['rating_point'] = $ros_reting['totalreting'];
					}
					else
					{
						$rat='0';
						$field[$i]['rating_point'] = '0';
					}
					$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
					$rs_review=mysql_query($sel_review);
					$ros_review=mysql_fetch_array($rs_review);
					//$field[$i]['review'] = $ros_review['totalrevies'];
					if($ros_review['totalrevies'] !='')
					{
						$review=$ros_review['totalrevies'];
						$field[$i]['review'] = $ros_review['totalrevies'];
					}
					else
					{
						$review='0';
						$field[$i]['review'] = '0';
					}
					$avreg_rate=$rat/$review;
					if($avreg_rate !='') 
					{
						$field[$i]['rate_avrege'] = "$avreg_rate";
					}
					else
					{
						$field[$i]['rate_avrege'] = "0";
					}
					$sel_cat="SELECT * FROM `tp_categories` where status !=0 and is_parent =0 ORDER by id DESC";
					$qry_cat=mysql_query($sel_cat);
					if (mysql_num_rows($qry_cat) > 0)
					{
						$a=0;
						//$row=mysql_fetch_array($result);
						while($row_cat=mysql_fetch_array($qry_cat)) {
							$id = $row_cat['id'];

							$minute = $row_cat['category_time'];
							//$minuts=date('H:i',strtotime($minute));
							$minuts1 = date('H:i', strtotime($minute));
							$minuts = explode(":", $minuts1);
							$s = ' ';
							if ($minuts[0] != '00') {
								$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
								$times = $total_min / 60;
								$time = $times . $s . 'hrs';

							} else {
								$total_min = intval($minuts[1]);
								$time = $total_min . $s . 'mins';
							}

							$field_cat[$a]['id'] = $row_cat['id'];
							$field_cat[$a]['category_name'] = $row_cat['category_name'];
							$field_cat[$a]['category_price'] = $row_cat['category_price'];
							$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
							//$field[$i]['category_time'] = $row['category_time'];
							$field_cat[$a]['category_time'] = $time;
							$sel_sc="SELECT * FROM `tp_categories` where status !=0 and is_parent=$id ORDER by id DESC";
							$rs_sc=mysql_query($sel_sc);
							if(mysql_num_rows($rs_sc) > 0)
							{
								$c=0;
								while($row_sub=mysql_fetch_array($rs_sc))
								{
									$minute=$row_sub['category_time'];
									//$minuts=date('H:i',strtotime($minute));
									$minuts1=date('H:i',strtotime($minute));
									$minuts = explode(":",$minuts1);
									$s=' ';
									if($minuts[0] !='00')
									{
										$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
										$times=$total_min/60;
										$time=$times.$s.'hrs';

									}
									else
									{
										$total_min = intval($minuts[1]);
										$time=$total_min.$s.'mins';
									}

									$sub_cate[$c]['subcategory_name'] = $row_sub['category_name'];
									$sub_cate[$c]['subcategory_price'] = $row_sub['category_price'];
									$sub_cate[$c]['subcategory_icon'] = $row_sub['category_icon'];
									$sub_cate[$c]['subcategory_time'] = $time;
									//$sub_cate[$c]['parent_category_id'] = $row_sub['parent_category_id'];
									$sub_cate[$c]['sub_id'] = $row_sub['id'];
									$c++;
								}
								$field_cat[$a]['sub_category'] = $sub_cate;
							}
							else
							{
								$field_cat[$a]['sub_category'] = [];
							}
							$a++;
						}
						$field[$i]['category'] = $field_cat;
					}
					else
					{
						$field[$i]['category'] = [];
					}


					$i++;
					//$succArr = 1;
					$lim = 10;
					$off = $dataArr[off];
					if ($off == '' || $off == '0')
						$off = 0;
					$cms_pageing = new get_pageing_cms();
					$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
					$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
					$pg_query_string = '';
					$perpageTmp = urldecode($dataArr[perpage]);
					$perpage = '';
					if ($perpageTmp != '') {
						$perpage = $perpageTmp;
					} else {
						$perpage = 10;
					}

					$arra= array_slice( $field,$off,$lim);
					$num =sizeof($arra);
					//echo $num;exit;
					if($num !=0)
					{
						$fields=$arra;
						$new_off = $off + $num;
						$succArr = 1;
					}
					else
					{
						$result_array = 2;
					}
				}
				else
				{
					$succArr = 2;
				}
			}
			

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"stylist and Artist":' . json_encode($fields) . ',"Offset":' . $new_off .',"success":' . json_encode("true") . '}';

		}
		else if($succArr == 2)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	 public  function stylist_asc_desc($dataArr)
    	{
        $price=urldecode($dataArr[price]);
        $address =urldecode($dataArr[postcode]);
        $miles = urldecode($dataArr[miles]);
        $cate_id=urldecode($dataArr[category_id]);
        $event_date=urldecode($dataArr[schedule_date]);
        $schedule_time1=urldecode($dataArr[schedule_time]);
        $schedule_time=date("H:i:s", strtotime($schedule_time1));
        //echo $schedule_time;exit;

        $u_id=urldecode($dataArr[uid]);
        $status="SELECT * FROM `user` where u_id='$u_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        if($event_date !='')
        {
            $weekday = date('D', strtotime($event_date));
        }

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

        $geo = json_decode($geo, true);

        if ($geo['status'] = 'OK')
        {
            $latitude1 = $geo['results'][0]['geometry']['location']['lat'];
            $longitude1 = $geo['results'][0]['geometry']['location']['lng'];
        }
        if ($price == 'high' and $event_date == '' and $schedule_time1 == '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        } else if ($price == 'low' and $event_date == '' and $schedule_time1 == '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0  and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        }
        /*elseif ($price == 'rate' and $event_date == '' and $schedule_time1 == '') {
                $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
            }*/
        elseif ($price == 'highrate' and $event_date == '' and $schedule_time1 == '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        }
        elseif ($price == 'lowrate' and $event_date == '' and $schedule_time1 == '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by ta.rating_point ASC";
        }
        elseif ($price == 'high' and $event_date != '' and $schedule_time1 != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        } elseif ($price == 'low' and $event_date != '' and $schedule_time1 != '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time) AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        }
       
        elseif ($price == 'highrate' and $event_date != '' and $schedule_time1 != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        }
        elseif ($price == 'lowrate' and $event_date != '' and $schedule_time1 != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by ta.rating_point ASC";
        }
        elseif ($event_date != '' and $schedule_time1 != '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        else
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        $qry=mysql_query($sel);
        $field=[];
        if (mysql_num_rows($qry) > 0)
        {
            $data_count = mysql_num_rows($qry);
            $i=0;
            while($row=mysql_fetch_array($qry))
            {
                $latitude2 = $row['latitude'];
                $longitude2 = $row['longitude'];
                $artist_id=$row['artist_id'];
                $distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
                if ($distance < $row['miles'])
                {
			 if($schedule_time !='00:00:00')
                    	{
                      		 $times_final = strtotime("-30 minutes", strtotime($schedule_time));
                        	//$times_final1=date('H:i:s', $times_final);
				$times_final1=date('H:i:s', $schedule_time);
                    	}	

                     $sel_time_artist = "SELECT * FROM `tp_booking_schedule` where ('$schedule_time' BETWEEN start_time AND end_time) AND  date='$event_date' AND artist_id=$artist_id";
                    $rs_time_artist = mysql_query($sel_time_artist);
                    if (mysql_num_rows($rs_time_artist) >0)
                    {
			//echo  $row['fullname'];exit;
                    }
                    else
                    {

                        $a_id = $row['a_id'];
                        $service_id = $row['service_price'];
                        $field[$i]['a_id'] = $row['a_id'];
                        $field[$i]['fullname'] = $row['fullname'];
                        $field[$i]['image'] = $row['image'];
                        $field[$i]['mobile_number'] = $row['mobile_no'];
                        $field[$i]['country_code'] = '+' . $row['country_code'];
                        $field[$i]['email'] = $row['email'];
                        $field[$i]['password'] = $row['password'];
                        $field[$i]['profile_detail'] = strip_tags(utf8_encode($row['about_you']));
                        $field[$i]['qualifications'] = strip_tags(utf8_encode($row['qualifications']));
                        $field[$i]['work_experience'] = strip_tags(utf8_encode($row['work_experience']));
                        $field[$i]['service_price'] = $row['service_price'];
                        $field[$i]['document'] = $row['document'];
                        $field[$i]['zipcode'] = $row['zipcode'];
                        $field[$i]['miles'] = $row['miles'];
                        $sel_price = "SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
                        $rs_price = mysql_query($sel_price);
                        $data = mysql_fetch_array($rs_price);
                        if ($data['artist_price'] != '') {
                            $field[$i]['price'] = $data['artist_price'];
                        } else {
                            $field[$i]['price'] = "0";
                        }
                        $sel_reting = "SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=" . $a_id . " order by totalreting ";
                        $rs_reting = mysql_query($sel_reting);
                        $ros_reting = mysql_fetch_array($rs_reting);
                        //if($ros_reting['totalreting'] !='')
                        // if($row['rating_point'] !='')
                        // {
                        // 	$rat=$row['rating_point'];
                        // 	$field[$i]['rating_point'] = $row['rating_point'];
                        // }
                        if ($ros_reting['totalreting'] != '') {
                            $rat = $ros_reting['totalreting'];
                            //$field[$i]['rating_point'] = $ros_reting['totalreting'];
				$field[$i]['rating_point'] = $row['rating_point'];
                        } else {
                            $rat = '0';
                            $field[$i]['rating_point'] = '0';
                        }
                        $sel_review = "SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=" . $a_id . " order by  totalrevies DESC";
                        $rs_review = mysql_query($sel_review);
                        $ros_review = mysql_fetch_array($rs_review);
                        //$field[$i]['review'] = $ros_review['totalrevies'];
                        if ($ros_review['totalrevies'] != '') {
                            $review = $ros_review['totalrevies'];
                            $field[$i]['review'] = $ros_review['totalrevies'];
                        } else {
                            $review = '0';
                            $field[$i]['review'] = '0';
                        }
                        // $avreg_rate = $rat / $review;
                        $avreg_rate = $row['rating_point'];
                        if ($avreg_rate != '') {
                            $field[$i]['rate_avrege'] = $avreg_rate;
                        } else {
                            $field[$i]['rate_avrege'] = "0";
                        }

                        $sel_gallary = "SELECT * FROM `tp_artist_portfolio` WHERE artist_id=$a_id order by p_id desc";
                        $rs_gallary = mysql_query($sel_gallary);
                        $field_gallary = [];
                        if (mysql_num_rows($rs_gallary) > 0) {
                            $g = 0;
                            while ($row_gallary = mysql_fetch_array($rs_gallary)) {
                                $field_gallary[$g][portfolio_image] = $row_gallary['portfolio_image'];
                                $field_gallary[$g][image_title] = $row_gallary['image_title'];
                                $field_gallary[$g][image_caption] = $row_gallary['image_caption'];
                                $g++;
                            }
                            $field[$i]['gallary'] = $field_gallary;
                        } else {
                            $field[$i]['gallary'] = [];
                        }
                        $field_cat = [];
                        //$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
                        $sel_cat = "SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) order BY tc.id DESC";
                        $qry_cat = mysql_query($sel_cat);
                        if (mysql_num_rows($qry_cat) > 0) {
                            $a = 0;
                            while ($row_cat = mysql_fetch_array($qry_cat)) {

                                // $format = '%02d:%02d';
                                $minute = $row_cat['artist_time'];
                                $s = ' ';
                                $total_min = $minute;
                                $hours = floor($total_min / 60);
                                $minutes = ($total_min % 60);
                                // $time=sprintf($format, $hours, $minutes);
                                $art_time = $hours . $s . 'hr' . $s . $minutes . $s . 'mins';

                                $service_price = explode(",", $row['price']);
                                $field_cat[$a]['id'] = $row_cat['artist_category'];
                                $field_cat[$a]['category_name'] = $row_cat['category_name'];
                                $field_cat[$a]['category_price'] = $row_cat['artist_price'];
                                $field_cat[$a]['category_icon'] = $row_cat['category_icon'];
                                $field_cat[$a]['category_time'] = $art_time;
                                $field_cat[$a]['main_category_id'] = $row_cat['is_parent'];
                                $a++;
                            }
                            $field[$i]['category'] = $field_cat;

                        } else {
                            $field[$i]['category'] = [];
                        }
                        $i++;
                        $lim = 10;
                        $off = $dataArr[off];
                        if ($off == '' || $off == '0')
                            $off = 0;
                        $cms_pageing = new get_pageing_cms();
                        $cur_page_arr = split("/", $_SERVER['PHP_SELF']);
                        $cur_page = $cur_page_arr[count($cur_page_arr) - 1];
                        $pg_query_string = '';
                        $perpageTmp = urldecode($dataArr[perpage]);
                        $perpage = '';
                        if ($perpageTmp != '') {
                            $perpage = $perpageTmp;
                        } else {
                            $perpage = 10;
                        }

                        $arra = array_slice($field, $off, $lim);
                        $num = sizeof($arra);
                        //echo $num;exit;
                        if ($num != 0) {
                            $fields = $arra;
                            $new_off = $off + $num;
                            $succArr = 1;
                        } else {
                            $result_array = 2;
                        }
                    }
                }
               //else
                //{
                //    $succArr = 2;
                //}
            }


        }
        else
        {
            $succArr = -1;
        }
        if ($succArr == 1 and $statuschk == 1)
        {
            return '{"stylist and Artist":' . json_encode($fields) .',"isActive":' . json_encode($statuschk). ',"Offset":' . $new_off .',"success":' . json_encode("true") . ',"total":'.$data_count.'}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
      //  else if($succArr == 2)
	  else if($succArr == -1)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
        else if($succArr = 3)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
    }
	public  function stylist_asc_desc_20sep($dataArr)
    	{
        $price=urldecode($dataArr[price]);
        $address =urldecode($dataArr[postcode]);
        $miles = urldecode($dataArr[miles]);
        $cate_id=urldecode($dataArr[category_id]);
        $event_date=urldecode($dataArr[schedule_date]);
        $schedule_time1=urldecode($dataArr[schedule_time]);
        $schedule_time=date("H:i", strtotime($schedule_time1));
        //echo $schedule_time;exit;

        $u_id=urldecode($dataArr[uid]);
        $status="SELECT * FROM `user` where u_id='$u_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        if($event_date !='')
        {
            $weekday = date('D', strtotime($event_date));
        }

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

        $geo = json_decode($geo, true);

        if ($geo['status'] = 'OK')
        {
            $latitude1 = $geo['results'][0]['geometry']['location']['lat'];
            $longitude1 = $geo['results'][0]['geometry']['location']['lng'];
        }
        if ($price == 'high' and $event_date == '' and $schedule_time1 == '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        } else if ($price == 'low' and $event_date == '' and $schedule_time1 == '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0  and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        }
        /*elseif ($price == 'rate' and $event_date == '' and $schedule_time1 == '') {
                $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
            }*/
        elseif ($price == 'highrate' and $event_date == '' and $schedule_time1 == '')
        {
             $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        }
        elseif ($price == 'lowrate' and $event_date == '' and $schedule_time1 == '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point ASC";
        }
        elseif ($price == 'high' and $event_date != '' and $schedule_time1 != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        } elseif ($price == 'low' and $event_date != '' and $schedule_time1 != '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time) AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        }
        /*elseif ($price == 'rate' and $event_date != '' and $schedule_time1 != '') {
                $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";*/
        elseif ($price == 'highrate' and $event_date != '' and $schedule_time1 != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        }
        elseif ($price == 'lowrate' and $event_date != '' and $schedule_time1 != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point ASC";
        }
        elseif ($event_date != '' and $schedule_time1 != '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time)  AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        else
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and ts.book_date !=CURDATE() and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        $qry=mysql_query($sel);
        $field=[];
        if (mysql_num_rows($qry) > 0)
        {
            $data_count = mysql_num_rows($qry);
            $i=0;
            while($row=mysql_fetch_array($qry))
            {
                $latitude2 = $row['latitude'];
                $longitude2 = $row['longitude'];
                $artist_id=$row['artist_id'];
                $distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
                if ($distance < $row['miles'])
                {
                    $sel_time_artist = "SELECT * FROM `tp_booking_schedule` where ('$event_date' BETWEEN start_time AND end_time) AND date='$event_date' AND artist_id=$artist_id";
                    $rs_time_artist = mysql_query($sel_time_artist);
                    if (mysql_num_rows($rs_time_artist) >0)
                    {

                    }
                    else
                    {

                        $a_id = $row['a_id'];
                        $service_id = $row['service_price'];
                        $field[$i]['a_id'] = $row['a_id'];
                        $field[$i]['fullname'] = $row['fullname'];
                        $field[$i]['image'] = $row['image'];
                        $field[$i]['mobile_number'] = $row['mobile_no'];
                        $field[$i]['country_code'] = '+' . $row['country_code'];
                        $field[$i]['email'] = $row['email'];
                        $field[$i]['password'] = $row['password'];
                        $field[$i]['profile_detail'] = strip_tags(utf8_encode($row['about_you']));
                        $field[$i]['qualifications'] = strip_tags(utf8_encode($row['qualifications']));
                        $field[$i]['work_experience'] = strip_tags(utf8_encode($row['work_experience']));
                        $field[$i]['service_price'] = $row['service_price'];
                        $field[$i]['document'] = $row['document'];
                        $field[$i]['zipcode'] = $row['zipcode'];
                        $field[$i]['miles'] = $row['miles'];
                        $sel_price = "SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
                        $rs_price = mysql_query($sel_price);
                        $data = mysql_fetch_array($rs_price);
                        if ($data['artist_price'] != '') {
                            $field[$i]['price'] = $data['artist_price'];
                        } else {
                            $field[$i]['price'] = "0";
                        }
                        $sel_reting = "SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=" . $a_id . " order by totalreting ";
                        $rs_reting = mysql_query($sel_reting);
                        $ros_reting = mysql_fetch_array($rs_reting);
                        //if($ros_reting['totalreting'] !='')
                        // if($row['rating_point'] !='')
                        // {
                        // 	$rat=$row['rating_point'];
                        // 	$field[$i]['rating_point'] = $row['rating_point'];
                        // }
                        if ($ros_reting['totalreting'] != '') {
                            $rat = $ros_reting['totalreting'];
                            $field[$i]['rating_point'] = $ros_reting['totalreting'];
                        } else {
                            $rat = '0';
                            $field[$i]['rating_point'] = '0';
                        }
                        $sel_review = "SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=" . $a_id . " order by  totalrevies DESC";
                        $rs_review = mysql_query($sel_review);
                        $ros_review = mysql_fetch_array($rs_review);
                        //$field[$i]['review'] = $ros_review['totalrevies'];
                        if ($ros_review['totalrevies'] != '') {
                            $review = $ros_review['totalrevies'];
                            $field[$i]['review'] = $ros_review['totalrevies'];
                        } else {
                            $review = '0';
                            $field[$i]['review'] = '0';
                        }
                        // $avreg_rate = $rat / $review;
                        $avreg_rate = $row['rating_point'];
                        if ($avreg_rate != '') {
                            $field[$i]['rate_avrege'] = $avreg_rate;
                        } else {
                            $field[$i]['rate_avrege'] = "0";
                        }

                        $sel_gallary = "SELECT * FROM `tp_artist_portfolio` WHERE artist_id=$a_id";
                        $rs_gallary = mysql_query($sel_gallary);
                        $field_gallary = [];
                        if (mysql_num_rows($rs_gallary) > 0) {
                            $g = 0;
                            while ($row_gallary = mysql_fetch_array($rs_gallary)) {
                                $field_gallary[$g][portfolio_image] = $row_gallary['portfolio_image'];
                                $field_gallary[$g][image_title] = $row_gallary['image_title'];
                                $field_gallary[$g][image_caption] = $row_gallary['image_caption'];
                                $g++;
                            }
                            $field[$i]['gallary'] = $field_gallary;
                        } else {
                            $field[$i]['gallary'] = [];
                        }
                        $field_cat = [];
                        //$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
                        $sel_cat = "SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) order BY tc.id DESC";
                        $qry_cat = mysql_query($sel_cat);
                        if (mysql_num_rows($qry_cat) > 0) {
                            $a = 0;
                            while ($row_cat = mysql_fetch_array($qry_cat)) {

                                // $format = '%02d:%02d';
                                $minute = $row_cat['artist_time'];
                                $s = ' ';
                                $total_min = $minute;
                                $hours = floor($total_min / 60);
                                $minutes = ($total_min % 60);
                                // $time=sprintf($format, $hours, $minutes);
                                $art_time = $hours . $s . 'hr' . $s . $minutes . $s . 'mins';

                                $service_price = explode(",", $row['price']);
                                $field_cat[$a]['id'] = $row_cat['artist_category'];
                                $field_cat[$a]['category_name'] = $row_cat['category_name'];
                                $field_cat[$a]['category_price'] = $row_cat['artist_price'];
                                $field_cat[$a]['category_icon'] = $row_cat['category_icon'];
                                $field_cat[$a]['category_time'] = $art_time;
                                $field_cat[$a]['main_category_id'] = $row_cat['is_parent'];
                                $a++;
                            }
                            $field[$i]['category'] = $field_cat;

                        } else {
                            $field[$i]['category'] = [];
                        }
                        $i++;
                        $lim = 10;
                        $off = $dataArr[off];
                        if ($off == '' || $off == '0')
                            $off = 0;
                        $cms_pageing = new get_pageing_cms();
                        $cur_page_arr = split("/", $_SERVER['PHP_SELF']);
                        $cur_page = $cur_page_arr[count($cur_page_arr) - 1];
                        $pg_query_string = '';
                        $perpageTmp = urldecode($dataArr[perpage]);
                        $perpage = '';
                        if ($perpageTmp != '') {
                            $perpage = $perpageTmp;
                        } else {
                            $perpage = 10;
                        }

                        $arra = array_slice($field, $off, $lim);
                        $num = sizeof($arra);
                        //echo $num;exit;
                        if ($num != 0) {
                            $fields = $arra;
                            $new_off = $off + $num;
                            $succArr = 1;
                        } else {
                            $result_array = 2;
                        }
                    }
                }
                else
                {
                    $succArr = 2;
                }
            }


        }
        else
        {
            $succArr = -1;
        }
        if ($succArr == 1 and $statuschk == 1)
        {
            return '{"stylist and Artist":' . json_encode($fields) .',"isActive":' . json_encode($statuschk). ',"Offset":' . $new_off .',"success":' . json_encode("true") . ',"total":'.$data_count.'}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else if($succArr == 2)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
        else if($succArr = 3)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
    }
	public  function stylist_asc_desc_18oct($dataArr)
	{
		$price=urldecode($dataArr[price]);
		$address =urldecode($dataArr[postcode]);
		$miles = urldecode($dataArr[miles]);
		$cate_id=urldecode($dataArr[category_id]);
		$event_date=urldecode($dataArr[schedule_date]);
		$schedule_time1=urldecode($dataArr[schedule_time]);
                $schedule_time=date("H:i", strtotime($schedule_time1));

		$u_id=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$u_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];		
			
		if($event_date !='')
       		 {
          	 $weekday = date('D', strtotime($event_date));
       		 }

		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		$geo = json_decode($geo, true);

		if ($geo['status'] = 'OK')
		{
			$latitude1 = $geo['results'][0]['geometry']['location']['lat'];
			$longitude1 = $geo['results'][0]['geometry']['location']['lng'];
		}
		if ($price == 'high' and $event_date == '' and $schedule_time == '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        } else if ($price == 'low' and $event_date == '' and $schedule_time == '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        } elseif ($price == 'rate' and $event_date == '' and $schedule_time == '') {
             $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id  and ts.status =0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        } 
	elseif ($price == 'high' and $event_date != '' and $schedule_time != '') {
             
             // $sel = "SELECT * FROM `tp_schedule` ts JOIN tp_artist ta on ts.artist_id=ta.a_id JOIN tp_artist_categories tac ON tac.artist_id=ta.a_id WHERE ts.service_assign_id=$cate_id AND ts.schedule_day ='$weekday' and ts.schedule_start_time='$schedule_time' and ts.status =1 and tac.count=0 GROUP by ts.s_id ORDER by tac.artist_price DESC";
		$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time) and ts.status =0 AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        } elseif ($price == 'low' and $event_date != '' and $schedule_time != '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time) and ts.status =0 AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        } elseif ($price == 'rate' and $event_date != '' and $schedule_time != '') {
             $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time) and ts.status =0 AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        } elseif ($event_date != '' and $schedule_time != '') {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id  WHERE ts.schedule_day ='$weekday' AND ('$schedule_time' BETWEEN ts.schedule_start_time AND ts.schedule_end_time) and ts.book_date !=CURDATE() AND tac.artist_category=$cate_id AND ta.status =1 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        else
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and ts.status =0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$data_count = mysql_num_rows($qry);
			$i=0;
			while($row=mysql_fetch_array($qry))
			{
				$latitude2 = $row['latitude'];
				$longitude2 = $row['longitude'];
				$distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
				if ($distance < $row['miles'])
				{
					$a_id = $row['a_id'];
					$service_id=$row['service_price'];
					$field[$i]['a_id'] = $row['a_id'];
					$field[$i]['fullname'] = $row['fullname'];
					$field[$i]['image'] = $row['image'];
					$field[$i]['mobile_number'] = $row['mobile_no'];
					$field[$i]['country_code'] = '+' . $row['country_code'];
					$field[$i]['email'] = $row['email'];
					$field[$i]['password'] = $row['password'];
					$field[$i]['profile_detail'] = strip_tags(utf8_encode($row['about_you']));
					$field[$i]['qualifications'] = strip_tags(utf8_encode($row['qualifications']));
					$field[$i]['work_experience'] = strip_tags(utf8_encode($row['work_experience']));
					$field[$i]['service_price'] = $row['service_price'];
					$field[$i]['document'] = $row['document'];
					$field[$i]['zipcode'] = $row['zipcode'];
					$field[$i]['miles'] = $row['miles'];
					$sel_price="SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
					$rs_price=mysql_query($sel_price);
					$data=mysql_fetch_array($rs_price);
					if($data['artist_price'] !='')
					{
						$field[$i]['price'] = $data['artist_price'];
					}
					else
					{
						$field[$i]['price'] ="0";
					}
					$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=".$a_id." order by totalreting ";
					$rs_reting=mysql_query($sel_reting);
					$ros_reting=mysql_fetch_array($rs_reting);
					//if($ros_reting['totalreting'] !='')
					// if($row['rating_point'] !='')
					// {
					// 	$rat=$row['rating_point'];
					// 	$field[$i]['rating_point'] = $row['rating_point'];
					// }
					if($ros_reting['totalreting'] !='')
					{
						$rat=$ros_reting['totalreting'] ;
						$field[$i]['rating_point'] = $ros_reting['totalreting'] ;
					}
					else
					{
						$rat='0';
						$field[$i]['rating_point'] = '0';
					}
					$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=".$a_id." order by  totalrevies DESC";
					$rs_review=mysql_query($sel_review);
					$ros_review=mysql_fetch_array($rs_review);
					//$field[$i]['review'] = $ros_review['totalrevies'];
					if($ros_review['totalrevies'] !='')
					{
						$review=$ros_review['totalrevies'];
						$field[$i]['review'] = $ros_review['totalrevies'];
					}
					else
					{
						$review='0';
						$field[$i]['review'] = '0';
					}
					$avreg_rate=$rat/$review;
					if($avreg_rate !='')
					{
						$field[$i]['rate_avrege'] = $avreg_rate;
					}
					else
					{
						$field[$i]['rate_avrege'] = "0";
					}

					$sel_gallary="SELECT * FROM `tp_artist_portfolio` WHERE artist_id=$a_id";
                   			 $rs_gallary=mysql_query($sel_gallary);
                    			if(mysql_num_rows($rs_gallary) > 0)
                   			 {
                      			  $field_gallary=[];
                       			 $g=0;
                        		while($row_gallary=mysql_fetch_array($rs_gallary))
                        		{
		                            $field_gallary[$g][portfolio_image]=$row_gallary['portfolio_image'];
                		            $field_gallary[$g][image_title]=$row_gallary['image_title'];
                		            $field_gallary[$g][image_caption]=$row_gallary['image_caption'];
                		            $g++;
                		        }
                		            $field[$i]['gallary'] = $field_gallary;
                		    }
		                    else
                		    {
                		        $field[$i]['gallary'] = [];
                		    }
					$field_cat=[];
					//$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
					$sel_cat = "SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) order BY tc.id DESC";
					$qry_cat=mysql_query($sel_cat);
					if (mysql_num_rows($qry_cat) > 0)
					{
						$a=0;
						while($row_cat=mysql_fetch_array($qry_cat))
						{
							/*$minute = $row_cat['artist_time'];
							$minuts1 = date('H:i', strtotime($minute));
							$minuts = explode(":", $minuts1);
							$s = ' ';
							if ($minuts[0] != '00')
							{
								 $format = '%02d:%02d';
                               					 $total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
                                				 $hours = floor($total_min / 60);
                               					 $minutes = ($total_min % 60);
                                				 $time=sprintf($format, $hours, $minutes);
                               					 $art_time=$hours.$s.'hr'.$s.$minutes.$s.'mins';

							}
							else
							{
								  $total_min = intval($minuts[1]);
                                				  $art_time = $total_min . $s . 'mins';
							}*/
							// $format = '%02d:%02d';
							$minute = $row_cat['artist_time'];
                            				$s = ' ';
                            				$total_min=$minute;
                            				$hours = floor($total_min / 60);
                            				$minutes = ($total_min % 60);
                           				// $time=sprintf($format, $hours, $minutes);
                           				$art_time=$hours.$s.'hr'.$s.$minutes.$s.'mins';

							$service_price=explode(",", $row['price']);
							$field_cat[$a]['id'] = $row_cat['artist_category'];
							$field_cat[$a]['category_name'] = $row_cat['category_name'];
							$field_cat[$a]['category_price'] =$row_cat['artist_price'];
							$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
							$field_cat[$a]['category_time'] = $art_time;
							$field_cat[$a]['main_category_id']=$row_cat['is_parent'];
							$a++;
						}
						$field[$i]['category'] = $field_cat;				

					}
					else
					{
						$field[$i]['category'] = [];
					}
					$i++;
					$lim = 10;
					$off = $dataArr[off];
					if ($off == '' || $off == '0')
						$off = 0;
					$cms_pageing = new get_pageing_cms();
					$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
					$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
					$pg_query_string = '';
					$perpageTmp = urldecode($dataArr[perpage]);
					$perpage = '';
					if ($perpageTmp != '') {
						$perpage = $perpageTmp;
					} else {
						$perpage = 10;
					}

					$arra= array_slice( $field,$off,$lim);
					$num =sizeof($arra);
					//echo $num;exit;
					if($num !=0)
					{
						$fields=$arra;
						$new_off = $off + $num;
						$succArr = 1;
					}
					else
					{
						$result_array = 2;
					}
				}
				else
				{
					$succArr = 2;
				}
			}


		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1 and $statuschk == 1)
		{
			return '{"stylist and Artist":' . json_encode($fields) .',"isActive":' . json_encode($statuschk). ',"Offset":' . $new_off .',"success":' . json_encode("true") . ',"total":'.$data_count.'}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == 2)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}

		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	
	public  function stylist_asc_desc_21sep($dataArr)
	{
		$price=urldecode($dataArr[price]);
		if($price=='high')
		{
			 $sel = "SELECT * FROM `tp_artist` ORDER by a_id DESC";
		}
		else if($price=='low')
		{
			$sel = "SELECT * FROM `tp_artist` ORDER by a_id ASC";
		}
		elseif($price=='rate')
		{
			//$sel="SELECT * FROM `tp_artist`ta JOIN tp_review tr on ta.a_id=tr.artist_id ORDER by tr.review_rating DESC";
			$sel="SELECT * FROM `tp_artist` ORDER by rating_point DESC";
		}
		else
		{
			$sel = "SELECT * FROM `tp_artist` ORDER by a_id DESC";
		}
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$a_id=$row['a_id'];
				$field[$i]['a_id'] = $row['a_id'];
				$field[$i]['fullname'] = $row['fullname'];
				$field[$i]['image'] = $row['image'];
				$field[$i]['mobile_number'] = $row['mobile_no'];
				$field[$i]['country_code'] = '+'.$row['country_code'];
				$field[$i]['email'] = $row['email'];
				$field[$i]['password'] = $row['password'];
				$field[$i]['profile_detail'] = strip_tags($row['about_you']);
				$field[$i]['qualifications'] = strip_tags($row['qualifications']);
				$field[$i]['work_experience'] = strip_tags($row['work_experience']);
				$field[$i]['service_price'] = $row['service_price'];
				$field[$i]['document'] = $row['document'];
				$field[$i]['zipcode'] = $row['zipcode'];
				$field[$i]['miles'] = $row['miles'];
				$field[$i]['price'] = $row['price'];
				$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
				$rs_reting=mysql_query($sel_reting);
				$ros_reting=mysql_fetch_array($rs_reting);
				//$field[$i]['rating_point'] = $row['rating_point'];
				$field[$i]['rating_point'] = $ros_reting['totalreting'];
				$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
				$rs_review=mysql_query($sel_review);
				$ros_review=mysql_fetch_array($rs_review);
				$field[$i]['review'] = $ros_review['totalrevies'];
				$sel_cat="SELECT * FROM `tp_categories` ORDER by id DESC";
				$qry_cat=mysql_query($sel_cat);
				if (mysql_num_rows($qry_cat) > 0)
				{
					$a=0;
					//$row=mysql_fetch_array($result);
					while($row_cat=mysql_fetch_array($qry_cat)) {
						$id = $row_cat['id'];

						$minute = $row_cat['category_time'];
						//$minuts=date('H:i',strtotime($minute));
						$minuts1 = date('H:i', strtotime($minute));
						$minuts = explode(":", $minuts1);
						$s = ' ';
						if ($minuts[0] != '00') {
							$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
							$times = $total_min / 60;
							$time = $times . $s . 'hrs';

						} else {
							$total_min = intval($minuts[1]);
							$time = $total_min . $s . 'mins';
						}

						$field_cat[$a]['id'] = $row_cat['id'];
						$field_cat[$a]['category_name'] = $row_cat['category_name'];
						$field_cat[$a]['category_price'] = $row_cat['category_price'];
						$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
						//$field[$i]['category_time'] = $row['category_time'];
						$field_cat[$a]['category_time'] = $time;
						$sel_sc="SELECT * FROM `tp_subcategories` WHERE parent_category_id=$id ORDER BY id DESC";
						$rs_sc=mysql_query($sel_sc);
						if(mysql_num_rows($rs_sc) > 0)
						{
							$c=0;
							while($row_sub=mysql_fetch_array($rs_sc))
							{
								$minute=$row_sub['subcategory_time'];
								//$minuts=date('H:i',strtotime($minute));
								$minuts1=date('H:i',strtotime($minute));
								$minuts = explode(":",$minuts1);
								$s=' ';
								if($minuts[0] !='00')
								{
									$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
									$times=$total_min/60;
									$time=$times.$s.'hrs';

								}
								else
								{
									$total_min = intval($minuts[1]);
									$time=$total_min.$s.'mins';
								}

								$sub_cate[$c]['subcategory_name'] = $row_sub['subcategory_name'];
								$sub_cate[$c]['subcategory_price'] = $row_sub['subcategory_price'];
								$sub_cate[$c]['subcategory_icon'] = $row_sub['subcategory_icon'];
								//$sub_cate[$c]['subcategory_time'] = $row_rc['subcategory_time'];
								$sub_cate[$c]['subcategory_time'] = $time;
								$sub_cate[$c]['parent_category_id'] = $row_sub['parent_category_id'];
								$sub_cate[$c]['sub_id'] = $row_sub['id'];
								$c++;
							}
							$field_cat[$a]['sub_category'] = $sub_cate;
						}
						else
						{
							$field_cat[$a]['sub_category'] = [];
						}
						$a++;
					}
					$field[$i]['category'] = $field_cat;
				}
				else
				{
					$field[$i]['category'] = [];
				}



				$i++;
			}
			$succArr = 1;

		}
		else
		{
			$succArr = -1;
		}
		if ($succArr == 1)
		{
			return '{"stylist and Artist":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
		}
    public function booking_8_dec_2016($datAarr)
    {
        $b_id=urldecode($datAarr['booking_id']);
        $user_id=urldecode($datAarr['user_id']);
        //$price=urldecode($datAarr['price']);
        $book_date=urldecode($datAarr['book_date']);
        $book_time1=urldecode($datAarr['book_time']);
        $book_time=date("H:i", strtotime($book_time1));
        $book_date_time=urldecode($datAarr['book_date_time']);
        $address=urldecode($datAarr['address']);
        $artist_id=urldecode($datAarr['artist_id']);
        $payment_mode=urldecode($datAarr['payment_mode']);
        $transaction_id=urldecode($datAarr['transaction_id']);
        $create_date=date("Y-m-d h:i:sa");
        $update_date=date("Y-m-d h:i:sa");
        //$category_id=urldecode($datAarr['category_id']);
        $total_price=urldecode($datAarr['total_price']);
        $telephone_number=urldecode($datAarr['telephone_number']);
        $service_location=urldecode($datAarr['service_location']);
        $street_address=urldecode($datAarr['street_address']);
        $note=urldecode($datAarr['note']);
        $service_time=urldecode($datAarr['service_time']);
        $service_id=urldecode($datAarr['service_id']);

        $isdevice=urldecode($datAarr['isdevice']);


        $status="SELECT * FROM `user` where u_id='$user_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        $arr['user_id']=$user_id;
        $arr['total_price']=$total_price;
        $arr['book_date']=$book_date;
        $arr['book_time']=$book_time;
        $arr['book_date_time']=$book_date.' '.$book_time;
        $arr['address']=$service_location.' '.$street_address;
        $arr['artist_id']=$artist_id;
        $arr['isdevice']=$isdevice;
        $arr['telephone_number']=$telephone_number;
        $arr['service_location']=$service_location;
        $arr['street_address']=$street_address;
        $arr['note']=$note;
        $weekday = date('D', strtotime($book_date));
        $arr['book_day'] = $weekday;
        $arr['book_slot']=$book_date;
        $arr['flag'] = '0';
        $arr['create_time']=$create_date;
        $arr['update_date']=$update_date;
		
        $sel_time="SELECT SUM(artist_time) as total_time FROM `tp_artist_categories` WHERE artist_id=$artist_id AND artist_category IN ($service_id)";
        $rs_time=mysql_query($sel_time);
        $row_time=mysql_fetch_array($rs_time);
        $total_time=$row_time['total_time'];
        $timestamp = strtotime(".$book_time.") + ($total_time*60);
        $end_time = date('H:i', $timestamp);
        $date = date('Y-m-d');

        $artist_status = get_single_value('tp_artist','status','a_id='.$artist_id,'a_id','desc','limit 1',false);
        if($artist_status=='1')
		{
			$artist_schedule = mysql_query("SELECT MIN(schedule_start_time) as start_time, MAX(schedule_end_time) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
			$get_artist_schedule = mysql_fetch_assoc($artist_schedule);

				$artist_booking_schedule = mysql_query("SELECT DATE_FORMAT(start_time,'%H:%i') as start_time, DATE_FORMAT(end_time,'%H:%i') as end_time FROM `tp_booking_schedule` WHERE artist_id=$artist_id AND `date`='$book_date'");
				if (mysql_num_rows($artist_booking_schedule) > 0) {
					while ($row = mysql_fetch_assoc($artist_booking_schedule)) {
						$booked_start_time[] = $row['start_time'];
						$booked_end_time[] = $row['end_time'];
					}

					$tmp_book_time = date('H:i:s',strtotime($book_time));
					$tmp_end_time = date('H:i:s',strtotime($end_time) - 1);
					$qry = mysql_query("SELECT * FROM tp_booking_schedule WHERE ((start_time >= '$tmp_book_time' AND start_time <= '$tmp_end_time') OR (end_time >= '$tmp_book_time' AND end_time <= '$tmp_end_time')) AND artist_id = $artist_id and date = '$book_date'");
					if(mysql_num_rows($qry)>0){
						$statuschk = 1;
						$succArr = 0;
					} else {
						if($end_time > $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
							$qry = mysql_query("SELECT * FROM tp_booking_schedule WHERE ((start_time >= '$tmp_book_time' AND start_time <= '$tmp_end_time') OR (end_time >= '$tmp_book_time' AND end_time <= '$tmp_end_time')) AND artist_id = $artist_id and date = '$book_date'");
							if(mysql_num_rows($qry)>0){
								$statuschk = 1;
								$succArr = 2;
								foreach ($booked_start_time as $day) {
									//$interval[$count] = abs(strtotime($date) - strtotime($day));
									$interval[] = abs(strtotime($book_time) - strtotime($day));
									//$count++;
								}
								asort($interval);
								$closest = key($interval);
								$send_time = "Artist available till " . $booked_start_time[$closest] . " only";
							} else {
								$statuschk = 1;
								$succArr = 1;
							}
						}
						else{
							$statuschk = 1;
							$succArr = 2;
							$send_time = "Artist available till " . $get_artist_schedule['end_time'] . " only";

						}
					}

				} else {
					$artist_schedule = mysql_query("SELECT MIN(DATE_FORMAT(schedule_start_time,'%H:%i')) as start_time, MAX(DATE_FORMAT(schedule_end_time,'%H:%i')) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
					$get_artist_schedule = mysql_fetch_assoc($artist_schedule);
					if ($book_time >= $get_artist_schedule['start_time'] && $book_time < $get_artist_schedule['end_time']) {
						if ($end_time >= $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
							$statuschk = 1;
							$succArr = 1;
						} else {
							$statuschk = 1;
							$succArr = 2;
							$send_time = "Artist available till " . $get_artist_schedule['end_time'] . " only";
						}
					} else {
						$statuschk = 1;
						$succArr = 0;
					}
				}
				

            $check_qry = "SELECT * FROM `tp_booking_schedule` where ( artist_id='".$artist_id."'  and date='".$date."') and   (('".$book_time."' BETWEEN start_time and end_time) or ('".$end_time."' BETWEEN start_time and end_time))  ";
            $data_qry = mysql_query($check_qry);
            $row_count = mysql_num_rows($data_qry);
            if($row_count > 0 )
            {
                $succArr=2;
                /*$sel_artist_time="SELECT * FROM `tp_schedule` where artist_id=$artist_id and schedule_day='$weekday' and schedule_start_time Not BETWEEN '$book_time' and '$end_time'  ORDER BY s_id ASC";
                $rs=mysql_query($sel_artist_time);
                if(mysql_num_rows($rs) > 0)
                {
                    $i=0;
                    while($row=mysql_fetch_array($rs))
                    {
                        $sminute = $row['schedule_start_time'];
                        $eminute = $row['schedule_end_time'];
                        //$minuts=date('H:i',strtotime($minute));
                        $minuts1 = date('H:i', strtotime($sminute));
                        $minuts2 = date('H:i', strtotime($eminute));

                        $field[$i][event_id]=$row['s_id'];
                        $field[$i][artist_id]=$row['artist_id'];
                        //$field[$i][schedule_start_date]=$row['schedule_start_date'];
                        //$field[$i][schedule_end_date]=$row['schedule_end_date'];
                        $field[$i][schedule_start_time]= $row['schedule_start_time'];
                        $field[$i][schedule_end_time]=$row['schedule_end_time'];
                        $field[$i][status]=$row['status'];
                        $i++;
                        //$succArr=1;
                    }
                }*/
            }
            else
            {
               if($succArr==1){
                if ($b_id != '')
                {
                    upd_rec(tp_booking_tmp, $arr, "book_id =$b_id", false);
                    $id = $b_id;
                }
                else
                {
                    $id = ins_rec(tp_booking_tmp, $arr);
                }
                if ($id)
                {
                    $book_id = $id;
                    $arr_book['booking_id'] = $id;
                    //$arr_book['category_id']=$category_id;
                    $arr_book['total_price'] = $total_price;
                    $arr_book['service_time'] = $service_time;
                    $arr_book['create_date'] = $create_date;
                    $arr_book['update_date'] = $update_date;
                    $arr_book['service_id'] = $service_id;

                    if ($b_id != '') {
                        upd_rec(tp_book_service_tmp, $arr_book, "booking_id =$b_id", false);
                    } else {
                        $id = ins_rec(tp_book_service_tmp, $arr_book);
                    }
                    $succArr = 1;
                }
               }
            }
        }
        else
        {
		$statuschk = 0;
		$succArr = -1;
        }

        if($succArr == 1 and $statuschk == 1)
        {
			return '{"message":"You can book now","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 2 and $statuschk == 1)
        {
			return '{"message":"'.$send_time.'","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 0 && $statuschk == 1)
        {
			return '{"message":"Artist is busy","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("false") .',"isActive":' . json_encode($statuschk). '}';
        }
	else{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
	}
    }



public function booking($datAarr)
    {
        $b_id=urldecode($datAarr['booking_id']);
        $user_id=urldecode($datAarr['user_id']);
        //$price=urldecode($datAarr['price']);
        $book_date=urldecode($datAarr['book_date']);
        $book_time1=urldecode($datAarr['book_time']);
        $book_time=date("H:i", strtotime($book_time1));
        $book_date_time=urldecode($datAarr['book_date_time']);
        $address=urldecode($datAarr['address']);
        $artist_id=urldecode($datAarr['artist_id']);
        $payment_mode=urldecode($datAarr['payment_mode']);
        $transaction_id=urldecode($datAarr['transaction_id']);
        $create_date=date("Y-m-d h:i:sa");
        $update_date=date("Y-m-d h:i:sa");
        //$category_id=urldecode($datAarr['category_id']);
        $total_price=urldecode($datAarr['total_price']);
        $telephone_number=urldecode($datAarr['telephone_number']);
        $service_location=urldecode($datAarr['service_location']);
        $street_address=urldecode($datAarr['street_address']);
        $note=urldecode($datAarr['note']);
        $service_time=urldecode($datAarr['service_time']);
        $service_id=urldecode($datAarr['service_id']);

        $isdevice=urldecode($datAarr['isdevice']);


        $status="SELECT * FROM `user` where u_id='$user_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        $arr['user_id']=$user_id;
        $arr['total_price']=$total_price;
        $arr['book_date']=$book_date;
        $arr['book_time']=$book_time;
        $arr['book_date_time']=$book_date.' '.$book_time;
        $arr['address']=$service_location.' '.$street_address;
        $arr['artist_id']=$artist_id;
        $arr['isdevice']=$isdevice;
        $arr['telephone_number']=$telephone_number;
        $arr['service_location']=$service_location;
        $arr['street_address']=$street_address;
        $arr['note']=$note;
        $weekday = date('D', strtotime($book_date));
        $arr['book_day'] = $weekday;
        $arr['book_slot']=$book_date;
        $arr['flag'] = '0';
        $arr['create_time']=$create_date;
        $arr['update_date']=$update_date;
		
        $sel_time="SELECT SUM(artist_time) as total_time FROM `tp_artist_categories` WHERE artist_id=$artist_id AND artist_category IN ($service_id)";
        $rs_time=mysql_query($sel_time);
        $row_time=mysql_fetch_array($rs_time);
        $total_time=$row_time['total_time'];
        $timestamp = strtotime(".$book_time.") + ($total_time*60);
        $end_time = date('H:i', $timestamp);
        $date = date('Y-m-d');

        $artist_status = get_single_value('tp_artist','status','a_id='.$artist_id,'a_id','desc','limit 1',false);
        if($artist_status=='1')
		{
			$artist_schedule = mysql_query("SELECT MIN(schedule_start_time) as start_time, MAX(schedule_end_time) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
			$get_artist_schedule = mysql_fetch_assoc($artist_schedule);

				$artist_booking_schedule = mysql_query("SELECT DATE_FORMAT(start_time,'%H:%i') as start_time, DATE_FORMAT(end_time,'%H:%i') as end_time FROM `tp_booking_schedule` WHERE artist_id=$artist_id AND `date`='$book_date'");
				if (mysql_num_rows($artist_booking_schedule) > 0) {
					while ($row = mysql_fetch_assoc($artist_booking_schedule)) {
						$booked_start_time[] = $row['start_time'];
						$booked_end_time[] = $row['end_time'];
					}

					$tmp_book_time = date('H:i:s',strtotime($book_time));
					$tmp_end_time = date('H:i:s',strtotime($end_time));
					$qry = mysql_query("SELECT * FROM tp_booking_schedule WHERE ((start_time >= '$tmp_book_time' AND start_time <= '$tmp_end_time') AND (end_time >= '$tmp_book_time' AND end_time <= '$tmp_end_time')) AND artist_id = $artist_id and date = '$book_date'");
					if(mysql_num_rows($qry)>0){
						$statuschk = 1;
						$succArr = 0;
					} else {
						if($end_time > $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
							$qry = mysql_query("SELECT * FROM tp_booking_schedule WHERE ((start_time >= '$tmp_book_time' AND start_time <= '$tmp_end_time') OR (end_time >= '$tmp_book_time' AND end_time <= '$tmp_end_time')) AND artist_id = $artist_id and date = '$book_date'");
							if(mysql_num_rows($qry)>0){
								$statuschk = 1;
								$succArr = 2;
								foreach ($booked_start_time as $day) {
									//$interval[$count] = abs(strtotime($date) - strtotime($day));
									$interval[] = abs(strtotime($book_time) - strtotime($day));
									//$count++;
								}
								asort($interval);
								$closest = key($interval);
								$send_time = $booked_start_time[$closest];
							} else {
								$statuschk = 1;
								$succArr = 1;
							}
						}
						else{
							$statuschk = 1;
							$succArr = 2;
							$send_time = $get_artist_schedule['end_time'];

						}
					}

				} else {
					$artist_schedule = mysql_query("SELECT MIN(DATE_FORMAT(schedule_start_time,'%H:%i')) as start_time, MAX(DATE_FORMAT(schedule_end_time,'%H:%i')) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
					$get_artist_schedule = mysql_fetch_assoc($artist_schedule);
					if ($book_time >= $get_artist_schedule['start_time'] && $book_time < $get_artist_schedule['end_time']) {
						if ($end_time >= $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
							$statuschk = 1;
							$succArr = 1;
						} else {
							$statuschk = 1;
							$succArr = 2;
							$send_time = $get_artist_schedule['end_time'];
						}
					} else {
						$statuschk = 1;
						$succArr = 0;
					}
				}
        }
        else
        {
		$statuschk = 0;
		$succArr = -1;
        }

        if($succArr == 1 and $statuschk == 1)
        {
                if ($b_id != '')
                {
                    upd_rec(tp_booking_tmp, $arr, "book_id =$b_id", false);
                    $id = $b_id;
                }
                else
                {
                    $id = ins_rec(tp_booking_tmp, $arr);
                }
                if ($id)
                {
                    $book_id = $id;
                    $arr_book['booking_id'] = $id;
                    //$arr_book['category_id']=$category_id;
                    $arr_book['total_price'] = $total_price;
                    $arr_book['service_time'] = $service_time;
                    $arr_book['create_date'] = $create_date;
                    $arr_book['update_date'] = $update_date;
                    $arr_book['service_id'] = $service_id;

                    if ($b_id != '') {
                        upd_rec(tp_book_service_tmp, $arr_book, "booking_id =$b_id", false);
                    } else {
                        $id = ins_rec(tp_book_service_tmp, $arr_book);
                    }
                }
			return '{"message":"You can book now","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 2 and $statuschk == 1)
        {
			return '{"message":"'.$send_time.'","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 0 && $statuschk == 1)
        {
			return '{"message":"Artist is busy","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("false") .',"isActive":' . json_encode($statuschk). '}';
        }
	else{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
	}
    }
	public function booking_check($datAarr)
    {
       $b_id=urldecode($datAarr['booking_id']);
        $user_id=urldecode($datAarr['user_id']);
        //$price=urldecode($datAarr['price']);
        $book_date=urldecode($datAarr['book_date']);
        $book_time1=urldecode($datAarr['book_time']);
        $book_time=date("H:i", strtotime($book_time1));
        $book_date_time=urldecode($datAarr['book_date_time']);
        $address=urldecode($datAarr['address']);
        $artist_id=urldecode($datAarr['artist_id']);
        $payment_mode=urldecode($datAarr['payment_mode']);
        $transaction_id=urldecode($datAarr['transaction_id']);
        $create_date=date("Y-m-d h:i:sa");
        $update_date=date("Y-m-d h:i:sa");
        //$category_id=urldecode($datAarr['category_id']);
        $total_price=urldecode($datAarr['total_price']);
        $telephone_number=urldecode($datAarr['telephone_number']);
        $service_location=urldecode($datAarr['service_location']);
        $street_address=urldecode($datAarr['street_address']);
        $note=urldecode($datAarr['note']);
        $service_time=urldecode($datAarr['service_time']);
        $service_id=urldecode($datAarr['service_id']);

        $isdevice=urldecode($datAarr['isdevice']);


        $status="SELECT * FROM `user` where u_id='$user_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        $arr['user_id']=$user_id;
        $arr['total_price']=$total_price;
        $arr['book_date']=$book_date;
        $arr['book_time']=$book_time;
        $arr['book_date_time']=$book_date.' '.$book_time;
        $arr['address']=$service_location.' '.$street_address;
        $arr['artist_id']=$artist_id;
        $arr['isdevice']=$isdevice;
        $arr['telephone_number']=$telephone_number;
        $arr['service_location']=$service_location;
        $arr['street_address']=$street_address;
        $arr['note']=$note;
        $weekday = date('D', strtotime($book_date));
        $arr['book_day'] = $weekday;
        $arr['book_slot']=$book_date;
        $arr['flag'] = '0';
        $arr['create_time']=$create_date;
        $arr['update_date']=$update_date;
		
        $sel_time="SELECT SUM(artist_time) as total_time FROM `tp_artist_categories` WHERE artist_id=$artist_id AND artist_category IN ($service_id)";
        $rs_time=mysql_query($sel_time);
        $row_time=mysql_fetch_array($rs_time);
        $total_time=$row_time['total_time'];
        $timestamp = strtotime(".$book_time.") + ($total_time*60);
        $end_time = date('H:i', $timestamp);
        $date = date('Y-m-d');

        $artist_status = get_single_value('tp_artist','status','a_id='.$artist_id,'a_id','desc','limit 1',false);
        if($artist_status=='1')
		{
			$artist_schedule = mysql_query("SELECT MIN(schedule_start_time) as start_time, MAX(schedule_end_time) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
			$get_artist_schedule = mysql_fetch_assoc($artist_schedule);

				$artist_booking_schedule = mysql_query("SELECT DATE_FORMAT(start_time,'%H:%i') as start_time, DATE_FORMAT(end_time,'%H:%i') as end_time FROM `tp_booking_schedule` WHERE artist_id=$artist_id AND `date`='$book_date'");
				if (mysql_num_rows($artist_booking_schedule) > 0) {
					while ($row = mysql_fetch_assoc($artist_booking_schedule)) {
						$booked_start_time[] = $row['start_time'];
						$booked_end_time[] = $row['end_time'];
					}

					$tmp_book_time = date('H:i:s',strtotime($book_time));
					$tmp_end_time = date('H:i:s',strtotime($end_time));
					$qry = mysql_query("SELECT * FROM tp_booking_schedule WHERE ((start_time >= '$tmp_book_time' AND start_time <= '$tmp_end_time') AND (end_time >= '$tmp_book_time' AND end_time <= '$tmp_end_time')) AND artist_id = $artist_id and date = '$book_date'");
					if(mysql_num_rows($qry)>0){
						$statuschk = 1;
						$succArr = 0;
					} else {
						if($end_time > $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
							$qry = mysql_query("SELECT * FROM tp_booking_schedule WHERE ((start_time >= '$tmp_book_time' AND start_time <= '$tmp_end_time') OR (end_time >= '$tmp_book_time' AND end_time <= '$tmp_end_time')) AND artist_id = $artist_id and date = '$book_date'");
							if(mysql_num_rows($qry)>0){
								$statuschk = 1;
								$succArr = 2;
								foreach ($booked_start_time as $day) {
									//$interval[$count] = abs(strtotime($date) - strtotime($day));
									$interval[] = abs(strtotime($book_time) - strtotime($day));
									//$count++;
								}
								asort($interval);
								$closest = key($interval);
								$send_time = $booked_start_time[$closest];
							} else {
								$statuschk = 1;
								$succArr = 1;
							}
						}
						else{
							$statuschk = 1;
							$succArr = 2;
							$send_time = $get_artist_schedule['end_time'];

						}
					}

				} else {
					$artist_schedule = mysql_query("SELECT MIN(DATE_FORMAT(schedule_start_time,'%H:%i')) as start_time, MAX(DATE_FORMAT(schedule_end_time,'%H:%i')) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
					$get_artist_schedule = mysql_fetch_assoc($artist_schedule);
					if ($book_time >= $get_artist_schedule['start_time'] && $book_time < $get_artist_schedule['end_time']) {
						if ($end_time >= $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
							$statuschk = 1;
							$succArr = 1;
						} else {
							$statuschk = 1;
							$succArr = 2;
							$send_time = $get_artist_schedule['end_time'];
						}
					} else {
						$statuschk = 1;
						$succArr = 0;
					}
				}
        }
        else
        {
		$statuschk = 0;
		$succArr = -1;
        }

        if($succArr == 1 and $statuschk == 1)
        {
                if ($b_id != '')
                {
                    upd_rec(tp_booking_tmp, $arr, "book_id =$b_id", false);
                    $id = $b_id;
                }
                else
                {
                    $id = ins_rec(tp_booking_tmp, $arr);
                }
                if ($id)
                {
                    $book_id = $id;
                    $arr_book['booking_id'] = $id;
                    //$arr_book['category_id']=$category_id;
                    $arr_book['total_price'] = $total_price;
                    $arr_book['service_time'] = $service_time;
                    $arr_book['create_date'] = $create_date;
                    $arr_book['update_date'] = $update_date;
                    $arr_book['service_id'] = $service_id;

                    if ($b_id != '') {
                        upd_rec(tp_book_service_tmp, $arr_book, "booking_id =$b_id", false);
                    } else {
                        $id = ins_rec(tp_book_service_tmp, $arr_book);
                    }
                }
			return '{"message":"You can book now","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 2 and $statuschk == 1)
        {
			return '{"message":"'.$send_time.'","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 0 && $statuschk == 1)
        {
			return '{"message":"Artist is busy","book_status":"'.json_encode($succArr).'","book_id":' . json_encode($book_id) .',"success":' . json_encode("false") .',"isActive":' . json_encode($statuschk). '}';
        }
	else{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
	}

      }
	
		 public function booking_check_9des($datAarr)
    {
        $b_id=urldecode($datAarr['booking_id']);
        $user_id=urldecode($datAarr['user_id']);
        //$price=urldecode($datAarr['price']);
        $book_date=urldecode($datAarr['book_date']);
        $book_time1=urldecode($datAarr['book_time']);
        $book_time=date("H:i", strtotime($book_time1));
        $book_date_time=urldecode($datAarr['book_date_time']);
        $address=urldecode($datAarr['address']);
        $artist_id=urldecode($datAarr['artist_id']);
        $payment_mode=urldecode($datAarr['payment_mode']);
        $transaction_id=urldecode($datAarr['transaction_id']);
        $create_date=date("Y-m-d h:i:sa");
        $update_date=date("Y-m-d h:i:sa");
        //$category_id=urldecode($datAarr['category_id']);
        $total_price=urldecode($datAarr['total_price']);
        $telephone_number=urldecode($datAarr['telephone_number']);
        $service_location=urldecode($datAarr['service_location']);
        $street_address=urldecode($datAarr['street_address']);
        $note=urldecode($datAarr['note']);
        $service_time=urldecode($datAarr['service_time']);
        $service_id=urldecode($datAarr['service_id']);

        $isdevice=urldecode($datAarr['isdevice']);


        $status="SELECT * FROM `user` where u_id='$user_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        $arr['user_id']=$user_id;
        $arr['total_price']=$total_price;
        $arr['book_date']=$book_date;
        $arr['book_time']=$book_time;
        $arr['book_date_time']=$book_date.' '.$book_time;
        $arr['address']=$service_location.' '.$street_address;
        $arr['artist_id']=$artist_id;
        $arr['isdevice']=$isdevice;
        $arr['telephone_number']=$telephone_number;
        $arr['service_location']=$service_location;
        $arr['street_address']=$street_address;
        $arr['note']=$note;
        $weekday = date('D', strtotime($book_date));
        $arr['book_day'] = $weekday;
        $arr['book_slot']=$book_date;
        $arr['flag'] = '0';
        $arr['create_time']=$create_date;
        $arr['update_date']=$update_date;

        $sel_time="SELECT SUM(artist_time) as total_time FROM `tp_artist_categories` WHERE artist_id=$artist_id AND artist_category IN ($service_id)";
        $rs_time=mysql_query($sel_time);
        $row_time=mysql_fetch_array($rs_time);
        $total_time=$row_time['total_time'];
        $timestamp = strtotime(".$book_time.") + ($total_time*60);
        $end_time = date('H:i', $timestamp);
     //   $date = date('Y-m-d');

        $artist_status = get_single_value('tp_artist','status','a_id='.$artist_id,'a_id','desc','limit 1',false);
        $artist_holiday_status = get_single_value('tp_artist','holiday_status','a_id='.$artist_id,'a_id','desc','limit 1',false);
        if($artist_status=='1' and $artist_holiday_status ==0) {
            date_default_timezone_set('Asia/Kolkata');
              $current_time = date("H:i");
		//echo $book_time;
             $current_date=date("Y-m-d");
	  if($book_time =='00:00')
            {
                $book_time='12:00';
            }
            if ($current_time > $book_time and $current_date>=$book_date)
            {
                $succArr=5;
            }
            else
            {
                $artist_schedule = mysql_query("SELECT MIN(schedule_start_time) as start_time, MAX(schedule_end_time) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
                $get_artist_schedule = mysql_fetch_assoc($artist_schedule);

                $artist_booking_schedule = mysql_query("SELECT DATE_FORMAT(start_time,'%H:%i') as start_time, DATE_FORMAT(end_time,'%H:%i') as end_time FROM `tp_booking_schedule` WHERE artist_id=$artist_id AND `date`='$book_date'");
                if (mysql_num_rows($artist_booking_schedule) > 0) {
                    while ($row = mysql_fetch_assoc($artist_booking_schedule)) {
                        $booked_start_time[] = $row['start_time'];
                        $booked_end_time[] = $row['end_time'];
                    }
                    if ($book_time >= $booked_start_time[0] && $book_time < end($booked_end_time)) {
                        $statuschk = 1;
                        $succArr = 0;
                    } else {
                        if ($end_time > $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
                            if ($end_time >= $booked_start_time[0] && $end_time <= end($booked_end_time)) {
                                $statuschk = 1;
                                $succArr = 2;
                                foreach ($booked_start_time as $day) {
                                    //$interval[$count] = abs(strtotime($date) - strtotime($day));
                                    $interval[] = abs(strtotime($book_time) - strtotime($day));
                                    //$count++;
                                }
                                asort($interval);
                                $closest = key($interval);
                                //$send_time = $booked_start_time[$closest];
				$send_time1 = $get_artist_schedule['end_time'];
                       		 $send_time=date("h:i a", strtotime($send_time1));
                            } else {
                                $statuschk = 1;
                                $succArr = 1;
                            }
                        } else {
                            $statuschk = 1;
                            $succArr = 2;
                            //$send_time = $get_artist_schedule['end_time'];
				$send_time1 = $get_artist_schedule['end_time'];
                        $send_time=date("h:i a", strtotime($send_time1));

                        }
                    }

                } else {
                    $artist_schedule = mysql_query("SELECT MIN(DATE_FORMAT(schedule_start_time,'%H:%i')) as start_time, MAX(DATE_FORMAT(schedule_end_time,'%H:%i')) as end_time FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$weekday'");
                    $get_artist_schedule = mysql_fetch_assoc($artist_schedule);
                    if ($book_time >= $get_artist_schedule['start_time'] && $book_time < $get_artist_schedule['end_time']) {
                        if ($end_time >= $get_artist_schedule['start_time'] && $end_time <= $get_artist_schedule['end_time']) {
                            $statuschk = 1;
                            $succArr = 1;
                        } else {
                            $statuschk = 1;
                            $succArr = 2;
                           // $send_time = $get_artist_schedule['end_time'];
				$send_time1 = $get_artist_schedule['end_time'];
                        $send_time=date("h:i a", strtotime($send_time1));
                        }
                    } else {
                        $statuschk = 1;
                        $succArr = 0;
                    }
                }
            }
        }
        else
        {
            $statuschk = 0;
            $succArr = -1;
        }

        if($succArr == 1 and $statuschk == 1)
        {
            return '{"message":"You can book now","book_status":'.json_encode($succArr).',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 2 and $statuschk == 1)
        {
            return '{"message":'.json_encode($send_time).',"book_status":'.json_encode($succArr).',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else if($succArr == 0 && $statuschk == 1)
        {
            return '{"message":"Artist is busy","book_status":'.json_encode($succArr).',"success":' . json_encode("false") .',"isActive":' . json_encode($statuschk). '}';
        }
        elseif($succArr==5)
        {
            return '{"message":"This booking cannot be made as the current time has elapsed booking time.","book_status":'.json_encode($succArr).',"success":' . json_encode("true") .',"isActive":' . json_encode($statuschk). '}';
        }
        else{
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
    }
	public function booking_history($dataAarr)
	{
		$user_id=urldecode($dataAarr['user_id']);
		$status="SELECT * FROM `user` where u_id='$user_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

		$lim = 10;
		$off = $dataAarr[off];
		if ($off == '' || $off == '0')
			$off = 0;
		//$sel="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id ORDER by tb.book_id DESC LIMIT $off,$lim";
		$sel="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id group by tb.book_id ORDER by tb.book_id DESC LIMIT $off,$lim";
		$sel_total="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id ORDER by tb.book_id DESC";
        $rs_total=mysql_query($sel_total);
		$cms_pageing = new get_pageing_cms();
		$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
		$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
		$pg_query_string = '';
		$perpageTmp = urldecode($dataAarr[perpage]);
		$perpage = '';
		if ($perpageTmp != '') {
			$perpage = $perpageTmp;
		} else {
			$perpage = 10;
		}
		//$rs =$cms_pageing->number_pageing($sql,$lim,5,'N','Y',"",$cur_page,$pg_query_string);
		$rs=mysql_query($sel);
		$num = mysql_num_rows($rs);
		$new_off = $off + $num;
		if(mysql_num_rows($rs) > 0)
		{
			$total=mysql_num_rows($rs_total);
			$i=0;
			while($row=mysql_fetch_array($rs))
			{
				 $uid=$row['user_id'];;
                		 $art_id=$row['artist_id'];

				$field[$i][book_id]=$row['book_id'];
				$field[$i][user_id]=$row['user_id'];
				$field[$i][price]=$row['price'];
				$field[$i][book_date]=$row['book_date'];
				$field[$i][book_time]=$row['book_time'];
				$field[$i][address]=$row['address'];
				$field[$i][artist_id]=$row['artist_id'];
				$field[$i][payment_mode]=$row['payment_mode'];
				$field[$i][transaction_id]=$row['transaction_id'];
				$field[$i][isdevice]=$row['isdevice'];
				$field[$i][category_id]=$row['service_id'];
				$field[$i][total_price]=$row['total_price'];
				$field[$i][service_time]=$row['service_time'];
				$field[$i][service_id]=$row['service_id'];
				$field[$i][fullname]=$row['fullname'];
				$field[$i][image]=$row['image'];
				$field[$i][country_code]=$row['country_code'];
				$field[$i][mobile_number]=$row['mobile_no'];
				$field[$i][email]=$row['email'];
				$field[$i][profile_detail]=strip_tags(utf8_encode($row['about_you']));
				$field[$i][qualifications]=strip_tags(utf8_encode($row['qualifications']));
				$field[$i][work_experience]=strip_tags(utf8_encode($row['work_experience']));
				$field[$i][telephone_number]=strip_tags($row['telephone_number']);
				$field[$i][service_location]=strip_tags($row['service_location']);
				$field[$i][street_address]=strip_tags($row['street_address']);
				$field[$i][note]=strip_tags($row['note']);
				$field[$i][document]=$row['document'];
				$field[$i][zipcode]=$row['zipcode'];
				$field[$i][miles]=$row['miles'];
				$field[$i][price]=$row['total_price'];
				$field[$i][latitude]=$row['latitude'];
				$field[$i][longitude]=$row['longitude'];
				$field[$i][status]=$row['flag'];
				$book_id=$row['book_id'];
				 $sel_rew="SELECT COUNT(r_id) as review_id FROM `tp_review` WHERE user_id=$uid AND artist_id=$art_id AND book_id=$book_id";
               			 $rs_rew=mysql_query($sel_rew);
               			 $count_rew=mysql_fetch_array($rs_rew);
                		$field[$i][review_count]=$count_rew['review_id'];
				 $cate_id=$row['service_id'];
				$arr=[];
				//$sel_ser="SELECT * FROM `tp_categories` WHERE id in ($cate_id)";
				 $sel_ser="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE tc.id in ($cate_id)  AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) and ta.artist_id=$art_id order BY tc.id DESC";
				$rs_ser=mysql_query($sel_ser);
				if(mysql_num_rows($rs_ser) > 0)
                {
                    $c=0;
                    while($row_rs=mysql_fetch_array($rs_ser))
                    {
                        $minute = $row_rs['artist_time'];
                        $minuts1 = date('H:i', strtotime($minute));
                        $minuts = explode(":", $minuts1);
                        $s = ' ';
                        if ($minuts[0] != '00')
                        {
                            $format = '%02d:%02d';
                            $total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
                            $hours = floor($total_min / 60);
                            $minutes = ($total_min % 60);
                            $time=sprintf($format, $hours, $minutes);
                            $art_time=$hours.$s.'hr'.$s.$minutes.$s.'mins';

                        }
                        else
                        {
                            $total_min = intval($minuts[1]);
                            $art_time = $total_min . $s . 'mins';
                        }

                        $arr[$c]['cat_id']=$row_rs['artist_category'];
                        $arr[$c]['category_name']=$row_rs['category_name'];
                        $arr[$c]['category_price']=$row_rs['artist_price'];
                        $arr[$c]['category_icon']=$row_rs['category_icon'];
                        $field_cat[$c]['category_time'] = $art_time;
                        $arr[$c]['is_parent']=$row_rs['is_parent'];

                        $c++;
                    }
                    $field[$i]['service']=$arr;
                }
				else
				{
					$field[$i]['service']=[];
				}
				$i++;
			}
			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if($succArr == 1 and $statuschk==1)
		{
			return '{"message":"Booking History","booking_detail":'.json_encode($field).',"isActive":' . json_encode($statuschk).',"Offset":' . $new_off . ',"success":'.json_encode("true").',"total":'.$total.'}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"No booking found","success":'.json_encode("false").'}';
		}

	}
	public function padding_booking_history($dataAarr)
    	{
        $user_id=urldecode($dataAarr['user_id']);
        $status="SELECT * FROM `user` where u_id='$user_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        $lim = 10;
        $off = $dataAarr[off];
        if ($off == '' || $off == '0')
            $off = 0;
        //$sel="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id ORDER by tb.book_id DESC LIMIT $off,$lim";
        $sel="SELECT * FROM `tp_booking_tmp` tb JOIN tp_book_service_tmp tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id group by tb.book_id ORDER by tb.book_id DESC LIMIT $off,$lim";
	$sel_total="SELECT * FROM `tp_booking_tmp` tb JOIN tp_book_service_tmp tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id group by tb.book_id ORDER by tb.book_id DESC";
	$rs_total=mysql_query($sel_total);
        $cms_pageing = new get_pageing_cms();
        $cur_page_arr = split("/", $_SERVER['PHP_SELF']);
        $cur_page = $cur_page_arr[count($cur_page_arr) - 1];
        $pg_query_string = '';
        $perpageTmp = urldecode($dataAarr[perpage]);
        $perpage = '';
        if ($perpageTmp != '') {
            $perpage = $perpageTmp;
        } else {
            $perpage = 10;
        }
        //$rs =$cms_pageing->number_pageing($sql,$lim,5,'N','Y',"",$cur_page,$pg_query_string);
        $rs=mysql_query($sel);
        $num = mysql_num_rows($rs);
        $new_off = $off + $num;
        if(mysql_num_rows($rs) > 0)
        {
            $total=mysql_num_rows($rs_total);
            $i=0;
            while($row=mysql_fetch_array($rs))
            {
                $uid=$row['user_id'];;
                $art_id=$row['artist_id'];
		$book_time=$row['book_time'];
		$booking_times=$booking_time=date("h:i:s", strtotime($book_time));
                $field[$i][book_id]=$row['book_id'];
                $field[$i][user_id]=$row['user_id'];
                $field[$i][price]=$row['price'];
                $field[$i][book_date]=$row['book_date'];
               // $field[$i][book_time]=$booking_times;
		$field[$i][book_time]=$row['book_time'];
                $field[$i][address]=$row['address'];
                $field[$i][artist_id]=$row['artist_id'];
                $field[$i][payment_mode]=$row['payment_mode'];
                $field[$i][transaction_id]=$row['transaction_id'];
                $field[$i][isdevice]=$row['isdevice'];
                $field[$i][category_id]=$row['service_id'];
                $field[$i][total_price]=$row['total_price'];
                $field[$i][service_time]=$row['service_time'];
                $field[$i][service_id]=$row['service_id'];
                $field[$i][fullname]=$row['fullname'];
                $field[$i][image]=$row['image'];
                $field[$i][country_code]=$row['country_code'];
                $field[$i][mobile_number]=$row['mobile_no'];
                $field[$i][email]=$row['email'];
                $field[$i][profile_detail]=strip_tags(utf8_encode($row['about_you']));
                $field[$i][qualifications]=strip_tags(utf8_encode($row['qualifications']));
                $field[$i][work_experience]=strip_tags(utf8_encode($row['work_experience']));
                $field[$i][telephone_number]=strip_tags($row['telephone_number']);
                $field[$i][service_location]=strip_tags($row['service_location']);
                $field[$i][street_address]=strip_tags($row['street_address']);
                $field[$i][note]=strip_tags($row['note']);
                $field[$i][document]=$row['document'];
                $field[$i][zipcode]=$row['zipcode'];
                $field[$i][miles]=$row['miles'];
                $field[$i][price]=$row['total_price'];
                $field[$i][latitude]=$row['latitude'];
                $field[$i][longitude]=$row['longitude'];
                $field[$i][status]=$row['flag'];
                $book_id=$row['book_id'];
                $sel_rew="SELECT COUNT(r_id) as review_id FROM `tp_review` WHERE user_id=$uid AND artist_id=$art_id AND book_id=$book_id";
                $rs_rew=mysql_query($sel_rew);
                $count_rew=mysql_fetch_array($rs_rew);
                $field[$i][review_count]=$count_rew['review_id'];
                $cate_id=$row['service_id'];
                $arr=[];
                //$sel_ser="SELECT * FROM `tp_categories` WHERE id in ($cate_id)";
                $sel_ser="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE tc.id in ($cate_id)  AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) and ta.artist_id=$art_id order BY tc.id DESC";
                $rs_ser=mysql_query($sel_ser);
                if(mysql_num_rows($rs_ser) > 0)
                {
                    $c=0;
                    while($row_rs=mysql_fetch_array($rs_ser))
                    {
                        $minute = $row_rs['artist_time'];
                        $minuts1 = date('H:i', strtotime($minute));
                        $minuts = explode(":", $minuts1);
                        $s = ' ';
                        if ($minuts[0] != '00')
                        {
                            $format = '%02d:%02d';
                            $total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
                            $hours = floor($total_min / 60);
                            $minutes = ($total_min % 60);
                            $time=sprintf($format, $hours, $minutes);
                            $art_time=$hours.$s.'hr'.$s.$minutes.$s.'mins';

                        }
                        else
                        {
                            $total_min = intval($minuts[1]);
                            $art_time = $total_min . $s . 'mins';
                        }

                        $arr[$c]['cat_id']=$row_rs['artist_category'];
                        $arr[$c]['category_name']=$row_rs['category_name'];
                        $arr[$c]['category_price']=$row_rs['artist_price'];
                        $arr[$c]['category_icon']=$row_rs['category_icon'];
                        $field_cat[$c]['category_time'] = $art_time;
                        $arr[$c]['is_parent']=$row_rs['is_parent'];

                        $c++;
                    }
                    $field[$i]['service']=$arr;
                }
                else
                {
                    $field[$i]['service']=[];
                }
                $i++;
            }
            $succArr = 1;
        }
        else
        {
            $succArr = -1;
        }
        if($succArr == 1 and $statuschk==1)
        {
            return '{"message":"Booking History","booking_detail":'.json_encode($field).',"isActive":' . json_encode($statuschk).',"Offset":' . $new_off . ',"success":'.json_encode("true").',"total":'.$total.'}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else
        {
            return '{"message":"No booking found","success":'.json_encode("false").'}';
        }

    }
	public function booking_history_21sep($dataAarr)
	{
		$user_id=urldecode($dataAarr['user_id']);

		//$sel="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id WHERE tb.user_id=$user_id ORDER by tb.book_id DESC";
		$sel="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id JOIN tp_artist ta on tb.artist_id=ta.a_id WHERE tb.user_id=$user_id ORDER by tb.book_id DESC";
		$rs=mysql_query($sel);
		if(mysql_num_rows($rs) > 0)
		{
			$i=0;
			while($row=mysql_fetch_array($rs))
			{
				$field[$i][book_id]=$row['book_id'];
				$field[$i][user_id]=$row['user_id'];
				$field[$i][price]=$row['price'];
				$field[$i][book_date]=$row['book_date'];
				$field[$i][book_time]=$row['book_time'];
				$field[$i][address]=$row['address'];
				$field[$i][artist_id]=$row['artist_id'];
				$field[$i][payment_mode]=$row['payment_mode'];
				$field[$i][transaction_id]=$row['transaction_id'];
				$field[$i][isdevice]=$row['isdevice'];
				$field[$i][category_id]=$row['category_id'];
				$field[$i][total_price]=$row['total_price'];
				$field[$i][service_time]=$row['service_time'];
				$field[$i][service_id]=$row['service_id'];
				$field[$i][fullname]=$row['fullname'];
				$field[$i][image]=$row['image'];
				$field[$i][country_code]=$row['country_code'];
				$field[$i][mobile_number]=$row['mobile_number'];
				$field[$i][email]=$row['email'];
				$field[$i][profile_detail]=strip_tags($row['about_you']);
				$field[$i][qualifications]=strip_tags($row['qualifications']);
				$field[$i][work_experience]=strip_tags($row['work_experience']);
				$field[$i][service]=$row['service'];
				$field[$i][document]=$row['document'];
				$field[$i][zipcode]=$row['zipcode'];
				$field[$i][miles]=$row['miles'];
				$field[$i][price]=$row['price'];
				$field[$i][latitude]=$row['latitude'];
				$field[$i][longitude]=$row['longitude'];
	
				$cate_id=$row['category_id'];
				$sel_ser="SELECT * FROM `tp_categories` WHERE id=$cate_id and status !=0";
				$rs_ser=mysql_query($sel_ser);
				if(mysql_num_rows($rs_ser) > 0)
				{
					$c=0;
					while($row_rs=mysql_fetch_array($rs_ser))
					{
						$arr[$c]['cat_id']=$row_rs['id'];
						$arr[$c]['category_name']=$row_rs['category_name'];
						$arr[$c]['category_price']=$row_rs['category_price'];
						$arr[$c]['category_icon']=$row_rs['category_icon'];
						$arr[$c]['is_parent']=$row_rs['is_parent'];

						$c++;
					}
					$field[$i]['service']=$arr;
				}
				else
				{
					$field[$i]['service']=[];
				}
				$i++;
			}
			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if($succArr == 1)
		{
			//return '{"message":"Sign Up secessfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';
			return '{"message":"Booking History","booking_detail":'.json_encode($field).',"success":'.json_encode("true").'}';
		}
		else
		{
			return '{"message":"No data found","seccess":'.json_encode("false").'}';
		}

	}
	public function booking_history_20sep($dataAarr)
	{
		$user_id=urldecode($dataAarr['user_id']);

		$sel="SELECT * FROM `tp_booking` tb JOIN tp_book_service tbs ON tb.book_id=tbs.booking_id WHERE tb.user_id=$user_id ORDER by tb.book_id DESC";
		$rs=mysql_query($sel);
		if(mysql_num_rows($rs) > 0)
		{
			$i=0;
			while($row=mysql_fetch_array($rs))
			{
				$field[$i][book_id]=$row['book_id'];
				$field[$i][user_id]=$row['user_id'];
				$field[$i][price]=$row['price'];
				$field[$i][book_date]=$row['book_date'];
				$field[$i][book_time]=$row['book_time'];
				$field[$i][address]=$row['address'];
				$field[$i][artist_id]=$row['artist_id'];
				$field[$i][payment_mode]=$row['payment_mode'];
				$field[$i][transaction_id]=$row['transaction_id'];
				$field[$i][isdevice]=$row['isdevice'];
				$field[$i][category_id]=$row['category_id'];
				$field[$i][total_price]=$row['total_price'];
				$field[$i][service_time]=$row['service_time'];
				$field[$i][service_id]=$row['service_id'];

				$i++;
			}
			$succArr = 1;
		}
		else
		{
			$succArr = -1;
		}
		if($succArr == 1)
		{
			//return '{"message":"Sign Up secessfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';
			return '{"message":"Booking History","booking_detail":'.json_encode($field).',"success":'.json_encode("true").'}';
		}
		else
		{
			return '{"message":"No data found","seccess":'.json_encode("false").'}';
		}

	}
	public function stylist_schedule($dataArr)
	{
		$schedule_date=urldecode($dataArr['schedule_date']);
		$schedule_start_time=urldecode($dataArr['schedule_start_time']);
		$schedule_end_time=urldecode($dataArr['schedule_end_time']);
		$price=urldecode($dataArr[price]);
		$address =urldecode($dataArr[postcode]);
		$cate_id=urldecode($dataArr[category_id]);
		//$artist_id=urldecode($dataArr[artist_id]);

		$user_id=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$user_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];


		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		$geo = json_decode($geo, true);

		if ($geo['status'] = 'OK')
		{
			$latitude1 = $geo['results'][0]['geometry']['location']['lat'];
			$longitude1 = $geo['results'][0]['geometry']['location']['lng'];
		}
		if($price=='high')
		{
			//$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id ORDER by tac.artist_price DESC";
			$sel = "SELECT * FROM `tp_schedule` ts JOIN tp_artist ta on ts.artist_id=ta.a_id JOIN tp_artist_categories tac ON tac.artist_id=ta.a_id WHERE ts.service_assign_id=$cate_id AND ts.schedule_start_date >='$schedule_date' AND ts.schedule_end_date >='$schedule_date' and ts.schedule_start_time='$schedule_start_time' AND ts.schedule_end_time='$schedule_end_time' and ta.holiday_status=0 GROUP by ts.s_id ORDER by tac.artist_price DESC";
		}
		else if($price=='low')
		{
			//$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id ORDER by tac.artist_price ASC";
			$sel = "SELECT * FROM `tp_schedule` ts JOIN tp_artist ta on ts.artist_id=ta.a_id JOIN tp_artist_categories tac ON tac.artist_id=ta.a_id WHERE ts.service_assign_id=$cate_id AND ts.schedule_start_date >='$schedule_date' AND ts.schedule_end_date >='$schedule_date' and ts.schedule_start_time='$schedule_start_time' AND ts.schedule_end_time='$schedule_end_time' and ta.holiday_status=0 GROUP by ts.s_id ORDER by tac.artist_price ASC";
		}
		elseif($price=='rate')
		{
			$sel = "SELECT * FROM `tp_schedule` ts JOIN tp_artist ta on ts.artist_id=ta.a_id JOIN tp_artist_categories tac ON tac.artist_id=ta.a_id WHERE ts.service_assign_id=$cate_id AND ts.schedule_start_date >='$schedule_date' AND ts.schedule_end_date >='$schedule_date' and ts.schedule_start_time='$schedule_start_time' AND ts.schedule_end_time='$schedule_end_time' and ta.holiday_status=0 GROUP by ts.s_id ORDER by ta.rating_point DESC";
		}
		else
		{
			$sel = "SELECT * FROM `tp_schedule` ts JOIN tp_artist ta on ts.artist_id=ta.a_id JOIN tp_artist_categories tac ON tac.artist_id=ta.a_id WHERE ts.service_assign_id=$cate_id AND ts.schedule_start_date >='$schedule_date' AND ts.schedule_end_date >='$schedule_date' and ts.schedule_start_time='$schedule_start_time' AND ts.schedule_end_time='$schedule_end_time' and ta.holiday_status=0 GROUP by ts.s_id ORDER by tac.artist_price DESC";
		}
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$latitude2 = $row['latitude'];
				$longitude2 = $row['longitude'];
				$distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
				if ($distance < $row['miles']) {
					$a_id = $row['a_id'];
					$service_id=$row['service_price'];
					$field[$i]['a_id'] = $row['a_id'];
					$field[$i]['fullname'] = $row['fullname'];
					$field[$i]['image'] = $row['image'];
					$field[$i]['mobile_number'] = $row['mobile_no'];
					$field[$i]['country_code'] = '+' . $row['country_code'];
					$field[$i]['email'] = $row['email'];
					$field[$i]['password'] = $row['password'];
					$field[$i]['profile_detail'] = strip_tags($row['about_you']);
					$field[$i]['qualifications'] = strip_tags($row['qualifications']);
					$field[$i]['work_experience'] = strip_tags($row['work_experience']);
					$field[$i]['service_price'] = $row['service_price'];
					$field[$i]['document'] = $row['document'];
					$field[$i]['zipcode'] = $row['zipcode'];
					$field[$i]['miles'] = $row['miles'];
					$sel_price="SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
					$rs_price=mysql_query($sel_price);
					$data=mysql_fetch_array($rs_price);
					if($data['artist_price'] !='')
					{
						$field[$i]['price'] = $data['artist_price'];
					}
					else
					{
						$field[$i]['price'] = [];
					}
					$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
					$rs_reting=mysql_query($sel_reting);
					$ros_reting=mysql_fetch_array($rs_reting);
					//$field[$i]['rating_point'] = $row['rating_point'];
					if($ros_reting['totalreting'] !='')
					{
						$rat=$ros_reting['totalreting'];
						$field[$i]['rating_point'] = $ros_reting['totalreting'];
					}
					else
					{
						$rat='0';
						$field[$i]['rating_point'] = '0';
					}
					$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
					$rs_review=mysql_query($sel_review);
					$ros_review=mysql_fetch_array($rs_review);
					//$field[$i]['review'] = $ros_review['totalrevies'];
					if($ros_review['totalrevies'] !='')
					{
						$review=$ros_review['totalrevies'];
						$field[$i]['review'] = $ros_review['totalrevies'];
					}
					else
					{
						$review='0';
						$field[$i]['review'] = '0';
					}
					$avreg_rate=$rat/$review;
					if($avreg_rate !='')
					{
						$field[$i]['rate_avrege'] = $avreg_rate;
					}
					else
					{
						$field[$i]['rate_avrege'] = "0";
					}
					$field_cat=[];
					$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.id=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
					$qry_cat=mysql_query($sel_cat);
					if (mysql_num_rows($qry_cat) > 0)
					{
						$a=0;
						while($row_cat=mysql_fetch_array($qry_cat))
						{
							$minute = $row_cat['artist_time'];
							$minuts1 = date('H:i', strtotime($minute));
							$minuts = explode(":", $minuts1);
							$s = ' ';
							if ($minuts[0] != '00')
							{
								$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
								$times = $total_min / 60;
								$time = $times . $s . 'hrs';

							}
							else
							{
								$total_min = intval($minuts[1]);
								$time = $total_min . $s . 'mins';
							}
							$service_price=explode(",", $row['price']);
							$field_cat[$a]['id'] = $row_cat['artist_category'];
							$field_cat[$a]['category_name'] = $row_cat['category_name'];
							$field_cat[$a]['category_price'] =$row_cat['artist_price'];
							$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
							$field_cat[$a]['category_time'] = $time;
							$field_cat[$a]['main_category_id']=$row_cat['is_parent'];
							$a++;
						}
						$field[$i]['category'] = $field_cat;

					}
					else
					{
						$field[$i]['category'] = [];
					}


					$i++;
					//$succArr = 1;
					$lim = 10;
					$off = $dataArr[off];
					if ($off == '' || $off == '0')
						$off = 0;
					$cms_pageing = new get_pageing_cms();
					$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
					$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
					$pg_query_string = '';
					$perpageTmp = urldecode($dataArr[perpage]);
					$perpage = '';
					if ($perpageTmp != '') {
						$perpage = $perpageTmp;
					} else {
						$perpage = 10;
					}

					$arra= array_slice( $field,$off,$lim);
					$num =sizeof($arra);
					//echo $num;exit;
					if($num !=0)
					{
						$fields=$arra;
						$new_off = $off + $num;
						$succArr = 1;
					}
					else
					{
						$result_array = 2;
					}

				}
				else
				{
					$succArr = 2;
				}
			}


		}
		else
		{
			$succArr = -1;
		}

		if ($succArr == 1 and $statuschk==1)
		{
			return '{"stylist and Artist":' . json_encode($fields) . ',"isActive":' . json_encode($statuschk).',"Offset":' . $new_off .',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == 2)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	public function stylist_schedule_24sep($dataArr)
	{
		$schedule_date=urldecode($dataArr['schedule_date']);
		$schedule_start_time=urldecode($dataArr['schedule_start_time']);
		$schedule_end_time=urldecode($dataArr['schedule_end_time']);
		$price=urldecode($dataArr[price]);
		$address =urldecode($dataArr[postcode]);
		$miles = urldecode($dataArr[miles]);
		$cate_id=urldecode($dataArr[category_id]);

		$user_id=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$user_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];
		

		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		$geo = json_decode($geo, true);

		if ($geo['status'] = 'OK')
		{
			$latitude1 = $geo['results'][0]['geometry']['location']['lat'];
			$longitude1 = $geo['results'][0]['geometry']['location']['lng'];
		}
		if($price=='high')
		{
			//$sel = "select * from tp_artist where status !=0 AND find_in_set('$cate_id',service_price) <> 0 ORDER by price DESC";
			$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id ORDER by tac.artist_price DESC";
		}
		else if($price=='low')
		{
			//$sel = "select * from tp_artist where status !=0 AND find_in_set('$cate_id',service_price) <> 0 ORDER by price ASC";
			$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id ORDER by tac.artist_price ASC";
		}
		elseif($price=='rate')
		{
			$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id ORDER by ta.rating_point DESC";
		}
		else
		{
			$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id WHERE tac.artist_category=$cate_id ORDER by tac.artist_price DESC";
		}
		$qry=mysql_query($sel);
		if (mysql_num_rows($qry) > 0)
		{
			$i=0;
			//$row=mysql_fetch_array($result);
			while($row=mysql_fetch_array($qry))
			{
				$latitude2 = $row['latitude'];
				$longitude2 = $row['longitude'];
				$distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
				if ($distance < $row['miles']) {
					$a_id = $row['a_id'];
					$service_id=$row['service_price'];
					$field[$i]['a_id'] = $row['a_id'];
					$field[$i]['fullname'] = $row['fullname'];
					$field[$i]['image'] = $row['image'];
					$field[$i]['mobile_number'] = $row['mobile_no'];
					$field[$i]['country_code'] = '+' . $row['country_code'];
					$field[$i]['email'] = $row['email'];
					$field[$i]['password'] = $row['password'];
					$field[$i]['profile_detail'] = strip_tags($row['about_you']);
					$field[$i]['qualifications'] = strip_tags($row['qualifications']);
					$field[$i]['work_experience'] = strip_tags($row['work_experience']);
					$field[$i]['service_price'] = $row['service_price'];
					$field[$i]['document'] = $row['document'];
					$field[$i]['zipcode'] = $row['zipcode'];
					$field[$i]['miles'] = $row['miles'];
					$sel_price="SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
					$rs_price=mysql_query($sel_price);
					$data=mysql_fetch_array($rs_price);
					if($data['artist_price'] !='')
					{
						$field[$i]['price'] = $data['artist_price'];
					}
					else
					{
						$field[$i]['price'] = [];
					}
					$sel_reting="SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=$a_id";
					$rs_reting=mysql_query($sel_reting);
					$ros_reting=mysql_fetch_array($rs_reting);
					//$field[$i]['rating_point'] = $row['rating_point'];
					if($ros_reting['totalreting'] !='')
					{
						$rat=$ros_reting['totalreting'];
						$field[$i]['rating_point'] = $ros_reting['totalreting'];
					}
					else
					{
						$rat='0';
						$field[$i]['rating_point'] = '0';
					}
					$sel_review="SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=$a_id";
					$rs_review=mysql_query($sel_review);
					$ros_review=mysql_fetch_array($rs_review);
					//$field[$i]['review'] = $ros_review['totalrevies'];
					if($ros_review['totalrevies'] !='')
					{
						$review=$ros_review['totalrevies'];
						$field[$i]['review'] = $ros_review['totalrevies'];
					}
					else
					{
						$review='0';
						$field[$i]['review'] = '0';
					}
					$avreg_rate=$rat/$review;
					if($avreg_rate !='')
					{
						$field[$i]['rate_avrege'] = $avreg_rate;
					}
					else
					{
						$field[$i]['rate_avrege'] = "0";
					}
					$field_cat=[];
					$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.id=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
					$qry_cat=mysql_query($sel_cat);
					if (mysql_num_rows($qry_cat) > 0)
					{
						$a=0;
						while($row_cat=mysql_fetch_array($qry_cat))
						{
							$minute = $row_cat['artist_time'];
							$minuts1 = date('H:i', strtotime($minute));
							$minuts = explode(":", $minuts1);
							$s = ' ';
							if ($minuts[0] != '00')
							{
								$total_min = intval($minuts[0]) * 60 + intval($minuts[1]);
								$times = $total_min / 60;
								$time = $times . $s . 'hrs';

							}
							else
							{
								$total_min = intval($minuts[1]);
								$time = $total_min . $s . 'mins';
							}
							$service_price=explode(",", $row['price']);
							$field_cat[$a]['id'] = $row_cat['artist_category'];
							$field_cat[$a]['category_name'] = $row_cat['category_name'];
							$field_cat[$a]['category_price'] =$row_cat['artist_price'];
							$field_cat[$a]['category_icon'] = $row_cat['category_icon'];
							$field_cat[$a]['category_time'] = $time;
							$field_cat[$a]['main_category_id']=$row_cat['is_parent'];
							$a++;
						}
						$field[$i]['category'] = $field_cat;

					}
					else
					{
						$field[$i]['category'] = [];
					}


					$i++;
					//$succArr = 1;
					$lim = 10;
					$off = $dataArr[off];
					if ($off == '' || $off == '0')
						$off = 0;
					$cms_pageing = new get_pageing_cms();
					$cur_page_arr = split("/", $_SERVER['PHP_SELF']);
					$cur_page = $cur_page_arr[count($cur_page_arr) - 1];
					$pg_query_string = '';
					$perpageTmp = urldecode($dataArr[perpage]);
					$perpage = '';
					if ($perpageTmp != '') {
						$perpage = $perpageTmp;
					} else {
						$perpage = 10;
					}

					$arra= array_slice( $field,$off,$lim);
					$num =sizeof($arra);
					//echo $num;exit;
					if($num !=0)
					{
						$fields=$arra;
						$new_off = $off + $num;
						$succArr = 1;
					}
					else
					{
						$result_array = 2;
					}

				}
				else
				{
					$succArr = 2;
				}
			}


		}
		else
		{
			$succArr = -1;
		}
		
		if ($succArr == 1 and $statuschk==1)
		{
			return '{"stylist and Artist":' . json_encode($fields) . ',"isActive":' . json_encode($statuschk).',"Offset":' . $new_off .',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == 2)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
		else
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	public function confirm_booking($dataArr)
	{
		$payment_mode=urldecode($dataArr['payment_mode']);
		$transaction_id=urldecode($dataArr['transaction_id']);
		$book_id=urldecode($dataArr['book_id']);
		
		
		$user_id=urldecode($dataArr[uid]);
		$status="SELECT * FROM `user` where u_id='$user_id'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];

		$fields[payment_mode] = $payment_mode;
		$fields[transaction_id] = $transaction_id;
		$upd=upd_rec(tp_booking, $fields, "book_id=" . $book_id, false);
		if($upd)
		{
			$succArr=1;
		}
		else
		{
			$succArr= -1;
		}
		if ($succArr == 1 and $statuschk==1)
		{
			return '{"message":"booking Confirm successfully","success":' . json_encode("true") .  ',"isActive":' . json_encode($statuschk).'}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"booking Not a confirm try again","success":' . json_encode('false') . '}';
		}
	}
	public function cancel_booking($dataArr)
    {
        $book_id=urldecode($dataArr[book_id]);
        $flag=urldecode($dataArr[flag]);
        $uid=urldecode($dataArr[uid]);
        $book_time=urldecode($dataArr['book_time']);
        $book_day=urldecode($dataArr['book_day']);
        $artist_id=urldecode($dataArr['artist_id']);

        $status="SELECT * FROM `user` where u_id='$uid'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        if($statuschk == 1)
        {
            $bookingRowData = single_row(tp_booking,"*","book_id=$book_id","book_id","desc","",false);
            if($bookingRowData != '')
            {
                date_default_timezone_set('Asia/Kolkata');
                $currentDate = date('Y-m-d H:i:s');
                $newDate = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($currentDate)));
                $bookDate20 = date("Y-m-d H:i:s", strtotime('+20 minutes', strtotime($bookingRowData[book_date_time])));
                $bookTime20 = strtotime('+20 minutes', strtotime($bookingRowData[book_date_time]));
                if(strtotime($currentDate) > $bookTime20){
                    $flag = "3";
		del_rec('tp_booking_schedule','book_id='.$book_id.'',false);
                }
                else if($bookingRowData[book_date_time] >= $newDate){
                    $flag = "1";
                    $fields['flag']=$flag;
                   // $fields['status']='0';
                   // upd_rec(tp_booking, $fields, "book_id=" . $book_id,false);
			del_rec('tp_booking_schedule','book_id='.$book_id.'',false);
                    $sel_schedule="SELECT * FROM `tp_schedule` WHERE schedule_day='$book_day' AND schedule_start_time='$book_time' and artist_id=$artist_id";
                    $rs_schedule=mysql_query($sel_schedule);
                    if(mysql_num_rows($rs_schedule) > 0)
                    {
                        $row_schedule=mysql_fetch_array($rs_schedule);
                        $arr_schedule['status']='0';
                        $event_id=$row_schedule['s_id'];
                        //upd_rec(tp_schedule,$arr_schedule,"s_id=$event_id",false);
			del_rec('tp_booking_schedule','book_id='.$book_id.'',false);
                    }
                }
                else
                {
                    $flag = "2";
                    $fields['flag']=$flag;
                    // $fields['status']='0';
                   // upd_rec(tp_booking, $fields, "book_id=" . $book_id,false);
			del_rec('tp_booking_schedule','book_id='.$book_id.'',false);
                    $sel_schedule="SELECT * FROM `tp_schedule` WHERE schedule_day='$book_day' AND schedule_start_time='$book_time' and artist_id=$artist_id";
                    $rs_schedule=mysql_query($sel_schedule);
                    if(mysql_num_rows($rs_schedule) > 0)
                    {
                        $row_schedule=mysql_fetch_array($rs_schedule);
                        $arr_schedule['status']='0';
                        $event_id=$row_schedule['s_id'];
                       // upd_rec(tp_schedule,$arr_schedule,"s_id=$event_id",false);
			del_rec('tp_booking_schedule','book_id='.$book_id.'',false);
                    }
                }
//                //echo "test";
//                $arr='1';
//                $fields['flag']=$flag;
//                $fields['status']='0';
//                $array['flag'] = $flag;
//                $array['book_date_time'] = $bookingRowData[book_date_time];
//                $array['bookDate20'] = $bookDate20;
//                $array['bookTime20'] = $bookTime20;
//                $array['serverTime'] = $currentDate;
//                //upd_rec(tp_booking, $fields, "book_id=" . $book_id,false);

            }

            $succArr=1;
        }
        else
        {
            $succArr=-1;
        }
        if($succArr == 1 and $statuschk == 1 and ($flag ==1 OR $flag ==2))
        {
            return '{"message":"Booking cancell successfully","success":' . json_encode("true") .',"status":' . json_encode($flag). ',"isActive":' . json_encode($statuschk).'}';
        }
        elseif($flag == 3)
        {
            return '{"success":' . json_encode("true") .',"status":' . json_encode($flag). ',"isActive":' . json_encode($statuschk).'}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else
        {
            return '{"message":"booking Not a cancel try again","success":' . json_encode('false') . '}';
        }

    }
	public function cancel_booking_29sep($dataArr)
	{
		$book_id=urldecode($dataArr[book_id]);
		$flag=urldecode($dataArr[flag]);
		$uid=urldecode($dataArr[uid]);

		$status="SELECT * FROM `user` where u_id='$uid'";
		$statusrs=mysql_query($status);
		$datastatus=mysql_fetch_array($statusrs);
		$statuschk=$datastatus['status'];
		if($statuschk == 1)
		{
			 $sql1="SELECT * FROM tp_booking WHERE DATE_SUB(CURDATE(),INTERVAL 1 DAY) <= book_date_time AND book_id=$book_id";
			$rs=mysql_query($sql1);
			$num=mysql_num_rows($rs);
			if($num < 0 and $flag =='' )
			{
				$fields['flag']='1';
				$fields['status']='0';
			}
			else if($flag == 2)
			{
				$fields['flag'] = $flag;
				$fields['status']='0';
			}
			elseif($flag == 3)
			{
				$fields['flag'] = $flag;
				$fields['status']='1';
			}
			else
			{
				$fields['flag']='0';
				$fields['status']='0';
			}
			upd_rec(tp_booking, $fields, "book_id=" . $book_id, false);
			$succArr=1;
		}
		else
		{
			$succArr=-1;
		}
		if($succArr == 1 and $statuschk == 1)
		{
			return '{"message":"Booking cancell successfully","success":' . json_encode("true") .  ',"isActive":' . json_encode($statuschk).'}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else
		{
			return '{"message":"booking not a cancel try again","success":' . json_encode('false') . '}';
		}

	}

	public function stylist_event_18sep($dataArr)
	{
		$artist_id=urldecode($dataArr[artist_id]);
		$category_id=urldecode($dataArr[category_id]);
		$schedule_date=urldecode($dataArr[schedule_date]);
		$uid=urldecode($dataArr[uid]);
		$string = "$schedule_date";
		$date = DateTime::createFromFormat("Y-m-d", $string);
		$day=$date->format("D");

		$status="select * from user where u_id='$uid'";
		$status_rs=mysql_query($status);
		$datastatus=mysql_fetch_array($status_rs);
		$statuschk=$datastatus['status'];

		if($statuschk == 1)
		{
			//$sql="SELECT * FROM `tp_schedule` WHERE artist_id=$artist_id AND service_assign_id=$category_id AND schedule_day='$day' AND status =1 ORDER BY s_id DESC";
			 $sql="SELECT * FROM `tp_schedule` WHERE artist_id=$artist_id AND schedule_day='$day' AND status =0 ORDER BY s_id ASC";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs) > 0)
			{
				$i=0;
				while($row=mysql_fetch_array($rs))
				{
					$sminute = $row['schedule_start_time'];
					$eminute = $row['schedule_end_time'];
					//$minuts=date('H:i',strtotime($minute));
					$minuts1 = date('H:i', strtotime($sminute));
					$minuts2 = date('H:i', strtotime($eminute));

					$field[$i][event_id]=$row['s_id'];
					$field[$i][artist_id]=$row['artist_id'];
					//$field[$i][schedule_start_date]=$row['schedule_start_date'];
					//$field[$i][schedule_end_date]=$row['schedule_end_date'];
					$field[$i][schedule_start_time]= $row['schedule_start_time'];
					$field[$i][schedule_end_time]=$row['schedule_end_time'];
					$field[$i][status]=$row['status'];
					$i++;
					$succArr=1;
				}
			}
			else
			{
				$succArr=-1;
			}
		}
		else
		{
			$statuschk=0;
		}
		if ($succArr == 1 and $statuschk==1)
		{
			return '{"stylist event":' . json_encode($field) . ',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == -1)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
		 public function stylist_event($dataArr)
   	 {
        $artist_id=urldecode($dataArr[artist_id]);
        $category_id=urldecode($dataArr[category_id]);
        $schedule_date=urldecode($dataArr[schedule_date]);
        $uid=urldecode($dataArr[uid]);
        $string = "$schedule_date";
        $date = DateTime::createFromFormat("Y-m-d", $string);
        $day=$date->format("D");

        $status="select * from user where u_id='$uid'";
        $status_rs=mysql_query($status);
        $datastatus=mysql_fetch_array($status_rs);
        $statuschk=$datastatus['status'];

        if($statuschk == 1)
        {
            $sel_schedule="SELECT * FROM `tp_booking_schedule` where artist_id=$artist_id and date='$schedule_date' order by start_time asc Limit 1";
            $rs_schedule=mysql_query($sel_schedule);
            $row_schedule=mysql_fetch_array($rs_schedule);
            $start_time=$row_schedule['start_time'];
            $sel_schedule_end="SELECT * FROM `tp_booking_schedule` where artist_id=$artist_id and date='$schedule_date' order by end_time DESC Limit 1";
            $rs_schedule_end=mysql_query($sel_schedule_end);
            $row_schedule_end=mysql_fetch_array($rs_schedule_end);
            $end_time=$row_schedule_end['end_time'];

            //$sql="SELECT * FROM `tp_schedule` WHERE artist_id=$artist_id AND service_assign_id=$category_id AND schedule_day='$day' AND status =1 ORDER BY s_id DESC";
		$current_date=date("Y-m-d");
		if($schedule_date == $current_date)
		{
			//$final_end=$end_time-30;
			 if($end_time !='')
                	{
		            $times_final = strtotime("-30 minutes", strtotime($end_time));
		            $times_final1=date('H:i:s', $times_final);
               		 }
             $sql="SELECT * FROM `tp_schedule` where artist_id=$artist_id and schedule_day='$day' and schedule_start_time Not BETWEEN '$start_time' and '$end_time' AND schedule_start_time > CURRENT_TIME() ORDER BY s_id ASC";
		}
		else
		{
			//echo $final_end=$end_time-30;
			if($end_time !='')
                	{
		            $times_final = strtotime("-30 minutes", strtotime($end_time));
		            $times_final1=date('H:i:s', $times_final);
               		 }
			  $sql="SELECT * FROM `tp_schedule` where artist_id=$artist_id and schedule_day='$day' and schedule_start_time Not BETWEEN '$start_time' and '$end_time' ORDER BY s_id ASC";
		}
            $rs=mysql_query($sql);
            if(mysql_num_rows($rs) > 0)
            {
                $i=0;
                while($row=mysql_fetch_array($rs))
                {
                    $sminute = $row['schedule_start_time'];
                    $eminute = $row['schedule_end_time'];
                    //$minuts=date('H:i',strtotime($minute));
                    $minuts1 = date('H:i', strtotime($sminute));
                    $minuts2 = date('H:i', strtotime($eminute));

                    $field[$i][event_id]=$row['s_id'];
                    $field[$i][artist_id]=$row['artist_id'];
                    //$field[$i][schedule_start_date]=$row['schedule_start_date'];
                    //$field[$i][schedule_end_date]=$row['schedule_end_date'];
                    $field[$i][schedule_start_time]= $row['schedule_start_time'];
                    $field[$i][schedule_end_time]=$row['schedule_end_time'];
                    $field[$i][status]=$row['status'];
                    $i++;
                    $succArr=1;
                }
            }
            else
            {
                $succArr=-1;
            }
        }
        else
        {
            $statuschk=0;
        }
        if ($succArr == 1 and $statuschk==1)
        {
            return '{"stylist event":' . json_encode($field) . ',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else if($succArr == -1)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
    }
	public function stylist_event_27sep($dataArr)
	{
		$artist_id=urldecode($dataArr[artist_id]);
		$category_id=urldecode($dataArr[category_id]);
		$schedule_date=urldecode($dataArr[schedule_date]);
		$uid=urldecode($dataArr[uid]);

		$status="select * from user where u_id='$uid'";
		$status_rs=mysql_query($status);
		$datastatus=mysql_fetch_array($status_rs);
		$statuschk=$datastatus['status'];

		if($statuschk == 1)
		{
			//$sql="SELECT * FROM `tp_schedule` WHERE artist_id=$artist_id";
			  $sql="SELECT * FROM `tp_schedule` WHERE artist_id=$artist_id AND service_assign_id=$category_id AND schedule_start_date >='$schedule_date' AND schedule_end_date >='$schedule_date' AND user_id=0 ORDER BY s_id DESC";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs) > 0)
			{
				$i=0;
				while($row=mysql_fetch_array($rs))
				{
					//$minute = $row['schedule_start_time'];
					//$minuts=date('H:i',strtotime($minute));
					//$minuts1 = date('H:i', strtotime($minute));

					$field[$i][event_id]=$row['s_id'];
					$field[$i][artist_id]=$row['artist_id'];
					$field[$i][schedule_start_date]=$row['schedule_start_date'];
					$field[$i][schedule_end_date]=$row['schedule_end_date'];
					$field[$i][schedule_start_time]=$row['schedule_start_time'];
					$field[$i][schedule_end_time]=$row['schedule_end_time'];
					$field[$i][status]=$row['status'];
					$i++;
					$succArr=1;
				}
			}
			else
			{
				$succArr=-1;
			}
		}
		else
		{
			$statuschk=0;
		}
		if ($succArr == 1 and $statuschk==1)
		{
			return '{"stylist event":' . json_encode($field) . ',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
		}
		elseif($statuschk == 0)
		{
			return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
		}
		else if($succArr == -1)
		{
			return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
		}
	}
	public function change_password($dataArr)
    {
        $uid=urldecode($dataArr['uid']);
        $password=urldecode($dataArr['password']);

        $status = "select * from user where u_id='$uid'";
        $status_rs = mysql_query($status);
        $datastatus = mysql_fetch_array($status_rs);
        $statuschk = $datastatus['status'];
        if($statuschk == 1)
        {
            $arr['password'] = md5($password);
            upd_rec(user, $arr, "u_id=$uid");
            $succArr=1;
        }
        else
        {
            $succArr=-1;
        }
        if ($succArr == 1 AND $statuschk == 1) {
            return '{"message":"Your password details have been successfully updated.","isActive":' . json_encode($statuschk) . ',"success":' . json_encode("true") . '}';
        } elseif ($statuschk == 0) {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk) . ',"success":' . json_encode('fail') . '}';
        } else {
            return '{"message":"Your password details have been successfully updated","success":' . json_encode('false') . '}';
        }
    }
	public function schedule_time($dataArr)
    {
        $uid=urldecode($dataArr['uid']);
        $address =urldecode($dataArr[postcode]);
        $cate_id=urldecode($dataArr[category_id]);
        $event_date=urldecode($dataArr[schedule_date]);


        $status="SELECT * FROM `user` where u_id='$uid'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        if($event_date !='')
        {
            $weekday = date('D', strtotime($event_date));
        }

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

        $geo = json_decode($geo, true);

        if ($geo['status'] = 'OK')
        {
            $latitude1 = $geo['results'][0]['geometry']['location']['lat'];
            $longitude1 = $geo['results'][0]['geometry']['location']['lng'];
        }
        if ($address !='' and $cate_id !='')
        {
            //$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and ts.status =1 and tac.count=0 ORDER by tac.artist_price DESC";
		$sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE ta.status !=0 and ts.status =0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) ORDER by tac.artist_price DESC";
        }
        $qry=mysql_query($sel);
        $artist =[];
        if(mysql_num_rows($qry) > 0)
        {

            while($row=mysql_fetch_array($qry))
            {                //echo $a_id = $row['a_id'];
                $latitude2 = $row['latitude'];
                $longitude2 = $row['longitude'];
                $distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
                if ($distance < $row['miles'])
                {
                    //echo 'test';
                    array_push($artist, $row['a_id']);
                  //  $artist.=$row['a_id'];
                }
                }
           // echo json_encode($artist);

        }
        else
        {
            $artist='';
        }
        if($artist !='')
        {
             //$artist_id=json_encode($artist);
            $artist_id=implode(',',$artist);
            //echo $artist_id;
           //$sel_sche="SELECT * FROM `tp_schedule` WHERE artist_id IN ($artist_id) ORDER BY schedule_start_time ASC LIMIT 1";
	     $sel_sche="SELECT * FROM `tp_schedule` WHERE artist_id IN ($artist_id) AND schedule_day='$weekday' ORDER BY schedule_start_time ASC LIMIT 1";
            $rs=mysql_query($sel_sche);
            $data_start=mysql_fetch_array($rs);
            //$field['schedule_start_time'] = $data_start['schedule_start_time'];
		  if($data_start['schedule_start_time'] !='')
            {
                $field['schedule_start_time'] = $data_start['schedule_start_time'];
            }
            else
            {
                $field['schedule_start_time'] = '';
            }
            //$sel_end="SELECT * FROM `tp_schedule` WHERE artist_id IN ($artist_id) ORDER BY schedule_start_time DESC LIMIT 1";
	    $sel_end="SELECT * FROM `tp_schedule` WHERE artist_id IN ($artist_id) AND schedule_day='$weekday' ORDER BY schedule_start_time DESC LIMIT 1";
            $rs_end=mysql_query($sel_end);
            $data_end=mysql_fetch_array($rs_end);
            //$field['schedule_end_time'] = $data_end['schedule_end_time'];
		 if($data_end['schedule_end_time'] !='') {
                $field['schedule_end_time'] = $data_end['schedule_end_time'];
            }
            else
            {
                $field['schedule_end_time'] ='';
            }
            $succArr=1;
        }
        else
        {
            $succArr=-1;
        }

        if ($succArr == 1 and $statuschk == 1)
        {
            //echo"tets";
            return '{"stylist schedule":' . json_encode($field) .',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }

    }
	public function schedule_time_28sep($dataArr)
    {
        $uid=urldecode($dataArr['uid']);
        $address =urldecode($dataArr[postcode]);
        $cate_id=urldecode($dataArr[category_id]);
        $event_date=urldecode($dataArr[schedule_date]);


        $status="SELECT * FROM `user` where u_id='$uid'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        if($event_date !='')
        {
            $weekday = date('D', strtotime($event_date));
        }

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

        $geo = json_decode($geo, true);

        if ($geo['status'] = 'OK')
        {
            $latitude1 = $geo['results'][0]['geometry']['location']['lat'];
            $longitude1 = $geo['results'][0]['geometry']['location']['lng'];
        }
        if ($address !='' and $cate_id !='')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ta.status !=0 and ts.status =0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) ORDER by tac.artist_price DESC";
        }
        $qry=mysql_query($sel);
        if(mysql_num_rows($qry) > 0)
        {
            $i=0;
            while($row=mysql_fetch_array($qry))
            {
               //echo $a_id = $row['a_id'];
                $latitude2 = $row['latitude'];
                $longitude2 = $row['longitude'];
                $distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
                if ($distance < $row['miles'])
                {
                    $a_id = $row['a_id'];
                    $weekday = date('D', strtotime($event_date));
                    $a_id = $row['a_id'];
                    $sel_schedule="SELECT * FROM `tp_schedule` WHERE artist_id=$a_id AND schedule_day='$weekday' ORDER BY schedule_start_time ASC ";
                    $rs_schedule=mysql_query($sel_schedule);                    
                    if(mysql_num_rows($rs_schedule) > 0) 
			{
                        while ($row_schedule = mysql_fetch_array($rs_schedule)) 
			{				
                            $field[$i]['schedule_id'] = $row_schedule['s_id'];
                            $field[$i]['artist_id'] = $row_schedule['artist_id'];
                            $field[$i]['artist_id'] = $row_schedule['artist_id'];
                            $field[$i]['schedule_start_time'] = $row_schedule['schedule_start_time'];
                            $field[$i]['schedule_end_time'] = $row_schedule['schedule_end_time'];
                            $field[$i]['status'] = $row_schedule['status'];                          
                        }
			$succArr = 1;
                    }
                    else
                    {
                        $succArr = 2;
                    }

                }
		$i++;
            }
        }
        else
        {
            $succArr = -1;
        }
        if ($succArr == 1 and $statuschk == 1)
        {
            //echo"tets";
            return '{"stylist schedule":' . json_encode($field) .',"isActive":' . json_encode($statuschk).',"success":' . json_encode("true") . '}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else if($succArr == 2)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }

        else
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }

    }
	public function confirm_cancel($dataArr)
    {
        $flag=urldecode($dataArr['flag']);
        $book_id=urldecode($dataArr['book_id']);

        $uid=urldecode($dataArr['uid']);

        $status="select * from user where u_id='$uid'";
        $status_rs=mysql_query($status);
        $datastatus=mysql_fetch_array($status_rs);
        $statuschk=$datastatus['status'];

        if($statuschk == 1)
        {
            $bookingRowData = single_row(tp_booking,"*","book_id=$book_id","book_id","desc","",false);

            $fields['flag']=$flag;
            // $fields['status']='0';
            upd_rec(tp_booking, $fields, "book_id=" . $book_id,false);
            $book_day=$bookingRowData['book_day'];
            $book_time=$bookingRowData['book_time'];
            $artist_id=$bookingRowData['artist_id'];

            $sel_schedule="SELECT * FROM `tp_schedule` WHERE schedule_day='$book_day' AND schedule_start_time='$book_time' and artist_id=$artist_id";
            $rs_schedule=mysql_query($sel_schedule);
            if(mysql_num_rows($rs_schedule) > 0)
            {
                $row_schedule=mysql_fetch_array($rs_schedule);
                $arr_schedule['status']='0';
                $event_id=$row_schedule['s_id'];
                upd_rec(tp_schedule,$arr_schedule,"s_id=$event_id",false);
            }
            $succArr=1;
        }
        if($succArr == 1 and $statuschk == 1)
        {
            return '{"message":"Booking cancell successfully","success":' . json_encode("true") .',"status":' . json_encode($flag). ',"isActive":' . json_encode($statuschk).'}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }

    }
	public function signuptest($dataArr)
    {
        $request_data=array_decode($dataArr);
        $name=$request_data[name];
        $email=$request_data[email];
        $phone_number=$request_data[phone_number];
        $password = $request_data[password];
        $facebook_id = $request_data[facebook_id];
        $flag = $request_data[isdevice];

        $sel="select * from user WHERE email='$email'";
        $rs=mysql_query($sel);

        if($facebook_id !='')
        {
            $sel_face="select * from user WHERE facebook_id='$facebook_id'";
            $rs_face=mysql_query($sel_face);
        }
        if(mysql_num_rows($rs_face) > 0)
        {
            $succArr = 3;
        }
        else if(mysql_num_rows($rs) > 0)
        {
            $succArr = 2;
        }
        else
        {
            $arr['name'] = $name;
            $arr['email'] = $email;
            $arr['phone_number']=$phone_number;
            $arr['password']=md5($password);
            $arr['facebook_id']=$facebook_id;
            $arr['status']='1';
            $arr['isdevice']=$flag;
            if($facebook_id !='')
            {
                $image='graph.facebook.com/'.$facebook_id.'/picture?type=large';
                $arr['image']=$image;
            }
            else
            {
                $image='avtar.jpg';
                $arr['image']=$image;
            }

            if(ins_rec(user, $arr))
            {
                require 'PHPMailer/PHPMailerAutoload.php';

                $mail = new PHPMailer;

                $mail->isSMTP();
               // $mail->SMTPDebug=3;
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sarju@techintegrity.in';
                $mail->Password = 'Welcometis1';
                $mail->SMTPSecure = 'tls';

                //$mail->From = $email;
                $mail->From = 'sarju@techintegrity.in';
                $mail->FromName = 'Tap n’ Style';
                $mail->addAddress('sarju@techintegrity.in', 'Tap n’ Style');

                $mail->addReplyTo('sarju@techintegrity.in', 'Tap n’ Style');

                $mail->WordWrap = 50;
                $mail->isHTML(true);

                $mail->Subject = 'Tap n’ Style User Register';
                //$mail->Body = 'your new password is   '.$password.'';
                $mail->Body = '
			    <p><b>User Register</b></p><br>
			    <p><img src="http://138.68.5.43/tapNstyle/include/class/tapnstyle.png"></p><br>
			    <p>Hey,'.$email.'</p><br>

			    <p><b>User Name:</b> '.$email.'</p>
			    <p><b>Password:</b> '.$password.'</p><br>

			    <p>Thanks for signing up & to Tap n’ Style. Getting your hair or make up done just got a whole lot easier. A few taps on your phone and your own personal Stylist or Make-Up Artist will come to you!</p>

                <p>
            For the ladies, here’s an idea: before your next big night out get your girlfriend over to yours, buy some champers and order one of our trained professionals to Blow Dry & Style your hair or do your Make Up.  Sounds fun right, we think so too 

            Check Availability Now("https://mockingbot.in/app/6ctaxAoGx390jx076pmRgW3xOfhKs9j")
            </p>
            <p>Follow us for latest news and hair & beauty pics from happy Tap n Style clients!</p>

			<p><b>Follow us<b> for latest trends and hair & beauty pics</p>
			<p><b>Facebook, Twitter and Instagram <b> </p><br>

		    <p><b>Tap n’ Style    |    Don’t Plan Ahead Ltd    |    Company No. 9184952</b></p>

			';
            }


            $sql = "SELECT * FROM `user` WHERE email='$email'";
            $rs = mysql_query($sql) or die(mysql_error());
            $data=mysql_fetch_array($rs);
            $field['id']=$data['u_id'];
            $field['name']=$data['name'];
            $field['email']=$data['email'];
            $field['phone_number']=$data['phone_number'];
            $field['facebook_id']=$data['facebook_id'];

            //$succArr = 1;
            if ($mail->send())
            {
                $succArr = 1;
            }
        }
        if ($succArr == 1)
        {
            return '{"message":"Sign Up secessfully","user_details":' . json_encode($field) . ',"success":' . json_encode("true") . '}';

        }
        else if($succArr == 2)
        {
            return '{"message":"Email id Already exists","success":' . json_encode('false') . '}';
        }
        else if($succArr == 3)
        {
            return '{"message":"Facebook id Already exists","success":' . json_encode('false') . '}';
        }

    }
    
    public function flexible_artist($dataArr)
    {
        $price=urldecode($dataArr[price]);
        $address =urldecode($dataArr[postcode]);
        $miles = urldecode($dataArr[miles]);
        $cate_id=urldecode($dataArr[category_id]);
        $event_date=urldecode($dataArr[schedule_date]);

        $u_id=urldecode($dataArr[uid]);
        $status="SELECT * FROM `user` where u_id='$u_id'";
        $statusrs=mysql_query($status);
        $datastatus=mysql_fetch_array($statusrs);
        $statuschk=$datastatus['status'];

        if($event_date !='')
        {
            $weekday = date('D', strtotime($event_date));
        }

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

        $geo = json_decode($geo, true);

        if ($geo['status'] = 'OK')
        {
            $latitude1 = $geo['results'][0]['geometry']['location']['lat'];
            $longitude1 = $geo['results'][0]['geometry']['location']['lng'];
        }
        if ($price == 'high' and $event_date != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ts.schedule_day='$weekday' AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        else if ($price == 'low' and $event_date != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ts.schedule_day='$weekday' AND ta.status !=0  and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price ASC";
        }
        elseif ($price == 'highrate' and $event_date != '')
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ts.schedule_day='$weekday' AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by ta.rating_point DESC";
        }
        elseif ($price == 'lowrate' and $event_date != '' )
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ts.schedule_day='$weekday' AND ta.status !=0 and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by ta.rating_point ASC";
        }
        else
        {
            $sel = "SELECT * FROM `tp_artist_categories` tac join tp_artist ta ON tac.artist_id=ta.a_id JOIN tp_schedule ts on ta.a_id=ts.artist_id WHERE tac.artist_category=$cate_id AND ts.schedule_day='$weekday' AND ta.status !=0  and (tac.artist_cat_count !=0 OR tac.artist_cat_count =0) and ta.holiday_status=0 GROUP BY ta.a_id ORDER by tac.artist_price DESC";
        }
        $qry=mysql_query($sel);
        $field=[];
        if (mysql_num_rows($qry) > 0)
        {
            $data_count = mysql_num_rows($qry);
            $i=0;
            while($row=mysql_fetch_array($qry))
            {
                $latitude2 = $row['latitude'];
                $longitude2 = $row['longitude'];
                $artist_id=$row['artist_id'];
                $distance = $this->getDistance($latitude1, $longitude1, $latitude2, $longitude2);
                if ($distance < $row['miles']) {
                    $a_id = $row['a_id'];

                    $sel_schedule = "SELECT * FROM `tp_booking_schedule` where artist_id=$a_id and date='$event_date' order by start_time asc Limit 1";
                    $rs_schedule = mysql_query($sel_schedule);
                    $row_schedule = mysql_fetch_array($rs_schedule);
                    $start_time = $row_schedule['start_time'];
                    $sel_schedule_end = "SELECT * FROM `tp_booking_schedule` where artist_id=$a_id and date='$event_date' order by end_time DESC Limit 1";
                    $rs_schedule_end = mysql_query($sel_schedule_end);
                    $row_schedule_end = mysql_fetch_array($rs_schedule_end);
                    $end_time = $row_schedule_end['end_time'];

                    //$sql="SELECT * FROM `tp_schedule` WHERE artist_id=$artist_id AND service_assign_id=$category_id AND schedule_day='$day' AND status =1 ORDER BY s_id DESC";
                    $sql = "SELECT * FROM `tp_schedule` where artist_id=$a_id and schedule_day='$weekday' and schedule_start_time Not BETWEEN '$start_time' and '$end_time'  ORDER BY s_id ASC";
                    $rs = mysql_query($sql);
                    if (mysql_num_rows($rs) > 0) 
                    {

                        $service_id = $row['service_price'];
                        $field[$i]['a_id'] = $row['a_id'];
                        $field[$i]['fullname'] = $row['fullname'];
                        $field[$i]['image'] = $row['image'];
                        $field[$i]['mobile_number'] = $row['mobile_no'];
                        $field[$i]['country_code'] = '+' . $row['country_code'];
                        $field[$i]['email'] = $row['email'];
                        $field[$i]['password'] = $row['password'];
                        $field[$i]['profile_detail'] = strip_tags(utf8_encode($row['about_you']));
                        $field[$i]['qualifications'] = strip_tags(utf8_encode($row['qualifications']));
                        $field[$i]['work_experience'] = strip_tags(utf8_encode($row['work_experience']));
                        $field[$i]['service_price'] = $row['service_price'];
                        $field[$i]['document'] = $row['document'];
                        $field[$i]['zipcode'] = $row['zipcode'];
                        $field[$i]['miles'] = $row['miles'];
                        $sel_price = "SELECT * FROM `tp_artist_categories` WHERE artist_category=$cate_id and artist_id=$a_id";
                        $rs_price = mysql_query($sel_price);
                        $data = mysql_fetch_array($rs_price);
                        if ($data['artist_price'] != '') {
                            $field[$i]['price'] = $data['artist_price'];
                        } else {
                            $field[$i]['price'] = "0";
                        }
                        $sel_reting = "SELECT SUM(review_rating) as totalreting FROM tp_review WHERE artist_id=" . $a_id . " order by totalreting ";
                        $rs_reting = mysql_query($sel_reting);
                        $ros_reting = mysql_fetch_array($rs_reting);
                        //if($ros_reting['totalreting'] !='')
                        // if($row['rating_point'] !='')
                        // {
                        // 	$rat=$row['rating_point'];
                        // 	$field[$i]['rating_point'] = $row['rating_point'];
                        // }
                        if ($ros_reting['totalreting'] != '') {
                            $rat = $ros_reting['totalreting'];
                            $field[$i]['rating_point'] = $ros_reting['totalreting'];
                        } else {
                            $rat = '0';
                            $field[$i]['rating_point'] = '0';
                        }
                        $sel_review = "SELECT COUNT(r_id) as totalrevies FROM `tp_review` WHERE artist_id=" . $a_id . " order by  totalrevies DESC";
                        $rs_review = mysql_query($sel_review);
                        $ros_review = mysql_fetch_array($rs_review);
                        //$field[$i]['review'] = $ros_review['totalrevies'];
                        if ($ros_review['totalrevies'] != '') {
                            $review = $ros_review['totalrevies'];
                            $field[$i]['review'] = $ros_review['totalrevies'];
                        } else {
                            $review = '0';
                            $field[$i]['review'] = '0';
                        }
                        // $avreg_rate = $rat / $review;
                        $avreg_rate = $row['rating_point'];
                        if ($avreg_rate != '') {
                            $field[$i]['rate_avrege'] = $avreg_rate;
                        } else {
                            $field[$i]['rate_avrege'] = "0";
                        }

                        $sel_gallary = "SELECT * FROM `tp_artist_portfolio` WHERE artist_id=$a_id";
                        $rs_gallary = mysql_query($sel_gallary);
                        $field_gallary = [];
                        if (mysql_num_rows($rs_gallary) > 0) {
                            $g = 0;
                            while ($row_gallary = mysql_fetch_array($rs_gallary)) {
                                $field_gallary[$g][portfolio_image] = $row_gallary['portfolio_image'];
                                $field_gallary[$g][image_title] = $row_gallary['image_title'];
                                $field_gallary[$g][image_caption] = $row_gallary['image_caption'];
                                $g++;
                            }
                            $field[$i]['gallary'] = $field_gallary;
                        } else {
                            $field[$i]['gallary'] = [];
                        }
                        $field_cat = [];
                        //$sel_cat="SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id order BY tc.id DESC";
                        $sel_cat = "SELECT * FROM `tp_artist_categories` ta JOIN tp_categories tc on ta.artist_category=tc.id WHERE ta.artist_id=$a_id AND (ta.artist_cat_count !=0 OR ta.artist_cat_count =0) order BY tc.id DESC";
                        $qry_cat = mysql_query($sel_cat);
                        if (mysql_num_rows($qry_cat) > 0) 
                        {
                            $a = 0;
                            while ($row_cat = mysql_fetch_array($qry_cat)) {

                                // $format = '%02d:%02d';
                                $minute = $row_cat['artist_time'];
                                $s = ' ';
                                $total_min = $minute;
                                $hours = floor($total_min / 60);
                                $minutes = ($total_min % 60);
                                // $time=sprintf($format, $hours, $minutes);
                                $art_time = $hours . $s . 'hr' . $s . $minutes . $s . 'mins';

                                $service_price = explode(",", $row['price']);
                                $field_cat[$a]['id'] = $row_cat['artist_category'];
                                $field_cat[$a]['category_name'] = $row_cat['category_name'];
                                $field_cat[$a]['category_price'] = $row_cat['artist_price'];
                                $field_cat[$a]['category_icon'] = $row_cat['category_icon'];
                                $field_cat[$a]['category_time'] = $art_time;
                                $field_cat[$a]['main_category_id'] = $row_cat['is_parent'];
                                $a++;
                            }
                            $field[$i]['category'] = $field_cat;

                        } else {
                            $field[$i]['category'] = [];
                        }
                        $i++;
                        $lim = 10;
                        $off = $dataArr[off];
                        if ($off == '' || $off == '0')
                            $off = 0;
                        $cms_pageing = new get_pageing_cms();
                        $cur_page_arr = split("/", $_SERVER['PHP_SELF']);
                        $cur_page = $cur_page_arr[count($cur_page_arr) - 1];
                        $pg_query_string = '';
                        $perpageTmp = urldecode($dataArr[perpage]);
                        $perpage = '';
                        if ($perpageTmp != '') {
                            $perpage = $perpageTmp;
                        } else {
                            $perpage = 10;
                        }

                        $arra = array_slice($field, $off, $lim);
                        $num = sizeof($arra);
                        //echo $num;exit;
                        if ($num != 0) {
                            $fields = $arra;
                            $new_off = $off + $num;
                            $succArr = 1;
                        } else {
                            $result_array = 2;
                        }

                    }
                }
                else
                {
                    $succArr = 2;
                }
            }


        }
        else
        {
            $succArr = -1;
        }
        if ($succArr == 1 and $statuschk == 1)
        {
            return '{"stylist and Artist":' . json_encode($fields) .',"isActive":' . json_encode($statuschk). ',"Offset":' . $new_off .',"success":' . json_encode("true") . ',"total":'.$data_count.'}';
        }
        elseif($statuschk == 0)
        {
            return '{"message":"Your account has been temporary suspended by admin.","isActive":' . json_encode($statuschk).',"success":' . json_encode('fail') . '}';
        }
        else if($succArr == 2)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
        else if($succArr = 3)
        {
            return '{"message":"Data Not Found","success":' . json_encode('false') . '}';
        }
    }	
}