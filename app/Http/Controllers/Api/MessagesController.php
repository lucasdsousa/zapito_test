<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Client;

class MessagesController extends Controller
{
    public function index()
    {
      return view('form');
    }
  
    public function getNews()
    {
        $token = 'H9kAAJ1YcO2t6ALBWiVwlg1D7D4WD9p3DcX6gddXrU11TCp1YLJLnlxC2YS7';

        $client = new GuzzleHttp\Client();

        $bots = json_decode($client->request('GET', 'https://zapito.com.br/api/bots', [
            'headers' => [
                'accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ])->getBody(), true);

        $g1 = json_decode($client->request('GET', 'https://g1.globo.com/rss/g1/', [
          'headers' => [
              'accept' => 'application/json',
              'Authorization' => 'Bearer ' . $token
          ]
        ])->getBody(), true);

        dd($g1);

        return view('test', compact('bots'));
    }

    public function sendMessage()
    {
        $token = 'H9kAAJ1YcO2t6ALBWiVwlg1D7D4WD9p3DcX6gddXrU11TCp1YLJLnlxC2YS7';

        $client = new GuzzleHttp\Client();

        $message = array(
            "test_mode" => true,
            "data" => [
              [
                "phone" => "75983014336",
                "message" => "Mensagem de teste 1",
                "test_mode" => true
              ],
              [
                "phone" => "5575983014336",
                "message" => "Olá mundo!\n *Negrito* _itálico_ e EMOJIs: 🤖",
                "bot_id" => 11627,
                "file" => [
                  "url" => "https://via.placeholder.com/400",
                  "name" => "arquivo_exemplo.png",
                  "headers" => [
                    "X-Custom-Header" => "valor_custom_header"
              ],
                  "optional" => false
            ],
                "meta" => "Opcional - Não utilizado pelo Zapito"
              ]
            ]
          );

        $client->request('POST', 'https://zapito.com.br/api/messages', [
          'headers' => [
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
          ],
          'json' => $message
        ]);

        return view('test', compact('message'));
    }
}
