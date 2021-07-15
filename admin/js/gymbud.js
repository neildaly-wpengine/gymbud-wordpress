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
    const createFrontImageMarkup = (frontImages) => {
      const mainImage =
        "https://wger.de/static/images/muscles/muscular_system_front.svg";
      return `<div class="muscle-diagram-front" style="background-image: ${frontImages.map(
        (image) => `url(${image}),`
      )} url(${mainImage})"></div>`;
    };

    const createBackImageMarkup = (backImages) => {
      const mainImage =
        "https://wger.de/static/images/muscles/muscular_system_back.svg";
      return `<div class="muscle-diagram-back" style="background-image: ${backImages.map(
        (image) => `url(${image}),`
      )} url(${mainImage})"></div>`;
    };

    const renderMuscleDiagrams = (muscles) => {
      const frontImages = [];
      const backImages = [];

      muscles.forEach((muscle) => {
        const image = `https://wger.de/static/images/muscles/main/muscle-${muscle.id}.svg`;
        muscle.is_front ? frontImages.push(image) : backImages.push(image);
      });

      let result = "";
      if (frontImages.length > 0) {
        result += createFrontImageMarkup(frontImages);
      }
      if (backImages.length > 0) {
        result += createBackImageMarkup(backImages);
      }
      return result;
    };

    const generateDescriptionMarkup = (description, { name }, muscles) => {
      const muscleGroups = muscles
        .map((muscle) => `<div class="muscle-group">${muscle.name}</div>`)
        .join(" ");
      return `
        <div>
          <h3 class="description-category">${name}</h3>
          <div class="muscle-groups">
            ${muscleGroups}
          </div>
          <div class="description-exercise-description">
          ${description}
          </div>
          <div class="diagram-container">${renderMuscleDiagrams(muscles)}</div>
        </div>
      `.trim();
    };
    const setLinkToPost = (link) => {
      document.getElementById("view-post-link").href = link;
    };
    const showSuccessPanel = () =>
      (document.getElementById("success-section").style.display = "block");
    const hideSuccessPanel = () =>
      (document.getElementById("success-section").style.display = "none");

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
      hideSuccessPanel();
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

      const { name, description, category, muscles } =
        await makeExerciseRequest(e.target.value);
      document.getElementById("post-title").value = name;
      document.getElementById("post-description").value =
        generateDescriptionMarkup(description, category, muscles);
    });

    $(".post-preview-section").on("submit", (e) => {
      e.preventDefault();
      $.post(
        ajaxurl,
        {
          title: document.getElementById("post-title").value,
          description: document.getElementById("post-description").value,
          action: "gymbud-exercise-submit",
          nonce: gymbud.nonce,
        },
        (data) => {
          if (!data.success) {
            // todo
            return;
          }
          setLinkToPost(data.data.link);
          showSuccessPanel();
        }
      );
    });
  });
})(jQuery);
