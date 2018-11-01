<?php

namespace Modules\Agrocont\Repositories\Eloquent;

use Modules\Agrocont\Entities\Land;
use Modules\Agrocont\Events\Lands\LandIsCreating;
use Modules\Agrocont\Events\Lands\LandIsUpdating;
use Modules\Agrocont\Events\Lands\LandWasCreated;
use Modules\Agrocont\Events\Lands\LandWasDeleted;
use Modules\Agrocont\Events\Lands\LandWasUpdated;
use Modules\Agrocont\Repositories\LandsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentLandsRepository extends EloquentBaseRepository implements LandsRepository
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


        event($event = new LandIsCreating($data));
        $land = $this->model->create($event->getAttributes());
        $land->users()->sync($data->users);
        event(new LandWasCreated($land, $data));
        

        return $land;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {
   
        event($event = new LandIsUpdating($model, $data));
        $model->update($event->getAttributes());
        $model->users()->sync($data->users);
        event(new LandWasUpdated($model, $data));

        return $model;
    }

    public function destroy($page)
    {
        $page->untag();

        event(new LandWasDeleted($page));

        return $page->delete();
    }

    public function whereFilter($page, $take, $filter, $include)
    {
        //Initialize Query
        $query = $this->model->query();
        /*== RELATIONSHIPS ==*/
        if (count($include)) {
            //Include relationships for default
            $includeDefault = [
                'user',
                'translates'
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
    /**
     * Return a prelead by ID
     *
     * @param $id {int} : Require
     * @param $include {array} : optional
     * @return {object}
     */
    public function show($id, $include = [])
    {
        //Initialize Query
        $query = $this->model->where('id', $id);
        /*== RELATIONSHIPS ==*/
        if (count($include)) {
            //Include relationships for default
            $includeDefault = [
              'user'
            ];
            $query->with(array_merge($includeDefault, $include));
        }
        //Return prelead
        return $query->first();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function wherebyUser($id){

        return $this->model->whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->with('users')->get();

    }


}
