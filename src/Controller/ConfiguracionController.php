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
            
            $user = ["id: "=>$id, "Usuario: "=>$usuario->getUsername()];
            $imprime = [$user,$configuracion];
            $imprime = $serializer->serialize($imprime, 'json', ['groups' => 'configuracion']);
            return new Response($imprime);
        }
        if($request->isMethod('PUT')) {}
    }
}
