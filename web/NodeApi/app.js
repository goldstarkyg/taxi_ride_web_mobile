var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
server.listen(4040);
var mongodb = require('mongodb');
var MongoClient = mongodb.MongoClient;
var assert = require('assert');
var urlString = 'mongodb://localhost:27017/taxibooking';
var  fs = require('fs');
var url = require('url');
 var unirest = require('unirest');
var drivers = [{}];
var users= [{}];
var coords = [];
var currentdate = new Date();
//var serverIp = '132.148.66.112';  // OC Ride Taxi Booking.
var serverIp = '192.168.4.104';  // OC Ride Taxi Booking.
var datetime = currentdate.getDate() + "/"
+ (currentdate.getMonth()+1)  + "/"
+ currentdate.getFullYear() + "  "
+ currentdate.getHours() + ":"
+ currentdate.getMinutes() + ":"
+ currentdate.getSeconds();

var FCM = require('fcm-push'); 
var serverKey = 'AIzaSyBY1JHM0cmQ7X5v9wuhm5GtSQfh1tfo0R4'; //OCRides
var fcm = new FCM(serverKey) ;
var device_token = '';

var urlStringUser = 'mongodb://localhost:27017/pushUser';
var urlStringDriver = 'mongodb://localhost:27017/pushDriver';
var pushassociationsUser;
var pushassociationsDriver;


MongoClient.connect(urlStringUser, function(err, database) {
  if(err) throw err;
  db = database;
  pushassociationsUser = db.collection("pushassociations")
  
});

MongoClient.connect(urlStringDriver, function(err, database) {
  if(err) throw err;
  db = database;
  pushassociationsDriver = db.collection("pushassociations")
  
});


app.get('/sendUser', function (req, res)
{    
    console.log('** Begin execution of sendUser function.**');  
    var driverId = req.param('driverId');
    var pushTitle = req.param('pushTitle');
    var pushBody = req.param('pushBody');
    console.log('Parameter Received in sendUser functions are ' + 'DriverID = ' +  driverId  +  ' Push Title = ' + pushTitle +  'Push Body = ' + pushBody);  
    pushassociationsUser.find({'user':driverId}).toArray(function(err,result) 
    {
        if(result != null && result !='' && result != 'undefined')
        {
            if(result.length > 0 && result[0] != null)
            {
                device_token = result[0].token;
                if(device_token!='')
                {
                    console.log('Device Token Received from sendUser function is ' + device_token);
                    var message = {
                        to: device_token, // required fill with device token or topics
                        collapse_key: 'your_collapse_key', 
                        data: {
                        your_custom_data_key: 'your_custom_data_value'
                        },
                        notification: {
                        title: pushTitle,
                        body: pushBody
                                    }
                                };

                    fcm.send(message).then(function(response){
                            console.log("Successfully send push message with response = ", response);
                            res.status(200).json({"data":response,"success":true});
                    }).catch(function(err)
                    {
                        console.log("Something has gone wrong in sendUser function while sending messages !");
                        console.log( err);
                        res.status(500).json({"errDetail":err,"success":false});
                    }); 
                }
                else
                {
                    console.log('There is a problem getting device token. API is called without device token. ');
                    res.status(500).json({"errDetail":'Query Error',"success":false});            
                }
            }
        }

    });
    console.log('**Ending execution of sendUser function.**'); 
});  

app.get('/sendDriver', function (req, res)
{    
       console.log('** Begin execution of sendDriver function.**'); 
       var driverId = req.param('driverId');
        var pushTitle = req.param('pushTitle');
        var pushBody = req.param('pushBody');
        console.log('Url :- ' + driverId  + ' ' + pushTitle +  ' ' + pushBody);   
        pushassociationsDriver.find({'user':driverId}).toArray(function(err,result) 
        {
             
                if(result.length > 0 && result[0] != null )
                    {
                        device_token = result[0].token;
                        
                        //device_token = '';
                        if(device_token!='')
                        {

                            console.log('device_token' + device_token);
                            var message = {
                            to: device_token, // required fill with device token or topics
                            collapse_key: 'your_collapse_key', 
                            data: {
                                your_custom_data_key: 'your_custom_data_value'
                            },
                            notification: {
                                title: pushTitle,
                                body: pushBody
                            }
                            };

                                //promise style
                            fcm.send(message)
                            .then(function(response){
                                console.log("Successfully sent with response: ", response);
                                res.status(200).json({"data":response,"success":true});
                            })
                            .catch(function(err){
                                console.log("Something has gone wrong!");
                                res.status(500).json({"errDetail":err,"success":false});
                            }); 
                        }
                        else
                        {
                            console.log('Query Error');
                            res.status(500).json({"errDetail":'Query Error',"success":false});            
                        }
                    
                    }
                else
                {
                    res.status(500).json({"errDetail":'Query Error',"success":false});     
                }

        });
    console.log('**Ending execution of sendDriver function.**'); 
}); 


