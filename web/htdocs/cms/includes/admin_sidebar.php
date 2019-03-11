<div id="nav-col">
    <?php
    $sql="SELECT * FROM `adminlogin` WHERE role='admin'";
    $qry=mysql_query($sql);
    $data=mysql_fetch_array($qry);
    $permission_page = $this->session->userdata('permission_page');
    $permission_name = $this->session->userdata('username');
    if (isset($_SESSION['permission_page'])) $permission_page = $_SESSION['permission_page'];
    if (isset($_SESSION['username'])) $permission_name = $_SESSION['username'];

    ?>
    <section id="col-left" class="col-left-nano">
        <div id="col-left-inner" class="col-left-nano-content">
            <div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
                <img alt="" src="<?php echo base_url().$data['image']; ?>" />
                <div class="user-box">
                                    <span class="name">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                              <?php if($permission_name == 'staff') echo 'staff'; else  echo $data['username'];?>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
					<?php if($permission_name != 'staff') { ?>
                                        <ul class="dropdown-menu">
                                            <li><a href="profile"><i class="fa fa-user"></i><?php echo $profile_title_lng;?></a></li>
                                            <li><a href="password_change"><i class="fa fa-cog"></i><?php echo $change_passwor_lng;?></a></li>
                                            <li><a href="logout"><i class="fa fa-power-off"></i><?php echo $logout_lng;?></a></li>
                                        </ul>
					<?php } ?>
                                    </span>
                    <span class="status">
                                        <i class="fa fa-circle"></i> Online
                                    </span>
                </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-header nav-header-first hidden-sm hidden-xs">
                        Navigation
                    </li>
                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url=base_url().'admin/dashboard';
		            $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(DASHBOARD, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {
                    if($actual_link==$url) {
                        ?>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span><?php echo $dashboard_lng; ?></span>
                                <span class="label label-primary label-circle pull-right"></span>
                            </a>
                        </li>
                        <?php
			
                   
		    }else {
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/dashboard">
                                <i class="fa fa-dashboard"></i>
                                <span><?php echo $dashboard_lng;?></span>
                                <span class="label label-primary label-circle pull-right"></span>
                            </a>
                        </li>
                        <?php
                    	}
		    }		
                    ?>
                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url12 = base_url().'admin/real_time_mapping';
		    $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(REAL_TIME_MAPPING, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {	
                    if($actual_link==$url12) {
                        ?>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>admin/real_time_mapping">
                                <i class="fa fa-dashboard"></i>
                                <span><?php echo $Real_Time_Mapping_lng;?></span>
                                <span class="label label-primary label-circle pull-right"></span>
                            </a>
                        </li>
                        <?php
                    
		    
		    } else {
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/real_time_mapping">
                                <i class="fa fa-dashboard"></i>
                                <span><?php echo $Real_Time_Mapping_lng;?></span>
                                <span class="label label-primary label-circle pull-right"></span>
                            </a>
                        </li>
                        <?php
                    	}
		    }		
		    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $daily=base_url().'admin/Daily_Driver_Earnings';
		    $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(DAILY_DRIVER_EARNINGS, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {
		    if($actual_link == $daily) {
                        ?>
		    <li class="active">
                            <a href="<?php echo base_url(); ?>admin/Daily_Driver_Earnings">
                                <i class="fa fa-money"></i>
                                <span><?php echo $Daily_Driver_Earnings_lng;?></span>
                                <span class="label label-primary label-circle pull-right"></span>
                            </a>
                        </li>
			<?php
                    
		    
		    
		    } else {
                        ?>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/Daily_Driver_Earnings">
                                <i class="fa fa-money"></i>
                                <span><?php echo $Daily_Driver_Earnings_lng;?></span>
                                <span class="label label-primary label-circle pull-right"></span>
                            </a>
                        </li>
                    <?php
                    }
		}
                    ?>

		 <!--Manager staff--->	


                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url7=base_url().'admin/add_staff';
                    $url8=base_url().'admin/add_staff?flag=yes';
		     $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(MANAGE_STAFF, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {	
                    if($actual_link==$url7) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_staff; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
                                <li class="active">
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/add_staff'">
                                        <?php echo $Add_staff; ?>
                                    </a>
                                </li>
                                <li>
				    <a href="javascript:void(0);" 
				    	onclick="window.location.href='<?php echo base_url(); ?>admin/add_staff?flag=yes'">
                                        <?php echo $Manage_staff; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    
		    } else if($actual_link==$url8){
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_staff; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
                                <li> 
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/add_staff'">
                                        <?php echo $Add_staff; ?>
                                    </a>
                                </li>
                                <li class="active">
				    <a href="javascript:void(0);" 
				    	onclick="window.location.href='<?php echo base_url(); ?>admin/add_staff?flag=yes'">
                                        <?php echo $Manage_staff; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    
		    } else {
                        ?>
                        <li>
                            <!--onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'"-->
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_staff; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: none;">
                                <li>
				      <a href="javascript:void(0);" 
				      onclick="window.location.href='<?php echo base_url(); ?>admin/add_staff'">
                                        <?php echo $Add_staff; ?>
                                    </a>
                                </li>
                                <li>
				      <a href="javascript:void(0);" 
				      onclick="window.location.href='<?php echo base_url(); ?>admin/add_staff?flag=yes'">
                                        <?php echo $Manage_staff; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
		    	}
                    }
                    ?>
			 <!---------->	



















                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url7=base_url().'admin/manage_user';
                    $url8=base_url().'admin/manage_user?flag=yes';
		    $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(MANAGEUSER, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {	
                    if($actual_link==$url7) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_User_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				<?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEUSER_ALLUSER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li class="active">
				      <a href="javascript:void(0);" 
				      onclick="window.location.href='<?php echo base_url(); ?>admin/manage_user'">
                                        <?php echo $All_Users_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEUSER_FLAGGEDUSER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_user?flag=yes'">
                                        <?php echo $Flagged_Users_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>		
                            </ul>
                        </li>
                        <?php
                    
		    } else if($actual_link==$url8){
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_User_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEUSER_ALLUSER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_user'">
                                        <?php echo $All_Users_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEUSER_FLAGGEDUSER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li class="active">
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_user?flag=yes'">
                                        <?php echo $Flagged_Users_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
                    
		    } else {
                        ?>
                        <li>
                            <!--onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'"-->
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_User_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: none;">
				<?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEUSER_ALLUSER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_user'">
                                        <?php echo $All_Users_lng; ?>
                                    </a>
                                </li>
 				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEUSER_FLAGGEDUSER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_user?flag=yes'">
                                        <?php echo $Flagged_Users_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
			}
                    }
                    ?>
                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url1=base_url().'admin/manage_booking?status_code=pending';
                    $url2=base_url().'admin/manage_booking?status_code=completed';
                    $url3=base_url().'admin/manage_booking?status_code=user-cancelled';
                    $url4=base_url().'admin/manage_booking?status_code=driver-unavailable';
                    $url5=base_url().'admin/manage_booking';
	    	    $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(MANAGEBOOKING, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {	
                    if($actual_link==$url5) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_Booking_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_ALLBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li class="active">
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'">
                                        <?php echo $All_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>	
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=pending'">
                                        <?php echo $Pending_Booking_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=completed'">
                                        <?php $Completed_Booking_lng ?>
                                    </a>
                                </li>
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_USERCANCELBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=user-cancelled'">
                                        <?php echo $User_Cancelled_Booking_lng;  ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=driver-unavailable'">
                                        <?php echo $Driver_Cancelled_Booking_lng;?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
                    
		    } else if($actual_link==$url1) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_Booking_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_ALLBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'">
                                        <?php echo $All_Booking_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li class="active">
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=pending'">
                                        <?php echo $Pending_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>	
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=completed'">
                                        <?php $Completed_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_USERCANCELBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=user-cancelled'">
                                        <?php echo $User_Cancelled_Booking_lng;  ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=driver-unavailable'">
                                        <?php echo $Driver_Cancelled_Booking_lng;?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
                    
		    } else if($actual_link==$url2){
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_Booking_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_ALLBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				  <a href="javascript:void(0);" 
				  onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'">
                                        <?php echo $All_Booking_lng; ?>
                                    </a>
                                </li>
 				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=pending'">
                                        <?php echo $Pending_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                <li class="active">
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=completed'">
                                        <?php $Completed_Booking_lng; ?>
                                    </a>
                                </li>
				<?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_USERCANCELBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=user-cancelled'">
                                        <?php echo $User_Cancelled_Booking_lng;  ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=driver-unavailable'">
                                        <?php echo $Driver_Cancelled_Booking_lng;?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
			}  else if($actual_link==$url3){
			 $permission = true;
                            if($permission_name == 'staff' )  {
                                if (!in_array(MANAGEBOOKING, $permission_page)) {
                                    $permission = false;
                                }
                            }
                            if($permission == true) { ?>
                        
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_Booking_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_ALLBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'">
                                        <?php echo $All_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=pending'">
                                        <?php echo $Pending_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=completed'">
                                        <?php $Completed_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_USERCANCELBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li class="active">
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=user-cancelled'">
                                        <?php echo $User_Cancelled_Booking_lng;  ?>
                                    </a>
                                </li>
				 <?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=driver-unavailable'">
                                        <?php echo $Driver_Cancelled_Booking_lng;?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
                    }
                   } else if($actual_link==$url4){
                        
  			    $permission = true;
                            if($permission_name == 'staff' )  {
                                if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                    $permission = false;
                                }
                            }
                            if($permission == true) { ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_Booking_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				<?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_ALLBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'">
                                        <?php echo $All_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=pending'">
                                        <?php echo $Pending_Booking_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=completed'">
                                        <?php $Completed_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_USERCANCELBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=user-cancelled'">
                                        <?php echo $User_Cancelled_Booking_lng;  ?>
                                    </a>
                                </li>
				 <?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li class="active">
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=driver-unavailable'">
                                        <?php echo $Driver_Cancelled_Booking_lng;?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
                    }
                 } else {
			 $permission = true;
                            if($permission_name == 'staff' )  {
                                if (!in_array(MANAGEBOOKING, $permission_page)) {
                                    $permission = false;	    		  
                              }
                            }
                            if($permission == true) { ?>
                        <li>
                            <!--onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'"-->
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Manage_Booking_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: none;">
				 <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_ALLBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'">
                                        <?php echo $All_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_PENDNINGBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=pending'">
                                        <?php echo $Pending_Booking_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=completed'">
                                        <?php $Completed_Booking_lng; ?>
                                    </a>
                                </li>
				<?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_USERCANCELBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=user-cancelled'">
                                        <?php echo $User_Cancelled_Booking_lng;  ?>
                                    </a>
                                </li>
				 <?php  } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking?status_code=driver-unavailable'">
                                        <?php echo $Driver_Cancelled_Booking_lng;?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
			  }
                        }
                    }
                    ?>
                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url5=base_url().'admin/manage_driver';
                    $url6=base_url().'admin/manage_driver?flag=yes';
		    $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(MANAGEDRIVER, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {
                    if($actual_link==$url5) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_Driver_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEDRIVER_ALLDRIVER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li class="active">
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_driver'">
                                        <?php echo $All_Drivers_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(MANAGEDRIVER_FLAGDRIVER, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_driver?flag=yes'">
                                        <?php echo $Flagged_Drivers_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
			 } else if ($actual_link == $url6) {
                            $permission = true;
                            if($permission_name == 'staff' )  {
                                if (!in_array(MANAGEDRIVER, $permission_page)) {
                                    $permission = false;
                    		}  
			}
                        if($permission == true) { ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_Driver_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				<?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEDRIVER_ALLDRIVER, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				     <a href="javascript:void(0);" 
				     onclick="window.location.href='<?php echo base_url(); ?>admin/manage_driver'">
                                        <?php echo $All_Drivers_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEDRIVER_FLAGDRIVER, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li class="active">
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_driver?flag=yes'">
                                        <?php echo $Flagged_Drivers_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
                    }
                   } else {
                        ?>
			<?php
                            $permission = true;
                            if($permission_name == 'staff' )  {
                                if (!in_array(MANAGEDRIVER, $permission_page)) {
                                    $permission = false;
                                }
                            }
                            if($permission == true) { ?>
                        <li>
                            <!--onclick="window.location.href='<?php echo base_url(); ?>admin/manage_booking'"-->
                            <a href="javascript:void(0);" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span><?php echo $Manage_Driver_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: none;">
				<?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEDRIVER_ALLDRIVER, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_driver'">
                                        <?php echo $All_Drivers_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                        <?php
                                        $permission = true;
                                        if($permission_name == 'staff' )  {
                                            if (!in_array(MANAGEDRIVER_FLAGDRIVER, $permission_page)) {
                                                $permission = false;
                                            }
                                        }
                                        if($permission == true) { ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_driver?flag=yes'">
                                        <?php echo $Flagged_Drivers_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
 			 }
                       }
                    }
                    ?>
                    <?php
                    $url=base_url().'admin/manage_car_type';
		     $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(MANAGECARTYPE, $permission_page)) {
                            $permission = false;
                        }
                    }
                  if($permission == true) {	
                    if($actual_link==$url)   {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle"
                               onclick="window.location.href='<?php echo base_url(); ?>admin/manage_car_type'">

                                <i class="fa fa-taxi"></i>
                                <span><?php echo $Manage_Car_Type_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                        </li>
                        <?php  
			} else {
                        ?>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-toggle"
                               onclick="window.location.href='<?php echo base_url(); ?>admin/manage_car_type'">

                                <i class="fa fa-taxi"></i>
                                <span><?php echo $Manage_Car_Type_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                        </li>
                        <?php
                        }
		   }
                    ?>
                    <?php
                    $url=base_url().'admin/manage_delay_reasons';
		    $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(MANAGEDELAYREASON, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {	
                    	if($actual_link==$url) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle"
                               onclick="window.location.href='<?php echo base_url();?>admin/manage_delay_reasons'">

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Manage_Delay_Reasons_lng; ?></span>
                            </a>
                        </li>
                        <?php
			} else {
                        ?>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-toggle"
                               onclick="window.location.href='<?php echo base_url();?>admin/manage_delay_reasons'">

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Manage_Delay_Reasons_lng; ?></span>
                            </a>
                        </li>
                        <?php
			}
                    }
                    ?>
                    <?php
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url9=base_url().'admin/update_settings';
                    $url10=base_url().'admin/manage_fix_price_area';
                    $url11 = base_url().'admin/update_web_commision';
                    $url13 = base_url().'admin/manage_cashout';
                    //$url=base_url().'admin/update_settings';
                    $url=base_url().'admin/manage_time_type';
                    if($actual_link==$url)
                    {
			 $permission = true;
                        if($permission_name == 'staff' )  {
                            if (!in_array(SETTINGS, $permission_page)) {
                                $permission = false;
                            }
                        }
                        if($permission == true) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle" >

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Settings_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_UPDATESETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/update_settings'">
                                        <?php echo $Update_Setting_lng;?>
                                    </a>
                                </li>
				<?php }  ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_FIXPRICEAREA, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_fix_price_area'">
                                        <?php echo $Fix_Price_Area_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_MANAGEDAYTIME, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li class="active">
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/manage_time_type'">
                                        <?php echo $Manage_Day_Time_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_COMMISIONSETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) { ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/update_web_commision'">
                                        <?php echo $Commision_Setting_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
			}
                    }
                    else if($actual_link==$url9)
                    {
			$permission = true;
                        if($permission_name == 'staff' )  {
                            if (!in_array(SETTINGS, $permission_page)) {
                                $permission = false;
                            }
                        }
                        if($permission == true) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle" >

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Settings_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				<?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_UPDATESETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li class="active">
				      <a href="javascript:void(0);" 
				      onclick="window.location.href='<?php echo base_url(); ?>admin/update_settings'">
                                        <?php echo $Update_Setting_lng;?>
                                    </a>
                                </li>
				  <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_FIXPRICEAREA, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>	
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_fix_price_area'">
                                        <?php echo $Fix_Price_Area_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_MANAGEDAYTIME, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/manage_time_type'">
                                        <?php echo $Manage_Day_Time_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_COMMISIONSETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/update_web_commision'">
                                        <?php echo $Commision_Setting_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                            </ul>
                        </li>
                        <?php
			}
                    }
                    else if($actual_link==$url10)
                    {
			$permission = true;
                        if($permission_name == 'staff' )  {
                            if (!in_array(SETTINGS, $permission_page)) {
                                $permission = false;
                            }
                        }
                        if($permission == true) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle" >

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Settings_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				<?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_UPDATESETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/update_settings'">
                                        <?php echo $Update_Setting_lng;?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_FIXPRICEAREA, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li class="active">
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_fix_price_area'">
                                        <?php echo $Fix_Price_Area_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_MANAGEDAYTIME, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/manage_time_type'">
                                        <?php echo $Manage_Day_Time_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_COMMISIONSETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/update_web_commision'">
                                        <?php echo $Commision_Setting_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
			}
                    }
                    else if($actual_link==$url11)
                    {
		        $permission = true;
                        if($permission_name == 'staff' )  {
                            if (!in_array(SETTINGS, $permission_page)) {
                                $permission = false;
                            }
                        }
                        if($permission == true) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle" >

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Settings_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
				<?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_UPDATESETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/update_settings'">
                                        <?php echo $Update_Setting_lng;?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_FIXPRICEAREA, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_fix_price_area'">
                                        <?php echo $Fix_Price_Area_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_MANAGEDAYTIME, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/manage_time_type'">
                                        <?php echo $Manage_Day_Time_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_COMMISIONSETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li class="active">
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/update_web_commision'">
                                        <?php echo $Commision_Setting_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
			}
                    }
                    else
                    {
			$permission = true;
                        if($permission_name == 'staff' )  {
                            if (!in_array(SETTINGS, $permission_page)) {
                                $permission = false;
                            }
                        }
                        if($permission == true) {
                        ?>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-toggle">

                                <i class="fa fa-cog"></i>
                                <span><?php echo $Settings_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: none;">
				 <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_UPDATESETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li>
				  <a href="javascript:void(0);" 
				  onclick="window.location.href='<?php echo base_url(); ?>admin/update_settings'">
                                        <?php echo $Update_Setting_lng;?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_FIXPRICEAREA, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>
                                <li>
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_fix_price_area'">
                                        <?php echo $Fix_Price_Area_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_MANAGEDAYTIME, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                    ?>	
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/manage_time_type'">
                                        <?php echo $Manage_Day_Time_lng; ?>
                                    </a>
                                </li>
				<?php } ?>
                                    <?php
                                    $permission = true;
                                    if($permission_name == 'staff' )  {
                                        if (!in_array(SETTINGS_COMMISIONSETTING, $permission_page)) {
                                            $permission = false;
                                        }
                                    }
                                    if($permission == true) {
                                        ?>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-toggle"
                                       onclick="window.location.href='<?php echo base_url(); ?>admin/update_web_commision'">
                                        <?php echo $Commision_Setting_lng; ?>
                                    </a>
                                </li>
				 <?php } ?>
                            </ul>
                        </li>
                        <?php
			}
                    }
		     $permission = true;
                    if($permission_name == 'staff' )  {
                        if (!in_array(CASHOUT, $permission_page)) {
                            $permission = false;
                        }
                    }
                    if($permission == true) {	
                    	if($actual_link==$url13) {
                        ?>
                        <li class="active">
                            <a href="javascript:void(0);" class="dropdown-toggle" >

                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Cashout_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu" style="display: block;">
                                <li class="active">
				    <a href="javascript:void(0);" 
				    onclick="window.location.href='<?php echo base_url(); ?>admin/manage_cashout'">
                                        <?php echo $Manage_cashout;?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php
		} else {	
                    ?>
                        <li>
                            <a href="javascript:void(0);" class="dropdown-toggle" >

                                <i class="fa fa-ticket"></i>
                                <span><?php echo $Cashout_lng; ?></span>
                                <i class="fa fa-angle-right drop-icon"></i>
                            </a>
                            <ul class="submenu">
                                <li>
				   <a href="javascript:void(0);" 
				   onclick="window.location.href='<?php echo base_url(); ?>admin/manage_cashout'">
                                        <?php echo $Manage_cashout;?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php
			}
                    }
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <div id="nav-col-submenu"></div>
</div>
