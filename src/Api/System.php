<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class System extends AbstractApi
{
    public function addBannedIp(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('ip')
            ->setAllowedTypes('ip', 'string')
            ->setInfo('ip', 'Must be a valid ipv4/6')
            ->setAllowedValues('ip', function ($value): bool {
                return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6);
            });

        $resolver->setDefined('reason')
            ->setAllowedTypes('reason', 'string');
        $resolver->setDefined('days')
            ->setAllowedTypes('days', 'int');

        $resolver->setRequired(['ip', 'reason', 'days']);

        return $this->send('AddBannedIp', $resolver->resolve($parameters));
    }

    public function decryptPassword(string $password)
    {
        return $this->send('DecryptPassword', ['password2' => $password]);
    }

    public function encryptPassword(string $password)
    {
        return $this->send('EncryptPassword', ['password2' => $password]);
    }

    public function getStats(int $timelineDays)
    {
        return $this->send('GetStats', ['timeline_days' => $timelineDays]);
    }

    public function sendMail(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $resolver->setDefined('messagename')
            ->setAllowedTypes('messagename', 'string');
        $resolver->setDefined('customvars')
            ->setAllowedTypes('customvars', 'string');
        $resolver->setDefined('customsubject')
            ->setAllowedTypes('customsubject', 'string');
        $resolver->setDefined('custommessage')
            ->setAllowedTypes('custommessage', 'string');
        $resolver->setDefined('customtype')
            ->setAllowedTypes('customtype', 'string');

        return $this->send('SendEmail', $resolver->resolve($parameters));
    }

    public function whmcsDetails()
    {
        return $this->send('WhmcsDetails');
    }
}
