<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $ofertas;
    private $seleccion;
    private $topventas;

    public function __construct()
    {
        $this->init_variables();
    }

    public function init_variables()
    {
        // Ofertas guardadas en un array asociativo
        $this->ofertas = [
            ['id' => 1, 'nombre' => 'MDMA', 'descripcion' => 'MDMA (Éxtasis o Molly): Es una droga psicoactiva sintética que combina efectos estimulantes y empatógenos. Aumenta la liberación de serotonina, dopamina y norepinefrina en el cerebro, lo que produce sensaciones de euforia, empatía, y mayor energía. Se suele consumir en fiestas o eventos sociales.', 'precio' => 100, 'imagen' => 'producto1.jpeg'],
            ['id' => 2, 'nombre' => 'KETAMINA', 'descripcion' => 'Ketamina: Es un anestésico disociativo usado en medicina y veterinaria. En dosis recreativas, provoca efectos alucinógenos, despersonalización y sensación de distanciamiento de la realidad. Se ha estudiado en tratamientos para la depresión resistente.', 'precio' => 150, 'imagen' => 'producto2.jpeg']
        ];

        // Selección guardada como un string JSON
        $jsonSeleccion = '[
            {"id": 3, "nombre": "MARIJUANA", "descripcion": "Marihuana: Droga psicoactiva derivada de la planta Cannabis sativa. Contiene THC (tetrahidrocannabinol), responsable de los efectos que alteran la percepción, relajación y a veces ansiedad. Se utiliza recreativamente y también tiene aplicaciones medicinales.", "precio": 200, "imagen": "producto3.jpeg"},
            {"id": 4, "nombre": "MERKA", "descripcion": "Cocaína: Un estimulante potente derivado de la planta de coca. Produce un aumento rápido de energía, euforia, y una mayor sensación de alerta, debido a su acción en la dopamina. Su consumo prolongado puede llevar a la adicción y graves consecuencias para la salud.", "precio": 250, "imagen": "producto4.jpeg"}
        ]';
        $this->seleccion = json_decode($jsonSeleccion, true); // Decodificamos el JSON

        // Top Ventas guardado como un array de objetos Producto
        $this->topventas = [
            new Producto(5, 'HASHHH', 'Hachís: Derivado de la resina de la planta de cannabis, contiene concentraciones altas de THC. Sus efectos son similares a los de la marihuana, pero más potentes, incluyendo relajación, alteraciones sensoriales y, en algunos casos, efectos ansiolíticos o psicoactivos más intensos.

', 300, 'producto5.jpeg'),
            new Producto(6, 'FENTANILO', 'Fentanilo: Un opioide sintético extremadamente potente, usado en medicina para tratar el dolor severo. En el mercado ilegal, se ha asociado con sobredosis debido a su alta potencia. Es entre 50 y 100 veces más potente que la morfina.', 350, 'producto6.jpeg')
        ];
    }

    public function index()
    {
        return view('all', [
            'ofertas' => $this->ofertas,
            'seleccion' => $this->seleccion,
            'topventas' => $this->topventas,
        ]);
    }

    public function ofertas()
    {
        return view('ofertas', ['productos' => $this->ofertas]);
    }

    public function seleccion()
    {
        return view('seleccion', ['productos' => $this->seleccion]);
    }

    public function topVentas()
    {
        return view('topventas', ['productos' => $this->topventas]);
    }

    public function verProducto($productoid)
    {
        // Buscamos el producto en todos los catálogos
        $producto = collect($this->ofertas)
            ->merge($this->seleccion)
            ->merge($this->topventas)
            ->firstWhere('id', $productoid);

        if (!$producto) {
            abort(404);
        }

        return view('producto', ['producto' => (object)$producto]);
    }

            /*    Controlador modificado para API
            namespace App\Http\Controllers;

        use App\Models\Producto;
        use Illuminate\Http\Request;

        class ProductController extends Controller
        {
            private $ofertas;
            private $seleccion;
            private $topventas;

            public function __construct()
            {
                $this->init_variables();
            }

            public function init_variables()
            {
                $this->ofertas = [
                    ['id' => 1, 'nombre' => 'Producto A', 'descripcion' => 'Descripción de Producto A', 'precio' => 100, 'imagen' => 'producto1.jpeg'],
                    ['id' => 2, 'nombre' => 'Producto B', 'descripcion' => 'Descripción de Producto B', 'precio' => 150, 'imagen' => 'producto2.jpeg']
                ];

                $jsonSeleccion = '[
                    {"id": 3, "nombre": "Producto C", "descripcion": "Descripción de Producto C", "precio": 200, "imagen": "producto3.jpeg"},
                    {"id": 4, "nombre": "Producto D", "descripcion": "Descripción de Producto D", "precio": 250, "imagen": "producto4.jpeg"}
                ]';
                $this->seleccion = json_decode($jsonSeleccion, true);

                $this->topventas = [
                    new Producto(5, 'Producto E', 'Descripción de Producto E', 300, 'producto5.jpeg'),
                    new Producto(6, 'Producto F', 'Descripción de Producto F', 350, 'producto6.jpeg')
                ];
            }

            // Método API para obtener todos los catálogos juntos
            public function apiIndex()
            {
                return response()->json([
                    'ofertas' => $this->ofertas,
                    'seleccion' => $this->seleccion,
                    'topventas' => $this->topventas,
                ], 200);
            }

            // Método API para obtener productos de Ofertas
            public function apiOfertas()
            {
                return response()->json($this->ofertas, 200);
            }

            // Método API para obtener productos de Selección
            public function apiSeleccion()
            {
                return response()->json($this->seleccion, 200);
            }

            // Método API para obtener productos de Top Ventas
            public function apiTopVentas()
            {
                return response()->json($this->topventas, 200);
            }

            // Método API para obtener un producto específico por su ID
            public function apiVerProducto($productoid)
            {
                $producto = collect($this->ofertas)
                    ->merge($this->seleccion)
                    ->merge($this->topventas)
                    ->firstWhere('id', $productoid);

                if (!$producto) {
                    return response()->json(['error' => 'Producto no encontrado'], 404);
                }

                return response()->json($producto, 200);
            }
        }




            */
}
