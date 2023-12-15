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

    public function podcastById(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function podcastsUsuarioById(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function seguirPodcastById(Request $request)
    {
        if($request->isMethod('POST')) {}
        if($request->isMethod('DELETE')) {}
    }
}
