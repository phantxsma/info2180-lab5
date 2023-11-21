document.addEventListener("DOMContentLoaded", function() {
    var country_button = document.getElementById("country-lookup"); 
    var cities_button = document.getElementById("city-lookup"); 

    country_button.addEventListener("click", function() {
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

    cities_button.addEventListener("click", function(){
        var userInput = document.getElementById("country").value; 
        var result = document.getElementById("result");

        fetch('world.php?country=' + userInput + '&lookup=cities')
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



