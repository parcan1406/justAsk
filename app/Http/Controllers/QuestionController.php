<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 17.01.18
 * Time: 13:20
 */

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\CommentResource;
use App\Question;
use App\Topic;

class QuestionController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $topics = Topic::all();
        return view('question.create', compact('topics'));
    }


    /**
     * @param QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {

        $question = auth()->user()->questions()->create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'topic_id' => $request->get('topic')
        ]);

        return redirect()->route('question.show', $question);


    }


    /**
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Question $question)
    {
        $answers = $question->answers()->with('user')->paginate(5);

        return view('question.show', compact('question', 'answers'));
    }


    /**
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        $topics = Topic::all();
        return view('question.edit', compact('question', 'topics'));
    }


    /**
     * @param QuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);

        $question->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'topic_id' => $request->get('topic')
        ]);
        return redirect()->route('question.show', $question)
            ->with('success', 'Question was updated successfully');
    }


    /**
     * @param Question $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Question $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topic.index')
            ->with('success', 'Question was removed successfully');
    }
}