<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Interfaces\ChatRepositoryInterface;
use App\Models\Chat;
use Inertia\Inertia;
use Inertia\Response;

class ChatGPTController extends Controller
{
    /**
     * Constructor
     */
    public function __construct(private ChatRepositoryInterface $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function show(string $id = null): Response
    {
        return Inertia::render('Chat/index', $this->chatRepository->show($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request, string $id = null)
    {
        $newChat = $this->chatRepository->store($request, $id);

        return redirect()->route('chat.show', [$newChat->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        $this->chatRepository->destroy($chat);

        return redirect()->route('chat.show');
    }

    /**
     * Remove all resource of user from storage.
     */
    public function clear()
    {
        $this->chatRepository->clear();

        return redirect()->route('chat.show');
    }
}
