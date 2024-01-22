<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artista;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ArtistaController extends AbstractController
{
    public function artistas(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $artistas = $this->getDoctrine()->getRepository(Artista::class)->findAll();
            $artistas = $serializer->serialize($artistas, 'json', ['groups' => ["artista"]]);

            return new Response($artistas);
        }
    }

    public function albumsArtista(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $id = $request->get('id');
            $artista = $this->getDoctrine()->getRepository(Artista::class)->findOneBy(['id' => $id]);

            $albums = $this->getDoctrine()->getRepository(Album::class)->findBy(['artista' => $artista]);
            $albums = $serializer->serialize($albums, 'json', ['groups' => ["album"]]);

            return new Response($albums);
        }
    }

    public function albumByIdAndArtistaId(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $artistaId = $request->get('artistaId');
            $albumId = $request->get('albumId');

            $artista = $this->getDoctrine()->getRepository(Artista::class)->findOneBy(['id' => $artistaId]);
            $album = $this->getDoctrine()->getRepository(Album::class)->findOneBy(['id' => $albumId]);

            if($album->getArtista() == $artista)
            {
                $album = $serializer->serialize($album, 'json', ['groups' => ["album"]]);

                return new Response($album);
            }
            else
            {
                return new JsonResponse(['msg' => "El album no pertenece al artista"]);
            }
        }
    }
}
