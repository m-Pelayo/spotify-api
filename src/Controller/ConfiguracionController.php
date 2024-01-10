<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Configuracion;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ConfiguracionController extends AbstractController
{
    public function configuracionUsuario(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get("id");
        
        if($request->isMethod('GET')) {
            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(["id"=>$id]);
            $configuracion = $this->getDoctrine()->getRepository(Configuracion::class)->findOneBy(["usuario"=>$usuario]);
            $configuracion = $serializer->serialize($configuracion, 'json', ['groups' => 'configuracion']);

            return new Response($configuracion);
        }

        if($request->isMethod('PUT')) {}
    }
}
