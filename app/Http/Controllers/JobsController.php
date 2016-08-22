<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $jobs = Job::latest()->get();

        return view('jobs.index', compact('jobs'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);

        return view('jobs.show', compact('job'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'email' => ['required', 'email']
        ]);

        $job = Job::create($input);

        if ($this->isFirstTime($input['email'])) {
            $job->markPending();
            $this->sendMails($input);
        } else {
            $job->markApproved();
        }

        return redirect('jobs');
    }

    public function postApprove(Request $request)
    {
        $input = $request->all();
        $job = Job::where('email', $input['email'])->->first();

        if ($input['offer'] === 'Approve') {
            $this->postedFirstTime($input['email']);
            $job->markApproved();
        } else {
            $job->markRejected();

        }

        return redirect('jobs');
    }

    public function getApprove($email)
    {
        return view('jobs.approve', ['email' => $email]);
    }

    /**
     * @param $email
     * @return bool
     */
    private function isFirstTime($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        return !$user->firstTimePosted;
    }

    /**
     * @param $data
     */
    private function sendMails($data)
    {

        Mail::raw('Your submission is in moderation.', function ($message) use ($data) {
            $message->subject('Waiting for approve')
                    ->to($data['email'])
                    ->from('admin@app.com');
        });

        Mail::send('emails.wait', ['data' => $data], function ($message) use ($data) {
            $message->subject('Approve message')
                    ->to('admin@app.com')
                    ->from($data['email']);
        });

    }

    private function postedFirstTime($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        $user->firstTimePosted = 1;
    }

}