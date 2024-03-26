<?php

declare(strict_types=1);

namespace App\Services\ShortUrl;

use App\Models\ShortLink;
use App\Services\ShortUrl\Input\InfoForShorted;

interface ShortUrlServiceInterface
{
    public function getByCode(string $code): ShortLink;

    public function create(InfoForShorted $infoForShorted): ShortLink;
}
