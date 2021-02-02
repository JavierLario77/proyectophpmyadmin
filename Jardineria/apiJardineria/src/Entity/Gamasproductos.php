<?php

namespace App\Entity;

class Gamasproductos
{
    private $gama;

    private $descripciontexto;

    private $descripcionhtml;

    private $icono;

    public function getGama(): ?string
    {
        return $this->gama;
    }

    public function getDescripciontexto(): ?string
    {
        return $this->descripciontexto;
    }

    public function setDescripciontexto(?string $descripciontexto): self
    {
        $this->descripciontexto = $descripciontexto;

        return $this;
    }

    public function getDescripcionhtml(): ?string
    {
        return $this->descripcionhtml;
    }

    public function setDescripcionhtml(?string $descripcionhtml): self
    {
        $this->descripcionhtml = $descripcionhtml;

        return $this;
    }

    public function getIcono(): ?string
    {
        return $this->icono;
    }

    public function setIcono(string $icono): self
    {
        $this->icono = $icono;

        return $this;
    }
}
