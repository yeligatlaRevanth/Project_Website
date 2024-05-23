<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .modal-content {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow-y: auto;
            max-height: 90vh;
        }

        .title,
        .desc,
        .inputGroup {
            margin-bottom: 20px;
        }

        .inputGroup label {
            margin-right: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            font-size: 16px;
        }

        .placeholder {
            position: relative;
            text-align: center;
            border: 2px solid #aaa;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .uploaded-image-container {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .uploaded-image-container img {
            max-width: 100%;
            display: block;
            margin: auto;
        }

        .crossIcon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            background: #f79402;
            padding: 5px;
            border-radius: 50%;
            color: white;
        }

        .ingredientBar,
        .directionBar {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .ingredientGroup,
        .directionGroup {
            flex: 1;
            margin-right: 10px;
        }

        .buttons {
            display: flex;
        }

        .addButton,
        .addDirectionButton {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #f79402;
            color: white;
            margin-left: 10px;
        }

        .crossButton {
            padding: 10px;
            border: none;
            background: none;
            cursor: pointer;
        }

        .moveUpButton,
        .moveDownButton {
            padding: 5px;
            border: none;
            background: none;
            cursor: pointer;
            color: #f79402;
        }

        .submitContainer {
            text-align: center;
            margin-top: 20px;
        }

        .submitButton {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #f79402;
            color: white;
            font-size: larger;
        }
    </style>
</head>

<body>
    <form action="{{ route('dishadd.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div id="cont" class="title">
                <input type="text" id="titleInput" name="title" placeholder="Title">
            </div>
            <div id="desc" class="desc">
                <input type="text" id="description" name="description" placeholder="Brief description of your recipe">
            </div>
            <div class="inputGroup">
                <label for="timeInput">Time</label>
                <input type="text" id="timeInput" name="time" placeholder="How long to make (e.g. 1 hour)">
            </div>
            <div class="inputGroup">
                <label for="yieldInput">Yield</label>
                <input type="text" name="dish_yield" id="yieldInput" placeholder="Amount it makes (e.g. 2 servings)">
            </div>

            <div id="imageContainer" class="placeholder">
                <label for="uploadInput">
                    <i id="uploadedImage" class="fas fa-bowl"></i>
                    <span style="color:#f79402">Click to upload a photo you took yourself</span>
                </label>
                <input type="file" id="uploadInput" name="image" style="display: none;">
            </div>
            <div id="uploadedImageContainer" class="uploaded-image-container"></div>
            <div id="content" class="posi">
                <label class="mt-3" for="ingredientsInput" style="color:#f79402; font-size:larger">Ingredients</label>
                <div class="ingredientBars">
                    <div class="ingredientBar">
                        <div class="ingredientGroup">
                            <input type="text" name="ingredients[0]" placeholder="First ingredient">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button type="button" class="addButton">Add</button>
                </div>
            </div>
            <div id="directions" class="posi">
                <label class="mt-3" for="directionsInput" style="color:#f79402; font-size:larger">Directions</label>
                <div class="directionBars">
                    <div class="directionBar">
                        <div class="directionGroup">
                            <input type="text" name="directions[0]" placeholder="First step">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button type="button" class="addDirectionButton">Add</button>
                </div>
            </div>
            <div class="submitContainer">
                <input type="submit" name="submit_dish" value="Submit" class="submitButton">
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            console.log("Javascript Working");
            // Image upload and display
            const uploadInput = document.getElementById('uploadInput');
            const imageContainer = document.getElementById('imageContainer');
            const uploadedImageContainer = document.getElementById('uploadedImageContainer');

            function resetUpload() {
                imageContainer.style.display = 'block';
                uploadedImageContainer.style.display = 'none';
                document.getElementById('uploadInput').addEventListener('change', uploadHandler);
            }

            function uploadHandler(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        uploadedImageContainer.innerHTML = `<img src="${e.target.result}" alt="Recipe Image"><i class="fas fa-times crossIcon" id="removeImage"></i>`;
                        uploadedImageContainer.style.display = 'block';
                        imageContainer.style.display = 'none';
                        document.getElementById('removeImage').addEventListener('click', resetUpload);
                    };
                    reader.readAsDataURL(file);
                }
            }

            uploadInput.addEventListener('change', uploadHandler);

            // Form submission
            const form = document.querySelector('form');
            const submitButton = document.querySelector('.submitButton');

            submitButton.addEventListener('click', function(event) {
                // Check if an image is uploaded
                if (!uploadInput.value) {
                    // If no image is uploaded, display the placeholder icon
                    const placeholderIcon = '<i class="fa-solid fa-bowl-food"></i>'; // Change the icon as needed
                    uploadedImageContainer.innerHTML = placeholderIcon;
                    uploadedImageContainer.style.display = 'block';
                    imageContainer.style.display = 'none';
                } else {
                    // If an image is uploaded, submit the form
                    form.submit();
                }
            });

            // Ingredient section
            const addButton = document.querySelector('.addButton');
            const ingredientBars = document.querySelector('.ingredientBars');
            let ingredientIndex = 1;

            addButton.addEventListener('click', function() {
                const lastIngredient = ingredientBars.querySelector('.ingredientGroup input:last-of-type');
                if (lastIngredient && lastIngredient.value.trim() === "") {
                    alert("Field Cannot Be Empty");
                    return;
                }

                const newIngredientBar = document.createElement('div');
                newIngredientBar.classList.add('ingredientBar');

                const ingredientGroup = document.createElement('div');
                ingredientGroup.classList.add('ingredientGroup');

                const ingredientInput = document.createElement('input');
                ingredientInput.type = 'text';
                ingredientInput.placeholder = 'Next Ingredient';
                ingredientInput.classList.add('ingredientInput');
                ingredientInput.name = `ingredients[${ingredientIndex}]`;

                const moveUpButton = document.createElement('button');
                moveUpButton.classList.add('moveUpButton');
                moveUpButton.innerHTML = '<i class="fas fa-arrow-up"></i>';

                const moveDownButton = document.createElement('button');
                moveDownButton.classList.add('moveDownButton');
                moveDownButton.innerHTML = '<i class="fas fa-arrow-down"></i>';

                const crossButton = document.createElement('button');
                crossButton.classList.add('crossButton');
                crossButton.innerHTML = '<i class="fas fa-times"></i>';

                const ingredientCountText = document.createElement('span');
                ingredientCountText.classList.add('ingredientCount');
                ingredientCountText.innerText = ingredientIndex + 1;

                newIngredientBar.appendChild(ingredientCountText);
                newIngredientBar.appendChild(ingredientGroup);
                ingredientGroup.appendChild(ingredientInput);
                newIngredientBar.appendChild(moveUpButton);
                newIngredientBar.appendChild(moveDownButton);
                newIngredientBar.appendChild(crossButton);
                ingredientBars.appendChild(newIngredientBar);

                crossButton.addEventListener('click', function() {
                    this.parentElement.remove();
                    updateIngredientCounters();
                });

                moveUpButton.addEventListener('click', function() {
                    const current = this.parentElement;
                    const previous = current.previousElementSibling;
                    if (previous) {
                        ingredientBars.insertBefore(current, previous);
                    }
                    updateIngredientCounters();
                });

                moveDownButton.addEventListener('click', function() {
                    const current = this.parentElement;
                    const next = current.nextElementSibling;
                    if (next) {
                        ingredientBars.insertBefore(next, current);
                    }
                    updateIngredientCounters();
                });

                ingredientIndex++;
                updateIngredientCounters();
            });

            function updateIngredientCounters() {
                const counters = document.querySelectorAll('.ingredientCount');
                counters.forEach((counter, index) => {
                    counter.innerText = index + 1;
                    const input = ingredientBars.querySelector(`input[name="ingredients[${index}]"]`);
                    if (input) {
                        input.name = `ingredients[${index}]`;
                    }
                });
            }

            // Directions section
            const addDirectionButton = document.querySelector('.addDirectionButton');
            const directionBars = document.querySelector('.directionBars');
            let directionIndex = 1;

            addDirectionButton.addEventListener('click', function() {
                const lastDirection = directionBars.querySelector('.directionGroup input:last-of-type');
                if (lastDirection && lastDirection.value.trim() === "") {
                    alert("Field Cannot Be Empty");
                    return;
                }

                const newDirectionBar = document.createElement('div');
                newDirectionBar.classList.add('directionBar');

                const directionGroup = document.createElement('div');
                directionGroup.classList.add('directionGroup');

                const directionInput = document.createElement('input');
                directionInput.type = 'text';
                directionInput.placeholder = 'Next Step';
                directionInput.classList.add('directionInput');
                directionInput.name = `directions[${directionIndex}]`;

                const moveUpButton = document.createElement('button');
                moveUpButton.classList.add('moveUpButton');
                moveUpButton.innerHTML = '<i class="fas fa-arrow-up"></i>';

                const moveDownButton = document.createElement('button');
                moveDownButton.classList.add('moveDownButton');
                moveDownButton.innerHTML = '<i class="fas fa-arrow-down"></i>';

                const crossButton = document.createElement('button');
                crossButton.classList.add('crossButton');
                crossButton.innerHTML = '<i class="fas fa-times"></i>';

                const directionCountText = document.createElement('span');
                directionCountText.classList.add('directionCount');
                directionCountText.innerText = directionIndex + 1;

                newDirectionBar.appendChild(directionCountText);
                newDirectionBar.appendChild(directionGroup);
                directionGroup.appendChild(directionInput);
                newDirectionBar.appendChild(moveUpButton);
                newDirectionBar.appendChild(moveDownButton);
                newDirectionBar.appendChild(crossButton);
                directionBars.appendChild(newDirectionBar);

                crossButton.addEventListener('click', function() {
                    this.parentElement.remove();
                    updateDirectionCounters();
                });

                moveUpButton.addEventListener('click', function() {
                    const current = this.parentElement;
                    const previous = current.previousElementSibling;
                    if (previous) {
                        directionBars.insertBefore(current, previous);
                    }
                    updateDirectionCounters();
                });

                moveDownButton.addEventListener('click', function() {
                    const current = this.parentElement;
                    const next = current.nextElementSibling;
                    if (next) {
                        directionBars.insertBefore(next, current);
                    }
                    updateDirectionCounters();
                });

                directionIndex++;
                updateDirectionCounters();
            });

            function updateDirectionCounters() {
                const counters = document.querySelectorAll('.directionCount');
                counters.forEach((counter, index) => {
                    counter.innerText = index + 1;
                    const input = directionBars.querySelector(`input[name="directions[${index}]"]`);
                    if (input) {
                        input.name = `directions[${index}]`;
                    }
                });
            }
        });
    </script>
</body>

</html>