<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller
{
    /**
     * Базовая информация:
     * @url https://laravel.com/docs/5.8/collections
     * 
     * Справочная информация:
     * @url https://laravel.com/api/5.8/Illuminate/Support/Collection.html
     * 
     * Вариант коллекции для моделей eloquent:
     * @url https://laravel.com/api/5.8/Illuminate/Database/Eloquent/Collection.html
     * 
     * Билдер запросов - то с чем можно перепутать коллекции:
     * @url https://laravel.com/docs/5.8/queries
     */
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

        //dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());

/*        dd(
            get_class($eloquentCollection),
            get_class($collection),
            $collection
        );

        $result['first'] = $collection->first();
        $result['last'] = $collection->last();

        $result['where']['data'] = $collection
            ->where('category_id', 10)
            ->values() // Обновить ключи
            ->keyBy('id'); // Ключи в соответствии с id


        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        $result['where_first'] = $collection
            ->firstWhere('created_at', '>', '2019-01-17 01:35:11');
        
        // Базовая переменная не изменится. Просто вернется измененная версия.
        $result['map']['all'] = $collection->map(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);

            return $newItem;
        });

        $result['map']['not_exists'] = $result['map']['all']->where('exists', '=', false);
*/
        // Базовая переменная изменится (трансформируется).
        $collection->transform(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);

            return $newItem;
        });
        /*
        //dd($collection);
        $newItem = new \stdClass();
        $newItem->id = 9999;
        
        $newItem2 = new \stdClass();
        $newItem2->id = 8888;

        // Установить элемент в начало коллекции
        $newItemFirst = $collection->prepend($newItem)->first();
        $newItemLast = $collection->push($newItem2)->last();
        $pulledItem = $collection->pull(1);

        dd(compact('collection', 'newItemFirst', 'newItemLast', 'pulledItem'));

        // Фильтрация. Замена orWhere()
        $filtered = $collection->filter(function ($item)
        {
           //return $item->created_at->isFriday() && ($item->created_at->day == 11);
             $byDay = $item->created_at->isFriday();
             $byDate = $item->created_at->day == 13;

             //$result = $item->created_at->isFriday() && ($item->created_at->day == 11);
             $result = $byDay && $byDate;

             return $result;
        });

        dd(compact('filtered')); */

        /*
        $sortedSimpleCollection  = collect([5, 3, 1, 2, 4])->sort();
        $sortedAscCollection = $collection->sortBy('created_at');
        $sortedDescCollection = $collection->sortByDesc('item_id');

        dd(compact('sortedSimpleCollection', 'sortedAscCollection', 'sortedDescCollection'));
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
