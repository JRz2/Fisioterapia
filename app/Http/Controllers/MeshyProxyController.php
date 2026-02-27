<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imgconsulta;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;

class MeshyProxyController extends Controller
{

    public function model(Imgconsulta $imgconsulta, $format = 'glb')
    {
        $res = $imgconsulta->meshy_result ?? null;
        $modelUrl = $res['model_urls'][$format] ?? $res['model_urls']['glb'] ?? null;

        if (! $modelUrl) {
            Log::warning('MeshyProxy: modelo no disponible', ['imgconsulta' => $imgconsulta->id]);
            return response('Modelo no disponible', 404);
        }

        $client = new Client(['timeout' => 120, 'connect_timeout' => 10]);
        try {
            $g = $client->request('GET', $modelUrl, [
                'stream' => true,
                'headers' => [
                    'Accept' => '*/*',
                    'User-Agent' => 'Laravel-Meshy-Proxy/1.0',
                ],
                'allow_redirects' => true,
            ]);
        } catch (RequestException $e) {
            Log::error('MeshyProxy request failed', [
                'imgconsulta' => $imgconsulta->id,
                'url' => $modelUrl,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
            $body = $e->hasResponse() ? substr((string) $e->getResponse()->getBody(), 0, 1000) : '';
            return response("Remote fetch failed: {$e->getMessage()}\n\nRemote body: {$body}", 502);
        }

        if ($g->getStatusCode() !== 200) {
            Log::warning('MeshyProxy remote non-200', ['status' => $g->getStatusCode(), 'imgconsulta' => $imgconsulta->id]);
            return response("Remote status {$g->getStatusCode()}", 502);
        }

        $contentType = $g->getHeaderLine('Content-Type') ?: 'application/octet-stream';

        if ($format === 'glb') {
            $contentType = 'model/gltf-binary';
        }

        $contentLength = $g->getHeaderLine('Content-Length') ?: null;

        $stream = function () use ($g) {
            $body = $g->getBody();
            while (! $body->eof()) {
                echo $body->read(1024 * 8);
                flush();
            }
        };

        $headers = [
            'Content-Type' => $contentType,
            'Access-Control-Allow-Origin' => '*',
            'Cache-Control' => 'public, max-age=3600',
        ];
        if ($contentLength) $headers['Content-Length'] = $contentLength;

        return new StreamedResponse($stream, 200, $headers);
    }
}
