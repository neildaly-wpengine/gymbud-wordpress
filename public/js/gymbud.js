(($) => {
  $(document).ready(() => {
    const hideExerciseSection = () =>
      (document.getElementById("exercise-section").style.display = "none");
    const showExerciseSection = () =>
      (document.getElementById("exercise-section").style.display = "block");
    const hidePostPreviewSection = () =>
      (document.getElementById("post-preview-section").style.display = "none");
    const showPostPreviewSection = () =>
      (document.getElementById("post-preview-section").style.display = "block");
    const getExerciseSelectDropdown = () =>
      document.getElementById("exercise-select");
    const resetExerciseSelectDropdown = () =>
      (getExerciseSelectDropdown().innerHTML =
        "<option value='none'>Select</option>");

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
      const makeExercisesRequest = async (category) => {
        const response = await fetch(
          `https://wger.de/api/v2/exercise/?language=2&category=${
            category.split("-")[0]
          }&format=json`,
          {
            method: "GET",
            headers: {
              Accept: "application/json",
            },
          }
        );
        const json = await response.json();
        const dropdown = getExerciseSelectDropdown();

        json.results.map((result) => {
          const option = document.createElement("option");
          option.value = `${result.id}-${result.name}`;
          option.innerHTML = result.name;
          dropdown.appendChild(option);
        });
      };

      hidePostPreviewSection();
      if (e.target.value === "none") {
        hideExerciseSection();
        return;
      }
      showExerciseSection();
      resetExerciseSelectDropdown();
      makeExercisesRequest(e.target.value);
    });

    $("#exercise-select").change(async (e) => {
      if (e.target.value === "none") {
        hidePostPreviewSection();
        return;
      }
      showPostPreviewSection();
      const makeExerciseRequest = async (exercise) => {
        const response = await fetch(
          `https://wger.de/api/v2/exerciseinfo/${
            exercise.split("-")[0]
          }/?format=json&language=2`,
          {
            method: "GET",
            headers: {
              Accept: "application/json",
            },
          }
        );
        const json = await response.json();
        return json;
      };
      const { name, id, description, category, muscles } =
        await makeExerciseRequest(e.target.value);
      // $.post(ajaxurl, {
      //   name,
      //   id,
      //   description,
      //   category,
      //   muscles,
      //   action: "gymbud-exercise-preview",
      //   nonce: gymbud.nonce,
      // });
      document.getElementById("post-title").value = name;
      document.getElementById("post-description").value = description;
    });
  });
})(jQuery);
