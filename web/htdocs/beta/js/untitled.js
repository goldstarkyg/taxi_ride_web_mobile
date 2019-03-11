 $.ajax(
                {
                        type:"POST",
                        data:{countrycode:countrycode,mobileno:mobileno},
                        url:"http://localhost/okswissweb/php/before_otp.php",
                        success:function(response)
                        {
                            var resp=JSON.parse(response);
                            if(resp.success)
                            {
                                user_id=resp.id;
                                username=resp.username;
                               
                            }
                            else
                            {
                                swal({title: 'Error!',text: resp.message,type: 'error',confirmButtonText: 'Ok'});
                            }
                        }   
                });



 $.ajax(
                                {
                                        type:"POST",
                                        data:{countrycode:countrycode,mobileno:mobileno,otp:otp,search_from:search_from,search_to:search_to,booking_datetime:booking_datetime,booking_pessenger:booking_pessenger,booking_cartype:booking_cartype,cartype_value:cartype_value,user_id:user_id,username:username},
                                        url:"http://localhost/okswissweb/php/after_otp.php",
                                        success:function(response)
                                        {
                                            var resp=JSON.parse(response);
                                            if(resp.success)
                                            {
                                                swal({title: 'Successfully booking!',text: resp.message ,type: 'success',confirmButtonText: 'Ok'});
                                                //location.reload();
                                            }
                                            else
                                            {
                                                swal({title: 'Not booking!',text: resp.message ,type: 'error',confirmButtonText: 'Ok'});
                                            }
                                        }   
                                });