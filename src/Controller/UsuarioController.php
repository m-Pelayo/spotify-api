<?php

namespace App\Controller;

use App\Entity\Usuario;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UsuarioController extends AbstractController
{
    public function usuarios(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $usuarios = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
            $usuarios = $serializer->serialize($usuarios, 'json', ['groups' => ["usuario"]]);
            
            return new Response($usuarios);
        }

        if($request->isMethod('POST')) {
            //Primero creo el usuario y luego creo la configuracion
            //Depues tengo que indicar si es premium o free
            //Si indico que es premium le pongo que la fecha_renovacion poner que es la fecha de hoy

        }
    }

    public function usuario(Request $request,SerializerInterface $serializer)
    {
        $id = $request->get("id");
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(["id" => $id]);

        if($request->isMethod('GET')) {
            $usuario = $serializer->serialize($usuario, 'json', ['groups' => ["usuario"]]);
        }

        if($request->isMethod('PUT')) {}

        return new Response($usuario);
    }
}
