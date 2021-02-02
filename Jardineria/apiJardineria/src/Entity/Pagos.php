<?php

namespace App\Entity;

class Pagos
{
    private $idtransaccion;

    private $formapago;

    private $fechapago;

    private $cantidad;

    private $codigocliente;

    public function getIdtransaccion(): ?string
    {
        return $this->idtransaccion;
    }

    public function getFormapago(): ?string
    {
        return $this->formapago;
    }

    public function setFormapago(string $formapago): self
    {
        $this->formapago = $formapago;

        return $this;
    }

    public function getFechapago(): ?\DateTimeInterface
    {
        return $this->fechapago;
    }

    public function setFechapago(\DateTimeInterface $fechapago): self
    {
        $this->fechapago = $fechapago;

        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(string $cantidad): self
    {
        $this->cantidad = $cantidad;

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
}
