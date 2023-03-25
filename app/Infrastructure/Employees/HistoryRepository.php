<?php

declare(strict_types=1);

namespace App\Infrastructure\Employees;

use App\Domain\Employees\Aggregate\History;
use App\Domain\Employees\EmployeeSearchCriteria;
use App\Domain\Employees\Exception\EmployeeNotFoundException;
use App\Domain\Employees\HistoryRepositoryInterface;
use App\Domain\Employees\HistorySearchCriteria;
use App\Domain\Employees\ValueObjects\Attempts;
use App\Domain\Employees\ValueObjects\Department;
use App\Domain\Employees\ValueObjects\EmployeeId;
use App\Domain\Employees\ValueObjects\FirstName;
use App\Domain\Employees\ValueObjects\HasAccess;
use App\Domain\Employees\ValueObjects\Id;
use App\Domain\Employees\ValueObjects\LastName;
use App\Domain\Shared\ValueObjects\DateTimeValueObject;
use App\Infrastructure\Laravel\Models\History as ModelsHistory;
use Illuminate\Support\Facades\DB;

class HistoryRepository implements HistoryRepositoryInterface
{

    public function create(History $history): void
    {
        $modelHistory = new ModelsHistory();

        $modelHistory->id = $history->id()->value();
        $modelHistory->employee_id = $history->employeeId()->value();
        $modelHistory->created_at = DateTimeValueObject::now()->value();

        $modelHistory->save();
    }

    public function historyAttemptsLoginSearchByCriteria(Id $id, HistorySearchCriteria $criteria): array
    {
        $histories = ModelsHistory::where('employee_id', $id->value());

        if (!empty($criteria->dateInit())) {
            $histories = $histories->whereDate('created_at', '>=', $criteria->dateInit());
        }

        if (!empty($criteria->dateEnd())) {
            $histories = $histories->whereDate('created_at', '<=', $criteria->dateEnd());
        }

        if ($criteria->pagination() !== null) {
            $histories = $histories->take($criteria->pagination()->limit()->value())
                                    ->skip($criteria->pagination()->offset()->value());
        }

        if ($criteria->sort() !== null) {
            $histories = $histories->orderBy($criteria->sort()->field()->value(), $criteria->sort()->direction()->value());
        }

        return array_map(
            static fn (ModelsHistory $history) => self::map($history),
            $histories->get()->all()
        );
    }

    public static function map(ModelsHistory $model): History
    {
        return History::create(
            Id::fromPrimitives($model->id),
            EmployeeId::fromPrimitives($model->employee_id),
            DateTimeValueObject::fromPrimitives($model->created_at->__toString()),
            !empty($model->updated_at) ? DateTimeValueObject::fromPrimitives($model->updated_at->__toString()) : null,
        );
    }
}
