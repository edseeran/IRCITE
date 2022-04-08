<?php

// *** CREATED BY: Jim Kier Mesa

namespace App\Traits;



use App\Models\Employee;
    
    
    

trait Generator
{
    protected function employeeId(){
        do {

            $employeeId = bin2hex(random_bytes(7));

        } while (Employee::where("employee_id", "=", $employeeId)->first());

        return $employeeId;

    }
}
