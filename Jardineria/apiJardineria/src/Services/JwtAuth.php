<?php


namespace App\Services;

use App\Entity\Usuarios;
use Firebase\JWT\JWT;

class JwtAuth
{
    public $emanager;
    public $key = "key secret";
    public $token;

    public function __construct($manager)
    {
        $this->emanager = $manager;

    }

    public function signUp($login, $pass, $getHash = null){

        $user = $this->emanager->getRepository(Usuarios::class)
            ->findOneBy(array(
                'login' => $login,
                'password' => $pass
            ));
        $signup = false;
        if (is_object($user))
            $signup = true;
        else {
            $data = array(
                'status' => 'error',
                'data' => 'usuario no existe'
            );
            //return $data;
        }
        if ($signup){
            $this->token = array(
                "sub"       => $user->getId(),
                "email"     => $user->getLogin(),
                "password"  => $user->getPassword(),
                "iat"       => time(),
                "exp"       => time() + (7 * 24 * 60 * 60)
            );
            $hash = JWT::encode($this->token, $this->key, 'HS256');
            $decoded = JWT::decode($hash, $this->key, array('HS256') );
            if ($getHash != null)
                return $hash;
            else
                return $decoded;
        }
    }

    //checkea el token
    public function checkToken( $token, $getIdentity = false){
        // si getIdentity == true se devuelve $decoded que contiene los datos decodificados
        // si getIdentity == false se devuelve $auth que es true (si token es válido) /false (token no válido)
        $auth = false;
        try {
            //obtenemos datos decodificados dele token
            $decoded = JWT::decode($token, $this->key, array('HS256'));

        }catch (\UnexpectedValueException $e){
            $auth = false;
        }catch (\DomainException $e){
            $auth = false;
        }
        if (isset($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }
        if ($getIdentity == false) {
            return $auth;
        }else{
            return $decoded;
        }
    }
}