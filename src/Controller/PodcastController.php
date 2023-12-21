<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PodcastController extends AbstractController
{
    public function podcasts(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function podcast(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function podcastsUsuario(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function seguirPodcast(Request $request)
    {
        if($request->isMethod('POST')) {}
        if($request->isMethod('DELETE')) {}
    }
}
