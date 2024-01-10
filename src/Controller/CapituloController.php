<?php

namespace App\Controller;

use App\Entity\Capitulo;
use App\Entity\Podcast;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CapituloController extends AbstractController
{
    public function capitulosPodcast(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $podcastId = $request->get('id');
            $podcast = $this->getDoctrine()->getRepository(Podcast::class)->findOneBy(['id' => $podcastId]);

            $capitulos = $this->getDoctrine()->getRepository(Capitulo::class)->findBy(['podcast' => $podcast]);
            $capitulos = $serializer->serialize($capitulos, 'json', ['groups' => ["capitulo"]]);

            return new Response($capitulos);
        }
    }

    public function capituloByIdAndPodcastId(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $podcastId = $request->get('podcastId');
            $capituloId = $request->get('capituloId');

            $podcast = $this->getDoctrine()->getRepository(Podcast::class)->findOneBy(['id' => $podcastId]);
            $capitulo = $this->getDoctrine()->getRepository(Capitulo::class)->findOneBy(['id' => $capituloId, 'podcast' => $podcast]);
            $capitulo = $serializer->serialize($capitulo, 'json', ['groups' => ["capitulo"]]);

            return new Response($capitulo);
        }
    }
}
