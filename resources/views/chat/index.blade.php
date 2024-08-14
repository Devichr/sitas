<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full">
            <div class="w-1/4 border-r border-gray-200">
                <h2 class="text-lg font-bold p-4">Chat</h2>
            </div>
            <div class="w-full">
                <h2 id="receiverName" class="text-lg font-bold p-4">
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="flex h-[calc(100vh-7rem)]">
        <div class="border-r border-gray-200 bg-white w-1/4">
            <ul id="userList"></ul>
        </div>
        <div class="flex-1 flex flex-col">
            <div id="messages" class="flex-1 p-4 overflow-y-auto space-y-4">
                <div class="flex justify-center items-center h-full" id="notes"><p class="font-bold text-xl bg-white rounded-lg p-4">Silahkan pilih dari daftar kontak untuk Memulai chat</p></div>
            </div>
            <div class="border-t p-4">
                <form id="messageForm" enctype="multipart/form-data" class="hidden">
                    <input type="hidden" id="receiverId" name="receiver_id" value="">
                    <label for="file" class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                            </path>
                        </svg>
                    </label>
                    <input type="file" id="file" name="file" class="hidden">
                    <input type="text" id="message" name="message" placeholder="Type a message"
                        class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                        autocomplete="off">
                    <button type="submit"
                        class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0"><span>Send</span>
                        <span class="ml-2">
                            <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </span></button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userId = localStorage.getItem('chatUserId');
            const userName = localStorage.getItem('chatUserName');

            if (userId && userName) {
                selectUser(userId, userName);
                localStorage.removeItem('chatUserId');
                localStorage.removeItem('chatUserName');
            }
        });
        let selectedUserId = null;

        function selectUser(userId, userName) {
            if (selectedUserId) {
                document.getElementById(`${selectedUserId}`).classList.remove('bg-gray-300');
            }

            selectedUserId = userId;
            document.getElementById('receiverId').value = userId;
            document.getElementById('receiverName').innerHTML = userName;

            document.getElementById(`${selectedUserId}`).classList.add('bg-gray-300');
            document.getElementById('messageForm').classList.add('flex');


            fetchMessages();
        }

        function loadUserList() {
            fetch('/chatlist')
                .then(response => response.json())
                .then(users => {
                    const userList = document.getElementById('userList');
                    userList.innerHTML = '';

                    users.forEach(user => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('p-4', 'border-b', 'cursor-pointer', 'ml-10');
                        listItem.setAttribute('id', user.id);
                        listItem.onclick = () => selectUser(user.id, user.name);

                        listItem.innerHTML = `
                    ${user.name}
                    ${user.unread_count > 0 ? `<span class="bg-red-500 text-white rounded-full px-2 ml-2">${user.unread_count}</span>` : ''}
                `;

                        userList.appendChild(listItem);
                    });
                });
        }

        function fetchMessages() {
            if (!selectedUserId) return;


            document.getElementById('messageForm').classList.remove('hidden');
            document.getElementById('messageForm').classList.add('flex');
            fetch(`/messages/${selectedUserId}`)
                .then(response => response.json())
                .then(data => {
                    const messagesContainer = document.getElementById('messages');
                    messagesContainer.innerHTML = '';
                    let lastDate = null;

                    data.forEach(message => {
                        const messageDate = new Date(message.created_at).toLocaleDateString();

                        if (messageDate !== lastDate) {
                            const dateSeparator = document.createElement('div');
                            dateSeparator.classList.add('text-center', 'text-gray-500', 'text-xs', 'my-2', 'border-t', 'border-gray-500', 'border-dashed');
                            dateSeparator.innerText = messageDate;
                            messagesContainer.appendChild(dateSeparator);
                            lastDate = messageDate;
                        }

                        const messageElement = document.createElement('div');
                        messageElement.classList.add('py-2', 'rounded-xl', 'shadow-md', 'px-4', 'max-w-xs',
                            'text-white', 'relative', 'w-fit', 'mb-2');

                        if (message.sender_id === {{ auth()->id() }}) {
                            messageElement.classList.add('bg-blue-500', 'ml-auto');
                            messageElement.innerHTML = `
                            <div>${message.message}</div>`;
                        } else {
                            messageElement.classList.add('bg-gray-100', 'mr-auto');
                            messageElement.innerHTML = `
                            <div class="text-black">${message.message}</div>`;
                        }



                        if (message.file_path) {
                            const fileLink = document.createElement('a');
                            fileLink.href = `/storage/${message.file_path}`;
                            fileLink.innerText = 'Download File';
                            fileLink.classList.add('block', 'text-blue-300', 'underline', 'mt-2');
                            messageElement.appendChild(fileLink);
                        }

                        const infoElement = document.createElement('div');
                        infoElement.classList.add('flex', 'justify-between');
                        const time = new Date(message.created_at).toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        const timeElement = document.createElement('p');
                        timeElement.classList.add('text-xs', 'text-gray-300', 'mt-1', 'flex');
                        timeElement.innerText = time;
                        infoElement.appendChild(timeElement);

                        if (message.sender_id === {{ auth()->id() }}) {
                            const statusElement = document.createElement('p');
                            statusElement.classList.add('text-xs', 'text-gray-300', 'mt-1', 'flex', 'ml-2');
                            statusElement.innerText = message.status;
                            infoElement.appendChild(statusElement);
                        }

                        messageElement.appendChild(infoElement);
                        messagesContainer.appendChild(messageElement);
                    });

                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadUserList();
            const userId = localStorage.getItem('chatUserId');
            const userName = localStorage.getItem('chatUserName');

            if (userId && userName) {
                selectUser(userId, userName);
                localStorage.removeItem('chatUserId');
                localStorage.removeItem('chatUserName');
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            loadUserList();
            const userId = localStorage.getItem('chatUserId');
            const userName = localStorage.getItem('chatUserName');

            if (userId && userName) {
                selectUser(userId, userName);
                localStorage.removeItem('chatUserId');
                localStorage.removeItem('chatUserName');
            }
        });


        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('receiver_id', selectedUserId);

            fetch('/messages', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    document.getElementById('message').value = '';
                    document.getElementById('file').value = '';
                    fetchMessages();
                });
        });
    </script>
</x-app-layout>
