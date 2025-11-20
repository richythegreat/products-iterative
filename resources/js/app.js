document.addEventListener("DOMContentLoaded", () => {

    /* -----------------------------------------------
       TAG INPUT AUTOCOMPLETE DROPDOWN
    ------------------------------------------------ */
    const tagInput = document.getElementById("tagInput");
    const tagSuggestions = document.getElementById("tagSuggestions");
    const tagContainer = document.getElementById("tagContainer");
    const tagsHidden = document.getElementById("tagsHidden");

    if (tagInput) {

        let selectedTags = Array.from(document.querySelectorAll(".tag-chip"))
            .map(chip => chip.dataset.name);

        let currentFocus = -1; // for arrow navigation

        updateHidden();

        // MAIN AUTOCOMPLETE
        tagInput.addEventListener("input", function () {
            const q = this.value.trim();

            if (q.length < 1) {
                tagSuggestions.innerHTML = "";
                return;
            }

            fetch(`/tags/search?q=${q}`)
                .then(res => res.json())
                .then(tags => {
                    tagSuggestions.innerHTML = "";

                    tags.forEach(tag => {
                        const div = document.createElement("div");
                        div.textContent = tag.name;

                        div.onclick = () => addTag(tag.name);

                        tagSuggestions.appendChild(div);
                    });

                    currentFocus = -1;
                });
        });

        // ENTER, UP, DOWN navigation
        tagInput.addEventListener("keydown", function (e) {

            let items = tagSuggestions.querySelectorAll("div");

            // DOWN
            if (e.key === "ArrowDown") {
                currentFocus++;
                highlight(items);
            }

            // UP
            else if (e.key === "ArrowUp") {
                currentFocus--;
                highlight(items);
            }

            // ENTER
            else if (e.key === "Enter") {
                e.preventDefault();

                // if menu open → choose highlighted item
                if (currentFocus > -1 && items[currentFocus]) {
                    items[currentFocus].click();
                } else {
                    // if no highlight but user typed a new tag
                    const name = tagInput.value.trim().toLowerCase();
                    if (name.length > 0) addTag(name);
                }
            }
        });

        function highlight(items) {
            if (!items.length) return;

            items.forEach(x => x.classList.remove("active"));

            if (currentFocus >= items.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = items.length - 1;

            items[currentFocus].classList.add("active");
        }

        // Add a CHIP
        function addTag(name) {
            name = name.toLowerCase();

            if (!selectedTags.includes(name)) {
                selectedTags.push(name);

                const chip = document.createElement("span");
                chip.className = "tag-chip";
                chip.dataset.name = name;
                chip.innerHTML = `${name} <button class="remove-tag">x</button>`;

                tagContainer.appendChild(chip);
                updateHidden();
            }

            tagInput.value = "";
            tagSuggestions.innerHTML = "";
        }

        // Remove chip
        tagContainer.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-tag")) {
                let chip = e.target.parentElement;
                let name = chip.dataset.name;

                selectedTags = selectedTags.filter(t => t !== name);

                chip.remove();
                updateHidden();
            }
        });

        function updateHidden() {
            tagsHidden.value = JSON.stringify(selectedTags);
        }
    }


    /* -----------------------------------------------
       AJAX QUANTITY FOR SHOW PAGE
    ------------------------------------------------ */
    document.querySelectorAll('.ajax-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            fetch(this.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": this.querySelector('input[name="_token"]').value,
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success !== false) {
                    document.getElementById("quantity").textContent = data.quantity;
                }
            });
        });
    });

});
