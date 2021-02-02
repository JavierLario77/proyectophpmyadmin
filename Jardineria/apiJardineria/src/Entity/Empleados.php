<?php

namespace App\Entity;

class Empleados
{
    private $codigoempleado;

    private $nombre;

    private $apellido1;

    private $apellido2;

    private $extension;

    private $email;

    private $puesto;

    private $codigojefe;

    private $codigooficina;

    public function getCodigoempleado(): ?int
    {
        return $this->codigoempleado;
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

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): self
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(?string $apellido2): self
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPuesto(): ?string
    {
        return $this->puesto;
    }

    public function setPuesto(?string $puesto): self
    {
        $this->puesto = $puesto;

        return $this;
    }

    public function getCodigojefe(): ?self
    {
        return $this->codigojefe;
    }

    public function setCodigojefe(?self $codigojefe): self
    {
        $this->codigojefe = $codigojefe;

        return $this;
    }

    public function getCodigooficina(): ?Oficinas
    {
        return $this->codigooficina;
    }

    public function setCodigooficina(?Oficinas $codigooficina): self
    {
        $this->codigooficina = $codigooficina;

        return $this;
    }
}
