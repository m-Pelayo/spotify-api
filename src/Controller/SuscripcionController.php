<?php

namespace App\Controller;

use App\Entity\Suscripcion;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class SuscripcionController extends AbstractController
{
    public function suscripcionesUsuario(Request $request, SerializerInterface $serializer)

    {
        if ($request->isMethod('GET')) {
            $id = $request->get('id');
            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $id]);

            if (!$usuario) {
                return new Response('Este usuario nunca estuvo subscrito');
            }
            $suscripciones = $this->getDoctrine()->getRepository(Suscripcion::class)->findBy(['premiumUsuario' => $usuario]);
            $suscripciones = $serializer->serialize($suscripciones, 'json', ['groups' => ['suscripcion','usuario']]);
            return new Response($suscripciones);
        }
    }

    public function suscripcionByIdAndUsuarioId(Request $request, SerializerInterface $serializer)
    {
        if ($request->isMethod('GET')) {
            $id = $request->get('suscripcionId');
            $usuarioId = $request->get('usuarioId');
            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $usuarioId]);
            $suscripcion = $this->getDoctrine()->getRepository(Suscripcion::class)->findOneBy(['id' => $id, 'premiumUsuario' => $usuario]);
            if (!$suscripcion || !$usuario) {
                return new Response('Este usuario nunca estuvo subscrito o la id no coincide');
            }
            $suscripcion = $serializer->serialize($suscripcion, 'json', ['groups' => ['suscripcion','usuario']]);
            return new Response($suscripcion);
        }
    }
}
