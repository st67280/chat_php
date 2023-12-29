function loadFAQ() {
    fetch('faq.json')
        .then(response => response.json())
        .then(data => {
            const faqContainer = document.getElementById('faq-container');
            data.faq.forEach(item => {
                const button = document.createElement('button');
                button.textContent = item.question;
                button.addEventListener('click', () => showAnswer(item.answer));
                faqContainer.appendChild(button);
            });
        });
}

function showAnswer(answer) {
    const answerContainer = document.getElementById('answer-container');
    answerContainer.innerHTML = `<p>${answer}</p>`;
}

function submitMessage() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    const data = {
        name: name,
        email: email,
        message: message
    };

    fetch('http://137.184.45.201:8000/submit_message.php', {
        method: 'POST',
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Message sent successfully');
                document.getElementById('new-question-form').reset();
            } else {
                alert('Message not sent. Please try again.');
            }
        });
}

function loadMessages() {
    fetch('http://137.184.45.201:8000/submit_message.php')
        .then(response => response.json())
        .then(messages => {
            const messagesContainer = document.getElementById('messages-container');
            messagesContainer.innerHTML = ''; // Очистить предыдущие сообщения
            messages.forEach(msg => {
                const messageDiv = document.createElement('div');
                messageDiv.innerHTML = `<p>Name: ${msg.name}</p><p>Email: ${msg.email}</p><p>Message: ${msg.message}</p> <hr>`;
                messagesContainer.appendChild(messageDiv);
            });
        });
}

document.getElementById('show-messages').addEventListener('click', loadMessages);

document.getElementById('about-us-button').addEventListener('click', function() {
    window.location.href = 'about-us.html';
});

document.getElementById('back-button').addEventListener('click', function() {
    window.location.href = '137.184.45.201:3000/products';
});

document.addEventListener('DOMContentLoaded', () => {
    loadFAQ();
    document.getElementById('new-question-form').addEventListener('submit', (e) => {
        e.preventDefault();
        submitMessage();
    });
});
