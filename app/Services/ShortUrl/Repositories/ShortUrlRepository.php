<?php

declare(strict_types=1);

namespace App\Services\ShortUrl\Repositories;

use App\Models\ShortLink;
use App\Services\ShortUrl\Input\InfoForShorted;

class ShortUrlRepository implements ShortUrlRepositoryInterface
{
    public function __construct(private ShortLink $link)
    {
    }

    public function getByCode(string $code): ShortLink
    {
        return $this->link->where('code', '=', $code)->firstOrFail();
    }

    public function create(InfoForShorted $infoForShorted): ShortLink
    {
        return ShortLink::create($infoForShorted->getForCreating());
    }

    public function deleteIfExist(string $code): void
    {
        ShortLink::where('code', '=', $code)->delete();
    }
}
