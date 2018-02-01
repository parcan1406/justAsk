<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 19.01.18
 * Time: 18:09
 */

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;

class CommentController
{

    public function index() {

        $commetable_id = request()->get('commentable_id');
        $commentable_type = request()->get('commentable_type');
        $comments = Comment::where('commentable_id', $commetable_id)
            ->where('commentable_type', $commentable_type)->orderBy('updated_at')->get();

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = auth()->user()->comments()->create($request->all());
        return new CommentResource($comment);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        return view('question.edit', compact('question'));
    }


    /**
     * @param AnswerRequest $request
     * @param Answer $answer
     */
    public function update(AnswerRequest $request, Answer $answer)
    {
        $answer->update($request->all());
        return response()->json([
            'content' => $answer->content,
            'updated_at' => $answer->updated_at->format('Y-m-d H:i:s')
        ]);
    }


    /**
     * @param Question $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Question $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topic.index')
            ->with('success', 'Topic was removed successfully');
    }

    private function recursiveComments($commentable_id, $commentable_type) {

    }
}