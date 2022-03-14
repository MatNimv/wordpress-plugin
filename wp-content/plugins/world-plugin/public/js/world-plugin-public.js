"use strict";

function alertWindow(message){
    alert(`${message}`); // this is the message in ""
}

let form = document.getElementById("world-plugin-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    let data = new FormData(form);

    // URL for sending async stuff to WordPress
    fetch("/wp-admin/admin-ajax.php", {
        method: "POST",
        body: data
    }).then(response => {
        console.log(response)
        if (response.status == 404) {
            alertWindow("Submitted country is not in current region. Also check your spelling.");
        } else {
            alertWindow("You submitted a country!");

        }
    } );
})




