<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ValidatioTagRequest;
use Illuminate\Support\Str;


class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::get();

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }

    public function createTag()
    {
        return view('tags.create',[
            'tag' => new Tag ,
        ]);
    }

    public function storeTag(ValidatioTagRequest $request)
    {
        $request->validated();

        $input['name'] = $request->input('name');
        $input['status'] = $request->input('status');
        $input['slug'] = Str::slug($request->input('name'));


        Tag::create($input)->save();
        return redirect()->route('tag.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editTag(Tag $tag){
        return view('tags.edit' , [
            'tag' => $tag ,
        ]);
    }
    public function updateTag(ValidatioTagRequest $request, Tag $tag){
        $request->validated();

        $input['name'] = $request->input('name');
        $input['status'] = $request->input('status');
        $input['slug'] = Str::slug($request->input('name'));


        $tag->update($input);
        return redirect()->route('tag.index')
        ->with([
            'message' => 'Tag updated successfully',
            'alert-type' => 'info'
        ]);
    }

    public function destroyTag($id){
        $tag = Tag::find($id);

        $tag->delete();
        return redirect('admin/tags')->with([
            'message' => 'deleted successfully',
            'alert-type' => 'success'
        ]);
    }



}
