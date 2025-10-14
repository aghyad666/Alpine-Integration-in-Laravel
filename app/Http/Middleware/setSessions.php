<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class setSessions
{
    /**
     * Set sessions.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->createSession($request, 'transactionType', 'activeTransactionType', 'expense');
        $this->createSession($request, 'categoryType', 'activeCategoryType', 'expense');
        $this->createSession($request, 'statsSection', 'activeStatsSection', 'monthly');

        return $next($request);
    }

    /**
     * Create session from the form input.
     */
    private function createSession($request, $inputName, $sessionName, $defaultValue)
    {
        $value = $request->input($inputName, session($sessionName, $defaultValue));
        session([$sessionName => $value]);
    }
}
