<?php

namespace App\UserInterface\Presenter\Histories;

use App\Domain\Employees\Aggregate\History;

class HistoryPresenter {

    private History $history;

    public function __construct(History $history) {
        $this->history = $history;
    }

    public function getId()
    {
        return $this->history->id()->value();
    }

    public function getEmployeeId()
    {
        return $this->history->employeeId()->value();
    }

    public function getCreatedAt()
    {
        return $this->history->createdAt()->value();
    }

}