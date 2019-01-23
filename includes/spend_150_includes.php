<?php

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
use EventSauce\EventSourcing\Header;
use EventSauce\EventSourcing\InMemoryMessageRepository;
use EventSauce\EventSourcing\Message;
use EventSauce\EventSourcing\Serialization\SerializableEvent;
use EventSauce\EventSourcing\UuidAggregateRootId;

include __DIR__ . '/../vendor/autoload.php';

class_alias(UuidAggregateRootId::class, 'AggregateRootId');
class_alias(InMemoryMessageRepository::class, 'InMemoryMessageRepository');
class_alias(ConstructingAggregateRootRepository::class, 'AggregateRootRepository');
class_alias(Header::class, 'Header');
class_alias(Message::class, 'Message');

class BudgetWasIncreased implements SerializableEvent
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

    public function amount(): int
    {
        return $this->amount;
    }
}

include __DIR__ . '/purchase_was_made.php';

class PersonalBudget implements AggregateRoot
{
    use AggregateRootBehaviour;

    private $budget = 0;

    protected function applyBudgetWasIncreased(BudgetWasIncreased $event)
    {
        $this->budget += $event->amount();
    }

    protected function applyPurchaseWasMade(PurchaseWasMade $event)
    {
        $this->budget -= $event->amount();
    }

    protected function applyBudgetWasInsufficient() {}

    public function spend(int $amount)
    {
        if ($this->budget < $amount) {
            $this->recordThat(new BudgetWasInsufficient($amount));
            return false;
        }
        $this->recordThat(new PurchaseWasMade($amount));
        return true;
    }
}

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
