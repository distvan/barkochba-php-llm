<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Application\Contracts\AIAssistant as AIAssistantInterface;
use App\Application\Services\AIAssistant as AIAssistantService;
use App\Domain\Contracts\Storage as StorageInterface;
use App\Infrastructure\Http\Curl\CurlHttpClient;
use App\Infrastructure\Http\Curl\CurlRequestOptionsBuilder;
use App\Infrastructure\Http\Curl\CurlResponseParser;
use App\Infrastructure\LLM\LLMClient;
use App\Shared\Contracts\ServiceProvider;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use App\Infrastructure\Http\Curl\CurlExecutor;

class AIAssistantServiceProvider implements ServiceProvider
{
    public function register(ContainerInterface $container): void
    {
        if (method_exists($container, 'bind')) {
            $container->bind(
                AIAssistantInterface::class,
                function ($container) {
                    $apiKey = !empty($_ENV["AI_ASSISTANT_KEY"]) ? $_ENV["AI_ASSISTANT_KEY"] : "";
                    $apiUrl = !empty($_ENV["AI_ASSISTANT_URL"]) ? $_ENV["AI_ASSISTANT_URL"] : "";
                    $factory = new Psr17Factory();
                    $executor = new CurlExecutor();
                    $responseParser = new CurlResponseParser($factory, $factory, $executor);
                    $httpClient = new CurlHttpClient(
                        new CurlRequestOptionsBuilder(),
                        $executor,
                        $responseParser
                    );
                    $dependency = new LLMClient($httpClient, $factory, $factory, $apiKey, $apiUrl);
                    return new AIAssistantService($dependency, $container->get(StorageInterface::class));
                }
            );
        }
    }
}
