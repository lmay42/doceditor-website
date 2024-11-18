function togglecreatepanel() {
	var panel = document.getElementById("createpanel")

	if (panel.style.display == "block") panel.style.display = "none";
	else panel.style.display = "block";
}

function create_doc(name) {
	window.location.href = "https://docedit.shwitter.ca/?edit="+name;
}
