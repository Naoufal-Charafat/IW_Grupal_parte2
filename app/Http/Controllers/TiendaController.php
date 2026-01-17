<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
// Importamos el controlador que queremos inyectar
use App\Http\Controllers\TiendaControllerApiRest;

class TiendaController extends Controller
{
    protected $apiController;
    public function __construct(TiendaControllerApiRest $apiController)
    {
        $this->apiController = $apiController;
    }

    public function index(Request $request)
    {
        // ---------------------------------------------------------
        // PASO 1: OBTENER DATOS USANDO LA INSTANCIA INYECTADA
        // ---------------------------------------------------------
        try {
            // Creamos la request interna
            $internalRequest = Request::create('/api/tienda/productos', 'GET', ['idCategoria' => 3]);

            // USAMOS $this->apiController EN LUGAR DE 'new ...'
            $response = $this->apiController->getProductos($internalRequest);

            // getData(true) convierte la respuesta JSON en Array PHP
            $contenido = $response->getData(true);
            $productos = collect($contenido);

        } catch (\Exception $e) {
            $productos = collect([]);
        }

        // ---------------------------------------------------------
        // PASO 2: FILTROS
        // ---------------------------------------------------------

        if ($request->filled('buscar')) {
            $busqueda = mb_strtolower($request->buscar);
            $productos = $productos->filter(function ($item) use ($busqueda) {
                $nombre = mb_strtolower($item['nombre'] ?? '');
                $marca = mb_strtolower($item['marca'] ?? '');
                return str_contains($nombre, $busqueda) || str_contains($marca, $busqueda);
            });
        }

        if ($request->filled('precio_min')) {
            $productos = $productos->where('precio', '>=', (float)$request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $productos = $productos->where('precio', '<=', (float)$request->precio_max);
        }

        // ---------------------------------------------------------
        // PASO 3: PAGINACIÓN
        // ---------------------------------------------------------
        $perPage = 6;
        $page = Paginator::resolveCurrentPage() ?: 1;

        $items = $productos->values()->forPage($page, $perPage);

        $paginatedProductos = new LengthAwarePaginator(
            $items,
            $productos->count(),
            $perPage,
            $page,
            [
                'path' => route('tienda.index', [], false),
                'query' => $request->query()
            ]
        );

        return view('tienda.index', ['productos' => $paginatedProductos]);
    }
}