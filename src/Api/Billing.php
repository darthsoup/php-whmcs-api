<?php

declare(strict_types=1);

namespace DarthSoup\WhmcsApi\Api;

class Billing extends AbstractApi
{
    public function acceptQuote(int $quoteId)
    {
        return $this->send('AcceptQuote', ['quoteid' => $quoteId]);
    }

    public function addBillableItem(array $parameters = [])
    {
        return $this->send(
            'AddBillableItem',
            $this->createOptionsResolver()->resolve($parameters)
        );
    }

    public function addCredit(int $clientId, string $description, float $amount = 0.00, array $parameters = [])
    {
        return $this->send(
            'addCredit',
            array_merge([
                'clientid' => $clientId,
                'description' => $description,
                'amount' => $amount
            ], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function addInvoicePayment(int $invoiceId, string $transId, string $gateway, \DateTime $date, array $parameters = [])
    {
        return $this->send(
            'AddInvoicePayment',
            array_merge([
                'invoiceid' => $invoiceId,
                'transid' => $transId,
                'gateway' => $gateway,
                'date' => $date->format('YYYY-MM-DD HH:mm:ss')
            ], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function addPayMethod(int $clientId, array $parameters = [])
    {
        return $this->send(
            'AddPayMethod',
            array_merge(['clientid' => $clientId], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function addTransaction(string $paymentMethod, array $parameters = [])
    {
        return $this->send(
            'AddTransaction',
            array_merge(['paymentmethod' => $paymentMethod], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function applyCredit(int $invoiceId, float $amount = 0.00, bool $noMail = false)
    {
        return $this->send('ApplyCredit', [
            'invoiceid' => $invoiceId,
            'amount' => $amount,
            'nomail' => $noMail
        ]);
    }

    public function createInvoice(int $clientId, array $parameters = [])
    {
        return $this->send(
            'CreateInvoice',
            array_merge(['clientid' => $clientId], $this->createOptionsResolver()->resolve($parameters))
        );
    }

    public function createQuote(string $subject, string $stage, string $validUntil, array $parameters = [])
    {
        // TODO: lineitems needs special handling base64_encode(serialize($lineitems))
        return $this->send(
            'CreateQuote',
            array_merge(
                ['subject' => $subject, 'stage' => $stage, 'validuntil' => $validUntil],
                $this->createOptionsResolver()->resolve($parameters)
            )
        );
    }

    public function deleteQuote(int $quoteId)
    {
        return $this->send('DeleteQuote', ['quoteid' => $quoteId]);
    }

    public function genInvoices(array $parameters = [])
    {
        return $this->send('GenInvoices', $this->createOptionsResolver()->resolve($parameters));
    }

    public function getCredits(int $clientId)
    {
        return $this->send('GetCredits', ['clientid' => $clientId]);
    }

    public function getInvoice(int $invoiceId)
    {
        return $this->send('GetInvoice', ['invoiceid' => $invoiceId]);
    }

    public function getInvoices(array $parameters = [])
    {
        return $this->send('GetInvoices', $this->createOptionsResolver()->resolve($parameters));
    }

    public function getTransactions(array $parameters = [])
    {
        return $this->send('GetTransactions', $this->createOptionsResolver()->resolve($parameters));
    }

    public function sendQuote(int $quoteId)
    {
        return $this->send('SendQuote', ['quoteid' => $quoteId]);
    }

    public function updateInvoice(int $invoiceId, array $parameters = [])
    {
        return $this->send(
            'UpdateInvoice',
            array_merge(['invoiceid' => $invoiceId], $this->createOptionsResolver()->resolve($parameters))
        );
    }
}
