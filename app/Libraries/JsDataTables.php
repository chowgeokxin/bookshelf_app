<?php namespace App\Libraries;

class JsDataTables
{

    // Helper class to assist jquery datatables plugin.

    private $inputs = [];

    /**
     * @param array $inputs
     */
    public function __construct($inputs)
    {
        $this->inputs = $inputs;
        $this->ensureInput(["order", "columns"]);
    }

    private function ensureInput($keys)
    {
        foreach ($keys as $key) {
            $value = $this->inputs[$key];

            if (!is_null($value) && is_string($value)) {
                $value = json_decode($value, true);
                $this->inputs[$key] = $value;
            }
        }
    }

    /**
     * @param bool $decodeJson
     * @param string $inputKey
     * @return string|mixed
     */
    public function searchParams($decodeJson = true, $inputKey = "searchParams")
    {
        $result = $this->inputs[$inputKey];

        if (!is_null($result) && $decodeJson) {
            return json_decode($result, true);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function limitSql()
    {
        return " LIMIT " . $this->start() . ", " . $this->length() . " ";
    }

    /**
     * @return int
     */
    public function start()
    {
        return intval($this->inputs["start"]);
    }

    /**
     * @return int
     */
    public function length()
    {
        return intval($this->inputs["length"]);
    }

    /**
     * @param array $columns
     * @return string
     */
    public function orderBySql($columns)
    {
        $dtOrders = $this->inputs["order"];
        $dtColumns = $this->inputs['columns'];
        $columnCount = count($columns);
        $orderBy = [];

        foreach ($dtOrders as $do) {
            $columnIndex = $do["column"];

            if ($columnIndex < $columnCount) {
                $targetColumn = $dtColumns[$columnIndex];

                if ($targetColumn["orderable"] == "true") {
                    $dir = $do["dir"] === "desc" ? "DESC" : "ASC";
                    $orderBy[] = $columns[$columnIndex] . " " . $dir;
                }
            }
        }

        return " ORDER BY " . implode(", ", $orderBy) . " ";
    }

    /**
     * @param array $columns
     * @param \Illuminate\Database\Query\Builder $queryBuilder
     * @return \Illuminate\Database\Query\Builder
     */
    public function orderByQueryBuilder($columns, $queryBuilder)
    {
        return $this->orderByModel($columns, $queryBuilder);
    }

    /**
     * @param array $columns
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder $model
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     */
    public function orderByModel($columns, $model)
    {
        $dtOrders = $this->inputs["order"];
        $dtColumns = $this->inputs['columns'];
        $columnCount = count($columns);

        foreach ($dtOrders as $do) {
            $columnIndex = $do["column"];

            if ($columnIndex < $columnCount) {
                $targetColumn = $dtColumns[$columnIndex];

                if ($targetColumn["orderable"] == "true") {
                    $dir = $do["dir"] === "desc" ? "desc" : "asc";
                    $orderCol = $columns[$columnIndex];

                    if (($subTo = stripos($orderCol, " ")) !== false) {
                        $orderCol = substr($orderCol, 0, $subTo);
                    }

                    $model->orderBy($orderCol, $dir);
                }
            }
        }

        return $model;
    }

    /**
     * @param array $array
     * @param int $recordsTotal
     * @param bool $invertOrder
     * @param bool $isArrayPaginated
     * @param int $fillRowIndexAt
     * @param int $orderByColumnIndex
     * @return array
     */
    public function fillRowIndexToArray($array, $recordsTotal, $invertOrder = false, $isArrayPaginated = true, $fillRowIndexAt = 0, $orderByColumnIndex = 0)
    {
        $orderCount = count($this->inputs["order"]);

        if ($orderByColumnIndex > $orderCount) {
            $orderByColumnIndex = $orderCount;
        }

        $direction = $this->columnOrderBy($orderByColumnIndex);
        $increment = true;

        if (!is_null($direction) && $direction == "desc") {
            $increment = false;
        }

        if ($invertOrder) {
            $increment = !$increment;
        }

        if ($increment) {
            $rowIndex = ($isArrayPaginated ? $this->start() : 0) + 1;
        } else {
            $rowIndex = $recordsTotal - $this->start();
        }

        for ($i = 0; $i < count($array); $i++) {
            array_splice($array[$i], $fillRowIndexAt, 0, strval($rowIndex));

            if ($increment) {
                $rowIndex++;
            } else {
                $rowIndex--;
            }
        }

        return $array;
    }

    /**
     * @param int $index
     * @return null|string Return "asc" or "desc"
     */
    public function columnOrderBy($index = 0)
    {
        $dtOrders = $this->inputs["order"];

        if ($index < count($dtOrders)) {
            return $dtOrders[$index]["dir"];
        }

        return null;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function pagingModel($model)
    {
        return $model->take($this->length())->skip($this->start());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function pagingCollection($collection)
    {
        if (!is_null($collection) && count($collection)) {
            return $collection->splice($this->start(), $this->length());
        } else {
            return $collection;
        }
    }

    /**
     * @param array $array
     * @return array
     */
    public function pagingArray($array)
    {
        if (!is_null($array) && is_array($array)) {
            return array_splice($array, $this->start(), $this->length());
        } else {
            return $array;
        }
    }

    /**
     * @return string
     */
    public function responseNoData()
    {
        return $this->resultJson(0, 0, []);
    }

    /**
     * @param int $recordsTotal
     * @param int $recordsFiltered
     * @param array $data
     * @param bool $encode
     * @return array|string
     */
    public function resultJson($recordsTotal, $recordsFiltered, $data, $encode = true)
    {
        $result = [
            "draw" => $this->inputs["draw"],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        ];

        if ($encode) {
            return json_encode($result);
        } else {
            return $result;
        }
    }
}
