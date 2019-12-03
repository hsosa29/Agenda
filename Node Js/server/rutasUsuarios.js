const Router = require('express').Router();
const Usuarios = require('./modelUsuarios.js')
const Eventos = require('./modelEventos.js')
const Operaciones = require('./crud.js')
//Verificar si existe el usuario DEMO
Router.get('/hugo', function(req, res) {
  Usuarios.find({user: req.query.user}).count({}, function(err, count) { //Verificar si exste el usuario DEMO
    if(count>0){ //Si el registro es mayor a 0
       
    }else{
      Eventos.find({}).count({}, function(err, count) {
        if(count>0){ 
          Eventos.remove({},function(err, doc){ 
          if(err){
            console.log(err)
          }else{
            console.log("Información de eventos reinicializada") 
          }
        })
      }
    })
      Operaciones.crearUsuarioDemo((error, result) => { 
        if(error){
          res.send(error) 
        }else{
          res.send(result) 
        }
      })
    }
  })
})


Router.post('/login', function(req, res) {
    let user = req.body.user 
    let password = req.body.pass, 
    sess = req.session; 
    Usuarios.find({user: user}).count({}, function(err, count) { 
        if (err) {
            res.status(500)
            res.json(err)
        }else{
          if(count == 1){ 
            Usuarios.find({user: user, password: password }).count({}, function(err, count) { //Verificar su contraseña
                if (err) {
                    res.status(500) 
                    res.json(err) 
                }else{
                  if(count == 1){ 
                    sess.user = req.body.user; 
                    res.send("Validado") 
                  }else{ 
                    res.send("Contraseña incorrecta") 
                  }
                }
            })
          }else{
            res.send("Usuario no registrado") 
          }
        }

    })
})


Router.post('/logout', function(req, res) {
  req.session.destroy(function(err) {
  if(err) {
    console.log(err); //Mostrar mensaje de error en cónsola
    res.json(err) //Devolver mensaje de error
  } else {
    req.session = null //Elimina las cookies de la session
    res.send('logout') //Devolver logout como respuesta
    res.end()
  }
  });
});

Router.all('*', function(req, res) {
  res.send('Error al mostrar el recurso solicitado. Por favor verifique la dirección url a la cual desea ingresar' )
  res.end()
})

module.exports = Router //Exportar el módulo Router
