<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiendaControllerApiRest extends Controller
{
    /**
     * Simula una base de datos de productos para el ejercicio
     */
    private $productos = [
        // --- RUNNING (ID Categoria: 2) ---
        [
            "id" => 25,
            "nombre" => "Zapatillas Nike Air",
            "referencia" => "NK-AIR-01",
            "precio" => 89.99,
            "marca" => "Nike",
            "genero" => "Unisex",
            "categoria_id" => 2,
            "descripcionCorta" => "Zapatillas deportivas",
            "descripcionLarga" => "Zapatillas ideales para running con amortiguación mejorada.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Nike+Air",
            "url" => "https://www.decathlon.es"
        ],
        [
            "id" => 26,
            "nombre" => "Camiseta Adidas Run",
            "referencia" => "AD-RUN-55",
            "precio" => 25.50,
            "marca" => "Adidas",
            "genero" => "Hombre",
            "categoria_id" => 2,
            "descripcionCorta" => "Camiseta técnica",
            "descripcionLarga" => "Camiseta transpirable para correr en climas cálidos.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Adidas+Run",
            "url" => "https://www.decathlon.es"
        ],

        // --- FISIOTERAPIA (ID Categoria: 3) ---
        [
            "id" => 27,
            "nombre" => "Vendaje Neuromuscular Kinesio",
            "referencia" => "PHYS-TAPE-01",
            "precio" => 12.50,
            "marca" => "KT Tape",
            "genero" => "Unisex",
            "categoria_id" => 3,
            "descripcionCorta" => "Cinta elástica terapéutica",
            "descripcionLarga" => "Rollo de 5m resistente al agua para alivio del dolor muscular.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Kinesio+Tape",
            "url" => "https://www.decathlon.es"
        ],
        [
            "id" => 28,
            "nombre" => "Electroestimulador TENS Digital",
            "referencia" => "ELEC-TENS-X2",
            "precio" => 45.99,
            "marca" => "Beurer",
            "genero" => "Unisex",
            "categoria_id" => 3,
            "descripcionCorta" => "Dispositivo para alivio del dolor",
            "descripcionLarga" => "Electroestimulador de 2 canales con 4 electrodos autoadhesivos incluidos.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=TENS+Digital",
            "url" => "https://www.decathlon.es"
        ],
        [
            "id" => 29,
            "nombre" => "Rodillo de Masaje Foam Roller",
            "referencia" => "RECO-ROLL-33",
            "precio" => 19.99,
            "marca" => "Blackroll",
            "genero" => "Unisex",
            "categoria_id" => 3,
            "descripcionCorta" => "Rodillo para liberación miofascial",
            "descripcionLarga" => "Herramienta ideal para el auto-masaje y recuperación post-entreno.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Foam+Roller",
            "url" => "https://www.decathlon.es"
        ],
        [
            "id" => 30,
            "nombre" => "Crema de Masaje Efecto Calor",
            "referencia" => "CRM-HEAT-500",
            "precio" => 15.75,
            "marca" => "PhysioRelax",
            "genero" => "Unisex",
            "categoria_id" => 3,
            "descripcionCorta" => "Crema térmica 500ml",
            "descripcionLarga" => "Crema profesional de efecto calor intenso para calentar músculos.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Crema+Calor",
            "url" => "https://www.decathlon.es"
        ],
        [
            "id" => 31,
            "nombre" => "Set Bandas de Resistencia",
            "referencia" => "THER-BAND-SET",
            "precio" => 14.90,
            "marca" => "TheraBand",
            "genero" => "Unisex",
            "categoria_id" => 3,
            "descripcionCorta" => "Pack de 3 gomas elásticas",
            "descripcionLarga" => "Set de bandas de látex para rehabilitación y fortalecimiento.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Bandas+Resistencia",
            "url" => "https://www.decathlon.es"
        ],
        [
            "id" => 34,
            "nombre" => "Pistola de Masaje Percusión",
            "referencia" => "MASS-GUN-PRO",
            "precio" => 79.95,
            "marca" => "Hyperice",
            "genero" => "Unisex",
            "categoria_id" => 3,
            "descripcionCorta" => "Masajeador muscular profundo",
            "descripcionLarga" => "Pistola de masaje con 4 cabezales intercambiables y 3 velocidades.",
            "disponibilidad" => true,
            "imagen" => "https://placehold.co/400x400?text=Pistola+Masaje",
            "url" => "https://www.decathlon.es"
        ]
    ];

    /**
     * GET /productos
     * Soporta filtro ?idCategoria=int
     */
    public function getProductos(Request $request)
    {
        $resultado = $this->productos;

        if ($request->has('idCategoria')) {
            $idCategoriaBuscada = (int) $request->query('idCategoria');

            $resultado = array_values(array_filter($this->productos, function($p) use ($idCategoriaBuscada) {
                // Usamos isset para evitar errores si falta la clave categoria_id
                return isset($p['categoria_id']) && (int)$p['categoria_id'] === $idCategoriaBuscada;
            }));
        }

        $respuesta = array_map(function($p) {
            return [
                "id" => $p['id'],
                "nombre" => $p['nombre'],
                "referencia" => $p['referencia'],
                "precio" => $p['precio'],
                "marca" => $p['marca'],
                "genero" => $p['genero'],
                // AQUI ESTABA EL ERROR: Usamos '??' por seguridad
                "descripcionCorta" => $p['descripcionCorta'] ?? '',
                "imagen" => $p['imagen'] ?? 'https://placehold.co/400x400?text=No+Image',
                "url" => $p['url'] ?? '#'
            ];
        }, $resultado);

        return response()->json($respuesta);
    }
}