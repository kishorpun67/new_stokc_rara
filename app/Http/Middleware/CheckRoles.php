<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin\Permission;
use App\Admin\AdminPermission;
class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {

    //     if(!$request->user()->hasPermission($permission)) {

    //         abort(404);

    //    }
    $roles = [
        'POS'=>[26],
        'Kitchen'=>[27],
        'Caffe'=>[28],
        'Bar'=>[29],
        'Waiter'=>[32],
        'IngredientCategory'=>[33],
        'IngredientUnit'=>[34],
        'IngredientItem'=>[35],
        'FoodCategory'=>[36],
        'FoodMenu'=>[37],
        'Customer'=>[38],
        'Supplier'=>[39],
        'Expense'=>[40],
        'Payment'=>[41],
        'Purchase'=>[43],
        'Sale'=>[44],
        'Stock'=>[45],
        'StockAdjusment'=>[46],
        'Waste'=>[47],
        'SupplierDuePayment'=>[48],
        'CustomerDuePayment'=>[49],
        'EmployeeManagement'=>[50],
        'Report'=>[51],
        'Account'=>[52],
        'Miscellaneous'=>[53]
    ];
    if(auth('admin')->user()->type !== "Admin"){
        if(!auth('admin')->user()->hasPermission($roles[$permission])) {
            // abort(403);
            return redirect()->route('admin.dashboard');

       }
    }
  
      
        // $rolesids = $roles[$role] ?? '';
        // if(!in_array(auth('admin')->user()->role_id, $roles[$role])){
        //     return redirect('/admin/dashboard' )->with('error_message', 'You are not allowed');
        // }
        return $next($request);
    }
}
