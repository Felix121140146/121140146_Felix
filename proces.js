document.getElementById("registrationForm").addEventListener("submit", function (event) {
    const name = document.getElementById("name").value.trim();
    const password = document.getElementById("password").value.trim();
    const fileInput = document.getElementById("uploadFile").files[0];

    // Validasi panjang nama dan password
    if (name.length < 3) {
        alert("Nama harus lebih dari 3 karakter.");
        event.preventDefault();
    }
    if (password.length < 6) {
        alert("Kata sandi harus minimal 6 karakter.");
        event.preventDefault();
    }

    // Validasi file
    if (fileInput) {
        const allowedTypes = ["application/pdf"];
        if (!allowedTypes.includes(fileInput.type)) {
            alert("Hanya file PDF yang diperbolehkan.");
            event.preventDefault();
        }
        if (fileInput.size > 2 * 1024 * 1024) { // Batas 2MB
            alert("Ukuran file maksimal 2MB.");
            event.preventDefault();
        }
    } else {
        alert("File harus diunggah.");
        event.preventDefault();
    }
});
