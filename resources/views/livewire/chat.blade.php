<div>
    <div>
        <flux:heading size="xl" level="1">{{ __('Chat') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Mulailah percakapan') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div>
        <div class="flex h-[550px] text-sm border rounded-xl shadow overflow-hidden">
            <!-- User List -->
            <div class="w-1/4 border-end overflow-y-auto">
                <nav>
                    <flux:heading size="sm" level="2" class="p-4 border-bottom ">{{ __('List User') }}</flux:heading>
                    @foreach ($users as $user) 
                        
                    <div wire:click="selectUser({{ $user->id }})" class="p-3 cursor-pointer hover:bg-blue-100 transition 
                        {{ $selectedUser->id === $user->id ? 'bg-blue-200' : '' }}">
                        <div class="font-semibold text-neutral-500 dark:text-neutral-400">{{ $user->name }}
                            <span></span>
                        </div>
                        <div class="text-sm text-neutral-500 dark:text-neutral-400">
                            {{ $user->email }}
                        </div>  
                        
                        
                    </div>
                    @endforeach
                </nav>
              
            </div>
            {{-- right: chat section --}}
            <div class="w-3/4 border-start overflow-y-auto">
                <!--header-->
                <div  class="p-4 border-b text-neutral-500 dark:text-neutral-400">
                    <div class="text-lg font-semibold text-neutral-500 dark:text-neutral-400">{{ $selectedUser->name }}</div>
                    <div class="text-sm text-gray-500">{{ $selectedUser->email }}</div>
                    
                </div>
                <!--messages-->
                <div class="p-4 h-[350px] overflow-y-auto space-y-2 text-neutral-500 dark:text-neutral-400">
                    @foreach ($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} ">
                        <div class="{{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-blue-200 text-gray-800' }} p-2 rounded-lg max-w-xs">
                            {{ $message->message }}
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div id="Typing-indicator" class="px-4 pb-1 text-xs text-neutral-500 dark:text-neutral-400 italic"></div>
                <!-- Message Input -->
                <form wire:submit="submit" class="p-3 border-t text-neutral-500 dark:text-neutral-400 flex space-x-2">
                    <input 
                        wire:model.live="messageText"
                        type="text" 
                        class="w-full p-2 border rounded" 
                        placeholder="Type your message..." 
                    />
                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Send</button>
                </form>

          
                   
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('userTyping', (event) => {
            console.log(event);
            window.Echo.private(`chat.${event.selectedUserID}`)
                .whisper("typing", {
                    userID: event.userID,
                    userName: event.userName
                });
        });
        window.Echo.private(`chat.{{ $loginID }}`).listenForWhisper('typing', (event) => {
                var t = document.getElementById('Typing-indicator');
                t.innerText = `${event.userName} is typing...`;

                setTimeout(() => {
                    t.innerText = '';
                }, 2000);
            });

    }); 
</script>

