<?php 

namespace Controllers;

use Classes\Email;
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

        $alertas = [];
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya está registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar Password2
                    unset($usuario->password2);

                    // Generar Token
                    $usuario->crearToken();

                    // Guardar Usuario
                    $resultado = $usuario->guardar();

                    // Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
            
        }

        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
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