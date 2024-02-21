<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Cancion;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AlbumController extends AbstractController
{
    public function albums(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $albums = $this->getDoctrine()->getRepository(Album::class)->findAll();
            $albums = $serializer->serialize($albums, 'json', ['groups'=> ["album"]]);

            return new Response($albums);
        }
    }

    public function album(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $id = $request->get('id');

            $album = $this->getDoctrine()->getRepository(Album::class)->findOneBy(['id' => $id]);
            $album = $serializer->serialize($album, 'json', ['groups' => ["album"]]);

            return new Response($album);
        }
    }

    public function cancionesAlbum(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $id = $request->get('id');
            $album = $this->getDoctrine()->getRepository(Album::class)->findOneBy(['id' => $id]);
            
            $canciones = $this->getDoctrine()->getRepository(Cancion::class)->findBy(['album' => $album]);
            $canciones = $serializer->serialize($canciones, 'json', ['groups' => ["cancion"]]);

            return new Response($canciones);
        }
    }

    public function albumsUsuario(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $id = $request->get('id');
            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $id]);
            $albums = $usuario->getAlbum();
            $albums = $serializer->serialize($albums, 'json', ['groups' => ["album"]]);

            return new Response($albums);
        }
    }
}
