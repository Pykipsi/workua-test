<?php

declare(strict_types=1);

namespace App\Services\ShortUrl\Input;

class InfoForShorted
{
    private string $code;

    public function __construct(
        private string $link,
        private string $expiry,
    )
    {
    }

    public function getForCreating(): array
    {
        return [
            'url' => $this->link,
            'code' => $this->code,
            'expiry' => $this->expiry,
            'clicks' => 0,
        ];
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
