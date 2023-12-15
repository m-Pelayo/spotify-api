<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CapituloController extends AbstractController
{
    public function capitulosByPodcastId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }

    public function capituloByIdAndPodcastId(Request $request)
    {
        if($request->isMethod('GET')) {}
    }
}
