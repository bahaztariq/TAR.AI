<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Assistant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        slate: {
                            850: '#1e293b', // Custom dark shade matching previous sidebar
                            900: '#0f172a', // Main bg
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar to match the previous aesthetic */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        .typing-dot {
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-50 h-screen flex overflow-hidden font-sans">

    <aside class="hidden md:flex w-[280px] bg-slate-800 border-r border-slate-700 p-6 flex-col gap-4">
        <div class="text-2xl font-semibold bg-gradient-to-br from-indigo-500 to-blue-500 bg-clip-text text-transparent mb-4 flex items-center gap-2">
            <span>✨</span> TAR.AI
        </div>

        <button onclick="location.reload()" class="w-full bg-gradient-to-br from-indigo-500 to-blue-500 hover:opacity-90 text-white font-medium py-3 px-4 rounded-lg transition-opacity flex items-center justify-center gap-2">
            + New Chat
        </button>

        <div class="mt-4">
            <label class="block text-xs text-slate-400 mb-2 font-medium">Model</label>
            <select id="modelSelect" class="w-full bg-slate-700 text-slate-200 text-sm rounded-lg p-3 border border-slate-600 focus:outline-none focus:border-indigo-500 transition-colors">
                <option value="gemini">Google Gemini</option>
                <option value="openai">OpenAI (GPT-3.5)</option>
            </select>
        </div>

        <div class="flex-1"></div>

        <div style="font-size: 0.8rem; color: var(--text-secondary);">
            Powered by Multi-LLM
        </div>
    </aside>

    <main class="flex-1 flex flex-col bg-slate-900 relative">
        <div id="chatContainer" class="flex-1 overflow-y-auto p-4 md:p-8 flex flex-col gap-6 scroll-smooth">
            <div class="flex gap-4 max-w-3xl w-full mx-auto animate-[fadeIn_0.3s_ease]">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center text-sm text-white shrink-0">AI</div>
                <div class="bg-slate-800 border border-slate-700 rounded-tr-xl rounded-br-xl rounded-bl-xl p-4 md:p-6 text-slate-100 leading-relaxed max-w-[85%]">
                    Hello! I am your AI assistant. How can I help you today?
                </div>
            </div>
        </div>

        <div class="p-4 md:p-8 bg-slate-900 border-t border-slate-700">
            <div class="max-w-3xl mx-auto relative">
                <input type="text" id="userInput"
                    class="w-full bg-slate-800 border border-slate-700 rounded-2xl py-4 pl-6 pr-14 text-slate-100 focus:outline-none focus:border-blue-500 transition-colors h-[60px]"
                    placeholder="Type your message here..."
                    autocomplete="off">

                <button id="sendBtn" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-500 p-2 transition-colors">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </div>
        </div>
    </main>

    <script>
        const chatContainer = document.getElementById('chatContainer');
        const userInput = document.getElementById('userInput');
        const sendBtn = document.getElementById('sendBtn');

        function appendMessage(role, text) {
            const isAI = role === 'ai';
            const msgDiv = document.createElement('div');

            msgDiv.className = `flex gap-4 max-w-3xl w-full mx-auto animate-[fadeIn_0.3s_ease] ${isAI ? '' : 'flex-row-reverse'}`;

            const avatar = document.createElement('div');
            avatar.className = `w-9 h-9 rounded-full flex items-center justify-center text-sm shrink-0 ${isAI ? 'bg-gradient-to-br from-indigo-500 to-blue-500 text-white' : 'bg-slate-700 text-slate-400'}`;
            avatar.textContent = isAI ? 'AI' : 'U';

            const content = document.createElement('div');
            const aiClasses = 'bg-slate-800 border border-slate-700 rounded-tr-xl rounded-br-xl rounded-bl-xl text-slate-100';
            const userClasses = 'bg-blue-500 text-white rounded-tl-xl rounded-tr-xl rounded-bl-xl';

            content.className = `p-4 md:p-6 leading-relaxed max-w-[85%] ${isAI ? aiClasses : userClasses}`;

            if (text.includes('```')) {
                text = text.replace(/```([\s\S]*?)```/g, '<pre class="bg-black p-4 rounded-lg overflow-x-auto my-2 text-sm"><code class="font-mono">$1</code></pre>');
            }

            content.innerHTML = text;

            msgDiv.appendChild(avatar);
            msgDiv.appendChild(content);

            chatContainer.appendChild(msgDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showTypingIndicator() {
            const id = 'typing-' + Date.now();
            const msgDiv = document.createElement('div');
            msgDiv.className = 'flex gap-4 max-w-3xl w-full mx-auto animate-[fadeIn_0.3s_ease]';
            msgDiv.id = id;

            const avatar = document.createElement('div');
            avatar.className = 'w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center text-sm text-white shrink-0';
            avatar.textContent = 'AI';

            const content = document.createElement('div');
            content.className = 'bg-slate-800 border border-slate-700 rounded-tr-xl rounded-br-xl rounded-bl-xl p-4 text-slate-100';
            content.innerHTML = `
                <div class="flex gap-1.5 py-1">
                    <div class="w-2 h-2 bg-slate-400 rounded-full typing-dot"></div>
                    <div class="w-2 h-2 bg-slate-400 rounded-full typing-dot"></div>
                    <div class="w-2 h-2 bg-slate-400 rounded-full typing-dot"></div>
                </div>
            `;

            msgDiv.appendChild(avatar);
            msgDiv.appendChild(content);
            chatContainer.appendChild(msgDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            return id;
        }

        function removeTypingIndicator(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        async function sendMessage() {
            const text = userInput.value.trim();
            if (!text) return;

            appendMessage('user', text);
            userInput.value = '';
            userInput.disabled = true;
            sendBtn.disabled = true;

            const typingId = showTypingIndicator();

            try {
                const response = await fetch('../api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: text,
                        model: document.getElementById('modelSelect').value
                    })
                });

                const data = await response.json();

                removeTypingIndicator(typingId);

                if (data.error) {
                    appendMessage('ai', 'Error: ' + data.error);
                } else {
                    appendMessage('ai', data.response);
                }

            } catch (err) {
                removeTypingIndicator(typingId);
                appendMessage('ai', 'Something went wrong. Please check your connection or API Key.');
                console.error(err);
            } finally {
                userInput.disabled = false;
                sendBtn.disabled = false;
                userInput.focus();
            }
        }

        sendBtn.addEventListener('click', sendMessage);

        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>

</html>