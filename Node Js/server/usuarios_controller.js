const Router = require('express').Router();
const Usuarios = require('./usuarios_model.js')
const Eventos = require('./eventos_model.js')
const Crear_Usuarios = require('./crear_usuarios.js')

Router.post('/login', function(req, res) {
    let user = req.body.user 
    let password = req.body.pass, 
    sess = req.session; 
    Usuarios.find({user: user}).count({}, function(err, count) { 
    
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
      
    })
})

Router.post('/logout', function(req, res) {
    req.session.destroy(function(err) {
    if(err) {
      
      res.json(err)
    } else {
      req.session = null
      res.send('logout') 
      res.end()
    }
    });
  });

  Router.all('*', function(req, res) {
    res.send('Error' )
    res.end()
  })

  Router.get('/hugo', function(req, res) {
    Usuarios.find({user: req.query.user}).count({}, function(err, count) { 
      if(count<0){ 
        Eventos.find({}).count({}, function(err, count) {
            if(count>0){ 
              Eventos.remove({},function(err, doc){ 
              if(err){
                console.log(err)
              }
            })
          }
        })
          Crear_Usuarios.crearUsuario((error, result) => { 
            if(error){
              res.send(error) 
            }else{
              res.send(result) 
            }
          })
        }
    })
  })

  module.exports = Router