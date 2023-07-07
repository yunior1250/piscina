<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;


//use App\Http\Controllers\Api\RekognitionClient;

class ControlPH extends Controller
{

    public function postFoto(Request $request)
    {
        //return 'asddadas';
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('piscina', 's3');
            $urlPH=Storage::disk('s3')->url($path);
            $urlCL=Storage::disk('s3')->url($path);
            $DominantColorsPH=$this->ImagePropeties($urlPH);
            $DominantColorsCL=$this->ImagePropeties($urlCL);
            $PHinicial=$this->CalculatePH($DominantColorsPH);
            $CLinicial=$this->CalculateCL($DominantColorsCL);
            return response()->json(['message' => 'Archivos Subidos con exito']);
        }

        return response()->json(['message' => 'Error al subir el archivo']);
    }

    public function ImagePropeties(Request $request)
    {
        $img=substr($request->url,38,strlen($request->url));
        return $img;
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
   
}
