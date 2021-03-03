<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Orders extends AbstractApi
{
    public function acceptOrder(int $orderId, array $parameters = [])
    {
        return $this->send(
            'AcceptOrder',
            array_merge(['orderid' => $orderId], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function addOrder(int $clientId, array $parameters = [])
    {
        return $this->send(
            'AddOrder',
            array_merge(['clientId' => $clientId], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function cancelOrder(int $orderId, array $parameters = [])
    {
        return $this->send(
            'CancelOrder',
            array_merge(['orderid' => $orderId], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function deleteOrder(int $orderId, array $parameters = [])
    {
        return $this->send('DeleteOrder', ['orderid' => $orderId]);
    }

    public function fraudOrder(int $orderId, bool $cancelSub = false)
    {
        return $this->send('FraudOrder', ['orderid' => $orderId, 'cancelsub' => $cancelSub]);
    }

    public function getOrders(array $parameters = [])
    {
        return $this->send(
            'GetOrders',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function getOrderStatuses()
    {
        return $this->send('GetOrderStatuses');
    }

    public function getPromotions(string $code)
    {
        return $this->send('getPromotions', ['code' => $code]);
    }

    public function pendingOrder(int $orderId)
    {
        return $this->send('PendingOrder', ['orderid' => $orderId]);
    }
}
