/**
 **  DOM ELEMENTS
 */
const container = document.querySelector(".container");
const row = document.querySelector(".row");
const urlPosts = "http://localhost/Le_pire_coin_API/post";

/**
 ** FUNCTIONS
 */

const getData = () => {
    fetch(urlPosts)
        .then((res) => {
            return res.json();
        })
        .then((data) => {
            let posts = data.data;
            // console.log(posts);

            for (let i = 0; i < posts.length; i++) {
                let postData = posts[i];
                // console.log(postData);

                let col = document.createElement("div");
                col.classList.add(
                    "col-md-6",
                    "col-sm-12",
                    "col-lg-4",
                    "col-xl-4",
                    "mb-4"
                );

                let cardDeck = document.createElement("div");
                cardDeck.setAttribute("style", "height: 100%;");
                cardDeck.classList.add("card-deck");

                let card = document.createElement("div");
                card.classList.add("card");

                let image = document.createElement("img");
                image.classList.add("card-img-top");
                image.setAttribute("style", "height: 250px;");
                if (postData.name == "Ionut Gheorgiu") {
                    image.setAttribute("src", "img/php.jpg");
                } else {
                    image.setAttribute("src", "img/art.jpg");
                }

                let cardBody = document.createElement("div");
                cardBody.classList.add("card-body");

                let cardTitle = document.createElement("h5");
                cardTitle.classList.add("card-title");
                cardTitle.innerHTML = `<span class="bold">${postData.title}</span>`;

                let cardText = document.createElement("p");
                cardText.classList.add("card-text");
                cardText.textContent = postData.body;

                let btnDetails = document.createElement("button");
                btnDetails.classList.add("btn", "btn-success", "m-2");
                btnDetails.textContent = "Details";

                let cardFooter = document.createElement("div");
                cardFooter.classList.add("card-footer");

                let cardFooterText = document.createElement("small");
                cardFooterText.classList.add("text-muted");
                cardFooterText.innerHTML = `
                Added on ${postData.creation_time} by <span class="bold">${postData.name}</span>`;

                card.append(image);

                cardBody.append(cardTitle);
                cardBody.append(cardText);

                card.append(cardBody);

                cardFooter.append(cardFooterText);
                cardFooter.append(btnDetails);
                card.append(cardFooter);
                cardDeck.append(card);

                col.append(cardDeck);
                row.append(col);

                btnDetails.addEventListener("click", () => {
                    console.log(postData);
                    document.querySelector(".container").innerHTML = " ";
                    document.querySelector(".row").innerHTML = " ";
                    getPost(postData.id);
                });
            }
        });
};
getData();

const getPost = (id) => {
    fetch(`http://localhost/Le_pire_coin_API/post/${id}`)
        .then((res) => {
            return res.json();
        })
        .then((data) => {
            row.innerHTML = `
            <div class="col-md-7 mb-3 mt-5">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-interval="3000">
                            <img src="img/volvo-1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="img/volvo-2.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-interval="3000">
                            <img src="img/volvo-3.jpeg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        
        <div class="col-md-4 offset-md-1 ">
        <p class="new-arrival text-center">NEW</p>
        <h2>${data.title}</h2>
        <p>Product code: ${data.id}</p>
        <p>General Informations: </p>
        <hr>
        <p>Price: <b class="price">1500 &euro;</b></p>
        <p><b>Availability:</b> In stock</p>
        <p><b>Condition:</b> Used  <img src="img/stars.png" class="stars"></p>
        <p><b>Brand:</b> Kawasaki</p>
        <label>Quantity:</label>
        <input type="number" value="1">
        <button class="btn btn-default cart">Add to cart</button>
    </div>
            `;
        });
};

// Get the current year for the copyright
$("#year").text(new Date().getFullYear());
