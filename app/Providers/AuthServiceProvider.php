<?php

namespace App\Providers;

use App\Answer;
use App\Policies\AnswerPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\UserPolicy;
use App\Question;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
         Question::class => QuestionPolicy::class,
         Answer::class => AnswerPolicy::class,
         User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
