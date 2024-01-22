<?php

namespace App\Controller;

use App\Entity\Calidad;
use App\Entity\Usuario;
use App\Entity\Configuracion;
use App\Entity\Idioma;
use App\Entity\TipoDescarga;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ConfiguracionController extends AbstractController
{
    public function configuracionUsuario(Request $request, SerializerInterface $serializer)
    {
        $id = $request->get("id");
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(["id"=>$id]);
        $configuracion = $this->getDoctrine()->getRepository(Configuracion::class)->findOneBy(["usuario"=>$usuario]);

        if($request->isMethod('GET')) {    
            $configuracion = $serializer->serialize($configuracion, 'json', ['groups' => ["configuracion"]]);

            return new Response($configuracion);
        }

        if($request->isMethod('PUT')) {

            $bodydata=$request->getContent();

            $body_configuracion=json_decode($bodydata,true);

            if(!empty($body_configuracion["autoplay"])){
                $configuracion->setAutoplay($body_configuracion["autoplay"]);

            }

            if(!empty($body_configuracion["ajuste"])){
                $configuracion->setAutoplay($body_configuracion["ajuste"]);

            }

            if(!empty($body_configuracion["normalizacion"])){
                $configuracion->setNormalizacion($body_configuracion["normalizacion"]);

            }

            if(!empty($body_configuracion["calidad"])){
                $calidad=$this->getDoctrine()->getRepository(Calidad::class)->findOneBy(['id'=>$body_configuracion["calidad"]]);
                $configuracion->setCalidad($calidad);

            }

            if(!empty($body_configuracion["idioma"])){
                $idioma=$this->getDoctrine()->getRepository(Idioma::class)->findOneBy(['id'=>$body_configuracion["idioma"]]);
                $configuracion->setIdioma($idioma);

            }

            if(!empty($body_configuracion["tipoDescarga"])){
                $descarga=$this->getDoctrine()->getRepository(TipoDescarga::class)->findOneBy(['id'=>$body_configuracion["tipoDescarga"]]);
                $configuracion->setTipoDescarga($descarga);

            }

            if(!empty($body_configuracion["usuario"])){
                $usuario=$this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['id'=>$body_configuracion["usuario"]]);
                $configuracion->setUsuario($usuario);

            }

            $this->getDoctrine()->getManager()->persist($configuracion);

            $this->getDoctrine()->getManager()->flush();

            $new_configuracion=$serializer->serialize($configuracion,'json',['groups'=>['configuracion']]);

            return new Response($new_configuracion);

        }
    }
}
