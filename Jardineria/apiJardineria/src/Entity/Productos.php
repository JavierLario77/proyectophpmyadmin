<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Productos
{
    private $codigoproducto;

    private $nombre;

    private $dimensiones;

    private $proveedor;

    private $descripcion;

    private $cantidadenstock;

    private $precioventa;

    private $precioproveedor;

    private $imagen;

    private $latitud;

    private $longitud;

    private $gama;

    private $codigopedido;

    public function __construct()
    {
        $this->codigopedido = new ArrayCollection();
    }

    public function getCodigoproducto(): ?string
    {
        return $this->codigoproducto;
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

    public function getDimensiones(): ?string
    {
        return $this->dimensiones;
    }

    public function setDimensiones(?string $dimensiones): self
    {
        $this->dimensiones = $dimensiones;

        return $this;
    }

    public function getProveedor(): ?string
    {
        return $this->proveedor;
    }

    public function setProveedor(?string $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCantidadenstock(): ?int
    {
        return $this->cantidadenstock;
    }

    public function setCantidadenstock(int $cantidadenstock): self
    {
        $this->cantidadenstock = $cantidadenstock;

        return $this;
    }

    public function getPrecioventa(): ?string
    {
        return $this->precioventa;
    }

    public function setPrecioventa(string $precioventa): self
    {
        $this->precioventa = $precioventa;

        return $this;
    }

    public function getPrecioproveedor(): ?string
    {
        return $this->precioproveedor;
    }

    public function setPrecioproveedor(?string $precioproveedor): self
    {
        $this->precioproveedor = $precioproveedor;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    public function setLatitud(?string $latitud): self
    {
        $this->latitud = $latitud;

        return $this;
    }

    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    public function setLongitud(?string $longitud): self
    {
        $this->longitud = $longitud;

        return $this;
    }

    public function getGama(): ?Gamasproductos
    {
        return $this->gama;
    }

    public function setGama(?Gamasproductos $gama): self
    {
        $this->gama = $gama;

        return $this;
    }

    /**
     * @return Collection|Pedidos[]
     */
    public function getCodigopedido(): Collection
    {
        return $this->codigopedido;
    }

    public function addCodigopedido(Pedidos $codigopedido): self
    {
        if (!$this->codigopedido->contains($codigopedido)) {
            $this->codigopedido[] = $codigopedido;
            $codigopedido->addCodigoproducto($this);
        }

        return $this;
    }

    public function removeCodigopedido(Pedidos $codigopedido): self
    {
        if ($this->codigopedido->contains($codigopedido)) {
            $this->codigopedido->removeElement($codigopedido);
            $codigopedido->removeCodigoproducto($this);
        }

        return $this;
    }
}
