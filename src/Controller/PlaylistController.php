<?php

namespace App\Controller;

use App\Entity\Activa;
use App\Entity\Eliminada;
use App\Entity\Playlist;
use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class PlaylistController extends AbstractController
{
    public function playlists(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) 
        {
            $playlists = $this->getDoctrine()->getRepository(Playlist::class)->findAll();
            $playlistsActivas = $this->getDoctrine()->getRepository(Activa::class)->findAll();
            $listaPlaylists = [];

            foreach($playlists as $playlist)
            {
                foreach($playlistsActivas as $playlistActiva)
                {
                    if($playlist === $playlistActiva->getPlaylist())
                    {
                        $listaPlaylists[] = $playlist;
                    }
                }
            }

            $playlists = $serializer->serialize($listaPlaylists, 'json', ['groups' => ["playlist"]]);

            return new Response($playlists);
        }
    }

    public function playlist(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) 
        {
            $id = $request->get('id');
            
            $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy(['id' => $id]);
            $playlistsEliminadas = $this->getDoctrine()->getRepository(Eliminada::class)->findAll();

            foreach($playlistsEliminadas as $playlistEliminada)
            {
                if($playlist === $playlistEliminada->getPlaylist())
                {
                    return new JsonResponse(['msg' => "La playlist ha sido eliminada"]);
                }
            }

            $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
                    
            return new Response($playlist);
        }
    }

    public function playlistsUsuario(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get('id');

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $id]);

        if($request->isMethod('GET')) 
        {
            $playlist = $usuario->getPlaylist();
            $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
        }

        if($request->isMethod('POST')) 
        {
            $bodyData = $request->getContent();

            $playlist = $serializer->deserialize($bodyData, Playlist::class, 'json');

            $playlist->setUsuario($usuario);

            $playlist = $this->getDoctrine()->getManager()->merge($playlist);
            $this->getDoctrine()->getManager()->flush();

            $playlistActiva = new Activa();
            $playlistActiva->setPlaylist($playlist);

            $this->getDoctrine()->getManager()->persist($playlistActiva);
            $this->getDoctrine()->getManager()->flush();
            
            return new JsonResponse(['msg' => "Playlist creada con exito"]);
        }

        return new Response($playlist);
    }

    public function playlistByIdAndUsuarioId(Request $request, SerializerInterface $serializer)
    {
        $usuarioId = $request->get('usuarioId');
        $playlistId = $request->get('playlistId');

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $usuarioId]);
        $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy(['id' => $playlistId]);
        $playlistsEliminadas = $this->getDoctrine()->getRepository(Eliminada::class)->findAll();

        foreach($playlistsEliminadas as $playlistEliminada)
        {
            if($playlist === $playlistEliminada->getPlaylist())
            {
                return new JsonResponse(['msg' => "La playlist ha sido eliminada"]);
            }
        }

        if($playlist->getUsuario() == $usuario) 
        {
            if($request->isMethod('GET'))
            {
                $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
            }
    
            if($request->isMethod('PUT'))
            {
                $bodyData = $request->getContent();
                $playlist = $serializer->deserialize($bodyData, Playlist::class, 'json', ['object_to_populate' => $playlist]);

                $this->getDoctrine()->getManager()->persist($playlist);
                $this->getDoctrine()->getManager()->flush();

                $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
            }
    
            if($request->isMethod('DELETE'))
            {
                $playlistActiva = $this->getDoctrine()->getRepository(Activa::class)->findOneBy(['playlist' => $playlist]);

                $playlistEliminada = new Eliminada();
                $playlistEliminada->setPlaylist($playlist);

                $this->getDoctrine()->getManager()->remove($playlistActiva);
                $this->getDoctrine()->getManager()->persist($playlistEliminada);
                $this->getDoctrine()->getManager()->flush();

                $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
            }
    
            return new Response($playlist);
        }
        else 
        {
            return new JsonResponse(['msg' => "La playlist no pertenece al usuario"]);
        }
    }
}
