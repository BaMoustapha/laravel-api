<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Affiche la liste des messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();
        return response()->json($messages);
    }

    /**
     * Enregistre un nouveau message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'body' => 'required|string'
        ]);


        $message = Message::create([
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'body' => $request->input('body'),
        ]);

        return response()->json($message, 201);
    }

    /**
     * Affiche les détails d'un message.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return response()->json($message);
    }

    /**
     * Supprime un message spécifique.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json(null, 204);
    }
}
