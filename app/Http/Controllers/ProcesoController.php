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
        /*$proceso->nombre = $request->nombreproceso;
        $proceso->descripcion = $request->descripcionproceso;
        //$proceso->ph_inicial = $request->ph_inicial;
        $proceso->ph_esperado = $request->ph_esperado;
        //$proceso->cloro_inicial = $request->cloro_inicial;
        $proceso->cloro_esperado = $request->cloro_esperado;
        $proceso->cloro_final = $request->cloro_final;
        $proceso->ph_final = $request->ph_final;
        $proceso->urlPH = $request->urlPH;
        
        $proceso->urlCL = $request->urlCL;
        $proceso->voljmen_pro = $request->volumen_pro;
        $proceso->voljmen_pro = $request->volumen_pro;*/

        $path = $request->file('urlPH')->store('piscina', 's3');
        $proceso->urlPH = Storage::disk('s3')->url($path);
        $path2 = $request->file('urlCL')->store('piscina', 's3');
        $proceso->urlCL = Storage::disk('s3')->url($path2);

        $DominantColorsPH = $this->ImagePropeties($proceso->urlPH);
        $DominantColorsCL = $this->ImagePropeties($proceso->urlCL);

        $proceso->ph_inicial =$this->CalculatePH($DominantColorsPH);
        $proceso->cloro_inicial =$this->CalculateCL($DominantColorsCL);

        /*$proceso->fecha_fin = $request->fechafinreserva;
        // $ambiente->imagen = $request->archivoambiente;
        //   $ambiente->organizadorId = Auth::user()->id;
        if ($request->hasFile('archivoambiente')) {
            $imagen = $request->file('archivoambiente');
            $rutaImagen = $imagen->store('public/imagenes'); // Cambia la ruta según tus necesidades
            $proceso->imagen = $rutaImagen;
        }
        //$sucursal = Sucursal::findOrFail($request->sucursal);
        $proceso->piscina_id = $request->input('piscina_id');*/
        $proceso->save();

        return redirect()->route('procesos.index');
    }

    private function ImagePropeties($url)
    {
        //$url= 'https://sw1-proyects.s3.amazonaws.com/piscina/KjOgujZwnZ2IZ5TvpCCwy2DXYnx5iTPuiveGkoQ7.jpg';
        $img=substr($url,38,strlen($url));        
        $client = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);

        $results = $client->detectLabels([
            'Image' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'), //'sw1-proyects',
                    'Name' => $img,//'piscina/deU3rkxk1Vw5BoI2MJYkKO6MRNMBF6myJDFPb3DC.jpg' 
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

    private function CalculatePH($colors){      
        $ph=0;  
        foreach ($colors as $color) {
            if($color['CSSColor'] === 'mediumvioletred') {
                $ph= 7.8;
            }else if ($color['CSSColor'] === 'thistle') {
                $ph= 7.6;
            }else if ($color['CSSColor'] === 'palevioletred') {
                $ph = 7.4;
            }
        }
        return $ph;
    }

    private function CalculateCL($colors){        
        $cl=0;
        foreach ($colors as $color) {
            if ($color['CSSColor'] === 'saddlebrown') {
                $cl= 3;
            } else if ($color['CSSColor'] === 'sienna') {
                $cl= 5;
            }
        }
        return $cl;
    }

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
