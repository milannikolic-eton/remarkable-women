    // Wait for the DOM to load
document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById("header");

        // Set the offset position of the header
        const sticky = header.offsetTop;

        // Add or remove the sticky-header class based on scroll position
        window.onscroll = function() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky-header");
            } else {
                header.classList.remove("sticky-header");
            }
        };

        document.getElementById('mob-menu-bar').addEventListener('click', function () {
            this.classList.toggle('change');
            document.querySelector('.header nav').classList.toggle('menu-open');
            document.body.classList.toggle('menu-open');
        });
            
}); //wait for DOM



document.addEventListener("DOMContentLoaded", function () {
    const select = document.querySelector(".gt_selector");
    
    // Create the custom dropdown container
    const customDropdown = document.createElement("div");
    customDropdown.classList.add("custom-dropdown");

    // Create the currently selected item
    const dropdownSelected = document.createElement("div");
    dropdownSelected.classList.add("dropdown-selected");
    dropdownSelected.textContent = select.options[select.selectedIndex]?.text || "Select Language";
    customDropdown.appendChild(dropdownSelected);

    // Create the options container
    const dropdownOptions = document.createElement("div");
    dropdownOptions.classList.add("dropdown-options");
    customDropdown.appendChild(dropdownOptions);

    // Populate the options
    Array.from(select.options).forEach((option) => {
        const dropdownItem = document.createElement("div");
        dropdownItem.classList.add("dropdown-item");
        dropdownItem.textContent = option.text;
        dropdownItem.setAttribute("data-value", option.value);

        // Check if the option matches the selected text
        if (option.text === dropdownSelected.textContent) {
            dropdownItem.style.display = "none"; // Hide the item
        }

        dropdownItem.addEventListener("click", function () {
            // Update the original select
            select.value = this.getAttribute("data-value");
            // Update the displayed selected item
            dropdownSelected.textContent = this.textContent;
            // Trigger change event
            select.dispatchEvent(new Event("change"));
            // Hide the options
            dropdownOptions.classList.remove("show");

            // Update the visibility of dropdown items
            Array.from(dropdownOptions.children).forEach(item => {
                item.style.display = item.textContent === this.textContent ? "none" : "block";
            });
        });

        dropdownOptions.appendChild(dropdownItem);
    });

    // Insert the custom dropdown after the select
    select.parentNode.insertBefore(customDropdown, select);
    // Hide the original select
    select.style.display = "none";

    // Toggle the dropdown
    dropdownSelected.addEventListener("click", function () {
        dropdownOptions.classList.toggle("show");
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!customDropdown.contains(event.target)) {
            dropdownOptions.classList.remove("show");
        }
    });
});





document.addEventListener("DOMContentLoaded", function () {
    const select = document.querySelector("#stories-dropdown");

    // Create the custom dropdown container
    const customDropdown = document.createElement("div");
    customDropdown.classList.add("custom-dropdown");

    // Create the currently selected item
    const dropdownSelected = document.createElement("div");
    dropdownSelected.classList.add("dropdown-selected");
    dropdownSelected.textContent = select.options[select.selectedIndex]?.text || "Select a Story";
    customDropdown.appendChild(dropdownSelected);

    // Create the options container
    const dropdownOptions = document.createElement("div");
    dropdownOptions.classList.add("dropdown-options");
    customDropdown.appendChild(dropdownOptions);

    // Populate the options
    Array.from(select.options).forEach((option) => {
        const dropdownItem = document.createElement("div");
        dropdownItem.classList.add("dropdown-item");
        dropdownItem.textContent = option.text;
        dropdownItem.setAttribute("data-value", option.value);
        dropdownItem.addEventListener("click", function () {
            // Update the original select
            select.value = this.getAttribute("data-value");
            // Trigger the redirection function
            redirectToStory(select);
            // Update the displayed selected item
            dropdownSelected.textContent = this.textContent;
            // Hide the options
            dropdownOptions.classList.remove("show");
        });
        dropdownOptions.appendChild(dropdownItem);
    });

    // Insert the custom dropdown after the select
    select.parentNode.insertBefore(customDropdown, select);
    // Hide the original select
    select.style.display = "none";

    // Toggle the dropdown
    dropdownSelected.addEventListener("click", function () {
        dropdownOptions.classList.toggle("show");
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        if (!customDropdown.contains(event.target)) {
            dropdownOptions.classList.remove("show");
        }
    });
});

// Function for redirection (already defined in your HTML)
function redirectToStory(selectElement) {
    const url = selectElement.value;
    if (url) {
        window.location.href = url; // Redirect to the selected URL
    }
}
