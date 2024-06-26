<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Free
 *
 * @ORM\Table(name="free", indexes={@ORM\Index(name="fk_free_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fecha_revision_idx", columns={"fecha_revision"})})
 * @ORM\Entity
 */
class Free
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revision", type="date", nullable=false)
     * @Groups({"free"})
     */
    private $fechaRevision;

    /**
     * @var int
     *
     * @ORM\Column(name="tiempo_publicidad", type="integer", nullable=false, options={"default"="600"})
     * @Groups({"free"})
     */
    private $tiempoPublicidad = 600;

    /**
     * @var Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    public function __construct()
    {
        $this->fechaRevision = new \DateTime();
    }

    /**
     * Get the value of fechaRevision
     */
    public function getFechaRevision(): \DateTime
    {
        return $this->fechaRevision;
    }

    /**
     * Set the value of fechaRevision
     */
    public function setFechaRevision(\DateTime $fechaRevision): self
    {
        $this->fechaRevision = $fechaRevision;

        return $this;
    }

    /**
     * Get the value of tiempoPublicidad
     */
    public function getTiempoPublicidad(): int
    {
        return $this->tiempoPublicidad;
    }

    /**
     * Set the value of tiempoPublicidad
     */
    public function setTiempoPublicidad(int $tiempoPublicidad): self
    {
        $this->tiempoPublicidad = $tiempoPublicidad;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     */
    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
