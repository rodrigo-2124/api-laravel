<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait
{
      //esto es un query scope
    //se pasa en la url como http://api.laravel.dev/v1/categories?inlcuded=posts,post.user
    public function scopeIncluded(Builder $query)
    { 
        if(empty($this->allowIncluded) || empty(request('included'))){
            return;
        }

        $relations= explode(',', request('included'));   //se separa el string del scope included
        $allowIncluded= collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        //se modifica la consulta en base a los parametros que se pasen
        $query->with($relations);
    }

    //se accede asi http://api.laravel.dev/v1/categories?filter[name]=et
    public function scopeFilter(Builder $query)
    {
        if(empty($this->allowFilter) || empty(request('filter'))){
            return;
        }
        $filters= request('filter');
        $allowFilter= collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%'.$value.'%');
            }
        }
    }

    //se accede asi http://api.laravel.dev/v1/categories?sort=-name     
    public function scopeSort(Builder $query)
    {
        if(empty($this->allowSort) || empty(request('sort'))){
            return;
        }

        $sortFields= explode(',', request('sort'));
        $allowSort= collect($this->allowSort);
        foreach ($sortFields as $sortField) {
            $direction= 'ASC';
            if ((substr($sortField, 0, 1) == '-')) {
                $sortField= substr($sortField, 1);
                $direction= 'DESC';
            }
            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }

    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage= intval(request('perPage'));
            if ($perPage) {
                return $query->paginate($perPage);
            }
        }
        return $query->get();
    }
}
?>