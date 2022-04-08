<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\Generator;

class EmployeeController extends Controller
{
// CREATE EMPLOYEE
public function create(Request $request)
   {
    if (Auth::user()->clearance_level == 'superuser' ){

    $data = $request->validate([
        'employee_id' => 'required|unique:employees|max:10',
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'position' => 'required|string',    
        'sickLeaveCredits' => 'required|numeric',
        'vacationLeaveCredits' => 'required|numeric',
        'hourlyRate' => 'required|numeric',
    ]);

    $employee = Employee::create([
        'employee_id' => $data['employee_id'],
        'first_name' => $data['firstName'],
        'last_name' => $data['lastName'],
        'position' => $data['position'],
        'sick_leave_credits' => $data['sickLeaveCredits'],
        'vacation_leave_credits' => $data['vacationLeaveCredits'],
        'hourly_rate' => $data['hourlyRate'],
    ]);

    $response = [
        'employee' => $employee,
    ];

    return response($response, 200);
    }
    elseif (Auth::user()->clearance_level == 'l1Admin'){
        $data = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'position' => 'required|string',
            'sickLeaveCredits' => 'required|numeric',
            'vacationLeaveCredits' => 'required|numeric',
            'hourlyRate' => 'required|numeric',
        ]);
    
        $employee = Employee::create([
            'employee_id' => $this->employeeId(),
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'position' => $data['position'],
            'sick_leave_credits' => $data['sickLeaveCredits'],
            'vacation_leave_credits' => $data['vacationLeaveCredits'],
            'hourly_rate' => $data['hourlyRate'],
        ]);
    
        return response($employee, 200);
        }
    }


public function list(){

        if (Auth::user()->clearance_level == 'superuser')
        {
            $employee = Employee::all();
        }elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $employee = Employee::all();
    
        }elseif(Auth::user()->clearance_level == 'l2Admin')
        {
            $employee = Employee::all();
    
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response($employee, 200);
        }


 public function show($employee_id)
    {
        if(Auth::user()->clearance_level == 'superuser')
        {
            $employee = Employee::where('employee_id', $employee_id)->first();
        }
        elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $employee = Employee::where('employee_id', $employee_id)->first();
        }
        elseif(Auth::user()->clearance_level == 'l2Admin')
        {
            $employee = Employee::where('employee_id', $employee_id)->first();
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response($employee, 200);
    }



public function delete($employee_id)
    {
        if(Auth::user()->clearance_level == 'superuser')
        {
            $employee = Employee::where('employee_id', $employee_id)->first();
            $employee->delete();
        }
        elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $employee = User::where('employee_id', $employee_id)->first();
            $employee->delete();
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response(['message: Account Deleted Successfully'], 200);
    }



public function update(Request $request, $employee_id)
    {
        if(Auth::user()->clearance_level == 'superuser')
        {
            $employee = Employee::where('employee_id', $employee_id)->first();
            $data = $request->validate([
                'employee_id' => 'required|unique:employees|max:10',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'position' => 'required|string',    
                'sickLeaveCredits' => 'required|numeric',
                'vacationLeaveCredits' => 'required|numeric',
                'hourlyRate' => 'required|numeric',
            ]);
            $employee->update($data);
        }
        elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $employee = Employee::where('employee_id', $employee_id)->first();
            $data = $request->validate([
                'employee_id' => 'required|unique:employees|max:10',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'position' => 'required|string',    
                'sickLeaveCredits' => 'required|numeric',
                'vacationLeaveCredits' => 'required|numeric',
                'hourlyRate' => 'required|numeric',
            ]);
            $employee->update($data);
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response(['message: Account Updated Successfully'], 200);
    }

    
}
