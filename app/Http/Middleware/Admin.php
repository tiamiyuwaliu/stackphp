<?php
namespace App\Http\Middleware;

use App\Repositories\User;
use Illuminate\Http\Request;

class Admin {
    public function handle(Request $request, \Closure  $next) {

        if (!User::repository()->isAdmin()) {
            return redirect('/');
        }
        return $next($request);
    }
}
