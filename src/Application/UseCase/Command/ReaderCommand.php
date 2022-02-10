<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\UseCase\Command;

use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

class ReaderCommand implements UseCaseCommandInterface
{
    const DEFAULT_ID_VALUE = 5;

    private $id;

    private $email;

    public function getId(): int
    {
        return $this->id ?? $this->defaultId;
    }

    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $value)
    {
        $this->email = $value;

        return $this;
    }
}
