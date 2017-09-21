<?php

namespace App\Http\Controllers;

use App\PDFGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\NewsletterPostRequest;

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
            // example.com E-Mails überspringen
            if(strpos($person->email, 'example.com')) {
                continue;
            }

            $attachmentPath = PDFGenerator::generatePDFPath('newsletter', compact('person', 'subject', 'body'));
            try {
                \Mail::send('newsletter.main', compact('person', 'subject', 'body'), function($message) use ($person, $subject, $attachmentPath) {
                        $message->from(env('MAIL_USERNAME'));
                        $message->to($person->email);
                        $message->subject($subject);
                        $message->attach($attachmentPath);
                    });
                 $success = true;
            } catch (\Swift_TransportException $e) {
                $success = false;
            }
        }
        return view('manager.newsletter.create', compact('recipients', 'success'));
    }

    protected function getRecipients()
    {
        $user = \Auth::user();
        $hotels = $user->hotels->where('active', true);

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
