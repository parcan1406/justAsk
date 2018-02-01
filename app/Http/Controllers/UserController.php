<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 24.01.18
 * Time: 12:12
 */

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    /**
     * @param int $user_id
     * @param string $entity
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $user_id, string $entity)
    {

        $user = User::where('id', $user_id)
            ->with('topics')
            ->withCount('questions')
            ->withCount('answers')
            ->withCount('topics')
            ->firstOrFail();

        switch ($entity) {
            case 'questions':
                $questions = $user->questions()->paginate(8);
                return view('user.questions', compact('user', 'questions'));
            case 'answers':
                $answers = $user->answers()
                    ->with('user')
                    ->with('question.topic')
                    ->paginate(5);
                return view('user.answers', compact('user', 'answers'));
            case 'topics':
                $allTopics = Topic::all();
                return view('user.topics', compact('user', 'allTopics'));
        }


    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAvatar(Request $request, User $user)
    {

        $this->authorize('update', $user);

        $this->validate($request, [
            'avatar' => 'required | mimes:jpeg,jpg,png'
        ]);

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->profile_avatar = $path;
        $user->save();
        return redirect()->back()->with('success', 'Profile image was updated successfully');
    }


    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProperty(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->all());
        $property = $request->keys()[0];
        return response()->json([
            'content' => $user->$property,
        ]);
    }
}