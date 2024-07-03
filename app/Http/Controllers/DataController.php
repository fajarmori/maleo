<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function getEmployees(Request $request)
    {
        if($request->ajax()) {
            $data = Employee::leftJoin('detail_employees', 'employees.id', '=', 'detail_employees.employee_id')
                ->where([
                    ['name', 'LIKE', '%'.$request->name.'%'],
                    ['user_id', '=', NULL],
                    ['resign', '=', NULL],
                ])->limit(3)->get();
            $output = '';

            if (count($data)>0) {
                $output = '<ul class="absolute w-full">';
                foreach ($data as $row){
                    $output .= '<li class="bg-white px-3 py-2 border">'.$row->name.' | MRIA-'.substr((10000+$row->mria), -4).'</li>';
                }
                $output .= '</ul>';
            }
            else {
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            return $output;
        }
    }
}
