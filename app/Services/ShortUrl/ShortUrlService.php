<?php

declare(strict_types=1);

namespace App\Services\ShortUrl;

use Exception;

use App\Models\ShortLink;
use App\Services\ShortUrl\Input\InfoForShorted;
use App\Services\ShortUrl\Repositories\ShortUrlRepositoryInterface;

readonly class ShortUrlService implements ShortUrlServiceInterface
{
    public function __construct(private ShortUrlRepositoryInterface $urlRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function getByCode(string $code): ShortLink
    {
        $linkInfo = $this->urlRepository->getByCode($code);

        if ($linkInfo->expiry < date('Y-m-d H:i:s')) {
            $linkInfo->delete();
            throw new Exception('The short url has expired');
        }

        return $linkInfo;
    }

    public function create(InfoForShorted $infoForShorted): ShortLink
    {
        $code = substr(md5($infoForShorted->getLink()), 0, 6);
        $infoForShorted->setCode($code);
        $this->urlRepository->deleteIfExist($code);

        return $this->urlRepository->create($infoForShorted);
    }
}
