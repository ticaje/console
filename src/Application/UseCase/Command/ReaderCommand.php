<?php
declare(strict_types=1);
/**
 * Console Suite
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\Crawler\Application\UseCase\Command;

use Ticaje\Contract\Traits\BaseDto;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

class ReaderCommand implements UseCaseCommandInterface
{
    use BaseDto;
}
