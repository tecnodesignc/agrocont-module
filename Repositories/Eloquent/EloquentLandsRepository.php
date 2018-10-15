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

        event(new LandWasUpdated($model, $data));


        return $model;
    }

    public function destroy($page)
    {
        $page->untag();

        event(new LandWasDeleted($page));

        return $page->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function wherebyUser($id){
        return $this->model->where('user_id',$id)->get();
    }


}
