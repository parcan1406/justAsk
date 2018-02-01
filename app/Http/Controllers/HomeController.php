<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function feed()
    {
        $user_id = auth()->user()->id;
        $questions = Question::whereHas('topic.users', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->with('topic')
            ->with('user')
            ->orderBy('updated_at', 'desc')
            ->paginate(7);

        return view('home.feed', compact('questions'));

    }
}
