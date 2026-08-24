<?php

namespace App\Http\Controllers;

use App\Services\AntiCensorshipEngineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AntiCensorshipController extends Controller
{
    protected AntiCensorshipEngineService $antiCensorshipService;

    public function __construct(AntiCensorshipEngineService $antiCensorshipService)
    {
        $this->antiCensorshipService = $antiCensorshipService;
    }

    /**
     * وضعیت زنده سرویس رفع فیلترینگ زرین بوت
     */
    public function getStatus(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->antiCensorshipService->getStatus()
        ]);
    }

    /**
     * تست استعلام آنلاین Cloudflare DoH برای دامنه‌های متا
     */
    public function testDohQuery(Request $request): JsonResponse
    {
        $domain = $request->input('domain', 'i.instagram.com');
        $resolvedIp = $this->antiCensorshipService->resolveMetaDomainWithDoH($domain);

        return response()->json([
            'status' => 'success',
            'domain' => $domain,
            'resolved_ip' => $resolvedIp,
            'doh_provider' => 'https://1.1.1.1/dns-query'
        ]);
    }

    /**
     * تست زنده تکه‌تکه‌سازی پکت‌های TLS ClientHello
     */
    public function testTlsFragmentation(Request $request): JsonResponse
    {
        $domain = $request->input('domain', 'i.instagram.com');
        $ip = $this->antiCensorshipService->resolveMetaDomainWithDoH($domain);
        $result = $this->antiCensorshipService->sendFragmentedTlsRequest($domain, $ip);

        return response()->json([
            'status' => 'success',
            'result' => $result
        ]);
    }
}
