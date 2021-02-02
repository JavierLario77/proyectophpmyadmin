<?php

namespace App\Entity;

class Oficinas
{
    private $codigooficina;

    private $ciudad;

    private $pais;

    private $region;

    private $codigopostal;

    private $telefono;

    private $lineadireccion1;

    private $lineadireccion2;

    public function getCodigooficina(): ?string
    {
        return $this->codigooficina;
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

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): self
    {
        $this->pais = $pais;

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

    public function getCodigopostal(): ?string
    {
        return $this->codigopostal;
    }

    public function setCodigopostal(string $codigopostal): self
    {
        $this->codigopostal = $codigopostal;

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
}
