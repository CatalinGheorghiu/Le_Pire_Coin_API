/**
 **  DOM ELEMENTS
 */
const container = document.querySelector(".container");
const row = document.querySelector(".row");
const url = "http://localhost/Le_pire_coin_API/post";

/**
 ** FUNCTIONS
 */

const getData = () => {
    fetch(url)
        .then((res) => {
            return res.json();
        })
        .then((data) => {
            let posts = data.data;
            console.log(posts);

            for (let i = 0; i < posts.length; i++) {
                let postData = posts[i];
                console.log(postData);

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

                let btnSeeAuthor = document.createElement("button");
                btnSeeAuthor.classList.add("btn", "btn-success", "m-2");
                btnSeeAuthor.textContent = "Details";

                let cardFooter = document.createElement("div");
                cardFooter.classList.add("card-footer");

                let cardFooterText = document.createElement("small");
                cardFooterText.classList.add("text-muted");
                cardFooterText.innerHTML = `
                Added on ${postData.creation_time} by <span class="bold">${postData.name}</span>`;

                // let btnDelete = document.createElement("button");
                // btnDelete.classList.add("btn", "btn-danger", "m-2");
                // btnDelete.textContent = "Delete";

                // let btnSeeAnnounces = document.createElement("button");
                // btnSeeAnnounces.classList.add(
                //     "btn",
                //     "btn-primary",
                //     "btn-block",
                //     "m-2"
                // );
                // btnSeeAnnounces.textContent = `See ${postData.name}'s announces`;

                card.append(image);

                cardBody.append(cardTitle);
                cardBody.append(cardText);

                card.append(cardBody);

                cardFooter.append(cardFooterText);
                cardFooter.append(btnSeeAuthor);
                card.append(cardFooter);
                cardDeck.append(card);

                col.append(cardDeck);
                row.append(col);
            }
        });
};
getData();

// Get the current year for the copyright
$("#year").text(new Date().getFullYear());
