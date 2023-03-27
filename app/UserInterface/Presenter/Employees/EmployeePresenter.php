<?php

namespace App\UserInterface\Presenter\Employees;

use App\Domain\Employees\Aggregate\Employee;
use Illuminate\Support\HtmlString;

class EmployeePresenter {

    private Employee $employee;

    public function __construct(Employee $employee) {
        $this->employee = $employee;
    }

    public function getId()
    {
        return $this->employee->id()?->value();
    }

    public function getFirstName()
    {
        return $this->employee->firstName()->value();
    }

    public function getFullName()
    {
        return $this->employee->firstName()->value() . ' ' . $this->employee->lastName()->value();
    }

    public function getLastName()
    {
        return $this->employee->lastName()->value();
    }

    public function getDepartment()
    {
        return $this->employee->department()->value();
    }

    public function getHasAccess()
    {
        return $this->employee->hasAccess()->value() == true ? 'SI' : 'NO';
    }

    public function getHasAccessColor()
    {
        return $this->employee->hasAccess()->value() == false ? 'success' : 'danger';
    }

    public function getHasAccessText()
    {
        return $this->employee->hasAccess()->value() == true ? 'Disable' : 'Enable';
    }

    public function getAttempts()
    {
        return $this->employee->attempts()->value();
    }

    public function link()
    {
        return new HtmlString("<a href=" . route('user.show', $this->employee->id()?->value()) . ">" . $this->getFullName()."</a>");
    }
}