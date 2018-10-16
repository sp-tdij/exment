<?php

namespace Exceedone\Exment\Model;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Facades\Admin;

class ModelBase extends Model
{
    protected $guarded = ['id'];
    
    public function getCreatedUserAttribute(){
        return $this->getUser('created_user_id');
    }
    public function getUpdatedUserAttribute(){
        return $this->getUser('updated_user_id');
    }
    public function getDeletedUserAttribute(){
        return $this->getUser('deleted_user_id');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
  

     /**
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        ///// add created_user_id, updated_user_id, deleted_user_id
        static::creating(function ($model) {
            static::setUser($model, ['created_user_id', 'updated_user_id']);
        });
        static::updating(function ($model) {
            static::setUser($model, ['updated_user_id']);
        });
        static::deleting(function ($model) {
            static::setUser($model, ['updated_user_id', 'deleted_user_id']);
        });
    }

    /**
     * set id to $columns
     */
    protected static function setUser($model, $columns = []){
        $user = Admin::user() ?? null;
        if(!isset($user)){return;}
        $base_user = $user->base_user;
        if(!isset($base_user)){return;}
        $id = $base_user->id ?? null;
        if(!isset($id)){return;}
        foreach($columns as $column){
            $model->{$column} = $id;
        }
    }
    /**
     * get user from id
     */
    protected function getUser($column){
        $value = getModelName(Define::SYSTEM_TABLE_NAME_USER)::find($this->{$column});
        if(!isset($value)){return;}
        return $value->getValue();
    }
}
