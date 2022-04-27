<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class System extends AbstractApi
{
    public function addBannedIp(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setAllowedTypes('reason', 'string');
        $resolver->setAllowedTypes('days', 'int');
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

    public function logActivity(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['clientid', 'description']);
        $resolver->setAllowedTypes('clientid', 'int');
        $resolver->setAllowedTypes('description', 'string');
        $resolver->setRequired(['description']);

        return $this->send('LogActivity', $resolver->resolve($parameters));
    }

    public function sendAdminEmail(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['id', 'messagename', 'customsubject', 'custommessage', 'type', 'deptid', 'mergefields']);
        $resolver->setAllowedTypes('id', 'int');
        $resolver->setAllowedTypes('messagename', 'string');
        $resolver->setAllowedTypes('customsubject', 'string');
        $resolver->setAllowedTypes('custommessage', 'string');
        $resolver->setAllowedTypes('type', 'string');
        $resolver->setAllowedTypes('deptid', 'int');
        $resolver->setAllowedTypes('mergefields', 'array');

        return $this->send('SendAdminEmail', $resolver->resolve($parameters));
    }

    public function sendMail(array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined(['id', 'messagename', 'customvars', 'customsubject', 'custommessage', 'customtype']);
        $resolver->setAllowedTypes('id', 'int');
        $resolver->setAllowedTypes('messagename', 'string');
        $resolver->setAllowedTypes('customvars', 'string');
        $resolver->setAllowedTypes('customsubject', 'string');
        $resolver->setAllowedTypes('custommessage', 'string');
        $resolver->setAllowedTypes('customtype', 'string');

        return $this->send('SendEmail', $resolver->resolve($parameters));
    }

    public function whmcsDetails()
    {
        return $this->send('WhmcsDetails');
    }
}
