<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 14.01.18
 * Time: 13:11
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $topics = Topic::paginate(15);

        return view('admin.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topic.create');
    }



    public function store(StoreTopicRequest $request)
    {
        Topic::create($request->all());
        return redirect()->route('admin.topic.index')
            ->with('success', 'Topic was created successfully');

    }


    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Topic $topic)
    {
        return view('admin.topic.edit', compact('topic'));
    }



    public function update(UpdateTopicRequest $request, Topic $topic)
    {

        $topic->update($request->all());
        return redirect()->route('admin.topic.index')
            ->with('success', 'Topic was updated successfully');
    }


    /**
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topic.index')
            ->with('success', 'Topic was removed successfully');
    }
}