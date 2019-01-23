<?php

use EventSauce\EventSourcing\Serialization\SerializableEvent;

class PurchaseWasMade implements SerializableEvent
{
    private $amount;

    public function __construct(int $amount) {
        $this->amount = $amount;
    }

    public function amount(): int {
        return $this->amount;
    }

    public function toPayload(): array {
        return ['amount' => $this->amount];
    }

    public static function fromPayload(array $payload): SerializableEvent {
        return new static($payload['amount']);
    }
}