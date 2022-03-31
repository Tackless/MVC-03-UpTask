<?php 

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','email','password','token','confirmado'];

    public function __construct($args = []) {
        
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    // Validar el Login de los Usuarios
    public function validarLogin() : array {
        
        if (!$this->email) {
            self::$alertas['error'][] = 'El E-mail de Usuario es Obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacío';
        }

        return self::$alertas;
    }

    // Validar Cuenta Nueva
    public function validarNuevaCuenta() : array {
        
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre de Usuario es Obligatorio';
        }
        
        if (!$this->email) {
            self::$alertas['error'][] = 'El E-mail de Usuario es Obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacío';
        }

        if (strlen($this->password) < 6 ) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 carácteres';
        }

        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los Passwords son diferentes';
        }

        return self::$alertas;
    }

    // Valida el email
    public function validarEmail() : array {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
    }

    // Valida el Password
    public function validarPassword() : array {
        
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacío';
        }

        if (strlen($this->password) < 6 ) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 carácteres';
        }

        return self::$alertas;
    }

    // Validar el perfil del Usuario
    public function validarPerfil() : array {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }

        if (!$this->email) {
            self::$alertas['error'][] = 'El E-mail es Obligatorio';
        }

        return self::$alertas;
    }

    // Cambiar password
    public function nuevo_password() : array {
        
        if (!$this->password_actual) {
            self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
        }

        if (!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo no puede ir vacio';
        }

        if (strlen($this->password_nuevo) < 6 ) {
            self::$alertas['error'][] = 'El Password Nuevo debe contener al menos 6 carácteres';
        }

        return self::$alertas;
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password);
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Crear token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}