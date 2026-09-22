<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "API Segura de E-commerce",
    description: "Documentación oficial de la API de Comercio Electrónico desarrollada con Laravel 12",
    contact: new OA\Contact(email: "tu-email@ejemplo.com")
)]

#[OA\Server(
    url: "/api",
    description: "Servidor Local de la API"
)]

#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT"
)]
class SwaggerConfig
{
    // Este archivo centraliza la configuración global mediante Atributos nativos de PHP
}
