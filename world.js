document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById("lookup"); 

    button.addEventListener("click", function() {
        var userInput = document.getElementById("country").value; 
        var result = document.getElementById("result");

        fetch('world.php?country=' + userInput)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                result.innerHTML = data;
            })
    })
})


