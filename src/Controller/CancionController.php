<?php

namespace App\Controller;

use App\Entity\AnyadeCancionPlaylist;
use App\Entity\Cancion;
use App\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CancionController extends AbstractController
{
    public function canciones(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $canciones = $this->getDoctrine()->getRepository(Cancion::class)->findAll();
            $canciones = $serializer->serialize($canciones, 'json', ['groups' => ["cancion"]]);

            return new Response($canciones);
        }
    }

    public function cancion(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $id = $request->get('id');

            $cancion = $this->getDoctrine()->getRepository(Cancion::class)->findOneBy(['id' => $id]);
            $cancion = $serializer->serialize($cancion, 'json', ['groups' => ["cancion"]]);

            return new Response($cancion);
        }
    }

    public function cancionesPlaylist(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET'))
        {
            $id = $request->get('id');
            $listaCanciones = [];

            $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy(['id' => $id]);
            $canciones = $this->getDoctrine()->getRepository(AnyadeCancionPlaylist::class)->findBy(['playlist' => $playlist]);

            foreach($canciones as $cancion)
            {
                $cancion = $cancion->getCancion();
                
                $listaCanciones[] = [
                    'id' => $cancion->getId(),
                    'titulo' => $cancion->getTitulo(),
                    'duracion' => $cancion->getDuracion(),
                    'ruta' => $cancion->getRuta(),
                    'numeroReproducciones' => $cancion->getNumeroReproducciones()
                ];
            }

            return new JsonResponse($listaCanciones);
        }
    }

    public function anadirCancionToPlaylist(Request $request, SerializerInterface $serializer)
    {
        $playlistId = $request->get('playlistId');
        $cancionId = $request->get('cancionId');

        $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy(['id' => $playlistId]);
        $usuario = $playlist->getUsuario();
        $cancion = $this->getDoctrine()->getRepository(Cancion::class)->findOneBy(['id' => $cancionId]);

        $cancionInPlaylist = $this->getDoctrine()->getRepository(AnyadeCancionPlaylist::class)->findOneBy(['cancion'=>$cancion,'usuario'=>$usuario]);

        if($request->isMethod('POST'))
        {
            if(!$cancionInPlaylist)
            {
                $anyadeCancion = new AnyadeCancionPlaylist();
                $anyadeCancion->setUsuario($usuario);
                $anyadeCancion->setPlaylist($playlist);
                $anyadeCancion->setCancion($cancion);

                $numeroCanciones = $playlist->getNumeroCanciones();
                $numeroCanciones = $numeroCanciones + 1;
                $playlist->setNumeroCanciones($numeroCanciones);

                $anyadeCancion = $this->getDoctrine()->getManager()->merge($anyadeCancion);
                $this->getDoctrine()->getManager()->persist($playlist);
                $this->getDoctrine()->getManager()->flush();

                return new JsonResponse(['msg' => "La canción se ha introducido correctamente"]);
            } 
            else
            {
                return new JsonResponse(['msg' => "Canción previamente añadida"]);
            }
        }
        
        if($request->isMethod('DELETE'))
        {
            if($cancionInPlaylist)
            {
                $deletedAnyadeCancion = clone $cancionInPlaylist;

                $this->getDoctrine()->getManager()->remove($cancionInPlaylist);
                $this->getDoctrine()->getManager()->flush();

                $cancion = $serializer->serialize($deletedAnyadeCancion, 'json', ['groups' => ["cancionPlaylist", "usuario", "playlist", "cancion"]]);
            }
            else
            {
                return new JsonResponse(['msg' => "La canción no pertenece a la playlist"]);
            }
        }
        
        return new JsonResponse($cancion);
    }
}
