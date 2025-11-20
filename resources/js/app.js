document.addEventListener("DOMContentLoaded", () => {

    /* ============================================
       AJAX QUANTITY BUTTONS (SHOW PAGE)
    ============================================ */
    document.querySelectorAll('.ajax-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // STOP RELOAD

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



    /* ============================================
       TAG SYSTEM (EDIT PAGE)
    ============================================ */

    const tagInput = document.getElementById("tagInput");
    const tagSuggestions = document.getElementById("tagSuggestions");
    const tagContainer = document.getElementById("tagContainer");
    const tagsHidden = document.getElementById("tagsHidden");

    if (tagInput) {
        let selectedTags = Array.from(document.querySelectorAll(".tag-chip"))
            .map(chip => chip.dataset.name);

        updateHidden();

        // Autocomplete
        tagInput.addEventListener("input", function () {
            const q = this.value;

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
                        div.onclick = () => {
                            addTag(tag.name);
                        };
                        tagSuggestions.appendChild(div);
                    });
                });
        });

        // Add tag chip
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

        // Remove tag chip
        tagContainer.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-tag")) {
                const chip = e.target.parentElement;
                const name = chip.dataset.name;

                selectedTags = selectedTags.filter(t => t !== name);
                chip.remove();
                updateHidden();
            }
        });

        // Sync to hidden field
        function updateHidden() {
            tagsHidden.value = JSON.stringify(selectedTags);
        }
    }

});
