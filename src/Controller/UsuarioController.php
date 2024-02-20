<?php

namespace App\Controller;

use App\Entity\Calidad;
use App\Entity\Configuracion;
use App\Entity\Free;
use App\Entity\Idioma;
use App\Entity\TipoDescarga;
use App\Entity\Usuario;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

use function PHPSTORM_META\type;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class UsuarioController extends AbstractController
{
    public function usuarios(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod('GET')) {
            $usuarios = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
            $usuarios = $serializer->serialize($usuarios, 'json', ['groups' => ["usuario"]]);
            
            return new Response($usuarios);
        }

        if($request->isMethod('POST')) {
            $bodydata=$request->getContent();

            $usuario=$serializer->deserialize($bodydata, Usuario::class, 'json');
            $this->getDoctrine()->getManager()->persist($usuario);
            
            $usuarioExistente = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['username' => $usuario->getUsername()]);

            if($usuarioExistente) {
                return new JsonResponse(['msg' => "El usuario ya existe"]);
            }

            $usuarioExistente = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['email' => $usuario->getEmail()]);
            if($usuarioExistente) {
                return new JsonResponse(['msg' => "El email ya existe"]);
            }

            $free=new Free();
            $free->setUsuario($usuario);
            $this->getDoctrine()->getManager()->persist($free);

            $configuracion=new Configuracion();

            $configuracion->setAutoplay(true);
            $configuracion->setAjuste(true);
            $configuracion->setNormalizacion(true);

            $calidad=$this->getDoctrine()->getRepository(Calidad::class)->findOneBy(['id'=>1]);
            $configuracion->setCalidad($calidad);

            $idioma=$this->getDoctrine()->getRepository(Idioma::class)->findOneBy(['id'=>1]);
            $configuracion->setIdioma($idioma);

            $tipodescarga=$this->getDoctrine()->getRepository(TipoDescarga::class)->findOneBy(['id'=>1]);
            $configuracion->setTipoDescarga($tipodescarga);

            $configuracion->setUsuario($usuario);
            $this->getDoctrine()->getManager()->persist($configuracion);

            $this->getDoctrine()->getManager()->flush();
            
            $usuariox = [$usuario,$free,$configuracion];
            $usuariox = $serializer->serialize($usuariox, 'json', ['groups'=>['usuario','free','configuracion']]);
            return new JsonResponse(['msg' => "Usuario creado correctamente"]);

        }
    }

    public function usuario(Request $request,SerializerInterface $serializer)
    {
        $id = $request->get("id");
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(["id" => $id]);

        if($request->isMethod('GET')) {
            $usuario = $serializer->serialize($usuario, 'json', ['groups' => ["usuario"]]);
        }

        if($request->isMethod('PUT')) {
            $bodyData = $request->getContent();
            $usuario = $serializer->deserialize($bodyData, Usuario::class, 'json',['object_to_populate' => $usuario]);

            $usuario = $this->getDoctrine()->getManager()->merge($usuario);
            $this->getDoctrine()->getManager()->flush();

            $usuario = $serializer->serialize($usuario, 'json', ['groups' => ["usuario"]]);

        }

        return new Response($usuario);
    }

    public function usuarioByUsername(Request $request, SerializerInterface $serializer)
    {
        if($request->isMethod("GET"))
        {
            $nombre = $request->get('username');

            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findOneBy(['username' => $nombre]);
            $usuario = $serializer->serialize($usuario, 'json', ['groups' => ["usuario"]]);

            return new Response($usuario);
        }
    }
}
