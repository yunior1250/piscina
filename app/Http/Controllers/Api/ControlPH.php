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
        //return "asddadas";
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store("piscina", 's3');
            Storage::disk('s3')->url($path);
            return response()->json(['message' => 'Archivos Subidos con exito']);
        }

        return response()->json(['message' => 'Error al subir el archivo']);
    }

    public function ImagePropeties()
    {
        //return "hola";
        $client = new RekognitionClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
        ]);

        $results = $client->detectLabels([
            'Image' => [
                'S3Object' => [
                    //'Bucket' => env('AWS_BUCKET'), //'sw1-proyects',
                    'Name' => 'https://i.blogs.es/466006/screenshot_8094/1366_2000.jpeg' //$img1,
                ],
            ],
            'Features' => [
                "IMAGE_PROPERTIES"
            ],
            "Settings" => [
                "ImageProperties" => [
                    "MaxDominantColors" => 5
                ]
            ]
        ]);

        $resultLabels = $results->get('Labels');
        return $resultLabels;
    }
}
