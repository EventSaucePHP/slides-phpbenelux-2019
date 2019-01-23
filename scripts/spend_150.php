<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
require __DIR__.'/../includes/spend_150_includes.php';

$messageRepository = new InMemoryMessageRepository();
$aggregateRootRepository = new AggregateRootRepository(
    PersonalBudget::class,
    $messageRepository
);

$id = AggregateRootId::create();
$headers = [Header::AGGREGATE_ROOT_ID => $id];
$messageRepository->persist(
    new Message(new BudgetWasIncreased(100), $headers)
);

$budget = $aggregateRootRepository->retrieve($id);

$budget->spend(150);

$aggregateRootRepository->persist($budget);
var_dump($messageRepository->lastCommit());