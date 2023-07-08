<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\prueba;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;


//use App\Http\Controllers\Api\RekognitionClient;

class ControlPH extends Controller
{

    public function postFoto(Request $request)
    {
        if ($request->hasFile('urlPH') && $request->hasFile('urlCL')) {
            $prueba = new prueba();
            
            $path = $request->file('urlPH')->store('piscina', 's3');
            $prueba->urlPH = Storage::disk('s3')->url($path);
            
            $path = $request->file('urlCL')->store('piscina', 's3');
            $prueba->urlCL = Storage::disk('s3')->url($path);
            
            $DominantColorsPH = $this->ImagePropeties($prueba->urlPH);
            return $DominantColorsPH;
            $DominantColorsCL = $this->ImagePropeties($prueba->urlCL);
            
            $prueba->ph_inicial = $this->CalculatePH($DominantColorsPH);
            $prueba->cl_inicial = $this->CalculateCL($DominantColorsCL);
            
            $prueba->save();
            return $prueba;
        }
        return response()->json(['message' => 'Error al subir el archivo']);
    }

    private function ImagePropeties($url)
    {
        $img = substr($url, 38, strlen($url));
        return $img;
        $client = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);

        $results = $client->detectLabels([
            'Image' => [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'), //'sw1-proyects',
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
            }
        }
        return $ph;
    }

    private function CalculateCL($colors)
    {
        $cl = 0;
        foreach ($colors as $color) {
            if ($color['CSSColor'] === 'saddlebrown') {
                $cl = 3;
            } else if ($color['CSSColor'] === 'sienna') {
                $cl = 5;
            }
        }
        return $cl;
    }
   
}
