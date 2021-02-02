<?php


namespace App\Controller;

use App\Entity\Productos;
use App\Entity\Gamasproductos;

use App\Entity\Usuarios;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use App\Services\Helpers;
use App\Services\JwtAuth;

class GamasproductosController extends AbstractController
{
    public function listar(Request $request, JwtAuth $jwt, Helpers $ayuda){
        $em = $this->getDoctrine();
        $dataJson = $request->get('data',null);
        if ($dataJson != null) {
            $param = json_decode($dataJson);
            $token = (isset($param->token)? $param->token:null);
            $auth = $jwt->checkToken($token, false);
            if ($auth == true){
                $categorias = $em->getRepository(Gamasproductos::class)->getAll();
                $respuesta = $ayuda->aJson(
                    array(
                        'status' => 'success',
                        'data'=>$categorias
                    ));
            }else {
                $respuesta = $ayuda->aJson(
                    array(
                        'status' => 'error',
                        'msn'=> 'Identificación no válida'
                    ));
            }
        }else{
            $respuesta = $ayuda->aJson(
                array(
                    'status' => 'error',
                    'msn'=> 'datos vacios'
                ));
        }

        return $respuesta;
    }
    public function registerGama(Request $request, Helpers $ayuda, JwtAuth $jwt)
    {
        //Controlador recibe Parámetros de LA REQUEST URL
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            //vienen datos

            $param = json_decode($dataJson);
            $token = isset($param->token) ? $param->token : null;

            $datosgama = (isset($param->datosGama) ? $param->datosGama : null);
            // $usuario_json = json_decode($usuario);
            $gama = (isset($datosgama->gama) ? $datosgama->gama : null);
            $descripcion = (isset($datosgama->descripciontexto) ? $datosgama->descripciontexto : null);
            $auth = $jwt->checkToken($token, false);
            
            //Controlador invoca al MODELO (Prámetros URL)
            $em = $this->getDoctrine()->getManager();
            if ($auth == true) {
                $user = $jwt->checkToken($token, true); //datos decodif. tk
                $usuario = $em->getRepository(Usuarios::class)
                ->findOneBy(array(
                    "id" => $user->sub
                ));
                $rol = $usuario->getRol();
                if ($rol == 'admin') {
                    $ok = $em->getRepository(Gamasproductos::class)
                        ->newGama($gama, $descripcion);
                    if ($ok == 1) {
                        $repuesta = array(
                            'status' => 'success',
                            'msg' => 'Gama registrada correctamente',
                        );
                    
                    } else {
                        $repuesta = array(
                            'status' => 'error',
                            'msg' => 'Gama no registrada');
                    }

                } else {
                    $repuesta = array(
                        'status' => 'error',
                        'msg' => 'No tienes privilegios para insertar');
                }
            }
            return $ayuda->aJson($repuesta);
        }

    }
}