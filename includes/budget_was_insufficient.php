<?php

use EventSauce\EventSourcing\Serialization\SerializableEvent;

class BudgetWasInsufficient implements SerializableEvent
{
    /**
     * @var int
     */
    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function toPayload(): array
    {
        return ['amount' => $this->amount];
    }

    public static function fromPayload(array $payload): SerializableEvent
    {
        return new static($payload['amount']);
    }
}