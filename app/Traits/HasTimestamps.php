<?php

declare(strict_types=1);

namespace App\Traits;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\Column;

trait HasTimestamps
{
    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private \DateTime $updatedAt;

    #[\Doctrine\ORM\Mapping\PrePersist, \Doctrine\ORM\Mapping\PreUpdate]
    public function updateTimestamps(LifecycleEventArgs $args): void
    {
        if (!isset($this->createdAt)) {
            $this->createdAt = new \DateTime();
            $this->updatedAt = new \DateTime();
        }
    }
}
