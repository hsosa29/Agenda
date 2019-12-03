var Usuario = require('./modelUsuarios.js') //Asignarle a la variable USUARIO el modelo del usuario

module.exports.crearUsuarioDemo = function(callback){ //Función para crear usuarios
  var arr = [{ email: 'hugo29@gmail.com', user: "hugo", password: "1234"}, { email: 'hugo@mail.com', user: "armando", password: "123456"}]; 
  Usuario.insertMany(arr, function(error, docs) { 
    if (error){ 
    
    }else{
     
    }
  });
}
