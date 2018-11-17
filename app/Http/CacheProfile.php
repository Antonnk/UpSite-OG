<?php 

namespace App\Http;

use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\BaseCacheProfile;
use Symfony\Component\HttpFoundation\Response;


class CacheProfile extends BaseCacheProfile
{
    public function shouldCacheRequest(Request $request): bool
    {
        if ($request->ajax()) {
            return false;
        }

        if ($this->isRunningInConsole()) {
            return false;
        }

        return $request->isMethod('get');
    }

    public function shouldCacheResponse(Response $response): bool
    {
        return $response->isSuccessful() || $response->isRedirection();
    }

    public function cacheNameSuffix(Request $request): string
    {
        if (\Auth::check()) {
            return \Auth::user()->id;
        }

        if(count(explode('.', $request->getHost())) == 3) {
            return array_first(explode('.', $request->getHost()));
        }

        return '';
    }
}