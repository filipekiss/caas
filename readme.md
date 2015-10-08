# DaaS - Documents as a Service

This is a simple application that returns a document so you can test your applications. Right now, we have Brazilian CPF, Brazilian CNPJ and Paypal Credit-Cards.


## Disclaimer

This is a simple service to be used when testing your application and you need a sample document, for example, when testing validators and stuff. The document numbers are generated at random, so there's no way for us to remove your document from the database, because there is not one. The credit cards are also international numbers used for testing, so don't even waste your time trying to use this in a real world application

## Usage

This is meant to be used in your command line to get a sample document. So if you need a CPF you can run this in your command line:

```
curl d.beij.in/cpf
```

and it will return a non-formatted, randomly generated CPF number.

###Endpoints

####CPF

 - /cpf
 
 Returns a non-formatted CPF. Example: `80092556612`
 
 - /cpf/s
 
 Returns a formatted CPF. Example: `624.602.020-83`
 

####CNPJ
 
  - /cnpj
 
 Returns a non-formatted CNPJ. Example: `09616629000135`
 
 - /cnpj/s
 
 Returns a formatted CNPJ. Example: `36.313.306/0001-45`

####Credit Card
 
 - /cc
 
 Returns a random credit-card number. Example: `4111111111111111`
 
 - /cc/json
 
 Returns a random credit-card number and flag in json format. Example: `{"flag":"visa","number":"4222222222222"}`
 
 You can also pass a credit-card flag as the second argument to any of the endpoints above so you will only get a number that is valid regarding that flag. For example
 
 ```
 curl d.beij.in/cc/json/mastercard
 ```
 will return `{"flag":"mastercard","number":"5105105105105100"}`
 
 To view all available flags, see `d.beij.in/cc/list`
 

##License
---

MIT © [Filipe Kiss][twitter]
 
[twitter]:http://twitter.com/filipekiss