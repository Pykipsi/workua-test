<?php

namespace App\Http\Controllers;

use Throwable;

use Illuminate\View\View;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

use App\Models\ShortLink;
use App\Http\Requests\FullUrlRequest;
use App\Services\ShortUrl\ShortUrlServiceInterface;

class ShortUrlController extends Controller
{
    public function __construct(private ShortUrlServiceInterface $urlService)
    {
    }

    public function show(): View
    {
        return view('url-minimizer');
    }

    public function minimize(FullUrlRequest $request)
    {
        $shortedUrl = $this->urlService->create($request->createDto());

        return redirect("/statistic/{$shortedUrl->code}");
    }

    public function redirect($code)
    {
        $errors = $this->codeValidation($code);
        if (!empty($errors)) {
            redirect(url('show'), ['errors' => $errors]);
        }

        try {
            $linkInfo = $this->urlService->getByCode($code);
            $linkInfo->increment('clicks');

            return redirect($linkInfo->url);
        } catch (Throwable $exception) {

            return redirect('/url-minimizer')->with(['errors' => new MessageBag([$exception->getMessage()])]);
        }
    }

    public function statistic($code)
    {
        try {
            $linkInfo = $this->urlService->getByCode($code);

            return view('statistic', [
                    'code' => $linkInfo->code,
                    'fullUrl' => $linkInfo->url,
                    'totalClicks' => $linkInfo->clicks
                ]
            );
        } catch (Throwable $exception) {
            return redirect('/url-minimizer')->with(['errors' => new MessageBag([$exception->getMessage()])]);
        }
    }

    private function codeValidation(string $code): ?array
    {
        $validator = Validator::make(['code' => $code], [
            'code' => ['required', 'string', 'max:6', 'exists:' . ShortLink::class . ',code'],
        ]);

        if ($validator->fails()) {
            return $validator->errors()->getMessages();
        }

        return null;
    }
}
