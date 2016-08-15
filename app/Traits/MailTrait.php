<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:20 PM
 */

namespace App\Traits;


use App\Http\Requests\Requests\Mail\AgentMailRequest;
use App\Http\Requests\Requests\Mail\ContactUSMailRequest;
use App\Http\Requests\Requests\Mail\MailPropertyToFriendRequest;
use App\Http\Requests\Requests\Mail\MailToAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Traits\User\UsersFilesReleaser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

trait MailTrait {
    use UsersFilesReleaser;
   public function mailToFriend(MailPropertyToFriendRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.mail_property_to_friend',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to($user['to'])->subject('Property42');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function mailToAgent(MailToAgentRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.mail_property_to_agent',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to($user['from'])->subject('Property42');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function contactUS(ContactUSMailRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.contact_us',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Property42');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function mailAgent(AgentMailRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.agent_mail',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to($user['to'])->subject('Property42');
        });

        return redirect()->back();
    }
    public function MailFeedbackUs($request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.feedback-us',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Property42.pk');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Property42');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
} 