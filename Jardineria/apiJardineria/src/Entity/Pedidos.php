<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Pedidos
{
    private $codigopedido;

    private $fechapedido;

    private $fechaesperada;

    private $fechaentrega;

    private $estado;

    private $comentarios;

    private $codigocliente;

    private $codigoproducto;

    public function __construct()
    {
        $this->codigoproducto = new ArrayCollection();
    }

    public function getCodigopedido(): ?int
    {
        return $this->codigopedido;
    }

    public function getFechapedido(): ?\DateTimeInterface
    {
        return $this->fechapedido;
    }

    public function setFechapedido(\DateTimeInterface $fechapedido): self
    {
        $this->fechapedido = $fechapedido;

        return $this;
    }

    public function getFechaesperada(): ?\DateTimeInterface
    {
        return $this->fechaesperada;
    }

    public function setFechaesperada(\DateTimeInterface $fechaesperada): self
    {
        $this->fechaesperada = $fechaesperada;

        return $this;
    }

    public function getFechaentrega(): ?\DateTimeInterface
    {
        return $this->fechaentrega;
    }

    public function setFechaentrega(?\DateTimeInterface $fechaentrega): self
    {
        $this->fechaentrega = $fechaentrega;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getComentarios(): ?string
    {
        return $this->comentarios;
    }

    public function setComentarios(?string $comentarios): self
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    public function getCodigocliente(): ?Clientes
    {
        return $this->codigocliente;
    }

    public function setCodigocliente(?Clientes $codigocliente): self
    {
        $this->codigocliente = $codigocliente;

        return $this;
    }

    /**
     * @return Collection|Productos[]
     */
    public function getCodigoproducto(): Collection
    {
        return $this->codigoproducto;
    }

    public function addCodigoproducto(Productos $codigoproducto): self
    {
        if (!$this->codigoproducto->contains($codigoproducto)) {
            $this->codigoproducto[] = $codigoproducto;
        }

        return $this;
    }

    public function removeCodigoproducto(Productos $codigoproducto): self
    {
        if ($this->codigoproducto->contains($codigoproducto)) {
            $this->codigoproducto->removeElement($codigoproducto);
        }

        return $this;
    }
}
