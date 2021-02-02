<?php

namespace App\Entity;

class Clientes
{
    private $codigocliente;

    private $nombrecliente;

    private $nombrecontacto;

    private $apellidocontacto;

    private $telefono;

    private $fax;

    private $lineadireccion1;

    private $lineadireccion2;

    private $ciudad;

    private $region;

    private $pais;

    private $codigopostal;

    private $limitecredito;

    private $codigoempleadorepventas;

    public function getCodigocliente(): ?int
    {
        return $this->codigocliente;
    }

    public function getNombrecliente(): ?string
    {
        return $this->nombrecliente;
    }

    public function setNombrecliente(string $nombrecliente): self
    {
        $this->nombrecliente = $nombrecliente;

        return $this;
    }

    public function getNombrecontacto(): ?string
    {
        return $this->nombrecontacto;
    }

    public function setNombrecontacto(?string $nombrecontacto): self
    {
        $this->nombrecontacto = $nombrecontacto;

        return $this;
    }

    public function getApellidocontacto(): ?string
    {
        return $this->apellidocontacto;
    }

    public function setApellidocontacto(?string $apellidocontacto): self
    {
        $this->apellidocontacto = $apellidocontacto;

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

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getLineadireccion1(): ?string
    {
        return $this->lineadireccion1;
    }

    public function setLineadireccion1(string $lineadireccion1): self
    {
        $this->lineadireccion1 = $lineadireccion1;

        return $this;
    }

    public function getLineadireccion2(): ?string
    {
        return $this->lineadireccion2;
    }

    public function setLineadireccion2(?string $lineadireccion2): self
    {
        $this->lineadireccion2 = $lineadireccion2;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getCodigopostal(): ?string
    {
        return $this->codigopostal;
    }

    public function setCodigopostal(?string $codigopostal): self
    {
        $this->codigopostal = $codigopostal;

        return $this;
    }

    public function getLimitecredito(): ?string
    {
        return $this->limitecredito;
    }

    public function setLimitecredito(?string $limitecredito): self
    {
        $this->limitecredito = $limitecredito;

        return $this;
    }

    public function getCodigoempleadorepventas(): ?Empleados
    {
        return $this->codigoempleadorepventas;
    }

    public function setCodigoempleadorepventas(?Empleados $codigoempleadorepventas): self
    {
        $this->codigoempleadorepventas = $codigoempleadorepventas;

        return $this;
    }
}
