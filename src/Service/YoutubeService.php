<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Programa;
use App\Entity\Columna;
use App\Entity\Vlog;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class YoutubeService {

    public string $apiKey;
    
    private $youtubeApiUrl = 'https://www.googleapis.com/youtube/v3/playlistItems';

    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager, string $apiKey, private readonly LoggerInterface $logger) {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
        $this->apiKey = $apiKey;
        
    }

    public function getProgramasFromPlaylist(string $playlistId): array {
        $programas = [];
        $nextPageToken = null;
        
        do {
            $url = sprintf(
                '%s?part=snippet&playlistId=%s&maxResults=50&key=%s%s',
                $this->youtubeApiUrl,
                $playlistId,
                $this->apiKey,
                $nextPageToken ? '&pageToken=' . $nextPageToken : ''
            );

            try {
                $response = $this->httpClient->request('GET', $url);
                $data = $response->toArray();
            } catch (\Exception $e) {
                throw new \RuntimeException('Error al comunicarse con la API de YouTube: ' . $e->getMessage());
            }

            if (isset($data['items'])) {
                foreach ($data['items'] as $item) {
                    $snippet = $item['snippet'];
                    $programa = new Programa();
                    $programa->setTitulo($snippet['title']);
                    $programa->setFecha(new \DateTime($snippet['publishedAt']));
                    $programa->setLinkYoutube('https://www.youtube.com/watch?v='.$snippet['resourceId']['videoId']);
                    $programa->setMiniatura($snippet['thumbnails']['maxres']['url']);

                    array_unshift($programas, $programa);
                }
            }

            $nextPageToken = $data['nextPageToken'] ?? null;

        } while ($nextPageToken);

        return $programas;
    }

    public function getVlogsFromPLaylist(string $playlistId): array {
        $vlogs = [];
        $nextPageToken = null;

        do {
            $url = sprintf(
                '%s?part=snippet&playlistId=%s&maxResults=50&key=%s%s',
                $this->youtubeApiUrl,
                $playlistId,
                $this->apiKey,
                $nextPageToken ? '&pageToken=' . $nextPageToken : ''
            );

            try {
                $response = $this->httpClient->request('GET', $url);
                $data = $response->toArray();
            } catch (\Exception $e) {
                throw new \RuntimeException('Error al comunicarse con la API de YouTube: ' . $e->getMessage());
            }

            if (isset($data['items'])) {
                foreach ($data['items'] as $item) {
                    $snippet = $item['snippet'];
                    $vlog = new Vlog();
                    $vlog->setTitulo($snippet['title']);
                    $vlog->setMiniatura($snippet['thumbnails']['high']['url']);
                    if (isset($snippet['thumbnails']['maxres']['url'])) {
                        $vlog->setMiniatura($snippet['thumbnails']['maxres']['url']);
                    } elseif (isset($snippet['thumbnails']['medium']['url'])) {
                        $vlog->setMiniatura($snippet['thumbnails']['medium']['url']);
                    } elseif (isset($snippet['thumbnails']['default']['url'])) {
                        $vlog->setMiniatura($snippet['thumbnails']['default']['url']);
                    } else {
                        $vlog->setMiniatura(null);
                    }
                    
                    array_unshift($vlogs, $vlog);
                }
            }

            $nextPageToken = $data['nextPageToken'] ?? null;

        } while ($nextPageToken);
        
        return $vlogs;
    }

    public function getColumnasFromPlaylist(string $playlistId): array {
        $columnas = [];
        $nextPageToken = null;

        do {
            $url = sprintf(
                '%s?part=snippet&playlistId=%s&maxResults=50&key=%s%s',
                $this->youtubeApiUrl,
                $playlistId,
                $this->apiKey,
                $nextPageToken ? '&pageToken=' . $nextPageToken : ''
            );

            try {
                $response = $this->httpClient->request('GET', $url);
                $data = $response->toArray();
            } catch (\Exception $e) {
                throw new \RuntimeException('Error al comunicarse con la API de YouTube: ' . $e->getMessage());
            }

            if (isset($data['items'])) {
                foreach ($data['items'] as $item) {
                    $snippet = $item['snippet'];
                    $columna = new Columna();
                    $columna->setTitulo($snippet['title']);
                    $columna->setLink('https://www.youtube.com/watch?v='.$snippet['resourceId']['videoId']);
                    
                    array_unshift($columnas, $columna);
                }
            }

            $nextPageToken = $data['nextPageToken'] ?? null;

        } while ($nextPageToken);
    
        return $columnas;
    }
}