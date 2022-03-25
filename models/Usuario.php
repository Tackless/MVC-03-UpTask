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
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validarNuevaCuenta() {
        
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
    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }

        return self::$alertas;
    }

    // Valida el Password
    public function validarPassword() {
        
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacío';
        }

        if (strlen($this->password) < 6 ) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 carácteres';
        }

        return self::$alertas;
    }

    // Hashea el password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Crear token
    public function crearToken() {
        $this->token = uniqid();
    }
}