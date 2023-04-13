<?php

namespace App\Interfaces;

use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;

interface ChatRepositoryInterface
{
    public function show(string $id = null);
    public function store(StoreChatRequest $request, string $id = null);
    public function destroy(Chat $chat);
    public function clear();
}