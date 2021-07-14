(($) => {
  $(document).ready(() => {
    const fetchCategories = async () => {
      const response = await fetch("https://wger.de/api/v2/exercisecategory/", {
        method: "GET",
        headers: {
          Accept: "application/json",
        },
      });
      const json = await response.json();
      const dropdown = document.getElementById("category-select");

      json.results.map((result) => {
        const option = document.createElement("option");
        option.value = `${result.id}-${result.name}`;
        option.innerHTML = result.name;
        dropdown.appendChild(option);
      });
    };

    fetchCategories();

    $("#category-select").change((e) => {
      if (e.target.value === "none") {
        return;
      }
      console.log("render exercises for", e.target.value);
    });
  });
})(jQuery);
