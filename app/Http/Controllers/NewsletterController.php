<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsletterPostRequest;
use App\PDFGenerator;

class NewsletterController extends Controller
{
    public function create()
    {
        $recipients = $this->getRecipients();
        return view('manager.newsletter.create', compact('recipients'));
    }

    public function send(NewsletterPostRequest $request)
    {
        $recipients = $this->getRecipients();
        $subject = $request->get('subject');
        $body = $request->get('body');

        if($recipients === null)
        {
            back();
        }

        foreach ($recipients as $person)
        {
            $attachmentPath = PDFGenerator::generatePDFPath('newsletter', compact('person', 'subject', 'body'));
                \Mail::send('newsletter.main', compact('person', 'subject', 'body'), function($message) use ($person, $subject, $attachmentPath) {
                    $message->from(env('MAIL_USERNAME'));
                    $message->to($person->email);
                    $message->subject($subject);
                    $message->attach($attachmentPath);
                });
        }

        $success = true;
        return view('manager.newsletter.create', compact('recipients', 'success'));
    }

    protected function getRecipients()
    {
        $user = \Auth::user();
        $hotels = $user->hotels;

        $recipients = null;

        foreach($hotels as $hotel)
        {
            if($recipients == null)
            {
                $recipients = $hotel->newsletters->where('active', true);
                continue;
            }

            $recipients = $hotel->newsletters->where('active', true)->merge($recipients);
        }

        return $recipients->unique('email');
    }
}
