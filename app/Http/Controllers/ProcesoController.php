<?php

namespace App\Http\Controllers;

use App\Models\Piscina;
use App\Models\Proceso;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcesoController extends Controller
{
    public function index()
    {
        $procesos = Proceso::all();
        $piscinas = Piscina::all();

        return view('procesos.index', compact('procesos', 'piscinas'));
    }

    public function create()
    {
        $piscinas = Piscina::all();
        //    $users = User::all();
        return view('procesos.create', compact('piscinas'));
    }

    public function store(Request $request)
    {
        $proceso = new Proceso();
        $proceso->nombre = $request->nombreproceso;
        $proceso->descripcion = $request->descripcionproceso;

        $proceso->ph_esperado = $request->ph_esperado; //imput fijos

        $proceso->cloro_esperado = $request->cloro_esperado; //imput fijos

        $proceso->volumen_pro = $request->input('volumen_pro'); //input variable

        $path = $request->file('urlPH')->store('piscina', 's3'); //guardar las imagenes del ph  en s3
        $proceso->urlPH = Storage::disk('s3')->url($path);
        $path2 = $request->file('urlCL')->store('piscina', 's3'); //guardar las imagenes del cloro en s3
        $proceso->urlCL = Storage::disk('s3')->url($path2);

        $DominantColorsPH = $this->ImagePropeties($proceso->urlPH); //obtener los colores dominantes de la imagen del ph
        $DominantColorsCL = $this->ImagePropeties($proceso->urlCL);

        $proceso->ph_inicial = $this->CalculatePH($DominantColorsPH); //funcion de identificacion de colores de PH
        $proceso->cloro_inicial = $this->CalculateCL($DominantColorsCL); //funcion de identificacion de colores de CL



        $proceso->ph_final = $proceso->calcularCantidadpH(); //calcular la cantidad de ph
        $proceso->cloro_final = $proceso->calcularCantidadCloro(); //calcular la cantidad de cloro
        $proceso->save();

        return redirect()->route('procesos.index');
    }

    private function ImagePropeties($url)
    {

        $img = substr($url, 38, strlen($url));
        $client = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);

        $results = $client->detectLabels([
            'Image' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'), //'sw2-proyects',
                    'Name' => $img, //'piscina/deU3rkxk1Vw5BoI2MJYkKO6MRNMBF6myJDFPb3DC.jpg' 
                ],
            ],
            'Features' => [
                'IMAGE_PROPERTIES'
            ],
            'Settings' => [
                'ImageProperties' => [
                    'MaxDominantColors' => 5
                ]
            ]
        ]);
        //return $results;
        $resultLabels = $results->get('ImageProperties');
        //return $resultLabels['DominantColors'];
        return $resultLabels['DominantColors'];
    }

    private function CalculatePH($colors)
    {
        $ph = 0;
        foreach ($colors as $color) {
            if ($color['CSSColor'] === 'mediumvioletred') {
                $ph = 7.8;
            } else if ($color['CSSColor'] === 'thistle') {
                $ph = 7.6;
            } else if ($color['CSSColor'] === 'palevioletred') {
                $ph = 7.4;
            } else if ($color['CSSColor'] === 'sienna') {
                $ph = 6.8;
            }
        }
        return $ph;
    }


    
    private function CalculateCL($colors)
    {
        $cl = 0;
        foreach ($colors as $color) {
           if ($color['CSSColor'] === 'darkgrey') {
                $cl = 0.5;
            }else if ($color['CSSColor'] === 'sienna') {
                $cl = 5;
            } else if ($color['CSSColor'] === 'gainsboro') {
                $cl = 1;
            }else if ($color['CSSColor'] === 'darkkhaki') {
                $cl = 1.5;
            }else if ($color['CSSColor'] === 'goldenrod') {
                $cl = 2;
            }else if ($color['CSSColor'] === 'saddlebrown') {
                $cl = 3;
            }
        }
        return $cl;
    }
  //  goldenrod
    public function show(Proceso $reserva)
    {
        return view('procesos.show', compact('proceso'));
    }

    public function edit(Proceso $reserva)
    {
        return view('procesos.edit', compact('proceso'));
    }

    public function update(Request $request, Proceso $reserva)
    {
        $reserva->update($request->all());
        return redirect()->route('procesos.index');
    }

    public function destroy(Proceso $reserva)
    {
        $reserva->delete();
        return redirect()->route('procesos.index');
    }
}


