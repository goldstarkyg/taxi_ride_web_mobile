<?php
include ('language.php');
?>
<!DOCTYPE html>
<html>
<?php
$id=$_GET['id'];
//echo $id;
$table='user_rate';
$this->db->select('ur.user_rate_id,ur.user_id,ur.driver_id,ur.driver_id,ur.driver_comment,ur.user_rate,ur.create_date,d.name,d.image');
$this->db->from('user_rate ur');
$this->db->join('driver_details d','ur.driver_id=d.id','join');
$this->db->where('ur.user_rate_id',$id);
$this->db->group_by('ur.user_rate_id','desc');
$query=$this->db->get($table);
//echo $this->db->last_query();exit;
$result=$query->result_array();
$user_id=$result[0]['user_id'];
//print_r($result);exit;
if(isset($_REQUEST['save']))
{
    $comment=$_REQUEST['comment'];
    $rating=$_REQUEST['rating'];
    $update_data=array(
        'driver_comment'=>$comment,
        'user_rate'=>$rating
    );
    //print_r($update_data);exit;
    $where_data=array(
        'user_rate_id'=>$id
    );
    //print_r($update_data);exit;
    $this->db->where($where_data);
    $data=$this->db->update($table,$update_data);
    //echo $this->db->last_query();exit;
    if($data == 1)
    {
        $url=base_url().'admin/user_rating?user_id='.$user_id;
       // echo $url;exit;
      //  redirect("http://$_SERVER[HTTP_HOST]/gagaji/fix_een_bob/admin/user_rating?user_id=".$user_id);
        redirect($url);
    }
}
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Edit user rating - <?php echo $header_title; ?></title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/bootstrap/bootstrap.min.css" />

    <!-- RTL support - for demo only -->
    <script src="js/demo-rtl.js"></script>
    <!--
    If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
    And add "rtl" class to <body> element - e.g. <body class="rtl">
    -->

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/nanoscroller.css" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/compiled/theme_styles.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/libs/daterangepicker.css" type="text/css" />

    <!-- Favicon -->
    <link type="image/x-icon" href="<?php echo base_url();?>upload/favicon.png" rel="shortcut icon" />

    <!-- google font libraries -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">.modal-open .modal{ background:url(<?php echo base_url();?>application/views/img/transpharant.png) top left repeat;}</style>
    <style>
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            top: 0px !important;
        }

    </style>
    <!-loader ->
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/main.css">
    <script src="<?php echo base_url();?>application/views/js/vendor/modernizr-2.6.2.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>application/views/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>application/views/js/main.js"></script>
    <!-- end loader-->
