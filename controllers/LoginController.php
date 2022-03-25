<?php 

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
        ]);
    }
    
    public static function logout() {
        echo 'desde logout';

    }

    public static function crear(Router $router) {

        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarNuevaCuenta();

            debuguear($alertas);
        }

        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario
        ]);
    }

    public static function olvide(Router $router) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
        $router->render('auth/olvide',[
            'titulo' => 'Olvide mi Password'
        ]);

    }

    public static function reestablecer(Router $router) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('auth/reestablecer',[
            'titulo' => 'Reestablecer Password'
        ]);
    }

    public static function mensaje(Router $router) {
    
        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);

    }

    public static function confirmar(Router $router) {
        
        $router->render('auth/confirmar',[
            'titulo' => 'Confirma tu cuenta UpTask'
        ]);

    }
}