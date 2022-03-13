<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\TipoProveedor;

/**
 * @ORM\Entity(repositoryClass=ProveedorRepository::class)
 */
class Proveedor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=150)
     */
    private $nombre;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", unique=true ,length=250)
     */
    private $correoelectronico;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", unique=true ,length=25)
     */
    private $telefono;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    
     /**
     * @ORM\Column(type="datetime")
     */
    protected $creado;

     /** 
     * @ORM\Column(type="datetime")
     */
    protected $modificado;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string" ,length=25)
     */
    private $tipoproveedor;


    public function __construct($nombre=null,$correoelectronico=null,$activo=null){
        $this->nombre=$nombre;
        $this->correoelectronico=$correoelectronico;
        $this->activo=$activo;
        $this->creado= new \DateTime();
        $this->modificado= new \DateTime();

    }

   /* Con esta función actualizamos el valor modificado del proveedor */
    public function actualizar(){
        $this->modificado= new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
    public function getCorreoelectronico(): ?string
    {
        return $this->correoelectronico;
    }

    public function setCorreoelectronico(string $correoelectronico): self
    {
        $this->correoelectronico = $correoelectronico;

        return $this;
    }
    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function gettipoproveedor(): ?string
    {
        return $this->tipoproveedor;
    }

    public function settipoproveedor(string $tipoproveedor): self
    {
        $this->tipoproveedor = $tipoproveedor;

        return $this;
    }
    public function getActivo(): ?string
    {
        return $this->activo;
    }

    public function setActivo(string $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getCreado(): ?string
    {
        return date_format($this->creado, 'Y-m-d H:i:s');
    }

    public function setCreado(\DateTimeInterface $creado): self
    {
        $this->creado = $creado;

        return $this;
    }

    public function getModificado(): ?string
    {
        return date_format($this->modificado, 'Y-m-d H:i:s');
    }

    public function setModificado(DateTime $modificado): self
    {
        $this->modificado = $modificado;

        return $this;
    }
}
