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

    public function playlistsById(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function playlistsByUserId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function playlistByIdAndUserId(Request $request)
    {
        if($request->isMethod('GET')) {}
        if($request->isMethod('PUT')) {}
        if($request->isMethod('DELETE')) {}
    }
}