MongoClient.connect(urlString, function (err, db) {
    if (err) 
    {
        console.log('Unable to connect to the mongoDB server. Error:', err);
    }
    else
    {
        var _Search = db.collection('search');
        console.log('Connection established to', urlString);
        app.get('/searchDriverForLocation', function (req, res)
        {
            var jsonData =  url.parse(req.url).query;
            var jsonObject = JSON.parse(decodeURIComponent(jsonData));
            console.log("jsonObject == "+JSON.stringify(jsonObject));
            var coords = jsonObject.coords;
            var limit = 100;
            // Here 50 = Miles as this is used by google map..   
            var maxDistance = 50/69; 
            var cursor = db.collection('search').find(
                 
                  {"loc":
                        { $near :coords ,$maxDistance: maxDistance}
                  }
                );
             cursor.limit(limit);
             cursor.toArray(function(err, searchResult)
                {
                    if (err)
                    {
                      console.log(" Error --> "+JSON.stringify(err)); 
                      res.status(500).json({"data":null});                     
                    }
                 else
                 {
                      res.status(200).json({"data":searchResult});
                 }
             })
        });

        app.get('/searchDriverForLocationM', function (req, res)
        {
            var jsonData =  url.parse(req.url).query;
            var jsonObject = JSON.parse(decodeURIComponent(jsonData));
            console.log("jsonObject == "+JSON.stringify(jsonObject));
            var coords = jsonObject.coords;
            var limit = 100;
            // Here 50 = Miles as this is used by google map..
            var maxDistance = 50/69;
            var cursor = db.collection('search').find(

                {"loc":
                { $near :coords ,$maxDistance: maxDistance}
                }

            );
            cursor.limit(limit);
            cursor.toArray(function(err, searchResult)
            {
                if (err)
                {
                    console.log(" Error --> "+JSON.stringify(err));
                    res.status(500).json({"data":null});
                }
                else
                {
                    res.status(200).json({"data":searchResult});
                }
            })
        });

        app.get('/setFeatureFlag', function (req, res)
        {
             console.log('** Begin execution of setFeatureFlag function.**'); 
             var jsonData =  url.parse(req.url).query.toString().trim();
             var jsonObject = JSON.parse(decodeURIComponent(jsonData));
             console.log("driver id == "+JSON.stringify(jsonObject.driver_id)); 
             console.log("feature_flag id == "+JSON.stringify(jsonObject.feature_flag));
             var feature_flag=parseInt(jsonObject.feature_flag);
             _Search.update({"driver_id":jsonObject.driver_id},{$set:{"feature_flag":feature_flag}},function(err,data)
             {
                if(err)
                   res.status(500).json({"Error":err});       
                else
                   res.status(200).json({"data":data});
             });
             console.log('** Ending execution of setFeatureFlag function.**'); 
        });
        
        app.get('/searchDriver', function (req, res)
        {
          console.log('** Begin execution of searchDriver function.**');     
          //console.log("jsonObject == "+JSON.stringify(req));
          var jsonData =  url.parse(req.url).query.toString().trim();
          var jsonObject = JSON.parse(decodeURIComponent(jsonData));
          console.log("jsonObject == "+JSON.stringify(jsonObject));          
          var driverId = jsonObject.driverId;         
          var coords = jsonObject.coords;
          var pickup = jsonObject.pickup; 
          var booking_id = jsonObject.booking_id;
          var start_time = jsonObject.start_time;
          var end_time = jsonObject.end_time;            
          var car_type = jsonObject.car_type; 
          var feature_flag=parseInt(jsonObject.feature_flag);
            
	     car_type =  parseInt(car_type);
         // Here 20 = Miles    
          var maxDistance = 20/69;   
          console.log("distance -- in from Search Driver > "+maxDistance);
          var limit = 1;           
            if(driverId != 0 || driverId != '0' )
            {
                //console.log("Id is NOt Null");
                //select feature driver  
                var cursor =db.collection('search').find({$and:[
                      {
                          "loc":
                            { $near :coords ,$maxDistance: maxDistance}
                      },
                      {"driver_id":{$nin : driverId}},
                      {"driver_status":1},
                      {"car_type":car_type},
                      {"feature_flag":1},
                      {"booking_status_flag":0},
                      {"booking_status_flag":{$ne:1}}]});

                  cursor.limit(limit);    
                  cursor.toArray(function(err, search_res) 
                  {
                      if (search_res != null && search_res !='' && search_res != 'undefined')
                      {   
                            console.log(" feature search_res --> "+JSON.stringify(search_res));
                            console.log("++++++++++++++feature search_res.length ++++++ "+ search_res.length);
                            if(search_res.length > 0)
                            {
                                  var aryObj = search_res[0]; 
                                  var json = JSON.stringify(aryObj);
                                  var jsonData = JSON.parse(json);
                                  console.log("< ---------- feature search_res.driver_id --> "+jsonData.driver_id); 

                                    if(jsonData.driver_id in drivers)
                                    {
                                         _Search.update({"driver_id":jsonData.driver_id},{$set:{"booking_status_flag":1}},function(err,data){
                                           if(err)
                                                console.log(err);
                                            else
                                                console.log(JSON.stringify(data));
                                        });
                                        console.log("<---------------Searched Driver Detail emit --------------->");  
                                        drivers[jsonData.driver_id].emit('Searched Driver Detail',{"data":search_res,"pickup":pickup,"booking_id":booking_id,"start_time":start_time,"end_time":end_time});
                                    }
                            }
                            console.log(" feature search_res --> "+JSON.stringify(search_res));
                            res.status(200).json({"data":search_res});
                      } 
                      else
                      {
                          //select non feature driver
                          var cursor =db.collection('search').find({$and:[
                              {
                                  "loc":
                                    { $near :coords ,$maxDistance: maxDistance}
                              },
                              {"driver_id":{$nin : driverId}},
                              {"driver_status":1},
                              {"car_type":car_type},
                              {"feature_flag":0},
                              {"booking_status_flag":0},
                              {"booking_status_flag":{$ne:1}}]});

                              cursor.limit(limit);    
                              cursor.toArray(function(err, search_res) 
                              {
                                  if (search_res != null && search_res !='' && search_res != 'undefined')
                                  {
                                      console.log(" non feature search_res --> "+JSON.stringify(search_res));
                                      console.log("++++++++++++++ non feature search_res.length ++++++ "+ search_res.length);
                                      if(search_res.length > 0)
                                      {
                                          var aryObj = search_res[0]; 
                                          var json = JSON.stringify(aryObj);
                                          var jsonData = JSON.parse(json);
                                          console.log("< ---------- non feature search_res.driver_id --> "+jsonData.driver_id); 

                                          if(jsonData.driver_id in drivers)
                                          {
                                             _Search.update({"driver_id":jsonData.driver_id},{$set:{"booking_status_flag":1}},function(err,data){
                                               if(err)
                                                    console.log(err);
                                                else
                                                    console.log(JSON.stringify(data));
                                            });
                                            console.log("<---------------non feature Searched Driver Detail emit --------------->");  
                                            drivers[jsonData.driver_id].emit('Searched Driver Detail',{"data":search_res,"pickup":pickup,"booking_id":booking_id,"start_time":start_time,"end_time":end_time});

                                          }
                                      }
                                       console.log(" feature search_res --> "+JSON.stringify(search_res));
                                       res.status(200).json({"data":search_res});
                                  }
                                  else
                                  {
                                      console.log(" Error in Search result --> "+JSON.stringify(err)); 
                                      res.status(500).json({"Error":err});
                                  }
                              });          
                      }
                  });
            }
            else
            {
               console.log("Id is Null and cartype = " +car_type);
               //feature Driver
               var cursor =db.collection('search').find({$and:[
                  {
                      "loc":
                        { $near :coords ,$maxDistance: maxDistance}
                  },
                  {"driver_status":1},
                  {"car_type":car_type},
                  {"feature_flag":1},
                  {"booking_status_flag":0},
                  {"booking_status_flag":{$ne:1}}]});
                
                cursor.limit(limit);
                cursor.toArray(function(err, search_res) 
                {
                        if (search_res != null && search_res !='' && search_res !='undefined')                      
                        {   
                              console.log(" feature search_res --> "+JSON.stringify(search_res));
                              console.log("++++++++++++++ feature search_res.length ++++++ "+ search_res.length);
                              if(search_res.length > 0)
                              {     
                                  var aryObj = search_res[0]; 
                                  var json = JSON.stringify(aryObj);
                                  var jsonData = JSON.parse(json);
                                  console.log("<--------------feature search_res.driver_id --> "+jsonData.driver_id);

                                  if(jsonData.driver_id in drivers)
                                  {
                                      _Search.update({"driver_id":jsonData.driver_id},{$set:{"booking_status_flag":1}},function(err,data){
                                            if(err)
                                                console.log(err);
                                            else
                                            {
                                                console.log(JSON.stringify(data));
                                            }
                                        });
                                        console.log("<---------------feature Searched Driver Detail emit --------------->");    
                                        drivers[jsonData.driver_id].emit('Searched Driver Detail',{"data":search_res,"pickup":pickup,"booking_id":booking_id,"start_time":start_time,"end_time":end_time});

                                  }
                                  else
                                  {
                                        console.log("Else condition for Driver id not in array..");    
                                  }
                                }
                                console.log(" search_res --> "+JSON.stringify(search_res));
                                res.status(200).json({"data":search_res});
                        } 
                        else 
                        {
                            //non feature Driver
                            var cursor =db.collection('search').find({$and:[
                                      {
                                          "loc":
                                            { $near :coords ,$maxDistance: maxDistance}
                                      },
                                      {"driver_status":1},
                                      {"car_type":car_type},
                                      {"feature_flag":0},
                                      {"booking_status_flag":0},
                                      {"booking_status_flag":{$ne:1}}]});

                                    cursor.limit(limit);
                                    cursor.toArray(function(err, search_res) 
                                    {
                                          if (search_res != null && search_res !='' && search_res !='undefined')                      
                                          {   
                                                  console.log(" non feature search_res --> "+JSON.stringify(search_res));
                                                  console.log("++++++++++++++ non feature search_res.length ++++++ "+ search_res.length);
                                                  if(search_res.length > 0)
                                                  {     
                                                      var aryObj = search_res[0]; 
                                                      var json = JSON.stringify(aryObj);
                                                      var jsonData = JSON.parse(json);
                                                      console.log("<--------------non feature search_res.driver_id --> "+jsonData.driver_id);

                                                      if(jsonData.driver_id in drivers)
                                                      {
                                                          _Search.update({"driver_id":jsonData.driver_id},{$set:{"booking_status_flag":1}},function(err,data){
                                                                if(err)
                                                                    console.log(err);
                                                                else
                                                                    console.log(JSON.stringify(data));
                                                            });
                                                            console.log("<---------------non feature Searched Driver Detail emit --------------->");    
                                                            drivers[jsonData.driver_id].emit('Searched Driver Detail',{"data":search_res,"pickup":pickup,"booking_id":booking_id,"start_time":start_time,"end_time":end_time});

                                                      }
                                                      else
                                                      {
                                                            console.log("Else condition for Driver id not in array..");    
                                                      }
                                                 }
                                                 console.log(" search_res --> "+JSON.stringify(search_res));
                                                 res.status(200).json({"data":search_res});
                                         } 
                                         else 
                                         {
                                               console.log(" Error --> "+JSON.stringify(err)); 
                                               res.status(500).json({"Error":err});
                                         }
                                    });
                        }
                });   
            }
            console.log('** Ending execution of searchDriver function.**'); 
        }); // Search Driver End
        
        app.get('/deleteDriver', function (req, res)
        {    
            var jsonData =  url.parse(req.url).query.toString().trim();
          var jsonObject = JSON.parse(decodeURIComponent(jsonData));
          console.log("jsonObject == "+JSON.stringify(jsonObject));          
          var driverIds = jsonObject.driverId;   
            
             console.log("Driver id = " + driverIds);
            _Search.remove({"driver_id" :  { $in: driverIds } },function(err, results) {
                if (err)
                {
                    console.log('There is an error deleting Driver .' + err );
                    res.status(500).json({"errDetail":err,"success":false});

                }
                else
                {
                    console.log('Driver deleted successfully.');
                     res.status(200).json({"data":results,"success":true});
                }
                                    }
            );


        });

        
        
        /*
            Parameter Required are 
            1. driverId
            2. carTypeID
            3. feature_flag
        */
            app.get('/updateDriverCarType', function (req, res)
            {
                    console.log('** Begin execution of updateDriverCarType function.**'); 
                    var jsonData =  url.parse(req.url).query;
                    var jsonObject = JSON.parse(decodeURIComponent(jsonData));
                    console.log("URl Object in updateDriverCarType == "+JSON.stringify(jsonObject)); 
                    var _driverId = parseInt(jsonObject.driverId);  
                    var _carTypeID = parseInt(jsonObject.carTypeID);
                    var _feature_flag = parseInt(jsonObject.feature_flag);
                    var cursor = db.collection('search').find({"driver_id":_driverId});
                    cursor.toArray(function(err, doc) 
                    {
                        if( err )
                        {
                            console.log("Error recieved on  updateDriverCarType --- > "+err);
                            var _myDataErr = {
                                                "data":err,
                                            "success": false
                                            }
                                            res.json(_myDataErr);
                            
                        }
                        else if (doc && doc.length >0)       
                        {
                             console.log("DOCS for updateDriverCarType --- > "+JSON.stringify(doc));  
                             var aryObj = doc[0]; 
                             var json = JSON.stringify(aryObj);
                             var jsonData = JSON.parse(json);
                             var conditions = { "driver_id" : _driverId}, update = {"driver_name" : jsonData.driver_name,"driver_id" :jsonData.driver_id,  "loc" : jsonData.loc,"driver_status":jsonData.driver_status,"isdevice":jsonData.isdevice,"car_type":parseInt(_carTypeID),"booking_status_flag":jsonData.booking_status_flag,"booking_status":jsonData.booking_status,"createdAt":datetime,"updatedAt":datetime,"feature_flag":parseInt(_feature_flag) };
                             console.log("UPDATE received  on updateDriverCarType --- > "+_driverId);
                             db.collection('search').update(conditions, update,
                             function callback (err,result)
                             {
                                 if (err)
                                     {
                                          var _myDataErr = {
                                                "data":err,
                                            "success": false
                                            }
                                             res.json(_myDataErr);
                                     }
                                 else
                                     {
                                          var _myData =  {
                                            "data":result,
                                            "success": true
                                        }
                                         res.json(_myData);  
                                     }
                               
                             });
                        }
                        else
                        {
                            console.log("Currently there is no driver found matching to this Driver ID" );
                           var _myData = {
                                            "data":"Currently there is no driver found for this driver-id.",
                                            "success": false
                                        }
                                         return  res.json(_myData);
                        }
                    })
                console.log('** Ending execution of updateDriverCarType function.**');    
            });
        
        app.get('/updateDriverStaus', function (req, res)
        {
            console.log('** Begin execution of updateDriverStaus function.**');
             var jsonData =  url.parse(req.url).query;
             var jsonObject = JSON.parse(decodeURIComponent(jsonData));
             console.log("  URl Object == "+JSON.stringify(jsonObject)); 
             var driverId = parseInt(jsonObject.driverId);  
             var _booking_status_flag = parseInt(jsonObject.booking_status_flag);
            
             if(parseInt(jsonObject.booking_status_flag) ==  0)
             {
                // fire socket   
                  console.log("settting flag to 1");
                _booking_status_flag = 1;
               
                 
             }
            else if(parseInt(jsonObject.booking_status_flag) ==  1)
             {
                //_booking_status_flag set to 2  
                 _booking_status_flag = 2 ;
                 console.log("settting flag to 2");
                 
             }
            else  
             {
                //_booking_status_flag set to 0  
                 _booking_status_flag = 0;
                 console.log("settting flag to 0");
                 
             }
             
             var cursor = db.collection('search').find({"driver_id":driverId});
             cursor.toArray(function(err, doc) 
                {
                    if( err )
                    {
                        console.log("Error recieved on  updateDriverStaus --- > "+err);

                    }
                    else if (doc && doc.length >0)       
                    {
                         console.log("DOCS --- > "+JSON.stringify(doc));  
                         var aryObj = doc[0]; 
                         var json = JSON.stringify(aryObj);
                         var jsonData = JSON.parse(json);
                         var conditions = { "driver_id" : driverId}, update = {"driver_name" : jsonData.driver_name,"driver_id" :jsonData.driver_id,  "loc" : jsonData.loc,"driver_status":jsonData.driver_status,"isdevice":jsonData.isdevice,"car_type":parseInt(jsonData.car_type),"booking_status_flag":_booking_status_flag,"booking_status":jsonData.booking_status,"createdAt":datetime,"updatedAt":datetime,"feature_flag": parseInt(jsonData.feature_flag)};
                         console.log("UPDATE received --- > "+_booking_status_flag);
                         db.collection('search').update(conditions, update,
                         function callback (err,result)
                         {
                              var _myData = {
                                                      "data":"success",
                                                      "success": true
                              }
                               res.json(_myData);

                         });
                    }
                    else
                    {
                        console.log("Currently there is no driver found for this in updateDriverStaus" );
                        return res.status(500).json({"message":false});
                    }
             } )
          console.log('** Ending execution of updateDriverStaus function.**'); 
        });
        
        app.get('/changeDriverStatus',function(req,res)
        {
          console.log('** Begin execution of changeDriverStatus function.**'); 
          var jsonData =  url.parse(req.url).query;
          var jsonObject = JSON.parse(decodeURIComponent(jsonData));
          console.log("URl Object == "+JSON.stringify(jsonObject)); 
          var driverId = parseInt(jsonObject.driverId);  
          var driver_status = parseInt(jsonObject.driver_status);    
            var cursor = db.collection('search').find({"driver_id":driverId});
                cursor.toArray(function(err, doc) {
                console.log("DOCS --- > "+JSON.stringify(doc));    
                //assert.equal(err, null);    
                    var aryObj = doc[0]; 
                      var json = JSON.stringify(aryObj);
                      var jsonData = JSON.parse(json);
                var conditions = { "driver_id" : driverId}, update = {"driver_name" : jsonData.driver_name,"driver_id" :jsonData.driver_id,  "loc" : jsonData.loc,"driver_status":driver_status,"isdevice":jsonData.isdevice,"car_type":parseInt(jsonData.car_type),"createdAt":datetime,"updatedAt":datetime,"feature_flag" : parseInt(jsonData.feature_flag),"feature_flag": parseInt(jsonData.feature_flag) };
                     db.collection('search').update(conditions, update,
                     function callback (err,result)
                        {
                         if(err) {res.status(500).json({"message":false});}
                         else{        
                             if(driver_status)
                                {
                                    statusFlag = "Active";
                                }
                            else
                                {
                                    statusFlag= "Inactive";
                                } 
                             unirest.get('http://'+serverIp+'/web_service/update_driver_socket_status')
                            .headers({'Accept': 'application/json', 'Content-Type': 'application/json'})
                            .send({"driver_id":driverId,"driver_status":statusFlag})
                            .end(function (response)
                            {
                                console.log("response getiing !!!!"+response);
                                 console.log("Status Changed ");
                            });
                             res.status(200).json({"message":true});
                            console.log("Status Changed >>> !!!");
                         }
                        
                        });
                });
            console.log('** Ending execution of changeDriverStatus function.**');     
        });
        
        
        
        
        //http://192.168.1.118:3001/
        // Live url :-  http://107.170.36.24:4040/
        app.get('/changeLocation',function(req,res)
        {
            console.log('** Begin execution of changeLocation function.**'); 
            var data =  url.parse(req.url,true).query;           
            console.log('changeLocation Data--> '+JSON.stringify(data));
                if(parseInt(data.driver_id) in drivers)
                {
                     console.log("Driver exist in driver");
                     //callback(true);
                }
                else
                {
                  io.sockets.nickname = parseInt(data.driver_id);
                  drivers[io.sockets.nickname] = io.sockets;
                 // console.log("Socket Stored in Drivers");
                  console.log("Drivers  == "+ drivers);                 
                }
                
                //var data = JSON.stringify(JSON.parse(data));
                //console.log("Create Driver Data == "+ JSON.stringify(data));
                var statusFlag = '';                
                var driverId = parseInt(data.driver_id);
                var booking_status = data.booking_status;
                var cursor = db.collection('search').find({"driver_id":driverId});
                cursor.toArray(function(err, doc) {
                assert.equal(err, null);
                if(parseInt(data.isdevice))
                {
                    console.log("Android Data ----- ");
                    coords = data.coords;
                }
                else
                {
                    console.log("IOS Data ---- ")
                    var lat = parseFloat(data.lat);
                    var long = parseFloat(data.long);
                    coords[0] =lat;
                    coords[1]=long;
                }
                console.log('Loc'+coords);
                //console.log("docs --> " + JSON.stringify(doc));
                if(parseInt(doc[0].driver_status))
                    {
                        statusFlag = "Active";
                    }
                else
                    {
                        statusFlag= "Inactive";
                    }   
                //console.log("Reached === unirest -- statusFlag "+statusFlag + " with Driver ID ==="+driverId );
                unirest.get('http://'+serverIp+'/web_service/update_driver_socket_status')
                .headers({'Accept': 'application/json', 'Content-Type': 'application/json'})
                .send({"driver_id":driverId,"driver_status":statusFlag})
                .end(function (response)
                {
                   // console.log("response getiing !!!!"+response);
                    
                });
               // console.log("Status Send >>> !!!");
                    
               if(driverId!='' || data.driver_name!='' || driverId!=NaN)
                {    
                if (doc == null || doc == [] || doc =='')
                {
                    console.log("No Data Found");
                    //console.log({ "coords":[22.28123, 70.77625],"driver_name":"ABC XYZ", "driver_id":"578f688066bbaf54e4ea9daf" , "driver_status":0,"lastlogin":" " });
                    var newDriver = {"driver_name" : data.driver_name, "loc" : coords,"driver_id":driverId,"driver_status":parseInt(doc[0].driver_status),"isdevice":parseInt(data.isdevice),"car_type" :parseInt(data.car_type),"booking_status":booking_status,"booking_status_flag":0,"createdAt":datetime,"updatedAt":datetime,"feature_flag":parseInt(0) };
                      _Search.insert([newDriver],function(_error,result)
                      {
                                if(_error)
                                {
                                  var data = {
                                      "errDetails": _error,
                                      "errorcode": 505,
                                      "success": false
                                  }
                                  console.dir(JSON.stringify(data));
                                    if(driverId in users)
                                    {
                                       users[driverId].emit('Driver Detail',data);                     
                                    }
                                }
                                else{
                                  var data = {
                                        "msg": "New Driver Inserted successfully.",
                                        "data":result.ops,
                                        "errorcode": 200,
                                        "success": true
                                      };
                                  console.dir(JSON.stringify(data));
                                  if(driverId in users)
                                    {                                                                        
                                       users[driverId].emit('Driver Detail',data);
                                    }                        

                                }
                            });
                    //res.status(200).json({"data":doc});
                }
                else
                {                   
                    var conditions = { "driver_id" : driverId}, update = {$set:{"loc" : coords,"driver_status":parseInt(doc[0].driver_status)}};
                     _Search.update(conditions, update,
                     function callback (err,result)
                        {
                         if(err)
                             {
                              var data = {
                                           "msg": "Something Went to wrong.",
                                           "errorcode": 500,
                                           "errDetails":err,
                                           "success": false
                                       }
                               console.dir(JSON.stringify(data));
                               if(driverId in users)
                                    {
                                       users[driverId].emit('Driver Detail',data);                     
                                    }                                
                             }
                            else
                             {
                                 //var cursor = db.collection('search').find({"driver_id":driverId});
                                cursor.toArray(function(err, update_result)
                                {
                                  var data = {
                                          "msg": "Driver updated successfully.",
                                          "errorcode": 200,
                                          "data":update_result,
                                          "success": true
                                            }
                                    console.dir(JSON.stringify(data));
                                    //console.log(" driverId **==**  "+ driverId);
                                   if(driverId in users)
                                    {
                                       users[driverId].emit('Driver Detail',data);  
                                          
                                    }
                                    //socket.broadcast.emit('Driver Detail',data);
                                });

                             }
                        });

                }
                }
                });
                console.log('----------------------------------------------------------------------------------');   
             console.log('** ending execution of changeLocation function.**'); 
        });

        app.get('/iOSDisconnect',function(req,res)
        {
            console.log('** Begin execution of iOSDisconnect function.**'); 
            var data =  url.parse(req.url,true).query;
            console.log("iOSDisconnect"+JSON.stringify(data));
             if(data.driver_id=="undefined" || data.driver_id=='')                {
                     console.log("Someting Went to Wrong..on  Socket Disconnect......");
                }else{
                    unirest.get('http://'+serverIp+'/web_service/update_driver_socket_status')
                    .headers({'Accept': 'application/json', 'Content-Type': 'application/json'})
                    .send({"driver_id":data.driver_id,"driver_status":"Inactive"})
                    .end(function (response)
                    {
                        console.log("response getiing !!!!"+response);

                    });                    
                   var conditions = { "driver_id" :data.driver_id,"booking_status_flag":{$ne:2}}, update = {$set:{"driver_status":0,"booking_status_flag":0}};
                    _Search.update(conditions, update,
                     function(err,result)
                        {
                         if(err) 
                             console.log(err);
                         else
                             console.log('Status Updated...');
                        });
                    
                console.log("Status Send >>> !!!");
                console.log("-------------------##################---------------###########");
                console.log("-------------------iOS Disconnted---------------###########");
                    
                if(!data.driver_id) return;		        
                delete drivers[data.driver_id];
                }    
             console.log('** Ending execution of iOSDisconnect function.**'); 
        });
        
        io.sockets.on('connection', function(socket)
        {
            //console.log("Socket Connected......");
           
            socket.on('New Driver Register', function(data,callback)
            {
                console.log('** Begin execution of New Driver Register function.**'); 
                console.log("New Driver Data ==== * "+ data);
                console.log("Driver Id == " +JSON.stringify(data.driver_id));
                //console.log("Drivers  == "+ JSON.stringify(drivers));
                if(data.driver_id in drivers)
                {
                     socket.nickname = parseInt(data.driver_id);     
		             delete drivers[socket.nickname];
                     console.log("socket exist in drivers and hence deleted");
                    
                }
                 
                  socket.nickname = parseInt(data.driver_id);
                  drivers[socket.nickname] = socket;                
                 
                //var driverId =
                console.log('** Ending execution of New Driver Register function.**'); 
            });           
                       
            socket.on('New User Register', function(data,callback)
            {
                console.log('** Begin execution of New User Register function.**'); 
                var driver_id=parseInt(data.driver_id);
                if(driver_id != null && driver_id != "")
                {
                    console.log("New User Register Start--->"+JSON.stringify(data));
                    if(parseInt(data.driver_id) in users)
                    {
                         users[driver_id]=socket;     
                         delete users[driver_id];
                         console.log("socket exist in users and hence deleted");                    
                    }
                    users[driver_id]=socket;  
                    console.log("New User Register End--->");
                }
                console.log('** Ending execution of New User Register function.**'); 
            });
            
                        
            socket.on('Create Driver Data', function (data,callback)
            {
                 console.log('** Begin execution of Create Driver Data function.**'); 
                 console.log("Create New Driver Data ***---***"+JSON.stringify( data));
                 console.log("Driver Id == " +JSON.stringify(data.driver_id));
                 console.log("Lat  == " +JSON.stringify(data.lat));
                 console.log("Long  == " +JSON.stringify(data.long));
                 console.log("booking status  == " +JSON.stringify(data.booking_status));
                 console.log("car type   == " +JSON.stringify(data.car_type));
                 var isLocationChange=parseInt(data.isLocationChange);
                //testing again 
                
               if(data.driver_id in drivers)
                {
                     socket.nickname = parseInt(data.driver_id);     
		             delete drivers[socket.nickname];
                     console.log("socket exist in drivers and hence deleted");
                    
                }
                socket.nickname = parseInt(data.driver_id);
                drivers[socket.nickname] = socket;     
             
                var statusFlag = '';                
                var driverId = parseInt(data.driver_id);
                var booking_status = data.booking_status;
                var cursor = db.collection('search').find({"driver_id":driverId});
                cursor.toArray(function(err, doc) 
                {
                assert.equal(err, null);
                if(parseInt(data.isdevice))
                {
                    console.log("Android Data ----- ");
                    coords = data.coords;
                }
                else
                {
                    console.log("IOS Data ---- ")
                    var lat = parseFloat(data.lat);
                    var long = parseFloat(data.long);
                    coords[0]=lat ;
                    coords[1] =long;
                }
                
                if(parseInt(data.driver_status))
                    {
                        statusFlag = "Active";
                    }
                else
                    {
                        statusFlag= "Inactive";
                    }   
                
                if(isLocationChange == 0)
                {
                    console.log("inside-->isLocationChange--->"+isLocationChange);
                    //console.log("Reached === unirest -- statusFlag "+statusFlag + " with Driver ID ==="+driverId );
                    unirest.get('http://'+serverIp+'/web_service/update_driver_socket_status')
                    .headers({'Accept': 'application/json', 'Content-Type': 'application/json'})
                    .send({"driver_id":driverId,"driver_status":statusFlag})
                    .end(function (response)
                    {
                       // console.log("response getiing !!!!"+response);

                    });
                 }    
                if(driverId!='' || data.driver_name!='' || driverId!=NaN)
                {    
                    if (doc == null || doc == [] || doc =='')
                    {
                        console.log("No Data Found");

                        var newDriver = {"driver_name" : data.driver_name, "loc" : coords,"driver_id":driverId,"driver_status":parseInt(data.driver_status),"isdevice":parseInt(data.isdevice),"car_type" :parseInt(data.car_type),"booking_status":booking_status,"booking_status_flag":0,"createdAt":datetime,"updatedAt":datetime,"feature_flag":parseInt(0)};



                          _Search.insert([newDriver],function(_error,result)
                          {
                                    if(_error)
                                    {
                                      var data = {
                                          "errDetails": _error,
                                          "errorcode": 505,
                                          "success": false
                                      }
                                      console.dir(JSON.stringify(data));
                                        if(driverId in users)
                                        {
                                           users[driverId].emit('Driver Detail',data);                     
                                        }
                                    }
                                    else{
                                      var data = {
                                            "msg": "New Driver Inserted successfully.",
                                            "data":result.ops,
                                            "errorcode": 200,
                                            "success": true
                                          };
                                      console.dir(JSON.stringify(data));   
                                      if(driverId in users)
                                      {                                                                        
                                         users[driverId].emit('Driver Detail',data);       
                                      }                        

                                    }
                                });

                    }
                else
                {                
                    
                      console.dir("Current Booking Status" +booking_status );                  
                        
                    var conditions = { "driver_id" : driverId}, update = {$set:{"loc" : coords,"driver_status":parseInt(data.driver_status),"booking_status":booking_status}};
                     _Search.update(conditions, update,
                     function callback (err,result)
                        {
                         if(err)
                             {
                              var data = {
                                           "msg": "Something Went to wrong.",
                                           "errorcode": 500,
                                           "errDetails":err,
                                           "success": false
                                       }
                               console.dir(JSON.stringify(data));
                               if(driverId in users)
                                    {
                                       users[driverId].emit('Driver Detail',data);                     
                                    }                                
                             }
                            else
                             {
                                 //var cursor = db.collection('search').find({"driver_id":driverId});
                                cursor.toArray(function(err, update_result)
                                {
                                  var data = {
                                          "msg": "Driver updated successfully.",
                                          "errorcode": 200,
                                          "data":update_result,
                                          "success": true
                                            }
                                    console.dir(JSON.stringify(data));
                                    //console.log(" driverId **==**  "+ driverId);
                                   
                                    console.log("User Array Data--->"+users[driverId]);
            
                                   if(driverId in users)
                                    {
                                        console.log("Driver details are fired");
                                        users[driverId].emit('Driver Detail',data);   
                                    }
                                    else
                                        {
                                            console.log("Driver details NOT fired");
                                        }
                                      //console.log("stringify array " + JSON.stringify(users)  );
                                    //socket.broadcast.emit('Driver Detail',data);
                                });

                             }
                        });

                }
                }
                });
                console.log('**Ending execution of Create Driver Data function.**'); 
            });                 
                        
                             
            
            socket.on('Driver Action',function(data,callback)
            {
             console.log('** Begin execution of Driver Action function.**'); 
             console.log('---------- Driver Action ------------ data :- '+JSON.stringify(data));                
             var driver_id = parseInt(data.driver_id);
             var flag = parseInt(data.flag);    
             _Search.update({"driver_id":driver_id},{$set:{"booking_status_flag":flag}},function(err,data1){
                 if(err)
                     console.log(err);
                 else
                     console.log(JSON.stringify(data1));
             });
                 console.log('** Ending execution of Driver Action function.**'); 
            });
            
            socket.on('disconnect', function(data)
            {          
                console.log('** Begin execution of disconnect function.**'); 
                console.log("@@@@@@@@@@@@@@@@##################@@@@@@@@@@@@###########"+JSON.stringify(data));
                console.log(" DIS Socket Nick ==> "+socket.nickname);                 
                if(socket.nickname=="undefined" || socket.nickname=='' || socket.nickname == null)
                {
                    console.log("Someting Went to Wrong..on  Socket Disconnect......");
                }
                else
                {
                    console.log("Got socket ID and getting disconnected");
                    if(!socket.nickname) return;
                    
		              //delete users[socket.nickname];
                      //delete drivers[socket.nickname];
                    
                    
                }
                 console.log('** Ending execution of disconnect function.**'); 
            });
            
            //find nearet driver from lat,lng start//
           socket.on('Nearest Driver', function(data,callback)
            {
                console.log('** Begin execution of Nearest Driver function.**'); 
                console.log('** Begi execution of Nearest Driver function.**');  
                console.log("JSON object received from Nearest Driver is "+JSON.stringify(data));
                console.log("coords:"+data.coords);
                var coords=data.coords;
                if(coords != null && coords!="")
                {
                    if(coords.length > 1)
                    {
                        // Here 20 = Miles    
                        var maxDistance = 20/69;   
                        var limit = 10;    
                        var cursor =db.collection('search').find({$and:[
                        {
                            "loc":
                            { $near :coords ,$maxDistance: maxDistance}
                        },
                        {"driver_status":1},
                        {"booking_status_flag":0},
                        {"booking_status_flag":{$ne:1}}]});

                        cursor.limit(limit);
                        cursor.sort({loc:1});
                        cursor.toArray(function(err, search_res)             
                        {
                            console.log("search_res length------->"+search_res.length);
                            if (search_res != null & search_res !='' && search_res != 'undefined')
                            {  
                                console.log("++++++++++++++ Length of Search Result in  Nearest Driver ++++++ "+ search_res.length);
                                console.log(" Search result in Nearest Driver  --> "+JSON.stringify(search_res));
                                socket.emit('Nearest Driver Data',search_res);
                            }
                            else
                            {
                                console.log(" Error in Search result --> "+JSON.stringify(err)); 
                            }
                        });
                    }
                    else
                    {
                        console.log("<-- coords must in Array --> ");   
                    }
                }
                else
                {
                    console.log("<-- coords blank --> ");   
                } 
               console.log('** Ending execution of Nearest Driver function.**'); 
            });
            //find nearet driver from lat,lng end//
            
            socket.on('forceDisconnect', function(data)
            {        
               console.log('** Begin execution of forceDisconnect function.**'); 
               console.log("****** forceDisconnect********"+JSON.stringify(data));
                 console.log(" DIS Socket Nick ==> "+socket.nickname);                 
                if(socket.nickname=="undefined" || socket.nickname=='' || socket.nickname == null)
                    
                {
                     console.log("Someting Went to Wrong..on  Socket Disconnect......");
                }
                else
                {
                    unirest.get('http://'+serverIp+'/web_service/update_driver_socket_status')
                    .headers({'Accept': 'application/json', 'Content-Type': 'application/json'})
                    .send({"driver_id":socket.nickname,"driver_status":"Inactive"})
                    .end(function (response)
                    {
                        console.log("response getiing !!!!"+response);
                    }); 
                    var conditions = { "driver_id" : socket.nickname,"booking_status_flag":{$ne:2}}, update = {$set:{"driver_status":0,"booking_status_flag":0}};
                    _Search.update(conditions, update,
                     function(err,result)
                    {
                     if(err) 
                         console.log(err);
                     else
                         console.log('Status Updated...');
                    });
                console.log("Status Send >>> !!!");
                console.log("-------------------##################---------------###########");
                if(!socket.nickname) return;
		        delete users[socket.nickname];
                delete drivers[socket.nickname];
                }
                console.log('** Ending execution of forceDisconnect function.**');
            });
            function updateNicknamesDrivers()
            {
                
  		        io.sockets.emit('usernames', Object.keys(drivers));
            }
            function updateNicknamesUsers()
            {
                
  		        io.sockets.emit('usernames', Object.keys(users));
            }
           
        });
    }

});


app.use(function (req, res, next) {
  res.setHeader('Access-Control-Allow-Origin', "http://"+req.headers.host+':4040');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
  res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
  next();
  }
);

app.get('/', function(req, res){
	res.sendFile(__dirname + '/index.html');
});

app.get('/Receive', function(req, res){
	res.sendFile(__dirname + '/indexReceive.html');
});
