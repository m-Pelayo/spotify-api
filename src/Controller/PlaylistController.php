<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PlaylistController extends AbstractController
{
    public function playlists(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('POST')) {}
    }

    public function playlist(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function playlistsUsuario(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function playlistByIdAndUsuarioId(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('PUT')) {}
        if($request->isMethod('DELETE')) {}
    }
}
