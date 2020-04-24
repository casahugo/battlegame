<?php

declare(strict_types=1);

namespace App\Collection;

use App\Card;

class CardCollection extends \ArrayIterator
{
    private ?string $owner = null;

    public function __construct($array = [], $flags = 0)
    {
        parent::__construct(array_filter($array, fn ($value) => \is_int($value)), $flags);
    }

    public function setOwner(string $identifier): self
    {
        $this->owner = $identifier;

        return $this;
    }

    public function current(): Card
    {
        return new Card(parent::current(), $this->owner);
    }

    public function key(): string
    {
        return (string) parent::key();
    }

    public function valid(): bool
    {
        return \is_int(parent::current());
    }
}