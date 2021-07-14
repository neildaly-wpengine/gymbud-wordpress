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
      const hideExerciseSection = () =>
        (document.getElementById("exercise-section").style.display = "none");
      const showExerciseSection = () =>
        (document.getElementById("exercise-section").style.display = "block");

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
        const dropdown = document.getElementById("exercise-select");
        dropdown.innerHTML = "<option value='none'>Select</option>";

        json.results.map((result) => {
          const option = document.createElement("option");
          option.value = `${result.id}-${result.name}`;
          option.innerHTML = result.name;
          dropdown.appendChild(option);
        });
      };

      if (e.target.value === "none") {
        hideExerciseSection();
        return;
      }
      showExerciseSection();
      makeExercisesRequest(e.target.value);
    });

    $("#exercise-select").change(async (e) => {
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
      console.log(name, id, description, category, muscles);
      $.post(ajaxurl, {
        name,
        action: "gymbud-exercise-preview",
        nonce: gymbud.nonce,
      });
    });
  });
})(jQuery);
