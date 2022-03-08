let form = document.getElementById("demo-plugin-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    let data = new FormData(form);

    // URL for sending async stuff to WordPress
    fetch("/wp-admin/admin-ajax.php", {
        method: "POST",
        body: data
    }).then(response => console.log(response));
})