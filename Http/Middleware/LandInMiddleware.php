<?php

namespace Modules\Agrocont\Http\Middleware;

use Modules\Agrocont\Repositories\LandsRepository;
use Modules\User\Contracts\Authentication;


class LandInMiddleware
{
    /**
     * @var Authentication
     */
    private $auth;
    private $land;

    public function __construct(Authentication $auth, LandsRepository $land)
    {
        $this->auth = $auth;
        $this->land = $land;
    }

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $user = $this->auth->user;
        if ($request->session()->has('land')) {
            $value = $request->session()->get('land');
            $land = $this->land->find($value);
            if($land->user_id == $user->id){
                return $next($request);
            }else{
                return redirect()->guest(config('asgard.user.config.redirect_route_not_logged_in', 'auth/login'));
            }
        }else{
            return redirect()->guest(config('asgard.user.config.redirect_route_not_logged_in', 'auth/login'));
        }

    }
}
