let timer;

    document.getElementById("search").addEventListener("keyup", function () {
        clearTimeout(timer);

        const query = this.value;
        

        timer = setTimeout(() => {
            console.log(query);
            fetch(`/search?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => renderResults(data))
                    .catch(error => {
                        console.error('Search failed:', error);
                    });
        }, 300); // debounce
        


        if(query.length < 2){
        results.innerHTML = "";
        results.classList.remove("active");
        return;
      }
    });
   
    function renderResults(data) {

        const total =
            (data.cities?.length || 0) +
            (data.restaurants?.length || 0) +
            (data.categories?.length || 0) +
            (data.experts?.length || 0);

    const results = document.getElementById("results");
     

    let html = `
        <div class="search-dropdown-container">
            <div class="search-grid">
    `;

     if (total === 0) {
            results.innerHTML = `   <div class="search-dropdown-container">
            <div class="search-grid">             
                    No results found
                </div>
                <div class="recent-search-footer">

            <a id="clearSearch" href="#" class="clear-btn">
                Clear All
            </a>

        </div>
                </div> 
            `;
            if(html.trim()){
                results.classList.add("active");
            }else{
                results.classList.remove("active");
            }
            return;
        }


    // Restaurants
    if ((data.restaurants || []).length > 0) {
        html += `
        <div class="search-column">
            <h6>Items</h6>
        `;

        data.restaurants.forEach(r=>{
            html += `
            <a href="${r.url}" class="search-item">
                <img src="${r.image || '/static/images/restaurant_icon.png'}" 
                     class="item-img">

                <div class="item-content">
                    <div class="title">${r.name} at ${r.restaurant_name}</div>
                    <div class="subtitle">Item</div>
                </div>
            </a>
            `;
        });

        html += `</div>`;
    }

    // Cities
    if ((data.cities || []).length > 0) {
         html += `
        <div class="search-column">
            <h6>CITIES</h6>
        `;

        data.cities.forEach(c=>{
            html += `
            <a href="${c.url}" class="search-item">

                <div class="icon-circle">
                    📍
                </div>

                <div class="item-content">
                    <div class="title">${c.name}</div>
                    <div class="subtitle">City</div>
                </div>

            </a>
            `;
        });

        html += `</div>`;
    }


    // Experts
    
    if ((data.experts || []).length > 0) {


        html += `
        <div class="search-column">
            <h6>EXPERTS</h6>
        `;

        data.experts.forEach(e=>{

            html += `
            <a href="${e.url}" class="search-item">

                <img src="${e.image || '/static/images/expert_icon.png'}" 
                class="item-img">

                <div class="item-content">
                    <div class="title">${e.name}</div>
                    <div class="subtitle">Food Expert</div>
                </div>

            </a>
            `;
        });

        html += `</div>`;
    }

    // Categories
    if ((data.categories || []).length > 0) {
    
        html += `
        <div class="search-column">
            <h6>CATEGORIES</h6>
        `;

        data.categories.forEach(cat=>{

            html += `
            <a href="${cat.url}" class="search-item">

                <img src="${cat.image || '/static/images/fc_icon.png'}" 
                class="item-img">

                <div class="item-content">
                    <div class="title">${cat.name}</div>
                    <div class="subtitle">Food Category</div>
                </div>

            </a>
            `;
        });

        html += `</div>`;
    }


    // // Popular searches

    // html += `
    //     <div class="search-column">
    //         <h6>POPULAR SEARCHES</h6>

    //         <a href="#" class="trend-item">
    //             🔥 Best cafes in Bangalore
    //         </a>

    //         <a href="#" class="trend-item">
    //             🔥 Pizza near me
    //         </a>

    //         <a href="#" class="trend-item">
    //             🔥 South Indian restaurants
    //         </a>

    //         <a href="#" class="trend-item">
    //             🔥 Top rated restaurants
    //         </a>

    //     </div>
    // `;


    html += `
        </div>

        <div class="recent-search-footer">

            <a id="clearSearch" href="#" class="clear-btn">
                Clear All
            </a>

        </div>

    </div>
    `;


    results.innerHTML=html;

    if(html.trim()){
        results.classList.add("active");
    }else{
        results.classList.remove("active");
    }
}

// Clear everything on click

const searchInput = document.getElementById("search");
const results = document.getElementById("results");

document.addEventListener("click", function(e){

    if(e.target.id === "clearSearch"){

        e.preventDefault();

        // clear search input
        searchInput.value = "";

        // clear search result content
        results.innerHTML = "";

        // close results dropdown
        results.classList.remove("active");

        // put cursor back
        searchInput.focus();
    }

});
    