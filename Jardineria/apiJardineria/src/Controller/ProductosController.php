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
use Knp\Component\Pager\PaginatorInterface;

class ProductosController extends AbstractController
{
    public function listarProductos(Request $request, JwtAuth $jwt, Helpers $ayuda, PaginatorInterface $paginator){
        $em = $this->getDoctrine();
        $dataJson = $request->get('data',null);
        if ($dataJson != null) {
            $param = json_decode($dataJson);
            $token = (isset($param->token)? $param->token:null);
            $auth = $jwt->checkToken($token, false);
            if ($auth == true){
                $gama = (isset($param->gama)? $param->gama:null);
                $productos = $em->getRepository(Productos::class)->getAll($gama);
                $page= $request->query->getInt("page",1);
                $items_per_page = 5;
	            // Paginamos la consulta con la página que queremos y los items por página
                $productosPaginados = $paginator->paginate($productos,$page,$items_per_page);
                $total_items_count= $productosPaginados->getTotalItemCount();

                $respuesta = $ayuda->aJson(
                    array(
                        'status' => 'success',
                        'data'=>$productosPaginados
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
    public function detallesProductos(Request $request, JwtAuth $jwt, Helpers $ayuda){
        $em = $this->getDoctrine();
        $dataJson = $request->get('data',null);
        if ($dataJson != null) {
            $param = json_decode($dataJson);
            $token = (isset($param->token)? $param->token:null);

            $auth = $jwt->checkToken($token, false);
            if ($auth == true){
                $codigo = (isset($param->codigo)? $param->codigo:null);

                $productos = $em->getRepository(Productos::class)->getDetalles($codigo);
                $respuesta = $ayuda->aJson(
                    array(
                        'status' => 'success',
                        'data'=>$productos
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
    public function registerProducto(Request $request, Helpers $ayuda, JwtAuth $jwt)
    {
        //Controlador recibe Parámetros de LA REQUEST URL
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            //vienen datos
            $param = json_decode($dataJson);
            $token = isset($param->token) ? $param->token : null;
            $datos = (isset($param->datosProducto) ? $param->datosProducto : null);
            // $usuario_json = json_decode($usuario);
            $codigo = (isset($datos->codigoproducto) ? $datos->codigoproducto : null);
            $nombre = (isset($datos->nombre) ? $datos->nombre : null);
            $gama = (isset($datos->gama) ? $datos->gama : null);
            $dimensiones = (isset($datos->dimensiones) ? $datos->dimensiones : null);
            $proveedor = (isset($datos->proveedor) ? $datos->proveedor : null);
            $descripcion = (isset($datos->descripcion) ? $datos->descripcion : null);
            $cantidadstock = (isset($datos->cantidadenstock) ? $datos->cantidadenstock : null);
            $preciov = (isset($datos->precioventa) ? $datos->precioventa : null);
            $preciop = (isset($datos->precioproveedor) ? $datos->precioproveedor : null);

            $auth = $jwt->checkToken($token, false);

            //Controlador invoca al MODELO (Prámetros URL)
            $em = $this->getDoctrine()->getManager();
            if ($auth == true){
                $user = $jwt->checkToken($token, true); //datos decodif. tk
                $usuario = $em->getRepository(Usuarios::class)
                ->findOneBy(array(
                    "id" => $user->sub
                ));
                $rol = $usuario->getRol();
                if ($rol == 'admin'){
                    $ok = $em->getRepository(Productos::class)
                        ->newProducto($codigo, $nombre, $gama, $dimensiones, $proveedor, $descripcion, $cantidadstock, $preciov, $preciop);
                    if ($ok == 1) {
                        $repuesta = array(
                            'status' => 'success',
                            'msg' => 'Producto registrado correctamente',
                        );
                    } else {
                        $repuesta = array(
                            'status' => 'error',
                            'msg' => 'Producto No Registrado');
                    }

                } else {
                    $repuesta = array(
                        'status' => 'error',
                        'msg' => 'No tienes privilegios para insertar');}
            }
            return $ayuda->aJson($repuesta);
        }



    }
    public function actualizarCoordenadas(Request $request, JwtAuth $jwt, Helpers $ayuda){
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            //vienen datos
            $param = json_decode($dataJson);

            $codigo = isset($param->codigo) ? $param->codigo : null;
            $lat = (isset($param->lat) ? $param->lat : null);
            $long = (isset($param->long) ? $param->long : null);
            var_dump($lat,$long);
            // $usuario_json = json_decode($usuario);
            
            $em = $this->getDoctrine()->getManager();
            //sacamos el usuario del TOKEN
            $usuario = $em->getRepository(Productos::class)
               ->findOneBy(array(
                   "codigoproducto" => $codigo
               ));
            $usuario->setLatitud($lat);
            $usuario->setLongitud($long);
            
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