</head>
<body>
<div class="cover"></div>
<div id="theme-wrapper">
    <?php
    include"includes/admin_header.php";
    ?>
    <div id="page-wrapper" class="container">
        <div class="row">
            <?php
            include"includes/admin_sidebar.php";
            ?>
            <div id="content-wrapper">
                <div class="row" style="opacity: 1;">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="content-header" class="clearfix">
                                    <div class="pull-left">
                                        <h1>Edit user rating</h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#">Home</a></li>
                                            <li class="active"><span>Edit user rating</span></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h2>Edit user rating</h2>
                                        </div>
                                    </div>

                                    <div class="main-box-body clearfix">
                                        <form  enctype="multipart/form-data" method="post" class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Driver Image</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <img class="img-circle" src="<?php echo base_url().'driverimages/'.$result[0]['image']; ?>" style="min-height:6%;width:6%">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Driver Name</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <input type="text" name="username" id="username" value="<?php echo $result[0]['name'];?>" class="form-control" readonly style="background-color: white;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Comment</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <textarea name="comment" class="form-control"><?php echo $result[0]['driver_comment']?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Rating</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <?php
                                                    $user_avrege=round($result[0]['user_rate']);
                                                    ?>

                                                    <?php
                                                    for($i=1;$i<=$user_avrege;$i++)
                                                    {
                                                        ?>
                                                        <b style="color: red;">&#9733;</b>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Edit Rating</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
							<?php
                                                    $user_rating=round($result[0]['user_rate']);
                                                    ?>
                                                    <select name="rating" id="rating" class="form-control">
                                                        <option value="1" <?php echo $user_rating == 1 ? 'selected="selected"' : ''?>>1</option>
                                                        <option value="2" <?php echo $user_rating == 2 ? 'selected="selected"' : ''?>>2</option>
                                                        <option value="3" <?php echo $user_rating == 3 ? 'selected="selected"' : ''?>>3</option>
                                                        <option value="4" <?php echo $user_rating == 4 ? 'selected="selected"' : ''?>>4</option>
                                                        <option value="5" <?php echo $user_rating == 5 ? 'selected="selected"' : ''?>>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Date</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <input type="text" name="date" id="date" value="<?php echo $result[0]['create_date']?>" class="form-control" readonly style="background-color: white;">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-10 col-lg-2">
                                                    <input class="btn btn-success" name="save" type="submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="row" id="footer-bar" style="opacity: 1;">
                    <p id="footer-copyright" class="col-xs-12">
                        <?php echo $footer; ?>
                    </p>
                </footer>
            </div>
        </div>
    </div>
</div>

<div id="config-tool" class="closed" style="display:none;">
    <a id="config-tool-cog">
        <i class="fa fa-cog"></i>
    </a>

    <div id="config-tool-options">
        <h4>Layout Options</h4>
        <ul>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-header" checked />
                    <label for="config-fixed-header">
                        Fixed Header
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-sidebar" checked />
                    <label for="config-fixed-sidebar">
                        Fixed Left Menu
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-footer" checked />
                    <label for="config-fixed-footer">
                        Fixed Footer
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-boxed-layout" />
                    <label for="config-boxed-layout">
                        Boxed Layout
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-rtl-layout" />
                    <label for="config-rtl-layout">
                        Right-to-Left
                    </label>
                </div>
            </li>
        </ul>
        <br/>
        <h4>Skin Color</h4>
        <ul id="skin-colors" class="clearfix">
            <li>
                <a class="skin-changer" data-skin="" data-toggle="tooltip" title="Default" style="background-color: #34495e;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-white" data-toggle="tooltip" title="White/Green" style="background-color: #2ecc71;">
                </a>
            </li>
            <li>
                <a class="skin-changer blue-gradient" data-skin="theme-blue-gradient" data-toggle="tooltip" title="Gradient">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-turquoise" data-toggle="tooltip" title="Green Sea" style="background-color: #1abc9c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-amethyst" data-toggle="tooltip" title="Amethyst" style="background-color: #9b59b6;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-blue" data-toggle="tooltip" title="Blue" style="background-color: #2980b9;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-red" data-toggle="tooltip" title="Red" style="background-color: #e74c3c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-whbl" data-toggle="tooltip" title="White/Blue" style="background-color: #3498db;">
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: "en" }, "google_translate_element");
    };

    $(function () {
        $(".loadMore").click(function () {
            $("<p/>", {
                text: "This is some injected text that will not be translated."
            }).appendTo($(".destination"));
        });
        $.getScript("//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit");
    });
</script>
<!-- global scripts -->
<script src="<?php echo base_url();?>application/views/js/demo-skin-changer.js"></script> <!-- only for demo -->

<script src="<?php echo base_url();?>application/views/js/jquery.js"></script>
<script src="<?php echo base_url();?>application/views/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>application/views/js/jquery.nanoscroller.min.js"></script>

<script src="<?php echo base_url();?>application/views/js/demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="<?php echo base_url();?>application/views/js/moment.min.js"></script>
<script src="<?php echo base_url();?>application/views/js/gdp-data.js"></script>

<!-- theme scripts -->
<script src="<?php echo base_url();?>application/views/js/scripts.js"></script>
<script src="<?php echo base_url();?>application/views/js/pace.min.js"></script>

<!-- this page specific inline scripts -->
<script type="text/javascript">
    $(window).load(function() {
        $(".cover").fadeOut(2000);
    });
    $(document).ready(function() {
        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }
    });
</script>
<script type="text/javascript">
    function validateForm() {
        var np = document.forms["change_password"]["new_password"].value;
        var cp = document.forms["change_password"]["confirm_password"].value;
        if (np == null || np == "") {
            alert("New Password must be filled out");
            return false;
        }
        else if(cp == null || cp=="")
        {
            alert("confirm password must be filled out");
            return false;
        }
    }
</script>
</body>
</html>
