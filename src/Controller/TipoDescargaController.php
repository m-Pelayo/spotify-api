<?php

namespace App\Controller;

use App\Entity\TipoDescarga;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class TipoDescargaController extends AbstractController
{
    public function tiposDescarga(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $tiposDescarga = $this->getDoctrine()->getRepository(TipoDescarga::class)->findAll();
            $tiposDescarga = $serializer->serialize($tiposDescarga, 'json', ['groups' => 'tipo_descarga']);
            
            return new Response($tiposDescarga);
        }
    }
}
