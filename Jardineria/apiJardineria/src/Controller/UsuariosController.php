<?php


namespace App\Controller;

use App\Entity\Gamasproductos;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;

//use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\Helpers;
use App\Services\JwtAuth;
use App\Entity\Usuarios;
use App\Controller\EntityManagerInterface;

class UsuariosController extends AbstractController
{
    public function login(Request $request, JwtAuth $jwt, Helpers $ayuda)
    {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $param = json_decode($dataJson);
            $login = (isset($param->login) ? $param->login : null);
            $pass = (isset($param->password) ? $param->password : null);
            $getHash = (isset($param->hash) ? $param->hash : null);

            $em = $this->getDoctrine();
            $user = $em->getRepository(Usuarios::class)
                ->findOneBy(array(
                    "login" => $login,
                    "password" => $pass
                ));

            if (is_object($user)) {

                $data = array(
                    'status' => 'success',
                    'token' => $signup = $jwt->signup($login, $pass, true),
                    'user' => $user
                );
                return $ayuda->aJson($data);
            } else {
                return $ayuda->aJson(
                    array(
                        'status' => 'error',
                        'msg' => 'El usuario NO EXISTE, verifica login/pass'
                    ));

            }
        } else {
            return $ayuda->aJson(
                array(
                    'status' => 'error',
                    'msg' => 'Formulario sin datos'
                ));
        }

    }

    public function register(Request $request, Helpers $ayuda, JwtAuth $jwt)
    {
        //Controlador recibe Parámetros de LA REQUEST URL
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            //vienen datos
            $param = json_decode($dataJson);
            $token = isset($param->token) ? $param->token : null;
            $usuario = (isset($param->usuario) ? $param->usuario : null);
            // $usuario_json = json_decode($usuario);
            $login = (isset($usuario->login) ? $usuario->login : null);
            $pass = (isset($usuario->password) ? $usuario->password : null);
            $nombre = (isset($usuario->nombre) ? $usuario->nombre : null);
            $rol = (isset($usuario->rol) ? $usuario->rol : null);
            $foto = (isset($usuario->foto) ? $usuario->foto : null);
            $auth = $jwt->checkToken($token, false);
            
    
            //Controlador invoca al MODELO (Prámetros URL)
            $em = $this->getDoctrine()->getManager();
            if ($auth == true) {
                $user = $jwt->checkToken($token, true); //datos decodif. tk
                $usuario2 = $em->getRepository(Usuarios::class)
                ->findOneBy(array(
                    "id" => $user->sub
                ));
                $rol2 = $usuario2->getRol();
                if ($rol2 == 'admin') {
            //función DQL new() en UsuariosRepositiry
                        $ok = $em->getRepository(Usuarios::class)
                            ->new($login, $pass, $nombre, $rol, $foto);
                        if ($ok == 1) {
                            $user2 = $em->getRepository(Usuarios::class)
                                ->findOneBy(array(
                                    "login" => $login,
                                    "password" => $pass
                                ));
                            $token = $jwt->signUp($login, $pass, true);
                            $repuesta = array(
                                'status' => 'success',
                                'msg' => 'Usuario Registrado Correctamente',
                                'user' => $user2,
                                'token' => $token
                            );
                        } else {
                            $repuesta = array(
                                'status' => 'error',
                                'msg' => 'Usuario No Registrado');
                        }

                    }}}
                    return $ayuda->aJson($repuesta);
                }


    public function uploadSingleImageGama(Request $request, Helpers $ayuda)
    {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $gama = isset($params->gama) ? $params->gama : null;
            $base64 = isset($params->base64) ? $params->base64 : null;
            $base64 = str_replace(" ", "+", $base64);
            $uniname = uniqid() . date("Y-m-d-H-i-s") . ".jpg";
            $new_image_url = "../public/img/categorias" . $uniname;
            $base64 = 'data:image/jpeg;base64,' . $base64;
            $base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
            file_put_contents($new_image_url, $base64);
            $em = $this->getDoctrine();
            $userD = $em->getRepository(Gamasproductos::class)
               ->findOneBy(array(
                   "gama" => $gama
               ));
            $userD = $em->getRepository(Gamasproductos::class)->setIcono( $uniname);
            //$userD->setImg("images/profile/" . $uniname);
            $em->persist($userD);
            $em->flush();
            return $ayuda->aJson(array(
                'status' => 'success'
            ));
        } else {
            return $ayuda->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }

    }
    public function uploadSingleImagePerfil(Request $request, Helpers $ayuda)
    {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $base64 = isset($params->base64) ? $params->base64 : null;
            $base64 = str_replace(" ", "+", $base64);
            $uniname = uniqid() . date("Y-m-d-H-i-s") . ".jpg";
            $new_image_url = "../public/img/perfil" . $uniname;
            $base64 = 'data:image/jpeg;base64,' . $base64;
            $base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
            file_put_contents($new_image_url, $base64);
            $em = $this->getDoctrine();
            $userD = $em->getRepository(Usuarios::class)->find($login);
            $userD = $em->getRepository(Usuarios::class)->setFoto( $uniname);
            //$userD->setImg("images/profile/" . $uniname);
            $em->persist($userD);
            $em->flush();
            return $ayuda->aJson(array(
                'status' => 'success'
            ));
        } else {
            return $ayuda->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }

    }
    public function uploadSingleImageProducto(Request $request, Helpers $ayuda)
    {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $codigo = isset($params->codigo) ? $params->codigo : null;
            $base64 = isset($params->base64) ? $params->base64 : null;
            $base64 = str_replace(" ", "+", $base64);
            $uniname = uniqid() . date("Y-m-d-H-i-s") . ".jpg";
            $new_image_url = "../public/img" . $uniname;
            $base64 = 'data:image/jpeg;base64,' . $base64;
            $base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
            file_put_contents($new_image_url, $base64);
            $em = $this->getDoctrine();
            $userD = $em->getRepository(Productos::class)
               ->findOneBy(array(
                   "codigoproducto" => $codigo
               ));
            $userD = $em->getRepository(Productos::class)->setImagen( $uniname);
            //$userD->setImg("images/profile/" . $uniname);
            $em->persist($userD);
            $em->flush();
            return $ayuda->aJson(array(
                'status' => 'success'
            ));
        } else {
            return $ayuda->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }

    }
    public function actualizar(Request $request, JwtAuth $jwt, Helpers $ayuda){
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            //vienen datos
            $param = json_decode($dataJson);

            $token = isset($param->token) ? $param->token : null;
            $usuario = (isset($param->usuario) ? $param->usuario : null);

            // $usuario_json = json_decode($usuario);
            $login = (isset($usuario->login) ? $usuario->login : null);
            $pass = (isset($usuario->password) ? $usuario->password : null);
            $nombre = (isset($usuario->nombre) ? $usuario->nombre : null);
            $rol = (isset($usuario->rol) ? $usuario->rol : null);
            $foto = (isset($usuario->foto) ? $usuario->foto : null);
            $em = $this->getDoctrine()->getManager();
            //sacamos el usuario del TOKEN
            $user = $jwt->checkToken($token, true); //datos decodif. tk
            //obtenemos su usuario de la BD con el sub del token
            $usuario = $em->getRepository(Usuarios::class)
               ->findOneBy(array(
                   "id" => $user->sub
               ));
            $usuario->setLogin($login);
            $usuario->setPassword($pass);
            $usuario->setNombre($nombre);
            $usuario->setRol($rol);
            $usuario->setFoto($foto);
            
            $em->persist($usuario);
            $em->flush();
        }


        return $ayuda->aJson(
            array(
                'status' => 'error',
                'data' => 'Modificación correcta.'
            ));
    }
}
