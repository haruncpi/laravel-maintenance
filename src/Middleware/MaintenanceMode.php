<?php namespace Haruncpi\LaravelMaintenance\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\IpUtils;

class MaintenanceMode extends Middleware
{
    protected $cookieName = "secret_cookie";

    public function handle($request, Closure $next)
    {

        if (!$this->app->isDownForMaintenance() && $request->hasCookie($this->cookieName)) {
            cookie()->queue(cookie()->forget($this->cookieName));
        }

        if ($this->app->isDownForMaintenance()) {
            $data = json_decode(file_get_contents(storage_path('/framework/down')), true);
            //maintenance secret route
            if (isset($data[$this->cookieName])) {
                if ($request->hasCookie($this->cookieName)) {
                    $cookieValue = Crypt::decrypt($request->cookie($this->cookieName));
                    if ($data[$this->cookieName] == $cookieValue) {
                        return $next($request);
                    }
                } else {
                    //secret route handle
                    $firstSegment = $request->segment(1);
                    if ($firstSegment == $data[$this->cookieName]) {
                        return redirect()->to(url("/"))
                            ->withCookie(cookie($this->cookieName, Crypt::encrypt($data[$this->cookieName])));
                    }
                }
            }
            //maintenance secret route


            if (isset($data['allowed']) && IpUtils::checkIp($request->ip(), (array)$data['allowed'])) {
                return $next($request);
            }

            if ($this->inExceptArray($request)) {
                return $next($request);
            }

            throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
        }

        return $next($request);
    }
}