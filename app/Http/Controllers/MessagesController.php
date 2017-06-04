<?php namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageSender;
use App\Models\MessageTemplate;
use App\Models\Provider;
use SMS;
use Illuminate\Http\Response;
use Log;


class MessagesController extends BaseController
{


    /**
     * Display a listing
     *
     * @return Response
     */
    public function index()
    {
        $messages = Message::orderBy('created_at','desc')->get();

        return \View::make('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new item
     *
     * @return Response
     */
    public function compose()
    {

        $providers = Provider::query()->orderBy('last_name')->get(['mobile', 'last_name', 'first_name'])->all();
        $providers_formatted = [];
        foreach ($providers as $provider) {
            $providers_formatted[$provider->mobile] = $provider->last_name . ', ' . $provider->first_name;
        }
        $providers = ['' => ''] + $providers_formatted;

        $message_templates = MessageTemplate::query()->orderBy('name')->get(['id', 'name', 'content', 'comment'])->all();

        $messageSenders = MessageSender::query()->orderBy('name')->get(['id', 'name', 'number'])->all();
        $messageSendersFormatted = [];
        foreach ($messageSenders as $messageSender) {
            $messageSendersFormatted[$messageSender->id] = $messageSender->name . ' (' . $messageSender->number . ')';
        }
        $messageSenders = ['' => ''] + $messageSendersFormatted;


        return \View::make('messages.compose', compact('providers', 'message_templates', 'messageSenders'));
    }

    /**
     * Store a newly created item in storage
     *
     * @return Response
     */
    public function send()
    {
        $validator = \Validator::make($data = \Request::all(), Message::$rules);

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        $messageSender = MessageSender::findOrFail($data['sender_id']);

        $data['sender'] = $messageSender->number;
        $data['is_incoming'] = false;
        $data['is_sent'] = false;
        $data['source'] = $messageSender->provider;
        unset($data['sender_id'], $data['provider_id']);


        if (Message::send($data['content'], $data['receiver'], $messageSender->number, $messageSender->provider)) {
            Message::create($data);
        } else {
            return \Redirect::back()->withErrors("Message could not be sent")->withInput();
        }

        return \Redirect::route('messages');
    }


    /**
     * receive an SMS message from external API
     * @return Response
     */
    public function receiveSMS()
    {

        Log::info('Incoming SMS request');


        $inbound = SMS::receive();
        $incomingMessage = new Message();
        $incomingMessage->content = $inbound->message();
        $incomingMessage->sender = '+' . $inbound->from();
        $incomingMessage->receiver = '+' . $inbound->to();
        $incomingMessage->external_id = $inbound->id();
        $incomingMessage->meta_info = json_encode($inbound->raw());
        $incomingMessage->source = 'nexmo';


        Log::info('Message ID ' . $inbound->id());

        Log::info('JSON' . json_encode($incomingMessage));

        $success = $incomingMessage->save();


        $incomingMessage->processMessage();

        if (!$success) {
            Log::warning('Message saving failed: ' . json_encode($incomingMessage));

            $response = new Response();
            return $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

        }

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_OK);


    }

    /**
     * Display the specified message.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);

        return \View::make('messages.show', compact('message'));
    }

}
