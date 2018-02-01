<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.01.18
 * Time: 20:47
 */

namespace App\Http\Controllers;


use App\Answer;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{

    /**
     * @param AnswerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AnswerRequest $request)
    {
       auth()->user()->answers()->create([
            'content' => $request->get('content'),
            'question_id' => $request->get('question')
        ]);

        return redirect()->back()->with('success', 'Answer was created successfully');


    }


    /**
     * @param AnswerRequest $request
     * @param Answer $answer
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProperty(AnswerRequest $request, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->all());
        return response()->json([
            'content' => $answer->content,
            'updated_at' => $answer->updated_at->format('Y-m-d H:i:s')
        ]);
    }


    /**
     * @param Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Answer $answer)
    {
        $this->authorize('remove', $answer);
        $answer->delete();
        return redirect()->back()->with('success', 'Answer was removed successfully');
    }
}