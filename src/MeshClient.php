<?php

namespace GenticsMeshRestApi\Raml;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\OAuth2\Client\Provider\AbstractProvider;
use Psr\Cache\CacheItemPoolInterface;

class MeshClient extends HttpClient {

    public function __construct(array $config = [], AbstractProvider $oauthProvider = null, CacheItemPoolInterface $cache = null)
    {
        if (!isset($config['handler'])) {
            $config['handler'] = HandlerStack::create();
        }
        if (!isset($config['credentials'])) {
            $config['credentials'] = [];
        }
        if (is_null($cache)) {
            $filesystemAdapter = new Local(__DIR__.'/../');
            $filesystem        = new Filesystem($filesystemAdapter);
            $cache = new FilesystemCachePool($filesystem);
        }

        parent::__construct($config);
    }
    
    private function getHandler($name, $config, $accessTokenUrl, $authorizeUrl, CacheItemPoolInterface $cache, AbstractProvider $provider = null) {
        $credentials = isset($config['credentials'][$name]) ? $config['credentials'][$name] : $config['credentials'];
        if (isset($config['providers'][$name])) {
            $provider = $config['providers'][$name];
        }
        if (is_null($provider)) {
            $provider = new TokenProvider(
                array_merge(
                    [
                        'urlAccessToken' => $accessTokenUrl,
                        'urlAuthorize' => $authorizeUrl,
                    ],
                    $credentials
                )
            );
        }
        return new OAuth2Handler($name, $provider, $cache);
    }
}

