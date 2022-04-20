<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libraries\Globals;
use App\Libraries\JsDataTables;
use Carbon\Carbon;
use App\Models\Bookshelf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BookShelfController extends Controller
{
    //
    public function index()
    {
        return view('bookshelf.index');
    }
    
    public function create()
    {
        return view('bookshelf.create');
    }

    public function store(Request $request)
    {
        $result = "Unable to Submit. Please Try Again.";

        $request->validate([
            'title' => 'required',
            'description' => 'max:500',
        ]);

        DB::beginTransaction();
        try {
            $bookshelf = new Bookshelf();
            $bookshelf->user_id = auth()->id();
            $bookshelf->title = $request->input('title');
            $bookshelf->description = $request->input('description');
            $bookshelf->save();
            DB::commit();
            $request->session()->flash('success', 'Record Saved Successfully');

            return redirect()->route('bookshelf.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput();

        }            
    }

    public function show(Request $request, $id)
    {
        $data = BookShelf::find($id);
        if($data){
            return view('bookshelf.show', compact('data'));
        }else{
            $request->session()->flash('fail', 'Record not found');
        }
        return redirect()->route('bookshelf.index');
        
    }

    public function update(Request $request, $id)
    {
        $bookshelf = BookShelf::find($id);

        if($bookshelf){
            $result = "Unable to Submit. Please Try Again.";

            $request->validate([
                'title' => 'required',
                'description' => 'max:500',
            ]);

            DB::beginTransaction();
            try {
                $bookshelf->title = $request->input('title');
                $bookshelf->description = $request->input('description');
                $bookshelf->is_read = $request->has('is_read') ? '1' : '0';
                $bookshelf->save();
                DB::commit();
                $request->session()->flash('success', 'Record Saved Successfully');
    
                return redirect()->route('bookshelf.show',['id'=>$id]);
            } catch (\Exception $e) {
                return $e;
                DB::rollBack();
                $request->session()->flash('fail', $result);

                return redirect()->back()->withInput();
            }
            
        }else{
            $request->session()->flash('fail', 'Record Not Found');
        }
        return redirect()->route('bookshelf.index');
        
    }

    public function get(Request $request)
    {
        if ($request->has("_act")) {
            $act = $request->input("_act");
            if ($act == "get_listing") {
                return $this->getListing($request);
            } 
        }

        if ($request->isXmlHttpRequest()) {
            return response("Page Not Found", 404);
        } else {
            abort(404);
        }
    }

    public function getListing(Request $request){
        $jsDataTables = new JsDataTables($request->all());
        $data = [];

        // Get records from database.
        $queryBuilder = $this->initQueryBuilder($jsDataTables);
        $recordsTotal = $queryBuilder->count();

        // Filter records by search params and paginate records.
        $queryBuilder = $this->filterQueryBuilder($jsDataTables, $queryBuilder);
        $recordsFiltered = $queryBuilder->count();

        // Get limit records by paginate.
        $records = $queryBuilder->skip($jsDataTables->start())->take($jsDataTables->length())->get();

        // Convert record rows into array.
        foreach ($records as $row) {
            $data[] = [
                $row->id,
                $row->title,
                $row->description,
                $row->is_read == 0 ? 'No' : 'Yes',
            ];
        }

        return $jsDataTables->resultJson($recordsTotal, $recordsFiltered, $data);
    }

    /**
     * @param \App\Libraries\JsDataTables $jsDataTables
     * @return \Illuminate\Database\Query\Builder
     */
    private function initQueryBuilder($jsDataTables)
    {
        $selects = [
            'id', 'title', 'description', 'is_read'
        ];

        $queryBuilder = DB::table('bookshelves')
            ->where("user_id","=", auth()->id())
            ->select($selects);

        $queryBuilder = $jsDataTables->orderByQueryBuilder($selects, $queryBuilder);

        return $queryBuilder;
    }

    private function filterQueryBuilder($jsDataTables, $queryBuilder)
    {
        // Standardize function to filter model for show and export records.
        $searchParams = $jsDataTables->searchParams();

        $queryBuilder = $queryBuilder->when($searchParams["book_title"], function ($query) use ($searchParams) {
            return $query->where("title", "LIKE", "%{$searchParams["book_title"]}%");
        })->when($searchParams["is_read"], function ($query) use ($searchParams) {
            if('yes' == strtolower($searchParams["is_read"])){
                return $query->where("is_read", "=" , 1);
            }else if('no' == strtolower($searchParams["is_read"])){
                return $query->where("is_read", "=" , 0);
            }
            
        });

        return $queryBuilder;

    }

    public function delete(Request $request, $id){
        $bookshelf = BookShelf::find($id);

        if ($bookshelf) {

            $bookshelf->delete();

            $request->session()->flash('success', 'Record Deleted Successfully');
        } else {
            $request->session()->flash('fail', 'Record Not Found');
        }
        return redirect()->route('bookshelf.index');            
        
    }

}
