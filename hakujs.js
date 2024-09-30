
    // Funktio, joka näyttää kaikki tulokset
    function displayResults(filteredData) {
        const resultsList = document.getElementById("results");
        resultsList.innerHTML = ''; // Tyhjennetään lista
        filteredData.forEach((item, index) => {
            const listItem = document.createElement("li");
            listItem.innerHTML = `<strong>${item.data.results.title}</strong> <br> Sivumäärä: ${item.pageCount}`;
            // Joka toinen item saa luokan "even" ja joka toinen "odd"
            listItem.className = (index % 2 === 0) ? 'even' : 'odd';
            resultsList.appendChild(listItem);
        });
    }

    function displayComics(data) {
        const resultsList = document.getElementById("results");
        resultsList.innerHTML = ''; // Clear previous results

        data.data.results.forEach((item, index) => {
            const listItem = document.createElement("li");
            listItem.innerHTML = `<strong>${item.title}</strong> <br> Sivumäärä: ${item.pageCount}`;
            // Joka toinen item saa luokan "even" ja joka toinen "odd"
            listItem.className = (index % 2 === 0) ? 'even' : 'odd';
            resultsList.appendChild(listItem);
        });



        /*
        const resultsList = document.getElementById("results");
        resultsList.innerHTML = ''; // Clear previous results
        
        data.data.results.forEach((item, index) => {
            const row = document.createElement("tr");
            row.className = (index % 2 === 0) ? 'even' : 'odd'; // Alternate row color
            
            const titleCell = document.createElement("td");
            const pageCountCell = document.createElement("td");

            titleCell.textContent = item.title || "No title available";
            pageCountCell.textContent = item.pageCount || "N/A";

            row.appendChild(titleCell);
            row.appendChild(pageCountCell);
            resultsList.appendChild(row);
            
        });
        */
    }

    // Suodatusfunktio hakua varten
    function filterResults() {
        // Fetching the JSON data and displaying it

        /*
        fetch('db.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Verkkovirhe tiedon hakemisessa');
            }
            return response.json();
        })
        .then(data => {



            const searchInput = document.getElementById("search").value.toLowerCase();
            const filteredData = data.filter(item => item.name.toLowerCase().includes(searchInput));
            displayResults(filteredData);
        })
        .catch(error => {
            console.error('Virhe datan haussa:', error);
        });
        */
    }


    

    // Näytetään kaikki tulokset, kun sivu ladataan
    window.onload = () => {

        fetch('comics.json')
        .then(response => response.json())
        .then(data => {
            displayComics(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

        /*
        fetch('db.json')
        .then(response => response.json())
        .then(data => {
            displayResults(data);
        })
        .catch(error => {
            console.error('Virhe datan haussa:', error);
        });
        */
    };




        
    const url = 'https://api.finna.fi/api/v1/search?type=AllFields&sort=relevance%2Cid%20asc&page=1&limit=20&prettyPrint=false&lng=fi';


