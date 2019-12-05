
const http = require('http'); 
path = require('path'), 
express = require('express'), 
session = require('express-session'), 
bodyParser = require('body-parser'); 
MongoClient = require('mongodb').MongoClient, 
mongoose = require('mongoose'), 

   connection = mongoose.connect('mongodb://localhost/agenda', {useMongoClient: true}, function(error){
     if(error){ 
          console.log(error.name +" "+ error.message); 
     }else{
        console.log('Conexión Correcta'); 
     }
  });


const usuarios = require('./usuarios_controller.js'), 
      eventos = require('./eventos_controller.js') 

const PORT = 3000 
const app = express() 

const Server = http.createServer(app) 

app.use(express.static('../client')) 
app.use(bodyParser.json()) 
app.use(bodyParser.urlencoded({ extended: true}))
app.use(session({ 
secret: 'secret-pass', 
cookie: { maxAge: 3600000 }, 
resave: false,
saveUninitialized: true,
}));

app.use('/usuarios', usuarios) 
app.use('/eventos', eventos) 

Server.listen(PORT, function() { 
console.log('Server is listening on port: ' + PORT) 
})