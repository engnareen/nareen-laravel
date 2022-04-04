<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValditionRequestArticle;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Image;

use PHPUnit\Util\Json;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articles = Article::orderby('id', 'desc')->get();
        $articles = Article::get();

        return view('articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create',[
            'article' => new Article ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(ValditionRequestArticle $request)
    // {
    //     $request->validated();

    //     $input['title'] = $request->input('title');
    //     $input['summary'] = $request->input('summary');
    //     $input['description'] = $request->input('description');

    //     //if($image = $request->file('image_path')){

    //         $file_name = time() . '-' . $request->title . '-' . $image->extension();
    //         $request->image_path->move(public_path('uploads/Articles'), $file_name)->save();

    //         //$file_name = time() . '-' . $request->title . '.' . $image->getClientOriginalExtension();
    //         //$path = public_path('uploads/Articles/' . $file_name);
    //         // Image::make($image->getRealPath())->ressize(500, 334, function($constraint){
    //         //     $constraint->aspectRatio();
    //         // })->save($path, 100);

    //         $input['image_path'] =$file_name;
    //     //}
    //     Article::create($input);

    //     return redirect()->route('article.index')
    //     ->with('success', 'Article added Successfully');
    // }
    public function store(ValditionRequestArticle $request)
    {

        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['description'] = $request->input('description');

        $image = $request->file('image_path');

        if($image){
        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Articles'), $file_name);

        $input['image_path'] =$file_name;

        }

        Article::create($input)->save();
         return redirect()->route('article.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
        // return redirect()->route('article.index')
        // ->with('success', 'Article added Successfully');


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
    public function edit(Article $article)
    {
        return view('articles.edit' , [
            'article' => $article ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValditionRequestArticle $request, Article $article)
    {
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['description'] = $request->input('description');

        $image = $request->file('image_path');
        if($image){
            if($article->image_path !=null && File::exists('uploads/Articles/' . $article->image_path)){
                unlink('uploads/Articles/' . $article->image_path);

            }

        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Articles'), $file_name);

        $input['image_path'] =$file_name;
        }
        $article->update($input);
        return redirect()->route('article.index')
        ->with([
            'message' => 'Article updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if($article->image_path !=null && File::exists('uploads/Articles/' . $article->image_path)){
            unlink('uploads/Articles/' . $article->image_path);
        }
        $article->delete();
        //Article::destroy($id);
        return redirect('/article')->with([
            'message' => 'deleted successfully',
            'alert-type' => 'success'
        ]);

    }

    public function remove_image(Request $request)
    {

        $article = Article::findOrFail($request->article_id);
        if (File::exists('uploads/Articles/'. $article->image_path)){
            unlink('uploads/Articles/'. $article->image_path);
            $article->image_path = null;
            $article->save();
        }
        return true;
    }


}


        // if (request()->wantsJson()) {
        //     return response()->json([
        //         'success' => true
        //     ]);
        // }
        // return Response::json([
        //     'success' => true,
        //     'message' => 'Article deleted Succesfully!'
        // ], 200);

        //return redirect()->back()->with('success', 'Article deleted Succesfully!');
        //return Json(new { success = true, message = "Delete Succesfully" }, JsonRequestBehavior.AllowGet);


        // $rules = [
        //     'title' => 'required|string|min:3|max:20',
        //     'summary'=> 'required',
        //     'description'=> 'required',
        //     'image' => 'required|mimes:png,jpg,jpeg',
        //     ];
        // $this->validate($request, $rules);
