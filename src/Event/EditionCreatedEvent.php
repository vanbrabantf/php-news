<?php declare(strict_types=1);

namespace App\Event;

use App\Domain\Edition;
use Symfony\Component\EventDispatcher\Event;

class EditionCreatedEvent extends Event
{
    /**
     * @var Edition
     */
    private $edition;

    /**
     * EditionCreatedEvent constructor.
     * @param Edition $edition
     */
    public function __construct(Edition $edition)
    {
        $this->edition = $edition;
    }

    /**
     * @return Edition
     */
    public function getEdition(): Edition
    {
        return $this->edition;
    }
}
