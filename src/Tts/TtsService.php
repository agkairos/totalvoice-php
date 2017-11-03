<?php
namespace TotalVoice\Tts;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class TtsService
{
    /**
     * @var string
     */
    const ROTA_TTS = '/tts/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Envia um TTS (text-to-speach) para um número destino
     * @param string $numero_destino
     * @param string $mensagem
     * @param string $velocidade
     * @param bool   $resposta_usuario
     * @param string $tipo_voz
     * @param string $bina
     * @return mixed
     */
    public function enviar($numero_destino, $mensagem, $velocidade = null, $resposta_usuario = false, $tipo_voz = null, $bina = null)
    {
        return $this->client->post(
            new Route([self::ROTA_TTS]), [
                'numero_destino'    => $numero_destino,
                'mensagem'          => $mensagem,
                'velocidade'        => $velocidade,
                'resposta_usuario'  => $resposta_usuario,
                'tipo_voz'          => $tipo_voz,
                'bina'              => $bina
            ]
        );
    }

    /**
     * Busca um tts pelo seu ID
     * @param $id
     * @return string
     */
    public function buscaTts($id)
    {
        return $this->client->get(new Route([self::ROTA_TTS, $id]));
    }

    /**
     * Relatório de mensagens de Tts
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return string
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_TTS, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }
}