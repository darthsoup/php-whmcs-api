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

    public const STATUS_ORDER = ['Pending', 'Active', 'Fraud', 'Cancelled'];
    public const STATUS_CLIENT = ['Active', 'Inactive', 'Closed'];
    public const STATUS_INVOICE = [
        'Draft', 'Unpaid', 'Paid', 'Cancelled',
        'Refunded', 'Collections', 'Payment Pending',
    ];
    public const STATUS_PRODUCT = [
        'Suspended', 'Terminated', 'Completed', 'Pending',
        'Pending Registration', 'Pending Transfer', 'Grace',
        'Redemption', 'Expired', 'Cancelled', 'Fraud', 'Transferred Away'
    ];
    public const STATUS_BILLINGSTAGE = [
        'Draft', 'Delivered', 'On', 'Hold', 'Accepted', 'Lost', 'Dead'
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

    protected function createOptionsResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefined('firstname')
            ->setAllowedTypes('firstname', 'string');
        $resolver->setDefined('lastname')
            ->setAllowedTypes('lastname', 'string');
        $resolver->setDefined('address1')
            ->setAllowedTypes('address1', 'string');
        $resolver->setDefined('address2')
            ->setAllowedTypes('address2', 'string');
        $resolver->setDefined('companyname')
            ->setAllowedTypes('companyname', 'string');
        $resolver->setDefined('city')
            ->setAllowedTypes('city', 'string');
        $resolver->setDefined('state')
            ->setAllowedTypes('state', 'string');
        $resolver->setDefined('postcode')
            ->setAllowedTypes('postcode', 'string');
        $resolver->setDefined('country')
            ->setAllowedTypes('country', 'string');
        $resolver->setDefined('number')
            ->setAllowedTypes('number', 'string');
        $resolver->setDefined('phonenumber')
            ->setAllowedTypes('phonenumber', 'string');

        $resolver->setDefined('email')
            ->setAllowedTypes('email', 'string')
            ->setAllowedValues('email', fn($value) => filter_var($value, FILTER_VALIDATE_EMAIL));
        $resolver->setDefined('password2')
            ->setAllowedTypes('password2', 'string');

        $resolver->setDefined('customfields')
            ->setAllowedTypes('customfields', 'string[]');

        $resolver->setDefined('ip')
            ->setAllowedTypes('ip', 'string')
            ->setInfo('ip', 'Must be a valid IPv4 or IPv6.')
            ->setAllowedValues('ip', fn($value) => filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6));
        $resolver->setDefined('clientip')
            ->setAllowedTypes('clientip', 'string')
            ->setInfo('clientip', 'Must be a valid IPv4 or IPv6.')
            ->setAllowedValues('clientip', fn($value) => filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6));


        // Global
        $resolver->setDefined('search')
            ->setAllowedTypes('search', 'string');
        $resolver->setDefined('limitstart')
            ->setAllowedTypes('limitstart', 'int')
            ->setAllowedValues('limitstart', fn($value) => $value > 0);
        $resolver->setDefined('limitnum')
            ->setAllowedTypes('limitnum', 'int')
            ->setAllowedValues('limitnum', fn($value) => $value > 0 && $value <= 250);

        $resolver->setDefined('sorting')
            ->setAllowedValues('sorting', self::SORTING);
        $resolver->setDefined('sortOrder')
            ->setAllowedValues('sortOrder', self::SORTING);
        $resolver->setDefined('orderby')
            ->setAllowedTypes('orderby', 'string');

        $resolver->setDefined('status')
            ->setAllowedValues('status', [
                ...self::STATUS_ORDER,
                ...self::STATUS_CLIENT,
                ...self::STATUS_INVOICE,
                ...self::STATUS_PRODUCT,
            ]);

        return $resolver;
    }

    protected function getClient(): Client
    {
        return $this->client;
    }
}
