<?php


namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Helpers
{
    public $emanager;



    public function aJson($datos){
        $encoders = array("json" => new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $datosJson = $serializer->serialize($datos, 'json');
        $response = new Response();
        $response->setContent($datosJson);
        $response->headers->set("Content-Type","application/json");
        return $response;

    }
    public function holaMundo(){
        return ("Hola Mundo desde el servicio");
    }
}