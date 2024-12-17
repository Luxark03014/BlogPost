<section class="mt-16 bg-gray-800 p-6 rounded-lg shadow-lg">
    <h3 class="text-2xl font-semibold text-purple-400 mb-4">Chat Global</h3>
    <div class="bg-gray-700 p-4 rounded-lg text-white h-64 overflow-y-scroll mb-4" id="chatBox">

    </div>
    <form id="chatForm" class="flex">
        <input type="text" id="messageInput" class="flex-grow bg-gray-900 text-gray-100 px-4 py-2 rounded-l-lg focus:outline-none" placeholder="Escribe un mensaje..." required>
        <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-r-lg">Enviar</button>
    </form>
</section>
<script>
// Función para cargar mensajes desde el servidor
async function loadMessages() {
    try {
        const response = await fetch('/blog/api/chat/messages');
        const messages = await response.json();

        const chatBox = document.getElementById('chatBox');
        chatBox.innerHTML = ''; // Limpia el chat antes de agregar nuevos mensajes

        messages.forEach(msg => {
            const messageElement = document.createElement('div');
            messageElement.textContent = `[${msg.created_at}] ${msg.name}: ${msg.message}`;
            chatBox.appendChild(messageElement);
        });

        // Desplazarse al final del chat
        chatBox.scrollTop = chatBox.scrollHeight;
    } catch (error) {
        console.error('Error loading messages:', error);
    }
}


document.addEventListener('DOMContentLoaded', loadMessages);
// Función para manejar el envío del formulario
document.getElementById('chatForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Evita el recargo de página

    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value;

    if (message.trim() === '') return; // No envíes mensajes vacíos

    try {
        const response = await fetch('blog/api/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message })
        });

        if (response.ok) {
            messageInput.value = ''; // Limpia el campo de entrada
            loadMessages(); // Actualiza los mensajes en el chat
        } else {
            console.error('Error sending message:', await response.text());
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

</script>