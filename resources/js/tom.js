import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".se-select");

    elements.forEach((el) => {
        if (!el.tomselect) {
            new TomSelect(el, {
                create: false,
                sortField: { field: "text", direction: "asc" },
                placeholder:
                    el.getAttribute("placeholder") || "Select an option...",
                allowEmptyOption: true,
            });
        }
    });
});
