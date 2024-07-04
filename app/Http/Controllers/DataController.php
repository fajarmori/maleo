<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function getEmployees(Request $request)
    {
        if($request->ajax()) {
            $employees = Employee::leftJoin('detail_employees', 'employees.id', '=', 'detail_employees.employee_id')
                ->where([
                    ['name', 'LIKE', '%'.$request->name.'%'],
                    ['user_id', '=', NULL],
                    ['resign', '=', NULL],
                ])->limit(3)->get();
            $output = '';

            $output = '<ul class="absolute w-full">';
            if (count($employees)>0) {
                foreach ($employees as $employee){
                    $output .= '<li class="bg-white px-3 py-2 border">'.$employee->name.' | MRIA-'.substr((10000+$employee->mria), -4).'</li>';
                }
            }
            else {
                $output .= '<li class="bg-white px-3 py-2 border">No results</li>';
            }
            $output .= '</ul>';
            return $output;
        }
    }

    public function getEmailSite(Request $request)
    {
        if($request->ajax()) {
            $users = User::leftJoin('sites', 'users.id', '=', 'sites.user_id')
                ->where([
                    ['users.name', 'LIKE', 'site%'],
                    ['user_id', '=', NULL],
                    ['email', 'LIKE', '%'.$request->email.'%']
                ])->limit(3)->get();
            $output = '';

            $output = '<ul class="absolute w-full">';
            if (count($users)>0) {
                foreach ($users as $user){
                    $output .= '<li class="bg-white px-3 py-2 border">'.$user->email.'</li>';
                }
            }
            else {
                $output .= '<li class="bg-white px-3 py-2 border">No results</li>';
            }
            $output .= '</ul>';
            return $output;
        }
    }
}
