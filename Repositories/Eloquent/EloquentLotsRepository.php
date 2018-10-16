<?php

namespace Modules\Agrocont\Repositories\Eloquent;

use Modules\Agrocont\Repositories\LotsRepository;
use Modules\Agrocont\Events\Lots\LotIsCreating;
use Modules\Agrocont\Events\Lots\LotIsUpdating;
use Modules\Agrocont\Events\Lots\LotWasCreated;
use Modules\Agrocont\Events\Lots\LotWasDeleted;
use Modules\Agrocont\Events\Lots\LotWasUpdated;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentLotsRepository extends EloquentBaseRepository implements LotsRepository
{
    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    public function All(){
        return $this->model->paginate(12);
    }

    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {


        event($event = new LotIsCreating($data));
        $land = $this->model->create($event->getAttributes());

        event(new LotWasCreated($land, $data));


        return $land;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {

        event($event = new LotIsUpdating($model, $data));
        $model->update($event->getAttributes());

        event(new LotWasUpdated($model, $data));


        return $model;
    }

    public function destroy($page)
    {
        $page->untag();

        event(new LotWasDeleted($page));

        return $page->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function whereByLand($id){
        return $this->model->where('land_id',$id)->get();
    }
    public function whereFilter($page, $take, $filter, $include)
    {
        //Initialize Query
        $query = $this->model->query();
        /*== RELATIONSHIPS ==*/
        if (count($include)) {
            //Include relationships for default
            $includeDefault = [
                'land'
            ];
            $query->with(array_merge($includeDefault, $include));
        }
        /*== FILTER ==*/
        if ($filter) {
            //add filter by search
            if (!empty($filter->search)) {

            }
            /*add filter by status*/
            if (isset($filter->status) && count($filter->status)) {
                $query->whereIn('status', $filter->status);
            }
            /*add filter by status*/
            if (isset($filter->land) && count($filter->land)) {
                $query->where('land_id',$filter->land);
            }
            /*filter by date*/
            if (isset($filter->date)) {
                $type_date = $filter->date->type ? $filter->date->type : 'created_at';
                /*add filter from date*/
                if (!empty($filter->date->from)) {
                    $query->whereDate($type_date, '>=', $filter->date->from);
                }
                /*add filter to date*/
                if (!empty($filter->date->to)) {
                    $query->whereDate($type_date, '<=', $filter->date->to);
                }
            }
            /*add filter include source*/
            if (isset($filter->exclude) && count($filter->exclude)) {
                $query->whereNotIn('', $filter->exclude);
            }

        }
        /*=== REQUEST ===*/
        $query->orderBy('id', 'desc'); // Order By
        //Return request with pagination
        if ($page) {
            $take ? true : $take = 12; //If no specific take, query take 12 for default
            return $query->paginate($take);
        }
        //Return request without pagination
        if (!$page) {
            $take ? $query->take($take) : false; //if request to take a limit
            return $query->get();
        }
    }

}
