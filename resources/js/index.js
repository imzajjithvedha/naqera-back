(function () {
    "use strict";

    const form = document.getElementById("filter-form");
    if (!form) return;

    function debounce(fn, ms) {
        let timer;
        return () => {
            clearTimeout(timer);
            timer = setTimeout(fn, ms);
        };
    }

    function showLoading() {
        const loader = document.getElementById("table-loader");
        if (loader) loader.classList.replace("hidden", "flex");
    }

    form.querySelectorAll('input[type="text"]').forEach((el) => {
        el.addEventListener("input", debounce(() => {
            showLoading();
            form.submit();
        }, 400));
    });

    form.querySelectorAll("select").forEach((el) => {
        el.addEventListener("change", () => {
            showLoading();
            form.submit();
        });
    });

    // document.getElementById("clear-filter")?.addEventListener("click", () => {
    //     // form.querySelectorAll('input[type="text"]').forEach(
    //     //     (el) => (el.value = ""),
    //     // );
    //     // form.querySelectorAll("select").forEach((el) => (el.selectedIndex = 0));
    //     // form.submit();

    //     const baseUrl = window.location.origin + window.location.pathname;
    //     window.location.href = baseUrl;
    // });

    // Delete modal
    const deleteModal = document.getElementById("delete-modal");
    const deleteForm = document.getElementById("delete-form");

    if (deleteModal && deleteForm) {
        document.addEventListener("click", (e) => {
            const btn = e.target.closest(".delete-btn");
            if (!btn) return;
            deleteForm.action = btn.dataset.url;
            deleteModal.classList.replace("hidden", "flex");
        });

        function closeModal() {
            deleteModal.classList.replace("flex", "hidden");
        }

        document
            .getElementById("delete-cancel")
            ?.addEventListener("click", closeModal);
        deleteModal.addEventListener("click", (e) => {
            if (e.target === deleteModal) closeModal();
        });
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeModal();
        });
    }
    // Delete modal
})();
