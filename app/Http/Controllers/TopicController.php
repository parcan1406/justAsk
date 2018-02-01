<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 29.01.18
 * Time: 16:29
 */

namespace App\Http\Controllers;


use App\Http\Resources\TopicResource;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();

        $topic_ids = $request->get('topics');
        $user->topics()->sync($topic_ids, false);

        return TopicResource::collection($user->topics);

    }

    /**
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $name)
    {
        $topic = Topic::where('name', $name)
            ->with('questions.user')
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();

        return view('topic.show', compact('topic'));
    }



    /**
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Topic $topic)
    {
        auth()->user()->topics()->detach($topic);
        return response()->json([
           'status' => 200
        ]);
    }

    public function userTopics()
    {
        $user = User::findOrFail(request()->get('user_id'));
        return response()->json([
            'data' => TopicResource::collection($user->topics),
            'can_remove' => auth()->user()->id == $user->id,
        ]);
    }

}