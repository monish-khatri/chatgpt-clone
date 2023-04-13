<?php

namespace App\Repositories;

use App\Http\Requests\StoreChatRequest;
use App\Interfaces\ChatRepositoryInterface;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;

class ChatRepository implements ChatRepositoryInterface
{
    public function model(): Chat|string
    {
        return Chat::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function show(string $id = null): array
    {
        return [
            'chat' => $id ? Chat::findOrFail($id) : null,
            'messages' => Chat::latest()->where('user_id', Auth::id())->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request, string $id = null): Chat
    {
        $messages = [];
        if ($id) {
            $chat = Chat::findOrFail($id);
            $messages = $chat->context;
        }
        $messages[] = ['role' => 'user', 'content' => $request->input('promt')];

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages
        ]);
        $messages[] = ['role' => 'assistant', 'content' => formatChatResponse($response->choices[0]->message->content)];

        return Chat::updateOrCreate([
            'id' => $id,
            'user_id' => Auth::id()
        ],[
            'context' => $messages
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat): bool
    {
        return $chat->delete();
    }

    /**
     * Remove all resource of user from storage.
     */
    public function clear(): bool
    {
        return Chat::where('user_id', Auth::id())->delete();
    }
}
