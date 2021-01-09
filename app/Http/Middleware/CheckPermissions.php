<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //current User
        $currentUser = $request->user();

        //get the current action name
        $currentActionName = $request->route()->getActionName();
        //separate controller name and function name 
        list($controller, $method) = explode('@', $currentActionName);
        //replace string from this: "App\Http\Controllers\Backend\PermissionsController
        // to be like this: Permissions  
        $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"], "", $controller);
        
        
        $classesMap = [
            'Permissions'   => 'permission',
            'Roles'         => 'role',
            'Users'         => 'user',
            'Rooms'         => 'room',
            'Home'          => 'home',
            'Events'        => 'event',
            'Calendar'      => 'calendar',
            'Bookings'      => 'booking',
            'Balance'       => 'balance',
            'Transactions'  => 'transaction',

        ];

        $className = $classesMap[$controller];

        //check if te current user has permission
        //dd("{$className}-{$method}");
        if(!$currentUser->isAbleTo("{$className}-{$method}"))
        {
            abort(403, "Forbidden acces!");
        }

        return $next($request);
    }
}
