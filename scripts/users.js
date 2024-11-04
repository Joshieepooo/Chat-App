const searchBar = document.querySelector(".users .search input"),
	searchIcon = document.querySelector(".users .search button"),
	usersList = document.querySelector(".users .users-list");

searchIcon.onclick = () => {
	searchBar.classList.toggle("active");
	searchBar.focus();
	searchIcon.classList.toggle("active");
	searchBar.value = "";
};

// Search bar keyup event
searchBar.onkeyup = () => {
	let searchTerm = searchBar.value;
	if (searchTerm != "") {
		searchBar.classList.add("active");
	} else {
		searchBar.classList.remove("active");
	}
	// AJAX request for search
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "php/search.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				usersList.innerHTML = xhr.response;
			}
		}
	};
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("searchTerm=" + searchTerm);
};

// Fetch users list every 500ms
setInterval(() => {
	let xhr = new XMLHttpRequest();
	xhr.open("GET", "php/users.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				if (!searchBar.classList.contains("active")) {
					usersList.innerHTML = xhr.response;
				}
			}
		}
	};
	xhr.send();
}, 500);
