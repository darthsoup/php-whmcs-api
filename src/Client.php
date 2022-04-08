<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi;

use DarthSoup\WhmcsApi\HttpClient\Builder;
use DarthSoup\WhmcsApi\HttpClient\Plugin\AccessKey;
use DarthSoup\WhmcsApi\HttpClient\Plugin\Authentication;
use DarthSoup\WhmcsApi\HttpClient\Plugin\ContentType;
use DarthSoup\WhmcsApi\HttpClient\Plugin\ExceptionHandler;
use DarthSoup\WhmcsApi\HttpClient\Plugin\WhmcsContentType;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

class Client
{
    use ApiClassTrait;

    public const AUTH_API_CREDENTIALS = 'API_TOKEN';
    public const AUTH_LOGIN_CREDENTIALS = 'USERNAME_TOKEN';

    public const API_PATH = '/includes/api.php';
    public const USER_AGENT = 'php-whmcs-api';

    /**
     * @var Builder
     */
    private Builder $httpClientBuilder;

    /**
     * @param Builder|null $httpClientBuilder
     */
    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => self::USER_AGENT,
        ]));
        $builder->addPlugin(new ExceptionHandler());
        $builder->addPlugin(new ContentType());
        $builder->addPlugin(new WhmcsContentType());
    }

    /**
     * @param string $identifier
     * @param string $secret
     * @param string $authMethod
     * @return void
     */
    public function authenticate(string $identifier, string $secret, string $authMethod = self::AUTH_API_CREDENTIALS): void
    {
        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(
            new Authentication($authMethod, $identifier, $secret)
        );
    }

    /**
     * @param string $accessKey
     * @return void
     */
    public function accessKey(string $accessKey): void
    {
        $this->getHttpClientBuilder()->removePlugin(AccessKey::class);
        $this->getHttpClientBuilder()->addPlugin(new AccessKey($accessKey));
    }

    /**
     * @param string $url
     * @return void
     */
    public function url(string $url): void
    {
        $uri = $this->getHttpClientBuilder()->getUriFactory()->createUri($url);
        $uri = $uri->withPath(self::API_PATH);

        $this->getHttpClientBuilder()->removePlugin(BaseUriPlugin::class);
        $this->getHttpClientBuilder()->addPlugin(
            new BaseUriPlugin($uri, ['replace' => true])
        );
    }

    /**
     * @return HttpMethodsClientInterface
     */
    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    /**
     * @return Builder
     */
    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
