<?php

namespace Modules\Agrocont\Repositories\Eloquent;

use Modules\Agrocont\Repositories\CropsRepository;
use Modules\Agrocont\Events\Crops\CropIsCreating;
use Modules\Agrocont\Events\Crops\CropIsUpdating;
use Modules\Agrocont\Events\Crops\CropWasCreated;
use Modules\Agrocont\Events\Crops\CropWasDeleted;
use Modules\Agrocont\Events\Crops\CropWasUpdated;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCropsRepository extends EloquentBaseRepository implements CropsRepository
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


        event($event = new CropIsCreating($data));
        $land = $this->model->create($event->getAttributes());

        event(new CropWasCreated($land, $data));


        return $land;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {

        event($event = new CropIsUpdating($model, $data));
        $model->update($event->getAttributes());

        event(new CropWasUpdated($model, $data));


        return $model;
    }

    public function destroy($page)
    {
        $page->untag();

        event(new CropWasDeleted($page));

        return $page->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function whereByLand($id){
        return $this->model->where('user_id',$id)->get();
    }
}
