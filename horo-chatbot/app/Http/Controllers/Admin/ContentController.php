<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Photosaver;
use App\Helpers\Stringsplit;
use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Null_;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $contents = Content::with('category')->paginate(10);
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::with('grandchildren')
            ->where('url_type', NUll)
            ->where('parent_id', '=', NULL)
            ->orWhere('id', 251)
            ->orWhere('id', 276)
            ->orWhere('id', 277)
            ->get();
        return view('admin.content.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
    {

        $photo = Photosaver::savePhoto($request, "image");
        $data = $request->all();
        $data['image'] = $photo;
        $sequence = 1;

//
//        if ($photo != null) {
//            Content::create([
//                'category_id' => $data['category_id'],
//                'image' => $data['image'],
//                'sequence' => 1,
//            ]);
//            $sequence++;
//        }

        $string = $data['content'];
        $contents = Stringsplit::mm_split($string, 1500);

        Content::create([

            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'start_date' =>  $request->filled('start_date') ? $request->get('start_date') : NULL,
            'end_date' =>  $request->filled('end_date') ? $request->get('end_date') : NULL,
            'for_month' =>  $request->filled('for_month') ? ltrim(strstr($request->for_month, '-'), '-') : NULL,
            'for_date' =>  $request->filled('for_date') ?  $request->get('for_date') : NULL,
            'content' => \GuzzleHttp\json_encode($contents),
        ]);

//
//        foreach ($contents as $key => $content) {
//            Content::create([
//                'category_id' => $data['category_id'],
//                'content' => $content,
//                'sequence' => $key + $sequence,
//            ]);
//        }
//
//
        return redirect(route('admin.content.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        $content = Content::with('category')->find($id);
        $body = \GuzzleHttp\json_decode($content->content);
        $block = Stringsplit::combine($body);
        $content->content = $block;
//        dd($content);
        return view('admin.content.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $content = Content::with('category')->find($id);
        $categories = Category::with('grandchildren')
            ->where('url_type', NUll)
            ->where('parent_id', '=', NULL)
            ->get();
        $body = \GuzzleHttp\json_decode($content->content);
        $block = Stringsplit::combine($body);
        $content->content = $block;
//        dd($content);


        return view('admin.content.edit', compact('content', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //



        $string = $request->content;
        $body = Stringsplit::mm_split($string, 1500);

        $content = Content::findorFail($id);

        $content->category_id = $request->category_id;
        $content->content = \GuzzleHttp\json_encode($body);
        if ($request->image != null){
            $photo = Photosaver::savePhoto($request, "image");
            $content->image = $photo;
        }
        $content->for_date = $request->for_date;
        $content->save();

        return redirect(route('admin.content.show',$content->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        Content::destroy($id);

        return redirect()->back();
    }
}
