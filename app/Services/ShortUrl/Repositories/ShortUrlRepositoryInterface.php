<?php

declare(strict_types=1);

namespace App\Services\ShortUrl\Repositories;

use App\Models\ShortLink;
use App\Services\ShortUrl\Input\InfoForShorted;

interface ShortUrlRepositoryInterface
{
    public function getByCode(string $code): ShortLink;

    public function create(InfoForShorted $infoForShorted): ShortLink;

    public function deleteIfExist(string $code): void;
}
