<?php
/**
 * Clase abstracta Accommodation
 * Representa un hospedaje genérico (hotel o apartamento).
 * Define propiedades comunes: id, nombre, ciudad, provincia.
 */
abstract class Accommodation
{
    protected int $id;
    protected string $name;
    protected string $city;
    protected string $province;

    public function __construct(int $id, string $name, string $city, string $province)
    {
        $this->id = $id;
        $this->name = $name;
        $this->city = $city;
        $this->province = $province;
    }

    // Debe devolver los datos en formato array
    abstract public function formatData(): array;
}