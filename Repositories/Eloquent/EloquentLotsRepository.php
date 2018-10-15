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


}
