const form = document.querySelector(".typing-area"),
	inputField = form.querySelector(".input-field"),
	chatBox = document.querySelector(".chat-box"),
	incomingIdInput = document.querySelector("#incoming_id");

form.onsubmit = (e) => {
	e.preventDefault();

	let xhr = new XMLHttpRequest();
	xhr.open("POST", "php/insert-chat.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			inputField.value = "";
			scrollToBottom();
		}
	};

	let formData = new FormData(form);
	xhr.send(formData);
};

// Fetch chat every 500ms without refreshing the user list
setInterval(() => {
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "php/get-chat.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			chatBox.innerHTML = xhr.response;
			scrollToBottom();
		}
	};
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("incoming_id=" + incomingIdInput.value);
}, 500);

function scrollToBottom() {
	chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom of chat
}
