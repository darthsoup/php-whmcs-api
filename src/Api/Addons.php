<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Addons extends AbstractApi
{
    public function updateClientAddon(array $parameters = [])
    {
        return $this->send(
            'UpdateClientAddon',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }
}
