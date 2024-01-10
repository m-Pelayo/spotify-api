<?php

namespace App\Controller;

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
        if($request->isMethod('GET')) {
            $playlists = $this->getDoctrine()->getRepository(Playlist::class)->findAll();
            $playlists = $serializer->serialize($playlists, 'json', ['groups' => ["playlist"]]);

            return new Response($playlists);
        }

        if($request->isMethod('POST')) {
            $bodyData = $request->getContent();

            $playlist = $serializer->deserialize($bodyData, Playlist::class, 'json');
            $playlist = $this->getDoctrine()->getManager()->merge($playlist);

            $this->getDoctrine()->getManager()->flush();

            $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlistPOST", "usuario"]]);

            return new Response($playlist);
        }
    }

    public function playlist(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $id = $request -> get('id');
            $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy(['id' => $id]);
            $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);

            return new Response($playlist);
        }
    }

    public function playlistsUsuario(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $id = $request -> get('id');
            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $id]);
            $playlists = $usuario->getPlaylist();
            $playlists = $serializer->serialize($playlists, 'json', ['groups' => ["playlist"]]);

            return new Response($playlists);
        }
    }

    public function playlistByIdAndUsuarioId(Request $request, SerializerInterface $serializer)
    {
        $usuarioId = $request -> get('usuarioId');
        $playlistId = $request -> get('playlistId');

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id' => $usuarioId]);
        $playlist = $this->getDoctrine()->getRepository(Playlist::class)->findOneBy(['id' => $playlistId]);

        if ($playlist->getUsuario() == $usuario) {
            if($request->isMethod('GET')) {
                $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
            }
    
            if($request->isMethod('PUT')) {
                if (!empty($playlist)) {
                    $bodyData = $request->getContent();
                    $playlist = $serializer->deserialize($bodyData, Playlist::class, 'json', ['object_to_populate' => $playlist]);

                    $this->getDoctrine()->getManager()->persist($playlist);
                    $this->getDoctrine()->getManager()->flush();

                    $playlist = $serializer->serialize($playlist, 'json', ['groups' => ["playlist"]]);
                }
            }
    
            if($request->isMethod('DELETE')) {
                $deletedPlaylist = clone $playlist;

                $this->getDoctrine()->getManager()->remove($playlist);
                $this->getDoctrine()->getManager()->flush();

                $playlist = $serializer->serialize($deletedPlaylist, 'json', ['groups' => ["playlist"]]);
            }
    
            return new Response($playlist);
            
        } else {
            return new JsonResponse(['msg' => "La Id de Usuario o la Id de Playlist son incorrectas"]);
        }
    }
}
