<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

use DarthSoup\WhmcsApi\Client;
use DarthSoup\WhmcsApi\HttpClient\Formatter\ResponseFormatter;
use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\Utils;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractApi
{
    public const SORT_ASC = 'ASC';
    public const SORT_DESC = 'DESC';

    public const SORTING = [
        self::SORT_ASC,
        self::SORT_DESC
    ];

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $action
     * @param array<string, mixed> $parameter
     * @return mixed|string
     */
    protected function send(string $action, array $parameter = [])
    {
        $header = [];
        $body = array_merge(['action' => $action], $parameter);

        $stream = new AppendStream([Utils::streamFor(http_build_query($body))]);

        $response = $this->client->getHttpClient()->post(
            '', // WHMCS doesnt use a specific url
            $header,
            $stream
        );

        return ResponseFormatter::format($response);
    }

    /**
     * @return OptionsResolver
     */
    protected function createOptionsResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefined('search')
            ->setAllowedTypes('search', 'string');
        $resolver->setDefined('limitstart')
            ->setAllowedTypes('limitstart', 'int')
            ->setAllowedValues('limitstart', function ($value): bool {
                return $value > 0;
            });
        $resolver->setDefined('limitnum')
            ->setAllowedTypes('limitnum', 'int')
            ->setAllowedValues('limitnum', function ($value): bool {
                return $value > 0 && $value <= 250;
            });
        $resolver->setDefined('sorting')
            ->setAllowedValues('sorting', self::SORTING);
        $resolver->setDefined('sortOrder')
            ->setAllowedValues('sortOrder', self::SORTING);
        $resolver->setDefined('orderby')
            ->setAllowedValues('orderby', ['id', 'invoicenumber', 'date', 'duedate', 'total', 'status']);
        $resolver->setDefined('status')
            ->setAllowedValues('status', [
                // Client
                'Active', 'Inactive', 'Closed',

                // Invoice
                'Draft', 'Unpaid', 'Paid', 'Cancelled',
                'Refunded', 'Collections', 'Payment Pending',

                // Product - DomainStatus
                'Suspended', 'Terminated', 'Completed', 'Pending',
                'Pending Registration', 'Pending Transfer', 'Grace',
                'Redemption', 'Expired', 'Cancelled', 'Fraud', 'Transferred Away'
            ]);


        return $resolver;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
