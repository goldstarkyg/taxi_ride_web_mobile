var express = require('express')
var app = express()
var braintree = require("braintree");
var bodyParser     =         require("body-parser");

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

var gateway = braintree.connect({
    environment:  braintree.Environment.Sandbox,
    //merchantId:   '8zwz92ydtx9r4m6z',
    merchantId:   '2hsqbyqtzknvftwt',
    //publicKey:    'vjdxnj6nk6jtkmyg',
    publicKey:    't424vsfw34hf6bbs',
    //privateKey:   '13d89485d76fc91af35df913388fa90a'
    privateKey:   '94823447049e343cc86a2d8145aec5a4'
});



app.get("/client_token", function (req, res) {
    var aCustomerId = req.param('customerId');
    
 gateway.clientToken.generate({
  customerId: aCustomerId
}, function (err, response) {
     if (err)
     {
           return res.json({
            errDetails: err,
            success: false
            }); 
     }
    else
    {
      res.send(response.clientToken) ;
    }
  
  
});
    
    
});

app.post("/createPaymentMethod", function (req, res) {
    
        
        var _customerId = req.body.customerId;
        var _paymentMethodNonce = req.body.paymentMethodNonce;
        gateway.paymentMethod.create({
        customerId: _customerId,
        paymentMethodNonce: _paymentMethodNonce
        }, function (err, result) { 

        if ( !err)
        {
            res.send(result) ;
        }
        else
        {
        return res.json({
            errDetails: err,
            success: false
        });     
        }

        });

        

});

app.post("/findPaymentMethodforCustomer", function (req, res) {
    
        
        var _customerId = req.body.customerId;
        
    gateway.customer.find(_customerId, function(err, customer) {
        
         if ( !err)
        {
            res.send(customer) ;
        }
        else
        {
        return res.json({
            errDetails: err,
            success: false
        });     
        }
        
    });
        

});






app.get("/createCustomer", function (req, res) {
    
        var aFirstName = req.param('firstName');
        var aLastName = req.param('lastName');
        var acompany = req.param('company');
        var aemail = req.param('email');
        var aphone = req.param('phone');
        var afax = req.param('fax');
        var awebsite = req.param('website');

    
        gateway.customer.create({
            firstName: aFirstName,
            lastName: aLastName,
            company: acompany,
            email: aemail,
            phone: aphone,
            fax: afax,
            website: awebsite
        }, function (err, result) {
        
        if ( !err)
        {
            res.send(result) ;
        }
        else
        {
            return res.json({
            errDetails: err,
            success: false
            });     
        }
           
         
        });

});
app.get("/findCustomer", function (req, res) {
    
     var theCustomerId = req.param('customerId');
    gateway.customer.find(theCustomerId, function(err, customer) {
    if ( err) 
    {
        return res.json({
        errDetails: err,
        success: false
        }); 

    }
    else
    {
        return res.json({
        data: customer,
        success: true
        }); 
    }

    });
});
    

app.post("/checkout", function (req, res) {
  var nonceFromTheClient = req.body.payment_method_nonce;
  var _amount = req.body.amount;
  gateway.transaction.sale({
  amount: _amount,
  paymentMethodNonce: nonceFromTheClient,
  options: {
    submitForSettlement: true 
  }
}, function (err, result) {

if ( err) 
{
return res.json({
    errDetails: err,
    success: false
}); 
                                        
                                        }
                                        else
                                        {
                                            return res.json({
                                            data: result,
                                            success: true
                                        }); 
                                        }

}
);
});

app.get('/', function (req, res) {
  res.send('Hello World!')
})

app.listen(3002, function () {
  console.log('Example app listening on port 3000!')
})
