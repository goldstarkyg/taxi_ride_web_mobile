    jQuery(document).ready(function($)
    {   
        //datepicker binding start     
        $('#booking_datetime').datetimepicker(
        {
            format:'d-m-Y - H:i:00',
            formatDate:'Y/m/d',
            formatTime:'H:i:00',
            defaultTime:'',
            step:5,
            minDate:0,
        });
        $('#booking_datetime').focus(function()
        {
            $('#booking_datetime').blur();
        });
        //datepicker binding over 
        
        //country code with flag start
        $("#txt_countrycode").intlTelInput(
        {
            utilsScript: "build/js/utils.js"
        });
        $("#txt_countrycode").css("color","black");
        $("#txt_countrycode").css("width","94px");
        $("#txt_countrycode").focus(function()
        {
            $("#txt_countrycode").blur();
        });
        // to modify propety
        $(".intl-tel-input,.country-list,.dropup").css({"width":"auto","color":"black"});
        //country code with flag over

        $("#passenger_sub1").click(function()
        {
            var no=parseInt($("#passenger_no1").val())-1;
            if(no > -1)
            {
                $("#passenger_no1").val(no);
            }
                $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
        $("#passenger_add1").click(function()
        {
            var no=parseInt($("#passenger_no1").val())+1;
            $("#passenger_no1").val(no);
            $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
        $("#passenger_sub2").click(function()
        {
            var no=parseInt($("#passenger_no2").val())-1;
            if(no > -1)
            {
                $("#passenger_no2").val(no);
            }
            $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
        $("#passenger_add2").click(function()
        {
            var no=parseInt($("#passenger_no2").val())+1;
            $("#passenger_no2").val(no);
            $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
        $("#passenger_sub3").click(function()
        {
            var no=parseInt($("#passenger_no3").val())-1;
            if(no > -1)
            {
                $("#passenger_no3").val(no);
            }
            $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
        $("#passenger_add3").click(function()
        {
            var no=parseInt($("#passenger_no3").val())+1;
            $("#passenger_no3").val(no);
            $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
         $("#passenger_sub4").click(function()
        {
            var no=parseInt($("#passenger_no4").val())-1;
            if(no > -1)
            {
                $("#passenger_no4").val(no);
            }
                $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });
        $("#passenger_add4").click(function()
        {
            var no=parseInt($("#passenger_no4").val())+1;
            $("#passenger_no4").val(no);
            $("#booking_pessenger").val(parseInt($("#passenger_no1").val())+parseInt($("#passenger_no2").val())+parseInt($("#passenger_no3").val())+parseInt($("#passenger_no4").val()));
        });      

        var cartype_select=null; 
        var cartype_value=0;
        $(".list_div").click(function()
        {
            var tmp=$(this).parent();
            tmp=$(tmp).parent();
            $(tmp).css("background-color","#ffdd0e");
            $("#booking_cartype").val($(this).attr("value"));
            cartype_value=$(this).attr("data");
            if(cartype_select!=null)
            {
                if(!cartype_select.is($(this)))
                {
                    tmp=$(cartype_select).parent();
                    tmp=$(tmp).parent();
                    $(tmp).css("background-color","white");
                    cartype_select=$(this);
                }
            }
            else
            {
                cartype_select=$(this);
            }
        });

        var cartype=0;
        $(".list_img").click(function()
        {
            cartype=$(this).attr("data");
            if(cartype!=0)
            {
             $.ajax(
                {
                    type:"POST",
                    data:{cab_id:cartype},
                    url:BASEPATH+"/php/get_cardetail.php",
                    success:function(response)
                    {
                        $(".car_detail").html(response);
                    }   
                });
            }
        });
        

        $("#txt_phoneno").keypress(function(event)
        {
            var key=event.charCode; 
            if(key==0 || 48 <= key && key <= 57)
            {
                return true;
            }
            else
            {
                return false;
            }
        });
        $("#txt_otp").keypress(function(event) 
        {
            var key=event.charCode;
            if(key==0 || 48 <= key && key <= 57)
            {
                return true;
            }
            else
            {
                return false;
            }
        });

        var flag=0;
        $("#txt_name").keyup(function()
        {
            var regex = /^([a-zA-Z ])+$/;
  	         if(!regex.test($("#txt_name").val()))  
             {
                 $("#txt_name").css("border","red solid 2px");
                 flag=1;
             }
            else
             {
                 $("#txt_name").css("border","2px solid #ebebeb");
                 flag=0;       
             }
        });
        $("#txt_email").keyup(function()
        {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  	         if(!regex.test($("#txt_email").val()))  
             {
                 $("#txt_email").css("border","red solid 2px");
                 flag=1;
             }
            else
             {
                 $("#txt_email").css("border","2px solid #ebebeb");
                 flag=0;       
             }
        });

    $(".btn_hide").click(function()
    {
    });
    
    $(".booking_submit").click(function()
    {
        if($("#search_from").val()!="" && $("#search_to").val()!=""  && $("#booking_datetime").val()!="" && $("#booking_pessenger").val()!="0" && $("#booking_cartype").val()!="")
        {
        	var search_from=$("#search_from").val();
		    var search_to=$("#search_to").val();
		    var booking_datetime=$("#booking_datetime").val();
		    var booking_pessenger=$("#booking_pessenger").val();
		    var booking_cartype=$("#booking_cartype").val();

            $.ajax(
            {
                type:"POST",
                data:{search_from:search_from,search_to:search_to,booking_datetime:booking_datetime,booking_pessenger:booking_pessenger,booking_cartype:booking_cartype,cartype_value:cartype_value},
                url:BASEPATH+"/php/book_process.php",
                beforeSend: function(){
                    // Show image container
                    $(".booking_submit").hide();
                    $("#buttonreplacement").show();
                },
                success:function(response)
                {
                    if(response!="")
                    {
                        $(".book_detail").html(response);
                        $(".btn_hide").attr("href","#booking_detail");
                        $(".btn_hide").trigger("click");
                    }
                    else
                    {
                        swal({title: 'Error!',text: "Enter Correct Place" ,type: 'error',confirmButtonText: 'Ok'});
                    }
                    
                },
                complete:function(data){
                    // Hide image container
                    $(".booking_submit").show();
                    $("#buttonreplacement").hide();
                }
            });
        }
        else
        {
            swal({title: 'Error!',text: 'Please Enter All Fields',type: 'error',confirmButtonText: 'Ok'});
        }
    });
    $("#btn_send").click(function()     
    {       
            if($("#txt_phoneno").val()!="")
            {
                var mobileno=$("#txt_phoneno").val();
                var countrycode=$("#txt_countrycode").val(); 
                $.ajax(
                {
                    type:"POST",
                    data:{countrycode:countrycode,mobileno:mobileno},
                    url:BASEPATH+"/php/send_otp.php",
                    beforeSend: function(){
                        // Show image container
                        $("#btn_send").hide();
                        $("#buttonreplacement1").show();
                    },
                    success:function(response)
                    {
                        var resp=JSON.parse(response);
                        if(resp.success=="true")
                        {
                            $(".btn_hide").attr("data-dismiss","modal");
                            $(".btn_hide").trigger("click");
                            $(".btn_hide").attr("href","#verification");
                            $(".btn_hide").trigger("click");
                        }
                        else
                        {
                            swal({title: 'Error!',text: resp.message,type: 'error',confirmButtonText: 'Ok'});
                        }
                    },
                    complete:function(data){
                        // Hide image container
                        $("#btn_send").show();
                        $("#buttonreplacement1").hide();
                    }
                });
            }
            else
            {
                swal({title: 'Error!',text: 'Phone Number Not Empty',type: 'error',confirmButtonText: 'Ok'});
            }
    });      
     $("#btn_submit").click(function()     
        {
         if(flag==0)
         {
            if($("#txt_otp").val()!="" && $("#txt_name").val()!="" && $("#txt_email").val()!="")
            {
                var search_from=$("#search_from").val();
                var search_to=$("#search_to").val();
                var booking_datetime=$("#booking_datetime").val();
                var booking_pessenger=$("#booking_pessenger").val();
                var booking_cartype=$("#booking_cartype").val();
                
                var name=$("#txt_name").val()
                var email=$("#txt_email").val()
                    
                var passenger_no1=$("#passenger_no1").val();
                var passenger_no2=$("#passenger_no2").val();
                var passenger_no3=$("#passenger_no3").val();
                var passenger_no4=$("#passenger_no4").val();
                
                var mobileno=$("#txt_phoneno").val();
                var countrycode=$("#txt_countrycode").val();
                var otp=$("#txt_otp").val();
                $.ajax( 
                {
                        type:"POST",
                        data:{countrycode:countrycode,mobileno:mobileno,otp:otp},
                        url:BASEPATH+"/php/check_otp.php",
                        beforeSend: function(){
                            // Show image container
                            $("#btn_submit").hide();
                            $("#buttonreplacement2").show();
                        },
                        success:function(response)
                        {
                            var resp=JSON.parse(response);
                            if(resp.success=="true")
                            {
                                $.ajax(
                                {
                                    type:"POST",
                                    data:{countrycode:countrycode,mobileno:mobileno,passenger_no1:passenger_no1,passenger_no2:passenger_no2,passenger_no3:passenger_no3,passenger_no4:passenger_no4,name:name,email:email},
                                    url:BASEPATH+"/php/add_booking.php",
                                    success:function(response)
                                    {
                                        var resp=JSON.parse(response);
                                        if(resp.success=="true")
                                        {
                                            swal({title: 'Booking Success',text: resp.message,type: 'success',confirmButtonText: 'Ok'}); 
                                            timer = setTimeout(function(){location.reload();},900);   
                                        }
                                        else
                                        {
                                            swal({title: 'Booking Not Success',text: resp.message,type: 'error',confirmButtonText: 'Ok'});
                                        }
                                    },
                                    complete:function(data){
                                        // Hide image container
                                        $("#btn_submit").show();
                                        $("#buttonreplacement2").hide();
                                    }
                                });
                            }
                            else
                            {
                                swal({title: 'Error!',text: "OTP Wrong!" ,type: 'error',confirmButtonText: 'Ok'});
                            }
                        }
                });
            }
            else
            {
                swal({title: 'Error!',text: 'OTP Not Empty',type: 'error',confirmButtonText: 'Ok'});
            }
         }
        else
        {
             swal({title: 'Error!',text: 'Enter Correct Details',type: 'error',confirmButtonText: 'Ok'});   
        }
    });                
});