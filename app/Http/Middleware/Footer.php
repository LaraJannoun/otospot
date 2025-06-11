<?php
 
namespace App\Http\Middleware;
 

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\SocialMedia;
 
use Illuminate\Http\Request;
 
use Closure;
use Auth;
use View;
 
class Footer extends Middleware
{
 
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixeds
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $locale = substr(request()->path(), 0, 2);
 
        $social_media = SocialMedia::select([
            'id',
            'icon',
            'title',
            'link',
            'pos',
            'publish',
        ])->wherePublish(1)->get();
      
        View::share(compact(
            'social_media',
        ));
        return $next($request);
    }
}
 
 
 