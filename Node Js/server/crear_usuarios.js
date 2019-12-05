var Usuarios = require('./usuarios_model.js') 

module.exports.crearUsuario = function(callback){ 
  var arr = [{ email: 'hugo29@gmail.com', user: "hugo", password: "1234"}, { email: 'hugo@mail.com', user: "armando", password: "123456"}]; 
  Usuarios.insertMany(arr, function(error, docs) { 
    if (error){ 
    
    }else{
     
    }
  });
}
